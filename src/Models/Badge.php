<?php

namespace Atom\Core\Models;

use Sushi\Sushi;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Badge extends Model
{
    use Sushi;

    /**
     * The table associated with the model.
     */
    protected static function booted()
    {
        static::creating(fn (Badge $badge) => $badge->updateExternalTexts($badge));
        static::saving(fn (Badge $badge) => $badge->updateExternalTexts($badge));
        static::deleted(fn (Badge $badge) => $badge->removeExternalTexts($badge));
    }
    
    /**
     * Get the rows for the table.
     *
     * @return void
     */
    public function getRows()
    {
        $externalTexts = collect($this->getExternalTexts());

        return array_map(fn (string $fileName) => [
            'file' => $fileName,
            'code' => str_replace('.gif', '', $fileName),
            'title' => $externalTexts->get('badge_name_' . str_replace('.gif', '', $fileName)) ?? '',
            'description' => $externalTexts->get('badge_desc_' . str_replace('.gif', '', $fileName)) ?? '',
        ], Storage::disk('album1584')->files());
    }

    /**
     * Get the external texts.
     */
    public function getExternalTexts(): array
    {
        $filePath = base_path('nitro/nitro-assets/gamedata/ExternalTexts.json');

        return json_decode(file_get_contents($filePath), true);
    }

    /**
     * Update the external texts.
     */
    public function updateExternalTexts(Badge $badge): bool
    {
        $externalTexts = collect($this->getExternalTexts());
        $externalTexts->put('badge_name_' . $badge->code, $badge->title);
        $externalTexts->put('badge_desc_' . $badge->code, $badge->description);

        return File::put(base_path('nitro/nitro-assets/gamedata/ExternalTexts.json'), json_encode($externalTexts, JSON_PRETTY_PRINT));
    }

    /**
     * Remove the external texts.
     */
    public function removeExternalTexts(Badge $badge): bool
    {
        Storage::disk('album1584')->delete($badge->file);

        $externalTexts = collect($this->getExternalTexts());
        $externalTexts->forget('badge_name_' . $badge->code);
        $externalTexts->forget('badge_desc_' . $badge->code);

        return File::put(base_path('nitro/nitro-assets/gamedata/ExternalTexts.json'), json_encode($externalTexts, JSON_PRETTY_PRINT));
    }
}
