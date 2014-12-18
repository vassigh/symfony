<?php

namespace WA\FlickrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use WA\FlickrBundle\Infrastructure\FlickrService;
use WA\FlickrBundle\Infrastructure\FlickrPhoto;


class SearchController extends Controller
{
    public function getAction()
    {

    	$searchForm = $this->createSearchForm();
        return $this->render('WAFlickrBundle:Search:get.html.twig', array('searchForm' => $searchForm->createView()));

    }

    public function postAction(Request $request)
    {
    	$searchForm = $this->createSearchForm();
    	$searchForm->handleRequest($request);

    	   if( $searchForm->isvalid() )
    	   {
            $formfields=$request->get('form');

            $FlickrService = new FlickrService();

            $photos = $FlickrService->searchPhotos($formfields['tags'], $formfields['maximum'], $formfields['taille']);
         }
         else
         {
            $this->get('session')->getFlashBag()->add(
            	'notice',
            	"Tgas rentré n'est pas valide");
         }         	
          return $this->render('WAFlickrBundle:Search:get.html.twig',
                                 array('searchForm' => $searchForm->createView(), 
                                  'photos'=>$photos)
                              );
    }


    private function createSearchForm()
    {
    	$formBuilder = $this->createFormBuilder();
    	$formBuilder ->add('tags', 'text');
    	$formBuilder ->add('maximum', 'choice', ['choices'=> [10=>10, 20=>20, 30=>30]]);
      $formBuilder ->add('taille', 'choice', ['choices'=> ['q'=>'Petite', 's'=>'carrée', 'b'=>'Grande']]);
    	$formBuilder ->add('send', 'submit');

    	return $formBuilder->getForm();
    }

    public function viewAction($farm, $id, $server, $secret)
    {

       $photo_object = new FlickrPhoto($farm, $id, $secret, $server, '', 'q' ); 
       $image = $photo_object->getUrl();

        $FlickrService = new FlickrService();
        $photo = $FlickrService->getPhotos($id);
        // var_dump($photo->photo->title->_content);

        $titre = $photo->photo->title->_content;
        $description = $photo->photo->description->_content;

/*
      $message = \Swift_Message::newInstance()
        ->setSubject("Photo")
        ->setFrom('cvassigh@wanadoo.fr')
        ->setTo('cvassigh@wanadoo.fr')
        ->setBody("Je t'ai envoyé une image")
        ->attach(\Swift_Attachment::fromPath($photo_object->getUrl() ));

      $this->get('mailer')->send($message);
*/
 //     $referer = $this->getRequest()->headers->get('referer');

       return $this->render('WAFlickrBundle:Search:view.html.twig', array('image'=>$image, 'titre'=>$titre, 'description'=>$description ) );

    }



}


