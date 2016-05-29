<?php

$app->get('/', 'HomeController:index')->setName('homepage');
$app->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
$app->post('/auth/signup', 'AuthController:postSignUp');