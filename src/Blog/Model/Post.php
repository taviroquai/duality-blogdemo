<?php

namespace Blog\Model;

use Duality\Structure\Database\Filter;
use Duality\Structure\RuleItem;
use Duality\Structure\Entity;

/**
 * Description of Post
 *
 * @author adminuser
 */
class Post
extends Entity
{
    /**
     * Holds the entity configuration for extended functionality
     * 
     * @var array The list of configuration items
     */
    protected $config = array(
        'name' => 'posts',
        'properties' => array(
            'id',
            'title',
            'resume',
            'keywords',
            'author',
            'body',
            'created_at',
            'updated_at',
            'published'
        )
    );
    
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
     * Gets all items
     * 
     * @param type $limit  The limit of list
     * @param type $offset The start offset of list
     * 
     * @return array The list of items
     */
    public function loadAll(
        $limit = 10, $offset = 0, $published = false
    ) {
        $filter = new Filter($this->table);
        $filter->columns(implode(',', $this->getProperties()));
        if ($published) {
            $filter->where('published = ?', array(1));
        }
        $filter->limit($limit, $offset);
        return $this->table->filter($filter)->toArray();
    }
    
    /**
     * Returns or crestes a new post
     * 
     * @param int $id The post id
     * 
     * @return array
     */
    public function loadOrDispense($id)
    {
        $post = $this->loadById($id);
        if (empty($post)) {
            $post = array();
            foreach ($this->getProperties() as $column) {
                $post[(string)$column] = '';
            }
        }
        
        // Get last input from session
        $session = $this->app->call('session');
        if ($session->has('inputPost')) {
            $post = $session->take('inputPost');
        }
        return $post;
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
     * @param array $post
     * 
     * @return boolean
     */
    public function validate($post)
    {
        $validator = $this->app->call('validator');
        $validator->addRuleItem(new RuleItem(
            'title',
            $post['title'],
            'required',
            'Post title is ok',
            'Post title cannot be empty'
        ));
        $validator->addRuleItem(new RuleItem(
            'body',
            $post['body'],
            'required',
            'Post body is ok',
            'Post body cannot be empty'
        ));
        $validator->addRuleItem(new RuleItem(
            'resume',
            $post['resume'],
            'required',
            'Post resume is ok',
            'Post resume cannot be empty'
        ));
        $validator->addRuleItem(new RuleItem(
            'keywords',
            $post['keywords'],
            'required',
            'Post keywords is ok',
            'Post keywords cannot be empty'
        ));
        $validator->validate(); // Calculate validation
        if (!$validator->ok()) {
            $this->app->call('session')->set(
                'errors', $validator->getErrorMessages()
            );
            
            // Save input on session
            $session = $this->app->call('session');
            $session->set('inputPost', $post);
        }
        return $validator->ok();
    }
    
    /**
     * Saves the post
     * 
     * @param array $post The post values
     * 
     * @return boolean
     */
    public function save($post)
    {
        // Validate data
        if (!$this->validate($post)) {
            return false;
        }
        
        // Update post
        $post['updated_at'] = date('Y-m-d');
        if (empty($post['id'])) {
            
            // Create
            unset($post['id']);
            $post['created_at'] = date('Y-m-d');
            $this->table->add(1, $post);
        } else {
            
            // Update
            $this->table->set($post['id'], $post);
        }
        
        // Set message
        $session = $this->app->call('session');
        $session->set('info', 'The post was saved!');
        return $post;
    }
    
    /**
     * Deletes a post
     * 
     * @param int $id The post id to be deleted
     */
    public function delete($id)
    {
        // Delete from table
        $this->table->remove($id);
        
        // Set message
        $session = $this->app->call('session');
        $session->set('info', 'The post was deleted!');
    }
    
}
