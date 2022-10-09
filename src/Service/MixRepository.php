<?php

declare(strict_types=1);

namespace App\Service;

use Psr\Cache\CacheItemInterface;
use Psr\Cache\InvalidArgumentException;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MixRepository
{
    protected const URL = 'https://raw.githubusercontent.com/SymfonyCasts/vinyl-mixes/main/mixes.json';

    public function __construct(
        private HttpClientInterface $httpClient,
        private CacheInterface      $cache
    )
    {
    }

    /**
     * @throws InvalidArgumentException
     */
    public function findAll(): array
    {
        return $this->cache->get('mises_data', function (CacheItemInterface $cacheItem) {
            $cacheItem->expiresAfter(5);
            return $this->httpClient->request('GET', self::URL)->toArray();
        });
    }
}
