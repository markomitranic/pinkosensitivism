<?php

namespace App;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PostUploadService
{

    /**
     * @var string
     */
    private $postDirectory;

    /**
     * @var string
     */
    private $tempDirectory;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var Filesystem
     */
    private $fileSystem;

    public function __construct(
        Filesystem $filesystem,
        LoggerInterface $logger,
        ContainerInterface $container
    ) {
        $this->fileSystem = $filesystem;
        $this->logger = $logger;
        $this->postDirectory = $container->getParameter('posts_directory');
        $this->tempDirectory = $container->getParameter('temporary_directory');
    }

    /**
     * @param string $url
     * @return File|UploadedFile
     * @throws \Exception
     */
    public function uploadPost(string $url)
    {
        $parsedUrl      = parse_url($url, PHP_URL_PATH);
        $extension = pathinfo($parsedUrl, PATHINFO_EXTENSION);
        $filename  = pathinfo($parsedUrl, PATHINFO_FILENAME);

        $temporaryFileName = uniqid().'.'.$extension;
        $temporaryDirectoryPath = $this->tempDirectory.'/'.rand(0,100).rand(0,100);
        $temporaryFilePath = $temporaryDirectoryPath.'/'.$temporaryFileName;

        try {
            $this->fileSystem->mkdir($temporaryDirectoryPath);
        } catch (\Exception $e) {
            $this->fileSystem->remove($temporaryDirectoryPath);
            $this->logger->error('Unable to create temp directory at: ' . $temporaryDirectoryPath);
            throw $e;
        }

        try {
            $client = new Client([
                'base_uri' => $url
            ]);
            $client->request('GET', '', ['sink' => $temporaryFilePath]);
        } catch (\Exception $e) {
            $this->fileSystem->remove($temporaryDirectoryPath);
            $this->logger->error('Unable to copy file from url.');
            throw $e;
        } catch (GuzzleException $e) {
            $this->fileSystem->remove($temporaryDirectoryPath);
            $this->logger->error('Unable to cocpy file from url.');
            throw new \Exception($e->getMessage(), 500, $e);
        }

        $uploadedFileName = $filename.rand(0,9).rand(0,9).'.'.$extension;

        try {
            $file = new File($temporaryFilePath);
            $file = $file->move($this->postDirectory, $uploadedFileName);
        } catch (\Exception $e) {
            $this->fileSystem->remove($temporaryDirectoryPath);
            $this->logger->error($e->getMessage());
            throw new \Exception($e->getMessage(), 500, $e);
        }

        return $file;
    }

}