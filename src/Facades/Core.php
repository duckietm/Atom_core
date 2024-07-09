<?php

namespace Atom\Core\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Atom\Core\Core
 */
class Core extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return \Atom\Core\Core::class;
    }
}
