<?php

namespace WA\FlickrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HelloController extends Controller
{
    public function indexAction($name, $age)
    {

    return $this->render('WAFlickrBundle:Hello:index.html.twig', array('name' => $name, 'age' => $age));
    //	$url= $this->generateUrl('wa_flickr_helloworld', array('name' => 'Brayan', 'age' => 30));
    //    return $this->render('WAFlickrBundle:Hello:index.html.twig', array('name' => $name, 'age' => $age, 'url'=>$url ));
    //    $content = $this->get('templating')->render('WAFlickrBundle:Hello:index.html.twig');
   //  	 return new Response($content);
    }
}
