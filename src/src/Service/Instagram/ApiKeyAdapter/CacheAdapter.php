<?php

namespace App\Service\Instagram\ApiKeyAdapter;

use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;


final class CacheAdapter extends FilesystemAdapter implements AdapterInterface
{

    /** @var string */
    const NAME_SPACE = 'apikey';
    /** @var int */
    const LIFETIME = 31557600; // 1 year

    /**
     * @param string $cacheRootDir
     */
    public function __construct($cacheRootDir)
    {
        parent::__construct(
            self::NAME_SPACE,
            self::LIFETIME,
            $cacheRootDir.DIRECTORY_SEPARATOR.'instagram'
        );
    }

}
