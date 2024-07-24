<?php

namespace Atom\Core\Observers;

use Atom\Core\Models\User;
use Atom\Core\Models\WebsiteSetting;
use Illuminate\Support\Str;

class UserObserver
{
    /**
     * Handle the User "creating" event.
     */
    public function creating(User $user): void
    {
        $settings = WebsiteSetting::whereIn('key', ['start_motto', 'start_look', 'start_credits', 'hotel_home_room'])
            ->pluck('value', 'key');

        $user->account_created = time();
        $user->last_login = time();
        $user->motto = $settings->get('start_motto');
        $user->look = $settings->get('start_look');
        $user->credits = $settings->get('start_credits');
        $user->ip_register = request()->ip();
        $user->ip_current = request()->ip();
        $user->auth_ticket = '';
        $user->home_room = $settings->get('hotel_home_room');
        $user->referral_code = Str::uuid();
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $settings = WebsiteSetting::whereIn('key', ['give_hc_on_register', 'hc_on_register_duration', 'start_duckets', 'start_diamonds', 'start_points'])
            ->pluck('value', 'key');

        $user->setting()->create([
            'last_hc_payday' => $settings->get('give_hc_on_register') == '1' ? now()->addYears(10)->unix() : 0,
        ]);

        if ((bool) $settings->get('give_hc_on_register')) {
            $user->subscriptions()->create([
                'subscription_type' => 'HABBO_CLUB',
                'timestamp_start' => now()->unix(),
                'duration' => $settings->get('hc_on_register_duration'),
                'active' => 1,
            ]);
        }

        $user->currencies()->create([
            'type' => 0,
            'amount' => $settings->get('start_duckets'),
        ]);

        $user->currencies()->create([
            'type' => 5,
            'amount' => $settings->get('start_diamonds'),
        ]);

        $user->currencies()->create([
            'type' => 101,
            'amount' => $settings->get('start_points'),
        ]);
    }
}
