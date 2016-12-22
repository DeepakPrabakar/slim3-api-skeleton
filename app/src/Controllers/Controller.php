<?php

namespace App\Controllers;

use \Silalahi\Slim\Logger as Logger;
use \Interop\Container\ContainerInterface as ContainerInterface;
use \PDO as PDO;

class Controller
{
	protected $db;
    protected $logger;

    protected static $messages = [
        
        //General 
        'Data_false' => 'No Records Found.',
        'Data_true'=> 'Data Retrieved Successfully.',
        'No_Data'=> '{}',

        'Resultcode_0' => 0,
        'Resultcode_1' => 1,

        //CustomerDetails Table 
        'Check_Mobile' => 'Please Check the Mobile Number.',
        'Account_Status_Updated' => 'Account Status Updated.', 
        'Wallet_Updated' => 'Wallet Updated.',
        'Account_Status_Not_Active' => 'Account Status Not Active.', 
        'Password_Updated' => 'Password Updated.',
        'Customer_Created' => 'Welcome to Impressive Application. Your Profile has been created.',
        'Check_Category' => 'Please Check the Category.',
        'Check_Password' => 'Mismatch in Password. You are not Authenticated.',
        'Mobile_Updated' => 'Customer Mobile Number Updated.',
        'Check_Order_Id' => 'Please Check the Order Id.',
        'Pickup_Slot_Updated' => 'Pickup Slot Updated.',
        'Delivery_Slot_Updated' => 'Delivery Slot Updated.',


        //  OrderDetails
        'Check_Display' =>'Give correct value for display (complete, today, 1,2,...,12).',
        'No_Orders_Complete' => 'There are no Orders.',
        'No_Orders_Today' => 'No Orders for Today.',
        'No_Orders_Month' => 'No Orders in Month of ',

        'Order_Created' => 'Your Order has been Created Successfully.',
        'Order_Id' => 'Your Order Id is ',
       
        'Promocode_Used' => 'Promocode has been used.',
        'Timeslot_Updated' => 'Timeslot Updated.',

        // TimeSlots Table
        'No_Slots' => 'No Slots on or after ',

        //Promocodes
        'Promocode_Created' => 'Promocode has been Created.',

        //Transaction Messages
        'Amount_Rs' => 'Amount Rs.',
        'Amount_Debit' => 'Debited against Order Id: ',
        'Amount_Credit' => 'Credited towards Order.',
        'No_Transactions_Complete' => 'There are no Transactions.',
        'No_Transactions_Today' => 'No Transactions for Today.',
        'No_Transactions_Month' => 'No Transactions in Month of ',


    ];

    public function __construct(Logger $logger, PDO $db)
    {
        $this->db = $db;
        $this->logger = $logger;
    }


}
