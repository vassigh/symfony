<?php

namespace WA\FlickrBundle\Infrastructure;


class FlickrPhoto
{

	public $description;
	public $farm;
	public $id;
	public $secret;
	public $server;
	public $title;
	public $taille;

    public function __construct($farm, $id, $secret, $server, $title, $taille) 
    {
		$this->farm=$farm;
		$this->id=$id;
		$this->secret=$secret;
		$this->server=$server;
		$this->title=$title;
		$this->taille=$taille;
		$this->description=null;
    }

    public function getUrl() 
    {
    	$image_flickr = "https://farm"		 .
    	              $this->farm  			 . 
    	              ".staticflickr.com/" 	 .
    	              $this->server      	 .
    	              "/"               	 . 
    	              $this->id 			 .
    	              "_"					 . 
    	              $this->secret 		 . 
    	              "_" 				     .
    	              $this->taille		     .
    	              ".jpg";


    	return $image_flickr;
    }
}


