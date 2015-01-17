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
     * Checks if user is valid
     * 
     * @param Response $res The server response
     * 
     * @return boolean The result
     */
    public function validateUser(Response &$res)
    {
        /**
         * Check if user is authenticated
         */
        $auth = $this->app->getAuth();
        if (!$auth->isLogged()) {
            
            // Set redirect
            $server = $this->app->call('server');
            $res = $server->createRedirect('/login');
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
        // Check valid user
        if (!$this->validateUser($res)) {
            return $res;
        }
        
		// Load posts
        $this->view->loadPosts();

		// Set response
		$res->setContent($this->view->render());
	}
    
    /**
	 * Run request to get auth page
	 * 
	 * @param \Duality\Structure\Http\Request  $req    The HTTP request
	 * @param \Duality\Structure\Http\Response $res    The HTTP response
     * @param array                            $params The uri params
	 */
	public function showAuthForm(Request &$req, Response &$res, $params = array())
	{
        // Load services
        $server = $this->app->call('server');
        $session = $this->app->getSession();
        
        // Check valid user
        if (!$session->has('logged')) {
            
            // Set response
            $this->view->loadAuthForm($req->getParams());
            $res->setContent($this->view->render());
        } else {
            
            // Set redirect
            $res = $server->createRedirect();
        }
	}
    
    /**
	 * Submit login
	 * 
	 * @param \Duality\Structure\Http\Request  $req    The HTTP request
	 * @param \Duality\Structure\Http\Response $res    The HTTP response
     * @param array                            $params The uri params
	 */
	public function doLogin(Request &$req, Response &$res, $params = array())
	{
        // Load services
        $server = $this->app->call('server');
        $session = $this->app->call('session');
        $auth = $this->app->call('auth');
        $model = $this->app->call('user');
        
        // Validate input
        if (!$model->validate($req->getParams())) {
            
            $res = $server->createRedirect('/login');
        } else {

            // Login or redirect
            var_dump($req->getParam('pass'));
            $pass = $this->app->getSecurity()->encrypt($req->getParam('pass'));
            if (!$auth->login($req->getParam('email'), $pass)) {

                // Back to form
                $session->set('error', 'Email/password do not authenticate');
                $session->set('inputAuth', $req->getParams());
                $res = $server->createRedirect('/login');
            } else {

                // OK!
                $session->set('logged', $req->getParam('email'));
                $res = $server->createRedirect('/admin');
            }
        }
	}
    
    /**
	 * Logout
	 * 
	 * @param \Duality\Structure\Http\Request  $req    The HTTP request
	 * @param \Duality\Structure\Http\Response $res    The HTTP response
     * @param array                            $params The uri params
	 */
	public function doLogout(Request &$req, Response &$res, $params = array())
	{
        // Load services
        $server = $this->app->call('server');
        $auth = $this->app->getAuth();
        
        // Logout
        $auth->logout();
		$res = $server->createRedirect();
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
        // Check valid user
        if (!$this->validateUser($res)) {
            return $res;
        }
        
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
        // Check valid user
        if (!$this->validateUser($res)) {
            return $res;
        }
        
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
        // Check valid user
        if (!$this->validateUser($res)) {
            return $res;
        }
        
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
        // Check valid user
        if (!$this->validateUser($res)) {
            return $res;
        }
        
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
        // Check valid user
        if (!$this->validateUser($res)) {
            return $res;
        }
        
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
        // Check valid user
        if (!$this->validateUser($res)) {
            return $res;
        }
        
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