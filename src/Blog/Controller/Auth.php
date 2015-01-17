<?php

namespace Blog\Controller;

use Duality\Structure\Http\Request;
use Duality\Structure\Http\Response;
use Duality\Service\Controller\Base as Controller;
use Blog\View\Home;

/**
 * The auth controller
 */
class Auth
extends Controller
{
    /**
     * Holds the default HTML document
     * @var \Duality\Structure\HtmlDoc
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
		$this->view = new Home($this->app);
        
        // Init session
        $this->app->call('session');
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
	 * Run request to get 404
	 * 
	 * @param \Duality\Structure\Http\Request  $req    The HTTP request
	 * @param \Duality\Structure\Http\Response $res    The HTTP response
     * @param array                            $params The uri params
	 */
	public function doNotFound(Request &$req, Response &$res, $params = array())
	{
        // Load View
        $this->view->do404();
        
		// Set response
		$res->setContent($this->view->render());
	}
}