<?php

/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
Router::connect('/', array('plugin' => false, 'controller' => 'users', 'action' => 'index'));

Router::connect('/about-us', array('plugin' => false, 'controller' => 'pages', 'action' => 'about_us', 'about_us'));
Router::connect('/contact-us', array('plugin' => false, 'controller' => 'pages', 'action' => 'contact_us', 'contact_us'));
Router::connect('/what-we-offer', array('plugin' => false, 'controller' => 'pages', 'action' => 'what_we_offer'));
Router::connect('/login', array('plugin' => false, 'controller' => 'users', 'action' => 'login'));
Router::connect('/register', array('plugin' => false, 'controller' => 'users', 'action' => 'register'));
Router::connect('/forgot-password', array('plugin' => false, 'controller' => 'users', 'action' => 'forgot_password'));
Router::connect('/developer-projects', array('plugin' => false, 'controller' => 'users', 'action' => 'developer_projects'));
Router::connect('/blog/*', array('plugin' => false, 'controller' => 'blogs', 'action' => 'index'));

Router::connect('/logout', array('plugin' => false, 'controller' => 'users', 'action' => 'logout'));
Router::connect('/my-profile', array('plugin' => false, 'controller' => 'users', 'action' => 'my_profile'));
Router::connect('/my-listing', array('plugin' => false, 'controller' => 'properties', 'action' => 'my_listing'));


Router::connect('/blog-detail/*', array('plugin' => false, 'controller' => 'blogs', 'action' => 'detail'));

Router::connect('/terms-and-conditions', array('plugin' => false, 'controller' => 'pages', 'action' => 'terms_and_conditions', 2));
Router::connect('/personal-information-collection-statement', array('plugin' => false, 'controller' => 'pages', 'action' => 'terms_and_conditions', 4));

Router::connect('/verify-account/*', array('plugin' => false, 'controller' => 'users', 'action' => 'verify_account'));

Router::connect('/change-password', array('plugin' => false, 'controller' => 'users', 'action' => 'change_pass'));


Router::connect(
        '/p/*', array('controller' => 'pages', 'action' => 'pages')
);
CakePlugin::routes();
//Router::parseExtensions('rss');
/**
 * Load the CakePHP default routes. Remove this if you do not want to use
 * the built-in default routes.
 */
require CAKE . 'Config' . DS . 'routes.php';
