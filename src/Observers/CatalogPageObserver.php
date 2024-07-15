<?php

namespace Atom\Core\Observers;

use Atom\Core\Models\CatalogPage;
use Atom\Core\Models\CatalogPageBuildersClub;

class CatalogPageObserver
{
    /**
     * Handle the CatalogPage "creating" event.
     */
    public function creating(CatalogPage|CatalogPageBuildersClub $catalogPage): void
    {
        if (is_null($catalogPage->parent_id)) {
            $catalogPage->parent_id = -1;
        }

        if (is_null($catalogPage->page_headline)) {
            $catalogPage->page_headline = '';
        }

        if (is_null($catalogPage->page_teaser)) {
            $catalogPage->page_teaser = '';
        }
    }

    /**
     * Handle the CatalogPage "updating" event.
     */
    public function updating(CatalogPage|CatalogPageBuildersClub $catalogPage): void
    {
        if (is_null($catalogPage->parent_id)) {
            $catalogPage->parent_id = -1;
        }

        if (is_null($catalogPage->page_headline)) {
            $catalogPage->page_headline = '';
        }

        if (is_null($catalogPage->page_teaser)) {
            $catalogPage->page_teaser = '';
        }
    }
}
