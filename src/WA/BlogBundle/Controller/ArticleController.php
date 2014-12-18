<?php

namespace WA\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    public function indexAction($article)
    {
        return $this->render('WABlogBundle:Article:index.html.twig', array('article' => $article));
    }

    public function editAction($article)
    {
        return $this->render('WABlogBundle:Article:article_template.html.twig', array('article' => $article));
    }

    public function deleteAction($article)
    {
        return $this->render('WABlogBundle:Article:delete.html.twig', array('article' => $article));
    }

    public function newAction($article)
    {
        return $this->render('WABlogBundle:Article:new.html.twig', array('article' => $article));
    }

    public function layoutAction()
    {
        return $this->render('WABlogBundle:Article:layout_template.html.twig');
    }

}

