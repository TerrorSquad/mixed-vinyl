<?php

declare(strict_types=1);

namespace App\Service;

use Psr\Cache\CacheItemInterface;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MixRepository
{
    public function __construct(
        private HttpClientInterface $githubContentClient,
        private CacheInterface      $cache,
        #[Autowire('%kernel.debug%')]
        private bool                $isDebug
    )
    {
    }

    /**
     * @throws InvalidArgumentException
     */
    public function findAll(): array
    {
        return $this->cache->get('mises_data', function (CacheItemInterface $cacheItem) {
            $cacheItem->expiresAfter($this->isDebug ? 5 : 60);
            return $this->githubContentClient->request('GET', '/SymfonyCasts/vinyl-mixes/main/mixes.json')->toArray();
        });
    }
}
