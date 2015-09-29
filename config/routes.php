<?php 

return array(
    array(
        'url' => 'ruleTheWorld/nOw',
        'controller' => 'UsersController',
        'method' => 'add'
    ),
	array(
        'url' => 'checkout',
        'controller' => 'CartController',
        'method' => 'checkout',
        'area' => 'checkout'
    ),
);

?>