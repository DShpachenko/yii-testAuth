<?php 
$I = new ApiTester($scenario);
$I->wantTo('perform actions and see result');
$I->sendGET('/auth/signin', ['phone' => ' 7 (919) 874-81-90', 'password' => '12345']);