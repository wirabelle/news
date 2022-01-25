<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('News/index.html.twig');
    }

    /**
     * @Route("/{id}", name="show")
     */
    public function show($id): Response
    {
        return $this->render('News/show.html.twig', ['id' => $id]);
    }
}
