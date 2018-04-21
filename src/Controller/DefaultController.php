<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;

class DefaultController extends BaseController
{

    /**
     * @return Response
     */
    public function index()
    {
        return $this->render('home.html.twig');
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