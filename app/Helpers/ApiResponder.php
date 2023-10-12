<?php

namespace App\Helpers;

trait ApiResponder
{

  public function apiResponse($data = null, $code = 200, $message = null, $errors = null)
  {
    $array = [];

    if (is_null($data) && !is_null($errors)) {
      $array['errors'] = $errors;
    } else if (!is_null($message)) {
      $array['message'] = $message;
    } 
    
    if (is_null($errors) && !is_null($data)) {
      $array['data'] = $data;
    }
    
    $responseData = count($array) > 0 ? $array : '';

    return response($responseData, $code);
  }
}
