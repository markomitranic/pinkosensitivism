<?php
namespace App\Command;

use App\InstagramApiService;
use App\InstagramService;
use App\PostUploadService;
use App\Service\Instagram\ApiKeyProvider;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class LoadNewInstagramPostsCommand extends Command
{

    /** @var string  */
    const NAME = 'app:instagram:sync';

    /**
     * @var string
     */
    protected static $defaultName = self::NAME;

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

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var SymfonyStyle
     */
    private $io;

    /**
     * @param PostUploadService $postUploadService
     * @param InstagramService $instagramService
     * @param InstagramApiService $api
     * @param LoggerInterface $logger
     */
    public function __construct(
        PostUploadService $postUploadService,
        InstagramService $instagramService,
        InstagramApiService $api,
        LoggerInterface $logger,
        ApiKeyProvider $test
    ) {
        parent::__construct(self::NAME);
        $this->postUploadService = $postUploadService;
        $this->instagramService = $instagramService;
        $this->api = $api;
        $this->logger = $logger;
        $this->test = $test;
    }

    protected function configure()
    {
        $this
            ->setName('app:instagram:sync')
            ->setDescription('Loads the latest 20 posts from Instagram API and saves the new ones locally.')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $this->io = new SymfonyStyle($input, $output);

        $this->io->title('Pulling latest data from Instagram API.');
        
        try {
            $posts = $this->api->getPostsStartingWith();
        } catch (\Exception $e) {
            $this->io->error('Unable to contact Instagram API.');
            $this->logger->error('Unable to contact Instagram API.', ['exception' => $e]);
            return 1;
        }

        foreach ($posts as $post) {
            try {
                $persisted = $this->instagramService->persistPost($post);
            } catch (\Exception $e) {
                $this->io->error('Unable to persist post: ' . $e->getMessage());
                $this->logger->error('Unable to persist post.', ['exception' => $e]);
                continue;
            }

            if ($persisted) {
                $this->io->writeln('Persisted post: '.$post->getInstagramId());
            } else {
                $this->io->writeln('Post '.$post->getInstagramId() . ' already exists. Skipping persist.');
            }
        }

        $this->io->success('Persisted posts.');
        return 0;
    }

}
