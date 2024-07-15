<?php

namespace Atom\Core\Observers;

use Atom\Core\Models\WebsiteArticle;
use Illuminate\Support\Str;

class WebsiteArticleObserver
{
    /**
     * Handle the WebsiteArticle "creating" event.
     */
    public function creating(WebsiteArticle $websiteArticle): void
    {
        $websiteArticle->slug = Str::slug($websiteArticle->title);
    }

    /**
     * Handle the WebsiteArticle "updating" event.
     */
    public function updating(WebsiteArticle $websiteArticle): void
    {
        $websiteArticle->slug = Str::slug($websiteArticle->title);
    }
}
