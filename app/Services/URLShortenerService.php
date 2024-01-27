<?php

namespace App\Services;

use App\Models\URLShortner;

class URLShortenerService
{
  public function shortenURL($originalURL, $userId)
  {
    $existingURL = $this->isExistingShortURL($originalURL, $userId);

    if ($existingURL) {
      return $existingURL->short_url;
    }

    $shortURL = $this->generateShortURL();

    URLShortner::create([
      'user_id' => $userId,
      'original_url' => $originalURL,
      'short_url' => $shortURL,
    ]);

    return $shortURL;
  }

  protected function isExistingShortURL($longURL, $userId)
  {
    return URLShortner::where('original_url', $longURL)
      ->where('user_id', $userId)
      ->first(['short_url']);
  }

  protected function generateShortURL()
  {
    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $url = '';

    for ($i = 0; $i < 7; $i++) {
      $url .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $url;
  }
}
