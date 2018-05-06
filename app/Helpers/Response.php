<?php
namespace App\Helpers;

/**
 * Class intended to generate helpers related to response printed in API
 *
 */ 
class Response
{

    /**
     * Print JSON based response
     *
     * @param $code response code -- TYPE_SUCCESS, TYPE_BAD_REQUEST, TYPE_ERROR 
     * @param $title title of message
     * @param $description description of message
     * @param $data actual data/collection
     * @param $displayType display type - 
     * 
     * @return Status
     */ 
    public static function write($code, $title, $description, $data, $displayType = "toast")
    {
        $displayMessage = array();

         // if(!$displayType){
         //     $displayType = "toast";
         // }
        
        $displayMessage['type']= $displayType;
        $displayMessage['title']=  $title;
        $displayMessage['description']=  $description;
        $displayMessage['descriptionType'] = "text";


        $result = array('code' => $code, 'message' => $title, 'data' => $data, 'displayMessage' => $displayMessage);
        header('Content-Type: application/json');
        // header("HTTP/1.0 418 I'm A Teapot");
        echo json_encode($result, JSON_NUMERIC_CHECK);
    }
    
}

?>
