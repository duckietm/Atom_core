<?php

namespace Atom\Core\Models;

use Atom\Core\Observers\UiTextObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([UiTextObserver::class])]
class UiText extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ui_texts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'value',
    ];
}
