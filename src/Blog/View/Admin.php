<?php

namespace Blog\View;

/**
 * The admin view
 */
class Admin extends Home
{   
    /**
     * Create the home view
     */
    public function __construct($app)
    {
        parent::__construct($app);
        
        // Get services
        $server = $this->app->call('server');
        
        // Set defaults
        $this->template = 'admin.html';
        $this->data->assign('title', 'Blog Administration');
		$this->data->assign('heading', 'Blog Administration');
        $this->navigation['active'] = (string) $server->createUrl('/admin');
        $this->navigation['items'][] = array(
            'url' => $server->createUrl('/admin/edit').'/0', 'link' => 'New Post'
        );
    }

    /**
     * Load posts into view
     */
    public function loadPosts()
    {
        // Load all posts
        $model = $this->app->call('post');
        $items = $model->loadAll();
        
        // Set URLs
        $server = $this->app->call('server');
        $this->data->assign('posts', $items);
        $this->data->assign('editUrl', $server->createUrl('/admin/edit'));
        $this->data->assign('delUrl', $server->createUrl('/admin/del'));
    }
    
    /**
     * Load post into form
     * 
     * @param int $id
     */
    public function loadPostForm($id)
    {
        // Set defaults
        $this->template = 'formpost.html';
        
        // Load all posts
        $model = $this->app->call('post');
        $post = $model->loadOrDispense($id);
        $post['bodyHtmlEntities'] = htmlentities($post['body']);
        
        // Set URLs
        $server = $this->app->call('server');
        $this->data->assign('saveUrl', $server->createUrl('/admin/save/'.$id));
        $this->data->assign('formPost', $post);
    }
    
    /**
     * Loads the authentication form
     * 
     * @param array $input The user input
     */
    public function loadAuthForm($input)
    {
        // Set defaults
        $this->template = 'formauth.html';
        
        // Set URLs
        $server = $this->app->call('server');
        $this->data->assign('loginUrl', $server->createUrl('/login/submit'));
        $this->data->assign('formAuth', $input);
    }
    
}