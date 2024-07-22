<?php

namespace Atom\Core\Models;

use Sushi\Sushi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class RoomAds extends Model
{
    use Sushi;

    /**
     * The table associated with the model.
     */
    protected static function booted()
    {
        static::deleted(fn (RoomAds $roomAds) => Storage::disk('room_backgrounds')->delete($roomAds->file));
    }
    
    /**
     * Get the rows for the table.
     *
     * @return void
     */
    public function getRows()
    {
        return array_map(
            fn (string $file) => compact('file'),
            Storage::disk('room_backgrounds')->files(),
        );
    }
}
