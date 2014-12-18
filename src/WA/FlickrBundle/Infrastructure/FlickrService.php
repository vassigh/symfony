<?php

namespace WA\FlickrBundle\Infrastructure;
use WA\FlickrBundle\Infrastructure\FlickrPhoto;


class FlickrService
{

  const API_KEY = '814772198ec9aa500687da8dcc184605';

    public function searchPhotos($tags, $maximum=10, $taille='b' )
    {

      $images = array();

/*
      $contents = file_get_contents("https://api.flickr.com/services/rest/?content_type=7&per_page=" .
                                  $maximum . 
                                  "&tags=" . 
                                  $tags . 
                                  "&api_key=814772198ec9aa500687da8dcc184605&format=json&method=flickr.photos.search&nojsoncallback=1");

*/

      $queryFields = array(

                          'api_key'=> FlickrService::API_KEY,
                          'content_type'=>7,
                          'format'=> 'json',
                          'method'=>'flickr.photos.search',
                          'nojsoncallback'=>true,
                          'per_page'=>$maximum,
                          'tags'=>$tags
                         );


      $query = "https://api.flickr.com/services/rest/?" . http_build_query($queryFields);
      $contents = file_get_contents($query);

      
      $result = json_decode($contents);



      foreach ($result->photos->photo as $photo)
      {
       $photo_object = new FlickrPhoto($photo->farm, $photo->id, $photo->secret, $photo->server, $photo->title, $taille ); 

       array_push($images, $photo_object);

      }
      return($images);


    }
   
    public function getPhotos($photoId)
    {
      $queryInfo = array(
                          'api_key'=> FlickrService::API_KEY,
                          'photo_id'=> $photoId,
                          'method'=>'flickr.photos.getinfo',
                          'nojsoncallback'=>true,
                          'format'=> 'json'
                         );
      $query = "https://api.flickr.com/services/rest/?" . http_build_query($queryInfo);
      $contents = file_get_contents($query);
      $result = json_decode($contents);
      return($result);

    }

}