<?php
// Routes
$app->get('/',function(){

  echo " in home";
});

$app->get('/getAllCustomers','CustomerDetails:getAllCustomers');

$app->post('/createNewCustomer','CustomerDetails:createNewCustomer');

$app->get('/getUser','CustomerDetails:getUser');

$app->get('/getAllOrders','OrderDetails:getAllOrders');


?>