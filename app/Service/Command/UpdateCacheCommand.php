<?php
namespace Command;

include(dirname(__DIR__) . '/../Kernel.php');

use Service\InstagramService;

class UpdateCacheCommand
{

    /**
     * Should be run as a CRON job, preferably not more often than 15min intervals.
     * crontab -e
     * 0,15,30,45 * * * * php UpdateCacheCommand.php
     */
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

$controller = new UpdateCacheCommand();
$controller->start();

?>