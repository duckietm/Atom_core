<?php

namespace Atom\Core\Http\Controllers;

use App\Events\UserRegister;
use Atom\Core\Http\Requests\RegisterRequest;
use Atom\Core\Models\ClaimedReferralLog;
use Atom\Core\Models\Referral;
use Atom\Core\Models\User;
use Atom\Core\Models\WebsiteSetting;
use Atom\Rcon\Services\RconService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|RedirectResponse
    {
        if ($request->has('referral_code')) {
            session()->put('referral_code', $request->get('referral_code'));

            return redirect()->route('register.index');
        }

        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RconService $rconService, RegisterRequest $request)
    {
        $user = User::create([
            'username' => $request->get('username'),
            'password' => $request->get('password'),
            'mail' => $request->get('mail'),
            'look' => $request->get('look'),
        ]);

        if ($request->has('referral_code')) {
            $this->claimReferral($rconService, $request, $user);
        }

        Auth::login($user);

        UserRegister::dispatch($user);

        return redirect()->route('index');
    }

    /**
     * Claim referral code.
     */
    protected function claimReferral(RconService $rconService, RegisterRequest $request, User $user): void
    {
        $referrer = User::firstWhere('referral_code', $request->get('referral_code'));

        if (! $referrer) {
            return;
        }

        $referral = Referral::create([
            'user_id' => $referrer->id,
            'referred_user_id' => $user->id,
            'referred_user_ip' => $request->ip(),
        ]);

        if ($referrer->referrals()->count() != WebsiteSetting::firstWhere('key', 'referrals_needed')->value) {
            return;
        }

        ClaimedReferralLog::create([
            'user_id' => $referral->user_id,
            'ip_address' => $referrer->ip_current,
        ]);

        $rconService->alertUser($referral->user_id, sprintf(
            'Thank you for referring %s users, you have been rewarded with %s %s',
            WebsiteSetting::firstWhere('key', 'referrals_needed')->value,
            WebsiteSetting::firstWhere('key', 'referral_reward_amount')->value,
            WebsiteSetting::firstWhere('key', 'referral_reward_currency_type')->value,
        ));

        match (WebsiteSetting::firstWhere('key', 'referral_reward_currency_type')->value) {
            'credits' => $rconService->giveCredits($referral->user_id, intval(WebsiteSetting::firstWhere('key', 'referral_reward_amount')->value)),
            'duckets' => $rconService->giveDuckets($referral->user_id, intval(WebsiteSetting::firstWhere('key', 'referral_reward_amount')->value)),
            'diamonds' => $rconService->giveDiamonds($referral->user_id, intval(WebsiteSetting::firstWhere('key', 'referral_reward_amount')->value)),
            'points' => $rconService->givePoints($referral->user_id, 101, intval(WebsiteSetting::firstWhere('key', 'referral_reward_amount')->value)),
        };
    }
}
