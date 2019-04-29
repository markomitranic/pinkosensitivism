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
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param CacheAdapter $cacheAdapter
     * @param LoggerInterface $logger
     */
    public function __construct(
        CacheAdapter $cacheAdapter,
        LoggerInterface $logger
    ) {
        $this->cacheAdapter = $cacheAdapter;
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
            throw new Exception('Unable to get key from cache. ' . $e->getMessage());
        }

        if (!$cachedKey->isHit() || is_null($cachedKey->get())) {
            throw new Exception('We have no Authorization Token to use as an API key. Please refresh the token.');
        }

        return $cachedKey->get();
    }

}
