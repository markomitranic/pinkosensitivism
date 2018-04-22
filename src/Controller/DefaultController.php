<?php

namespace App\Controller;


use App\Repository\InstaPostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class DefaultController extends BaseController
{

    /**
     * @var InstaPostRepository
     */
    private $instaPostRepository;

    public function __construct(InstaPostRepository $instaPostRepository)
    {
        $this->instaPostRepository = $instaPostRepository;
    }

    /**
     * @return Response
     */
    public function index()
    {
        try {
            $posts = $this->instaPostRepository->findAllPostsSortByDate();
        } catch (ResourceNotFoundException $e) {
            $posts = [];
        }

        return $this->render('home.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @return Response
     */
    public function about()
    {
        return $this->render('about.html.twig');
    }

    /**
     * @return Response
     */
    public function manifesto()
    {
        return $this->render('manifesto.html.twig');
    }

}