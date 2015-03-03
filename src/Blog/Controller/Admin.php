<?php

namespace Blog\Controller;

use Duality\Core\InterfaceAuthorization;
use Duality\Structure\Http\Request;
use Duality\Structure\Http\Response;
use Duality\Service\Controller\Base;
use Blog\View\Admin as AdminView;

/**
 * The admin controller
 */
class Admin
extends Base
implements InterfaceAuthorization
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
		$this->view = new AdminView($this->app);
	}
    
    /**
     * Validates authorization
     * 
     * @param \Duality\Core\Request  $req     The HTTP request
     * @param \Duality\Core\Response $res     The HTTP response
     * @param array                  $matches The route matched params
     * 
     * @return boolean The authorization result
     */
    public function isAuthorized(Request &$req, Response &$res, $matches = array())
    {
        $auth = $this->app->getAuth();
        if (!$auth->isLogged()) {

            // Set redirect
            $res = $this->app->call('server')->createRedirect('/login');
            return false;
        }

        // OK!
        return true;
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
    
    /**
	 * Edit comment
	 * 
	 * @param \Duality\Structure\Http\Request  $req    The HTTP request
	 * @param \Duality\Structure\Http\Response $res    The HTTP response
     * @param array                            $params The uri params
	 */
	public function doCommentEdit(Request &$req, Response &$res, $params = array())
	{   
		// Load form data
        $this->view->loadCommentForm($params[0]);
        
		// Set response
		$res->setContent($this->view->render());
	}
    
    /**
	 * Save comment
	 * 
	 * @param \Duality\Structure\Http\Request  $req    The HTTP request
	 * @param \Duality\Structure\Http\Response $res    The HTTP response
     * @param array                            $params The uri params
	 */
	public function doCommentSave(Request &$req, Response &$res, $params = array())
	{   
		// Default redirect
        $location = '/admin/edit/' . (int) $req->getParam('id_posts');
        
        // Save post
        $model = $this->app->call('comment');
        if (!$model->save($req->getParams())) {
            $location = '/admin/comment/edit/'. (int) $req->getParam('id');
        }
        
		// Set response
        $server = $this->app->call('server');
		$res = $server->createRedirect($location);
	}
    
    /**
	 * Delete comment
	 * 
	 * @param \Duality\Structure\Http\Request  $req    The HTTP request
	 * @param \Duality\Structure\Http\Response $res    The HTTP response
     * @param array                            $params The uri params
	 */
	public function doCommentDel(Request &$req, Response &$res, $params = array())
	{   
        // Default redirect
        $redirect = '/admin';
        
        // Delete post
        $model = $this->app->call('comment');
        $comment = $model->loadById($params[0]);
        if ($comment) {
            $id_posts = $comment['id_posts'];
            $model->delete($comment['id']);
            $redirect = '/admin/edit/' . (int) $id_posts;
        }
        
		// Set response
        $server = $this->app->call('server');
		$res = $server->createRedirect($redirect);
	}
}