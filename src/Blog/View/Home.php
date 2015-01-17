<?php

namespace Blog\View;

/**
 * The home view
 */
class Home
{
    protected $app;
    protected $dwoo;
    protected $template;
    protected $data;
    protected $navigation;
    
    /**
     * Create the home view
     * 
     * @param Duality\App $app
     */
    public function __construct($app)
    {
        $this->app = $app;
        $this->dwoo = $app->call('dwoo');
        $this->data = new \Dwoo\Data();
        
        // Get services
        $server = $this->app->call('server');
        $session = $this->app->call('session');
        $auth = $this->app->call('auth');
        
        // Default navigation
        $this->navigation = array(
            'active'    => (string) $server->createUrl('/'),
            'items'     => array(
                array('url' => (string) $server->createUrl('/'),        'link' => 'Home'),
                array('url' => (string) $server->createUrl('/admin'),   'link' => 'Admin')
            )
        );
        
        // Set defaults
        $this->template = 'home.html';
        $this->data->assign('isLogged',     $auth->isLogged());
        $this->data->assign('url',          $server->createUrl('/'));
        $this->data->assign('title',        'Duality Blog!');
        $this->data->assign('description',  'Duality Blog description');
        $this->data->assign('keywords',     'Duality Blog keywords');
        $this->data->assign('author',       'Marco Afonso');
		$this->data->assign('heading',      'Duality Blog!');
        
        // Get flash messages
        $this->data->assign('info', $session->take('info'));
        $this->data->assign('error', $session->take('error'));
        $this->data->assign('errors', $session->take('errors'));
    }
    
    public function doDisplayBlog()
    {   
        // Load all posts
        $model = $this->app->call('post');
        $posts = $model->loadAll(10, 0, true);
        
        // Set post
        $this->data->assign('posts', $posts);
    }
    
    public function doDisplayPost($id)
    {
        // Change template
        $this->template = 'post.html';
        
        // Load one post
        $model = $this->app->call('post');
        if (empty($post = $model->loadById($id))) {
            return false;
        }
        
        // Load comments
        $model = $this->app->call('comment');
        $form = $model->loadOrDispense(0);
        $comments = $model->loadPostComments($id);
        
        // fix comments breaklines
        foreach ($comments as &$item) {
            $item['comment'] = nl2br($item['comment']);
        }
        
        
        // Set post
        $server = $this->app->call('server');
        $this->data->assign('post', $post);
        $this->data->assign('saveUrl', $server->createUrl('/comment/save'));
        $this->data->assign('formComment', $form);
        $this->data->assign('comments', $comments);
        return true;
    }
    
    public function do404()
    {
        // Change template
        $this->template = '404.html';
        $this->data->assign('title', 'Content not found!');
        $this->data->assign('heading', 'Content not found!');
    }

    /**
     * Renders the view
     * 
     * @return string
     */
    public function render()
    {
        $this->data->assign('mainNav', $this->navigation);
        return $this->dwoo->get($this->template, $this->data);
    }
}