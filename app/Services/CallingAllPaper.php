<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CallingAllPaper
{
    protected $baseUrl = 'https://api.callingallpapers.com/v1/cfp';

    public function conferences()
    {
        return $this->call('get', '');
    }

    private function call(string $method, string $path, array $data = [])
    {
        return Http::accept('application/json')->$method(sprintf('%s%s', $this->baseUrl, $path))->json();
    }
}
