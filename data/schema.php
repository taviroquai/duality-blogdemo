<?php

return array(
    'create' => array(
        'posts' => array(
            'id'            => 'auto',
            'title'         => 'varchar(120)',
            'created_at'    => 'datetime',
            'updated_at'    => 'datetime',
            'body'          => 'text',
            'published'     => 'int(1)'
        ),
        'users' => array(
            'id'    => 'auto',
            'email' => 'varchar(60)',
            'pass'  => 'varchar(255)'
        )
    ),
    'update' => array(
        array('table' => 'posts', 'add' => 'resume', 'type' => 'varchar(255)'),
        array('table' => 'posts', 'add' => 'keywords', 'type' => 'varchar(255)'),
        array('table' => 'posts', 'add' => 'author', 'type' => 'varchar(64)'),
    ),
    'seed' => array(
        array('table' => 'posts', 'truncate' => true, 'values' => array(
            'title' => 'First post',
            'body'  => '<p>First post</p>',
            'published' => 1
        )),
        array('table' => 'users', 'values' => array(
            'email' => 'admin@isp.com',
            'pass'  => 'admin::hash'
        ))
    )
);