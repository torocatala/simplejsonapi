<?php

namespace App\Service;

use Symfony\Component\Cache\Adapter\ApcuAdapter;

class CacheService
{
    private $cache;

    public function __construct(ApcuAdapter $cache)
    {
        $this->cache = $cache;
    }

    public function getOrSetCacheItem(string $key, callable $setCacheCallback, int $ttl = 300)
    {
        $cacheItem = $this->cache->getItem($key);
        if (!$cacheItem->isHit()) {
            $cacheItem->set($setCacheCallback());
            $cacheItem->expiresAfter($ttl); // TTL in seconds
            $this->cache->save($cacheItem);
        }

        return $cacheItem->get();
    }
}
