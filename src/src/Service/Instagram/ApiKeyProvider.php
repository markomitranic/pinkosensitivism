<?php

namespace App\Service\Instagram;

use App\Service\Instagram\ApiKeyAdapter\ApiAdapter;
use App\Service\Instagram\ApiKeyAdapter\CacheAdapter;
use Exception;
use Psr\Cache\InvalidArgumentException;
use Psr\Log\LoggerInterface;

class ApiKeyProvider
{

    /**
     * @var CacheAdapter
     */
    private $cacheAdapter;

    /**
     * @var ApiAdapter
     */
    private $apiAdapter;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param CacheAdapter $cacheAdapter
     * @param ApiAdapter $apiAdapter
     * @param LoggerInterface $logger
     */
    public function __construct(
        CacheAdapter $cacheAdapter,
        ApiAdapter $apiAdapter,
        LoggerInterface $logger
    ) {
        $this->cacheAdapter = $cacheAdapter;
        $this->apiAdapter = $apiAdapter;
        $this->logger = $logger;
    }

    /**
     * @throws Exception
     */
    public function getKey(): string
    {
        $cachedKey = null;

        try {
            $cachedKey = $this->cacheAdapter->getItem('key');
        } catch (InvalidArgumentException $e) {
            $this->logger->error('Unable to get key from cache.', ['exception' => $e]);
        }

        if (!$cachedKey->isHit() || is_null($cachedKey->get())) {
            $cachedKey->set($this->apiAdapter->getKey());
            $this->cacheAdapter->save($cachedKey);
        }

        return $cachedKey->get();
    }

}
