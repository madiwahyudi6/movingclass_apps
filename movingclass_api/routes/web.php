<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('activities', 'ActivitiesController@show');
$router->post('create-activity', 'ActivitiesController@create');
$router->get('edit-activity/{id}', 'ActivitiesController@detail');
$router->post('edit-activity/{id}', 'ActivitiesController@update');
$router->delete('delete-activity/{id}', 'ActivitiesController@delete');

$router->get('subject', 'SubjectController@show');
$router->post('create-subject', 'SubjectController@create');
$router->get('edit-subject/{id}', 'SubjectController@detail');
$router->post('edit-subject/{id}', 'SubjectController@update');
$router->delete('delete-subject/{id}', 'SubjectController@delete');

$router->get('classroom', 'ClassroomController@show');
$router->post('create-classroom', 'ClassroomController@create');
$router->get('edit-classroom/{id}', 'ClassroomController@detail');
$router->post('edit-classroom/{id}', 'ClassroomController@update');
$router->delete('delete-classroom/{id}', 'ClassroomController@delete');

$router->get('studentclass', 'StudentclassController@show');
$router->post('create-studentclass', 'StudentclassController@create');
$router->get('edit-studentclass/{id}', 'StudentclassController@detail');
$router->post('edit-studentclass/{id}', 'StudentclassController@update');
$router->delete('delete-studentclass/{id}', 'StudentclassController@delete');
