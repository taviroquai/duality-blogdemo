<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

// Configure autoloaders
require_once './vendor/autoload.php';
require_once './src/autoload.php';

// Define local configuration
return array(

    // Logger Example: $app->call('logger')->log('My message!');
    'logger'    => array(
        'buffer'    => './data/logs.txt'
    ),

    // Database Example: $app->call('db')->reloadFromConfig();
    'db'    => array(
        'dsn'       => 'sqlite:./data/db.sqlite',
        'user'      => 'root',
        'pass'      => 'toor',
        'schema'    => 'data/schema.php'
    ),
    
    // Security Example: $password = $app->encrypt('password');
    'security'	=> array(
        'salt'  => 'secret!',
        'hash'  => 'sha256'
    ),
    
    // Auth configuration
    'auth' => array(
        'table' => 'users',
        'user'  => 'email',
        'pass'  => 'pass'
    ),
    
    // Use native PHP sessions
    'services'  => array(
        'session' => '\Duality\Service\Session\Native'
    )
);
