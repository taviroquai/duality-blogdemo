<?php

namespace Blog\Controller;

use Duality\Structure\Http\Request;
use Duality\Structure\Http\Response;
use Duality\Service\Controller\Base as Controller;
use Blog\View\Home;

/**
 * The home controller
 */
class Welcome
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
	 * Run request to get homepage
	 * 
	 * @param \Duality\Structure\Http\Request  $req    The HTTP request
	 * @param \Duality\Structure\Http\Response $res    The HTTP response
     * @param array                            $params The uri params
	 */
	public function doIndex(Request &$req, Response &$res, $params = array())
	{
        // Load View
        $this->view->doDisplayBlog();
        
		// Set response
		$res->setContent($this->view->render());
	}
    
    /**
	 * Run request to get post
	 * 
	 * @param \Duality\Structure\Http\Request  $req    The HTTP request
	 * @param \Duality\Structure\Http\Response $res    The HTTP response
     * @param array                            $params The uri params
	 */
	public function doPost(Request &$req, Response &$res, $params = array())
	{   
        // Load post
        if (!$this->view->doDisplayPost($params[0])) {
            
            // Redirect
            $server = $this->app->call('server');
            return $res = $server->createRedirect('/notfound');
        }
        
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
        $location = '/'. (int) $req->getParam('id_posts');
        
        // Save post
        $model = $this->app->call('comment');
        $data = $req->getParams();
        $data['created_at'] = date('Y-m-d');
        $data['published'] = 1;
        $model->save($data);
        
		// Set response
        $server = $this->app->call('server');
		$res = $server->createRedirect($location);
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