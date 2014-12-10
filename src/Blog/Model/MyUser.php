<?php

namespace Blog\Model;

use Duality\Structure\Database\Filter;
use Duality\Structure\RuleItem;
use Duality\Structure\Entity\User;

/**
 * Description of MyUSer
 *
 * @author adminuser
 */
class MyUser
extends User
{   
    /**
     * Holds the duality application
     * 
     * @var \Duality\App The duality application
     */
    protected $app;
    
    /**
     * Creates a new post model
     * 
     * @param \Duality\App $app The application
     */
    public function __construct(\Duality\App $app)
    {
        parent::__construct($app->call('db'));
        $this->app = $app;
    }
    
    /**
     * Gets one post by id
     * 
     * @param int $id The post id
     * 
     * @return array|false
     */
    public function loadById($id)
    {
        $filter = new Filter($this->table);
        $filter->columns(implode(',', $this->getProperties()));
        $filter->where('id = ?', array($id))->limit(1);
        $items = $this->table->filter($filter)->toArray();
        if (empty($items)) {
            return false;
        }
        return reset($items);
    }

    /**
     * Validates a post
     * 
     * @param array $user
     * 
     * @return boolean
     */
    public function validate($user)
    {
        $validator = $this->app->call('validator');
        $validator->addRuleItem(new RuleItem(
            'email',
            $user['email'],
            'required|email',
            'User email is ok',
            'User email is not valid'
        ));
        $validator->addRuleItem(new RuleItem(
            'pass',
            $user['pass'],
            'required',
            'User password is ok',
            'User password cannot be empty'
        ));
        $validator->validate(); // Calculate validation
        if (!$validator->ok()) {
            $this->app->call('session')->set(
                'errors', $validator->getErrorMessages()
            );
            
            // Save input on session
            $session = $this->app->call('session');
            $session->set('inputAuth', $user);
        }
        return $validator->ok();
    }
    
}
