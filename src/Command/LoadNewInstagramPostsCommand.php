<?php
namespace App\Command;

use App\InstagramApiService;
use App\InstagramService;
use App\PostUploadService;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LoadNewInstagramPostsCommand extends ContainerAwareCommand
{

    const URL = 'https://homullus.com/bfpe/logo.png';

    /**
     * @var PostUploadService
     */
    private $postUploadService;

    /**
     * @var InstagramService
     */
    private $instagramService;

    /**
     * @var InstagramApiService
     */
    private $api;

    public function __construct(
        PostUploadService $postUploadService,
        InstagramService $instagramService,
        InstagramApiService $api,
        ?string $name = null)
    {
        parent::__construct($name);
        $this->postUploadService = $postUploadService;
        $this->instagramService = $instagramService;
        $this->api = $api;
    }

    protected function configure()
    {
        $this
            ->setName('app:instagram:sync')
            ->setDescription('Loads the latest 20 posts from Instagram API and saves the new ones locally.')
        ;
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $output->writeln('Pulling latest data from Instagram API.');
        try {
            $posts = $this->api->getPostsStartingWith();
        } catch (\Exception $e) {
            $output->writeln('Unable to contact Instagram API.');
            return;
        }

        foreach ($posts as $post) {
            $persisted = $this->instagramService->persistPost($post);

            if ($persisted) {
                $output->writeln('Persisted post: '.$post->getInstagramId());
            } else {
                $output->writeln('Post '.$post->getInstagramId() . ' already exists. Skipping persist.');
            }
        }

        $output->writeln('Persisted posts.');
        return;
    }
}