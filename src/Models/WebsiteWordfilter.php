<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteWordfilter extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_wordfilter';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'word',
    ];
}
