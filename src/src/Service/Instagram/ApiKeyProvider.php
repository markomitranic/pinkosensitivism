<?php

namespace App\Service\Instagram;

use App\Service\Instagram\Cache\ApiKeyCacheAdapter;
use Psr\Cache\InvalidArgumentException;
use Psr\Log\LoggerInterface;

class ApiKeyProvider
{

    /**
     * @var ApiKeyCacheAdapter
     */
    private $cacheAdapter;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        ApiKeyCacheAdapter $cacheAdapter,
        LoggerInterface $logger
    ) {
        $this->cacheAdapter = $cacheAdapter;
        $this->logger = $logger;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getKey()
    {
        $cachedKey = null;

        try {
            $cachedKey = $this->cacheAdapter->getItem('key');
        } catch (InvalidArgumentException $e) {
            $this->logger->error('Unable to get key from cache.', ['exception' => $e]);
        }

        if ($cachedKey->isHit() && !is_null($cachedKey->get())) {
            return $cachedKey->get();
        }

        try {
            $apiKey = $this->requestNewKey();
        } catch (\Exception $e) {
            $this->logger->error('Unable to get new Instagram Api key.', ['exception' => $e]);
            throw new \Exception('Unable to get new Instagram Api key.');
        }

        $cachedKey->set($apiKey);
        $this->cacheAdapter->save($cachedKey);

        return $apiKey;
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function requestNewKey()
    {
        return '2966022865.bc6804b.eeb29a27d8c14cc0b9dcfb8570c4366b';
    }
}
