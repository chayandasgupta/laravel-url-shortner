<?php

namespace App\Http\Controllers;

use App\Models\URLShortner;

class URLController extends Controller
{
    public function redirect($shortUrl)
    {
        $shortUrlEntry = URLShortner::where('short_url', $shortUrl)->first();

        if (!$shortUrlEntry) {
            abort(404);
        }

        $shortUrlEntry->increment('visits');
        return redirect()->away($shortUrlEntry->original_url);
    }
}
