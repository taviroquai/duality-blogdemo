<?php

// Load local configuration
$config = include_once('./config/app.php');

// What will we use in our application?
use Duality\App;
use Blog\Model\MyUser;
use Blog\Model\Post;
use Blog\Model\Comment;

// Create application container
$app = new App(dirname(__FILE__), $config);

/**
 * Register post model
 */
$app->register('post', function() use ($app) {
    return new Post($app);
});

/**
 * Register comment model
 */
$app->register('comment', function() use ($app) {
    return new Comment($app);
});

/**
 * Register user model
 */
$app->register('user', function() use ($app) {
    return new MyUser($app);
});

/**
 * Register dwoo template engine
 */
$app->register('dwoo', function() {
    $dwoo = new Dwoo\Core();
    $dwoo->setCompileDir('data/dwoo-cache/');
    $dwoo->setTemplateDir('data/');
    return $dwoo;
});

// Get server and request from globals
$server = $app->call('server');
$request = $server->getRequestFromGlobals($_SERVER, $_REQUEST);

// Validate request. This is a Web application.
if (!$request) {
	die('HTTP request not found!' . PHP_EOL);
}

// Set server request
$server->setRequest($request);

// Set demo routes
$server->setHome('\Blog\Controller\Welcome@doIndex');
$server->addRoute('/^\/([0-9]+)$/', '\Blog\Controller\Welcome@doPost');
$server->addRoute('/^\/login$/', '\Blog\Controller\AdminController@showAuthForm');
$server->addRoute('/^\/login\/submit$/', '\Blog\Controller\AdminController@doLogin');
$server->addRoute('/^\/logout$/', '\Blog\Controller\AdminController@doLogout');
$server->addRoute('/^\/admin$/', '\Blog\Controller\AdminController@doIndex');
$server->addRoute('/^\/admin\/edit\/([0-9]+)$/', '\Blog\Controller\AdminController@doPostEdit');
$server->addRoute('/^\/admin\/save\/([0-9]+)$/', '\Blog\Controller\AdminController@doPostSave');
$server->addRoute('/^\/admin\/del\/([0-9]+)$/', '\Blog\Controller\AdminController@doPostDel');
$server->addRoute('/^\/admin\/comment\/edit\/([0-9]+)$/', '\Blog\Controller\AdminController@doCommentEdit');
$server->addRoute('/^\/admin\/comment\/save\/([0-9]+)$/', '\Blog\Controller\AdminController@doCommentSave');
$server->addRoute('/^\/admin\/comment\/del\/([0-9]+)$/', '\Blog\Controller\AdminController@doCommentDel');
$server->addRoute('/^\/comment\/save$/', '\Blog\Controller\Welcome@doCommentSave');
$server->addRoute('/^\/notfound$/', '\Blog\Controller\Welcome@doNotFound');

// Tell server to execute services
$server->listen();
