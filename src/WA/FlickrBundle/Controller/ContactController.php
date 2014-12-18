<?php

namespace WA\FlickrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ContactController extends Controller
{
    public function getAction()
    {

    /* UNE PREMIÈRE MÉTHODE SANS FUNCTION SAVE 
    	if ( $this->get('request')->getMethod()=="POST")
    	{
    		var_dump($_POST);
    	}
	*/

    	$contactForm = $this->createContactForm();
        return $this->render('WAFlickrBundle:Contact:get.html.twig', array('contactForm' => $contactForm->createView()));

    }

    public function postAction(Request $request)
    {
    	$contactForm = $this->createContactForm();
    	$contactForm->handleRequest($request);
    	if( $contactForm->isvalid() )
    	{

    /*      $this->get('session')->getFlashBag()->add(
          	'notice',
          	'votre message a été envoyé');
	*/
			$formfields=$request->get('form');
			$message = \Swift_Message::newInstance()
				->setSubject("Formulaire de contact")
				->setFrom($formfields['email'])
				->setTo('cvassigh@wanadoo.fr')
				->setBody($formfields['message']);
			$this->get('mailer')->send($message);
         }
         else
         {
          $this->get('session')->getFlashBag()->add(
          	'notice',
          	"votre message n'pas a été envoyé");
         }         	
 
    	return $this->redirect($this->generateUrl( 'wa_flickr_contact_get') );
    }


    private function createContactForm()
    {
    	$formBuilder = $this->createFormBuilder();
    	$formBuilder ->add('firstname', 'text');
    	$formBuilder ->add('lastname', 'text');
    	$formBuilder ->add('email', 'email');
    	$formBuilder ->add('message', 'text');
    	$formBuilder ->add('send', 'submit');

    	return $formBuilder->getForm();
    }


}