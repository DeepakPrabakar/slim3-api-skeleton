<?php
// Application middleware

// Adding Slim Logger as part of Middleware
$app->add(new Silalahi\Slim\Logger([
      'path' => __DIR__. '/../logs/',
      'name' => 'logs_',
      'name_format' => 'Y-m-d',
      'extension' => '.log',
      'message_format' => '[%label%]' .@date(' [D M d h:i:s a Y] ') .'%message%'

    ]));
?>