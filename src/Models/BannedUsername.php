<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannedUsername extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'banned_usernames';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username'];
}
