<?php

namespace App\Controllers;

class CustomerDetails extends Controller
{
	public function getAllCustomers($request, $response)
    {
		$handle = $this->db->prepare('Select * from customer_details');
         
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
   
    public function createNewCustomer($request, $response)
    {
        $args = $request->getParsedBody();
        
        $this->db->beginTransaction();

        $handle = $this->db->prepare('insert into customer_details(Customer_Name,Customer_Mobno,Customer_Emailid,Customer_AddressDetails,Customer_GPSLan,Customer_GPSLon,Customer_Password,isAdmin,Account_Status,Wallet) values(?,?,?,?,?,?,?,?,?,?)');
    
        $_REQUEST['Category']=$args['category'];
        $_REQUEST['Customer_Name']=$args['name'];
        $_REQUEST['Customer_Mobno']=$args['mobno'];
        $_REQUEST['Customer_Emailid']=$args['emailid'];
        $_REQUEST['Customer_AddressDetails']=$args['address'];
        $_REQUEST['Customer_GPSLan']=$args['lat'];
        $_REQUEST['Customer_GPSLon']=$args['lon'];
        $_REQUEST['Customer_Password']=$args['password'];

        $handle->bindValue(1, $_REQUEST['Customer_Name']);
        $handle->bindValue(2, $_REQUEST['Customer_Mobno']);
        $handle->bindValue(3, $_REQUEST['Customer_Emailid']);
        $handle->bindValue(4, $_REQUEST['Customer_AddressDetails']);
        $handle->bindValue(5, $_REQUEST['Customer_GPSLan']);
        $handle->bindValue(6, $_REQUEST['Customer_GPSLon']);
        $handle->bindValue(7, password_hash($_REQUEST['Customer_Password'], PASSWORD_DEFAULT));

        if($_REQUEST['Category']=="admin") {
            $_REQUEST['Account_Status']="Active";
            $handle->bindValue(8, 1);
        }
        else if($_REQUEST['Category']=='customer') {
            $_REQUEST['Account_Status']="Waiting For Verification";    
            $handle->bindValue(8, 0);
        }

        $handle->bindValue(9, $_REQUEST['Account_Status']);
        $handle->bindValue(10, 0);
     
        $result = $handle->execute();
        $id = $this->db->lastInsertId();

        $handle3 = $this->db->prepare('select * from customer_details where id= ?');
        $handle3->bindValue(1, $id);
        $result3 = $handle3->execute();
        $data= $handle3->fetchObject();

        $errresult['Resultcode'] = static::$messages['Resultcode_0'];;
        $errresult['Message'] = static::$messages['Data_true'].' '.static::$messages['Customer_Created'];
        $errresult['Data'] = $data;
        $errresult['StatusCode'] = $handle->errorCode();
        $this->db->commit();
        $this->db = null;
      
        return $response->withJson($errresult);
    }
 
    public function getUser($request, $response)
    {
        $args = $request->getQueryParams();
        $handle = $this->db->prepare('Select * from customer_details where  
            Customer_Mobno=:Customer_Mobno LIMIT 1');
          
        $handle->bindParam('Customer_Mobno', $args['mobno']);

        $result = $handle->execute();
        $data = $handle->fetchObject();

        $errresult['Resultcode'] = static::$messages['Resultcode_0'];;

        if($data) {

            $errresult['Message'] = static::$messages['Data_true'];
            $errresult['Data'] = $data;
        }
        else {
           
            $errresult['Message'] = static::$messages['Data_false'].' '.static::$messages['Check_Mobile'];
            $errresult['Data'] = static::$messages['No_Data'];
        }
      
        $errresult['StatusCode'] = $handle->errorCode();
        $this->db = null;
      
        return $response->withJson($errresult);
    }

    
}