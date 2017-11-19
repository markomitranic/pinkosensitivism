<?php
namespace Command;

include(dirname(__DIR__) . '/../Kernel.php');

use Service\InstagramService;

class UpdateCacheCommand
{

    public function start()
    {
        $this->getInstagramService()->updateCache();
    }

    /**
     * @return InstagramService
     */
    private function getInstagramService()
    {
        return new InstagramService();
    }

}

/**
 * Should be run as a CRON job, preferably not more often than 15min intervals.
 */
$controller = new UpdateCacheCommand();
$controller->start();

?>