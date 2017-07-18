<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */

 	
    Router::parseExtensions();
    Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
    Router::connect('/landing', array('controller' => 'pages', 'action' => 'display', 'home'));
    Router::connect('/admin', array('plugin' => 'admin', 'controller' => 'dashboard', 'action' => 'index'));
    Router::connect('/admin/:controller/:action/*', array('plugin' => 'admin'));
    Router::connect('/changePassword', array('controller' => 'players', 'action' => 'changePassword'));
	Router::connect('/stage', array('controller' => 'pages', 'action' => 'display', 'stage'));
	Router::connect('/finalScreen', array('controller' => 'pages', 'action' => 'display', 'finalScreen'));
	Router::connect('/profile', array('controller' => 'pages', 'action' => 'display', 'profile'));
	Router::connect('/hairyQuestions', array('controller' => 'pages', 'action' => 'display', 'hairyQuestions'));
	Router::connect('/trophies', array('controller' => 'pages', 'action' => 'display', 'trophies'));
	Router::connect('/notifications', array('controller' => 'pages', 'action' => 'display', 'notifications'));
	Router::connect('/gameplay', array('controller' => 'pages', 'action' => 'display', 'gameplay'));
	Router::connect('/storedQuestions', array('controller' => 'pages', 'action' => 'display', 'storedQuestions'));
	Router::connect('/challengeSelector', array('controller' => 'pages', 'action' => 'display', 'challengeSelector'));
	Router::connect('/updateCiudades/*', array('controller' => 'app', 'action' => 'getCiudades'));
	Router::connect('/refreshSidebar', array('controller' => 'app', 'action' => 'reloadSidebar'));
	Router::connect('/restartLives', array('controller' => 'app', 'action' => 'restartLives'));
	Router::connect('/giveOne', array('controller' => 'app', 'action' => 'giveOne'));
	Router::connect('/getRanking', array('controller' => 'app', 'action' => 'getRanking'));
	Router::connect('/markNotificationAsRead', array('controller' => 'app', 'action' => 'markNotificationAsRead'));
/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
