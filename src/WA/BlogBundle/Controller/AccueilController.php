<?php

namespace WA\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccueilController extends Controller
{
    public function indexAction($page)
    {
        return $this->render('WABlogBundle:Accueil:index.html.twig', array('page' => $page));
    }
}

