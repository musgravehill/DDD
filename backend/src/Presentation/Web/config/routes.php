<?php

declare(strict_types=1);


use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;


/**
 * laminas-router route configuration
 *
 * @see https://docs.laminas.dev/laminas-router/
 *
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Handler\HomePageHandler::class, 'home');
 * $app->post('/album', App\Handler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/:id', App\Handler\AlbumDeleteHandler::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Handler\ContactHandler::class,
 *     Mezzio\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */

// PSALM UnusedVariable Can be suppressed by prefixing the variable name with an underscore:
return static function (Application $app, MiddlewareFactory $_factory, ContainerInterface $_container): void {
    $app->get('/', Presentation\Web\Handler\Home\Handler\HomePageHandler::class, 'home');
    $app->get('/api/ping', Presentation\Web\Handler\Home\Handler\PingHandler::class, 'api.ping');

    /*$app->get(
        '/page',
        $factory->pipeline([
            //some mw
            Page\Handler\PageHandler::class,
            //some mw         
        ]),
        null
    );*/

    /*
    $app->route(
        '/page',
        [
            //Page\Middleware\HeaderPageMiddleware::class,
            //App\Validator\ValidatorMiddleware::class,
            //App\Authentication\AuthenticationMiddleware::class,
            //some mw         
            Page\Handler\PageHandler::class, //handler stop propogation and return response            
        ],
        /*$factory->pipeline([
            Page\Middleware\HeaderPageMiddleware::class,
            //some mw         
            Page\Handler\PageHandler::class, //handler stop propogation and return response            
        ]),/
        Mezzio\Router\Route::HTTP_METHOD_ANY,
        'page.main'
    );
    */
};
