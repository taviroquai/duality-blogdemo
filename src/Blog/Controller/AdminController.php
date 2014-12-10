<?php

namespace Blog\Controller;

use Duality\Structure\Http\Request;
use Duality\Structure\Http\Response;
use Duality\Service\Controller\Base;
use Blog\View\Admin;

/**
 * The home controller
 */
class AdminController
extends Base
{
    /**
     * Holds the default HTML document
     * @var \Blog\View\Admin
     */
    protected $view;
    
	/**
	 * Init method will run before calling any action
	 * Here you can use filters or register common operations
	 */
	public function init()
	{
		/**
		 * Example of a native template system
		 * Set homepage document (from file template)
		 */
		$this->view = new Admin($this->app);
	}

	/**
	 * Run request to get homepage
	 * 
	 * @param \Duality\Structure\Http\Request  $req    The HTTP request
	 * @param \Duality\Structure\Http\Response $res    The HTTP response
     * @param array                            $params The uri params
	 */
	public function doIndex(Request &$req, Response &$res, $params = array())
	{   
		// Load posts
        $this->view->loadPosts();

		// Set response
		$res->setContent($this->view->render());
	}
    
    /**
	 * Edit post
	 * 
	 * @param \Duality\Structure\Http\Request  $req    The HTTP request
	 * @param \Duality\Structure\Http\Response $res    The HTTP response
     * @param array                            $params The uri params
	 */
	public function doPostEdit(Request &$req, Response &$res, $params = array())
	{   
		// Load form data
        $this->view->loadPostForm($params[0]);
        
		// Set response
		$res->setContent($this->view->render());
	}
    
    /**
	 * Save post
	 * 
	 * @param \Duality\Structure\Http\Request  $req    The HTTP request
	 * @param \Duality\Structure\Http\Response $res    The HTTP response
     * @param array                            $params The uri params
	 */
	public function doPostSave(Request &$req, Response &$res, $params = array())
	{   
		// Default redirect
        $location = '/admin';
        
        // Save post
        $model = $this->app->call('post');
        if (!$model->save($req->getParams())) {
            $location = '/admin/edit/'. (int) $req->getParam('id');
        }
        
		// Set response
        $server = $this->app->call('server');
		$res = $server->createRedirect($location);
	}
    
    /**
	 * Delete post
	 * 
	 * @param \Duality\Structure\Http\Request  $req    The HTTP request
	 * @param \Duality\Structure\Http\Response $res    The HTTP response
     * @param array                            $params The uri params
	 */
	public function doPostDel(Request &$req, Response &$res, $params = array())
	{
        // Delete post
        $model = $this->app->call('post');
        $model->delete($params[0]);
        
		// Set response
        $server = $this->app->call('server');
		$res = $server->createRedirect('/admin');
	}
}