<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CurrencyService
{
    public function getExchangeRate($from, $to)
    {
        $req_url = 'https://api.exchangerate.host/latest?base=' . $from . '&symbols=' . $to;

        $response = Http::get($req_url);

        if ($response->successful()) {
            $responseData = $response->json();
            if (isset($responseData['rates'][$to])) {
                return $responseData['rates'][$to];
            }
        }

        return null;
    }

    public function getCachedExchangeRate(string $defaultCurrencyCode, string $code): ?float
    {
        $cacheKey = 'currency_data_' . $defaultCurrencyCode . '_' . $code;

        $cachedData = Cache::get($cacheKey);

        if ($cachedData !== null) {
            return $cachedData['rate'];
        }

        $rate = $this->getExchangeRate($defaultCurrencyCode, $code);

        if ($rate !== null) {
            $dataToCache = compact('rate');
            $expirationTimeInSeconds = 60 * 60 * 24; // 24 hours
            Cache::put($cacheKey, $dataToCache, $expirationTimeInSeconds);
        }

        return $rate;
    }
}
