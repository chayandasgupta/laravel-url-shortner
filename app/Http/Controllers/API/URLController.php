<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\URLShortnerRequest;
use Illuminate\Http\Request;
use App\Services\URLShortenerService;

class URLController extends Controller
{
    protected $urlShortenerService;

    public function __construct(URLShortenerService $urlShortenerService)
    {
        $this->urlShortenerService = $urlShortenerService;
    }

    public function shortUrl(URLShortnerRequest $request)
    {
        $user = $request->user();
        $shortURL = $this->urlShortenerService->shortenURL($request->original_url, $user->id);

        return response()->json(['short_url' => $shortURL], 201);
    }

    public function getUserURLs(Request $request)
    {
        $user = $request->user();
        $urls = $user->urls;

        return response()->json($urls, 200);
    }
}
