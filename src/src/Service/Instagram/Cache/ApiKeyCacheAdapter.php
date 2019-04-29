<?php

namespace App\Service\Instagram\Cache;

use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;


final class ApiKeyCacheAdapter extends FilesystemAdapter implements AdapterInterface
{

    /** @var string */
    const NAME_SPACE = 'apikey';
    /** @var int */
    const LIFETIME = 2629800; // 1 month

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
