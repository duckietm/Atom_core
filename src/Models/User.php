<?php

namespace Atom\Core\Models;

use Atom\Core\Observers\UserObserver;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[ObservedBy([UserObserver::class])]
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Determine if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'real_name',
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed',
        'two_factor_confirmed_at',
        'mail',
        'mail_verified',
        'account_created',
        'account_day_of_birth',
        'last_login',
        'last_online',
        'motto',
        'look',
        'gender',
        'rank',
        'rank_expires_at',
        'hidden_staff',
        'credits',
        'pixels',
        'points',
        'online',
        'auth_ticket',
        'ip_register',
        'ip_current',
        'machine_id',
        'home_room',
        'referral_code',
        'website_balance',
        'secret_key',
        'pincode',
        'extra_rank',
        'home_background',
        'team_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'rank_expires_at' => 'datetime',
            'password' => 'hashed',
            'hidden_staff' => 'boolean',
        ];
    }

    /**
     * Get the team that the user belongs to.
     */
    public function setting(): HasOne
    {
        return $this->hasOne(UserSetting::class, 'user_id');
    }

    /**
     * Get the subscription that the user belongs to.
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(UserSubscription::class, 'user_id');
    }

    /**
     * Get the currency that the user belongs to.
     */
    public function currencies(): HasMany
    {
        return $this->hasMany(UserCurrency::class, 'user_id', 'id');
    }

    /**
     * Get the team that the user belongs to.
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(WebsiteTeam::class, 'team_id');
    }

    /**
     * Get the articles for the user.
     */
    public function articles(): HasMany
    {
        return $this->hasMany(WebsiteArticle::class, 'user_id');
    }

    /**
     * Get the comments for the user.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(WebsiteArticleComment::class, 'user_id');
    }

    /**
     * Get the reactions for the user.
     */
    public function reactions(): HasMany
    {
        return $this->hasMany(WebsiteArticleReaction::class, 'user_id');
    }

    /**
     * Get the friendships that the user has.
     */
    public function friends(): HasMany
    {
        return $this->hasMany(MessengerFriendship::class, 'user_one_id');
    }

    /**
     * Get the guilds that the user is an owner of.
     */
    public function guilds(): HasMany
    {
        return $this->hasMany(Guild::class, 'user_id');
    }

    /**
     * Get the guilds that the user is a member of.
     */
    public function guildMembers(): HasMany
    {
        return $this->hasMany(GuildMember::class, 'user_id');
    }

    /**
     * Get the settings for the user.
     */
    public function settings(): HasOne
    {
        return $this->hasOne(UserSetting::class, 'user_id');
    }

    /**
     * Get the tickets for the user.
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(WebsiteHelpCenterTicket::class, 'user_id');
    }

    /**
     * Get the replies for the user.
     */
    public function ticketReplies(): HasMany
    {
        return $this->hasMany(WebsiteHelpCenterTicketReply::class, 'user_id');
    }

    /**
     * Get the open positions for the user.
     *
     * @return HasMany
     */
    public function permission(): BelongsTo
    {
        return $this->belongsTo(Permission::class, 'rank');
    }

    /**
     * Get the staff applications for the user.
     */
    public function staffApplications(): HasMany
    {
        return $this->hasMany(WebsiteStaffApplications::class, 'user_id');
    }

    /**
     * Get the photos for the user.
     */
    public function photos(): HasMany
    {
        return $this->hasMany(CameraWeb::class, 'user_id');
    }

    /**
     * Get the paypal transactions for the user.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(WebsitePaypalTransaction::class, 'user_id');
    }

    /**
     * Get the password reset tokens for the user.
     */
    public function passwordResetTokens(): HasMany
    {
        return $this->hasMany(PasswordResetToken::class, 'email', 'mail');
    }

    /**
     * Get the bans for the user.
     */
    public function bans(): HasMany
    {
        return $this->hasMany(Ban::class, 'user_id');
    }

    /**
     * Get the bans that the user has issued.
     */
    public function issuedBans(): HasMany
    {
        return $this->hasMany(Ban::class, 'user_staff_id');
    }

    /**
     * Get the referrals for the user.
     */
    public function referrals(): HasMany
    {
        return $this->hasMany(Referral::class, 'user_id');
    }

    /**
     * Get the referred users for the user.
     */
    public function referredUsers(): HasMany
    {
        return $this->hasMany(Referral::class, 'referred_user_id');
    }

    /**
     * Get the claimed referral logs for the user.
     */
    public function claimedReferralLogs(): HasMany
    {
        return $this->hasMany(ClaimedReferralLog::class, 'user_id');
    }

    /**
     * Get the user referral for the user.
     */
    public function userReferral(): HasOne
    {
        return $this->hasOne(UserReferral::class, 'user_id');
    }

    /**
     * Get the guestbook entries for the user.
     */
    public function guestbookEntries(): HasMany
    {
        return $this->hasMany(WebsiteUserGuestbook::class, 'user_id');
    }

    /**
     * Get the guestbook entries that the user has posted.
     */
    public function guestbookPosts(): HasMany
    {
        return $this->hasMany(WebsiteUserGuestbook::class, 'profile_id');
    }

    /**
     * Get the home room for the user.
     */
    public function homeRoom(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'home_room');
    }

    /**
     * Get the rooms for the user.
     */
    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class, 'owner_id');
    }

    /**
     * Get the badges for the user.
     */
    public function badges(): HasMany
    {
        return $this->hasMany(UserBadge::class, 'user_id');
    }

    /**
     * Get the home items for the user.
     */
    public function homeItems(): BelongsToMany
    {
        return $this->belongsToMany(WebsiteHomeItem::class)
            ->withPivot('id', 'left', 'top', 'z', 'data')
            ->withTimestamps();
    }

    /**
     * Get the inventory for the user.
     */
    public function inventoryItems(): BelongsToMany
    {
        return $this->homeItems()
            ->wherePivot('user_id', $this->id)
            ->wherePivot('left', null)
            ->wherePivot('top', null);
    }

    /**
     * Get the home items for the user.
     */
    public function activeItems(): BelongsToMany
    {
        return $this->homeItems()
            ->wherePivot('user_id', $this->id)
            ->wherePivot('left', '!=', null)
            ->wherePivot('top', '!=', null);
    }

    /**
     * Get the user's items.
     */
    public function items(): HasMany
    {
        return $this->hasMany(Item::class, 'user_id');
    }

    /**
     * Get the cloned users for the user.
     */
    public function getClonesAttribute(): Collection
    {
        return User::where('id', '<>', $this->id)
            ->where(fn (Builder $query) => $query->where('ip_register', $this->ip_register)
                ->orWhere('ip_register', $this->ip_current)
                ->orWhere('ip_current', $this->ip_register)
                ->orWhere('ip_current', $this->ip_current))
            ->orderBy('id', 'asc')
            ->get();
    }

    /**
     * Get the user's avatar.
     */
    public function getAvatarAttribute(): string
    {
        return sprintf('%s?figure=%s', config('nitro.imager_url'), $this->look);
    }
}
