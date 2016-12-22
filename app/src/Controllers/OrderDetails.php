<?php

namespace App\Controllers;

class OrderDetails extends Controller
{
	public function getAllOrders($request, $response)
   	{
 
        $handle = $this->db->prepare('Select * from order_details');
         
        $result = $handle->execute();
    
        $data = $handle->fetchAll();
		if($data) {

            $errresult['Message'] = static::$messages['Data_true'];
            $errresult['Data'] = $data;
        }
        else {
           
            $errresult['Message'] = static::$messages['Data_false'];
            $errresult['Data'] = static::$messages['No_Data'];
        }
      
        $errresult['StatusCode'] = $handle->errorCode();
        $this->db = null;
      
        return $response->withJson($errresult);        
	}

}