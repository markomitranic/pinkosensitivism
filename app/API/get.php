<?php
namespace API;
header('Content-Type: application/json');

include(dirname(__DIR__) . '/Kernel.php');

use Service\InstagramService;
use Service\InstaPostTransformer;

class getController
{

    /**
     * @return string
     */
    public function render()
    {
        $response = $this->getInstagramService()->getPosts();

        $response['posts'] = $this->getInstaPostTransformer()->postsToArray($response['posts']);

        return json_encode($response);
    }

    /**
     * @return InstagramService
     */
    private function getInstagramService()
    {
        return new InstagramService();
    }

    private function getInstaPostTransformer()
    {
        return new InstaPostTransformer();
    }

}

$controller = new getController();
echo $controller->render();

?>