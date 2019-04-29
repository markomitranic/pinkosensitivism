<?php

namespace App\Service\Instagram;

use App\Service\Instagram\ApiKeyAdapter\CacheAdapter;
use Psr\Cache\InvalidArgumentException;

class ApiKeySaver
{

    /**
     * @var CacheAdapter
     */
    private $cacheAdapter;

    public function __construct(CacheAdapter $cacheAdapter)
    {
        $this->cacheAdapter = $cacheAdapter;
    }

    /**
     * @param string $apiKey
     * @return bool
     * @throws InvalidArgumentException
     */
    public function save(string $apiKey): bool
    {
        $cachedKey = $this->cacheAdapter->getItem('key');
        $cachedKey->set($apiKey);
        $this->cacheAdapter->save($cachedKey);

        return true;
    }

}
