<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 * Cache: Routes are cached to improve performance, check the RoutingMiddleware
 * constructor in your `src/Application.php` file to change this behavior.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    // Register scoped middleware for in scopes.
    $routes->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httpOnly' => true
    ]));

    /**
     * Apply a middleware to the current route scope.
     * Requires middleware to be registered via `Application::routes()` with `registerMiddleware()`
     */
    #$routes->applyMiddleware('csrf');

    #INDEX
    $routes->connect(
        '/',
        [
            'controller' => 'Comentarios'
        ]
    );


    #Exibir comentario
    $routes->connect(
        '/comentario/:id',
        [
            'controller' => 'Comentarios',
            'action' => 'exibir'
        ],
        [
            'id'    =>  '\d+',
            'pass'  =>  ['id']
        ]
    );

    #Login
    $routes->connect(
        '/login',
        [
            'controller' => 'Usuarios',
            'action' => 'login'
        ]
    );

    #LogOut
    $routes->connect(
        '/logout',
        [
            'controller' => 'Usuarios',
            'action' => 'logout'
        ]
    );

    #Cadastro
    $routes->connect(
        '/cadastro',
        [
            'controller' => 'Usuarios',
            'action' => 'cadastro'
        ]
    );

    #Cadastro
    $routes->connect(
        '/comentar',
        [
            'controller' => 'comentarios',
            'action' => 'add'
        ]
    );

    #Deletar comentario
    $routes->connect(
        '/deletar-comentario/:id',
        [
            'controller' => 'comentarios',
            'action' => 'deletar'
        ],
        ['id' => '\d+', 'pass' => ['id']]
    );

    #Editar comentario
    $routes->connect(
        '/editar-comentario/:id',
        [
            'controller' => 'comentarios',
            'action' => 'editar'
        ],
        ['id' => '\d+', 'pass' => ['id']]
    );

    #Meus comentários
    $routes->connect(
        '/meus-comentarios',
        [
            'controller' => 'comentarios',
            'action' => 'listarMeusComentarios'
        ]
    );

    #Meus comentários
    $routes->connect(
        '/usuarios-editar',
        [
            'controller' => 'usuarios',
            'action' => 'editar'
        ]
    );

    #Perquisar comentários
    $routes->connect(
        '/buscar-comentario',
        [
            'controller' => 'comentarios',
            'action' => 'buscar'
        ]
    );
});
