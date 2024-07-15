<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;

class CatalogClubOffer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'catalog_club_offers';

    /**
     * Determine if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'enabled',
        'name',
        'days',
        'credits',
        'points',
        'points_type',
        'type',
        'deal',
        'giftable',
    ];

    /**
     * Auto increment the ID.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(fn ($model) => $model->id = CatalogClubOffer::max('id') + 1);
    }
}
