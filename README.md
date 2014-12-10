Blog Demo of Duality PHP Framework
===============================

Features
--------
1. SQLite as database
1. MVC example at ./src/Blog
1. CRUD of blog posts
1. Dwoo as template engine (using cache)
1. Twitter Bootstrap as CSS framework

Blog Namespace Usage
-------------------
1. Model\Post
1. Controller\Welcome
1. Controller\AdminController
1. View\Home
1. View\Admin

Non-PHP Code Files
--------------------
1. data/template.html
1. data/home.html
1. data/nav.html
1. data/messages.html
1. data/post.html
1. data/admin.html
1. data/formpost.html
1. data/404.html
1. data/db.sqlite
1. data/schema.php

Duality Namespace Usage
-------------------
1. App
1. Service\Server
1. Service\Controller\Base
1. Service\Session
1. Service\Database
1. Service\Validator
1. Structure\Http\Request
1. Structure\Http\Response
1. Structure\Database\Table
1. Structure\Database\Filter
1. Structure\RuleItem
1. Structure\Entity

How to Install
--------------
1. Download **zip** file and **extract** to an Apache web directory
2. Install dependencies with **composer**: php composer.phar install
3. Enable mod rewrite on Apache webserver
4. Edit **config/app.php** and change your local settings
5. Open in browser http://localhost/blog/

Observations
------------
The number of LoC using Duality Framework is about 10%-20% of the total files.  
Database schema was created with:  
```
php cmd.php db:create
php cmd.php db:update
php cmd.php db:seed
```