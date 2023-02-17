<?php

use Core\Router;

require_once __DIR__ . "/../core/bootstrap.php";

// Create new Router instance
$router = new Router();
// Add routes to the router

// Route for the home page
$router->add('/', ['controller' => 'HomeController', 'action' => 'index']);

// Group of routes for the user
$router->group('/user', [], function () use ($router) {
    // Route for the user index page
    $router->add('', ['controller' => 'User\UserController', 'action' => 'index']);
    // Route for a specific user page
    $router->add('/([0-9]+)', ['controller' => 'User\UserController', 'action' => 'show']);
    // Route for creating a new user
    $router->add('/create', ['controller' => 'User\UserController', 'action' => 'create']);
    // Route for updating an existing user
    $router->add('/([0-9]+)/update', ['controller' => 'User\UserController', 'action' => 'update']);
    // Route for deleting an existing user
    $router->add('/([0-9]+)/delete', ['controller' => 'User\UserController', 'action' => 'delete']);
});

// Group of routes for departments
$router->group('/departments', [], function () use ($router) {
    // Route for the departments index page
    $router->add('', ['controller' => 'Departments\DepartmentController', 'action' => 'index']);
    // Route for creating a new department
    $router->add('/create', ['controller' => 'Departments\DepartmentController', 'action' => 'create']);
    // Route for viewing a specific department
    $router->add('/([0-9]+)', ['controller' => 'Departments\DepartmentController', 'action' => 'show']);
    // Route for editing a specific department
    $router->add('/([0-9]+)/edit', ['controller' => 'Departments\DepartmentController', 'action' => 'update']);
    // Route for deleting a specific department
    $router->add('/([0-9]+)/delete', ['controller' => 'Departments\DepartmentController', 'action' => 'delete']);
});

// Group of routes for user-department relationships
$router->group('/user/([0-9]+)/department/([0-9]+)/', [], function () use ($router) {
    // Route for adding a user to a department
    $router->add('add', ['controller' => 'Relationships\DepartmentUserController', 'action' => 'addUserToDepartment']);
    // Route for removing a user from a department
    $router->add('remove', ['controller' => 'Relationships\DepartmentUserController', 'action' => 'removeUserFromDepartment']);
});

// Group of routes for a specific department
$router->group('/department/([0-9]+)/', [], function () use ($router) {
    // Route for getting all users in a specific department
    $router->add('users', ['controller' => 'Relationships\DepartmentUserController', 'action' => 'getUsersInDepartment']);
});

// Group of routes for a specific user
$router->group('/user/([0-9]+)/', [], function () use ($router) {
    // Route for getting all departments for a specific user
    $router->add('departments', ['controller' => 'Relationships\DepartmentUserController', 'action' => 'getDepartmentsForUser']);
});

// Group of routes for streets
$router->group('/streets', [], function () use ($router) {
    // Route for getting all streets
    $router->add('', ['controller' => 'Game\StreetsController', 'action' => 'index']);
    // Route for getting a street by id
    $router->add('/([0-9]+)', ['controller' => 'Game\StreetsController', 'action' => 'show']);
    // Route for adding a new street
    $router->add('/create', ['controller' => 'Game\StreetsController', 'action' => 'create']);
    // Route for updating a street
    $router->add('/([0-9]+)/update', ['controller' => 'Game\StreetsController', 'action' => 'update']);
    // Route for deleting a street
    $router->add('/([0-9]+)/delete', ['controller' => 'Game\StreetsController', 'action' => 'delete']);
});


// Group of routes for the API roles
$router->group('/api-role', [], function () use ($router) {
    // Route for the API roles index page
    $router->add('', ['controller' => 'Api\ApiRoleController', 'action' => 'index']);
    // Route for creating a new API role
    $router->add('/create', ['controller' => 'Api\ApiRoleController', 'action' => 'create']);
    // Route for viewing a specific API role
    $router->add('/([0-9]+)', ['controller' => 'Api\ApiRoleController', 'action' => 'show']);
    // Route for updating a specific API role
    $router->add('/([0-9]+)/update', ['controller' => 'Api\ApiRoleController', 'action' => 'update']);
    // Route for deleting a specific API role
    $router->add('/([0-9]+)/delete', ['controller' => 'Api\ApiRoleController', 'action' => 'delete']);
});

// Group of routes for the API Permissions
$router->group('/api-permissions', [], function () use ($router) {
    // Route for the API Permissions index page
    $router->add('', ['controller' => 'Api\ApiPermissionController', 'action' => 'index']);
    // Route for creating a new API Permission
    $router->add('/create', ['controller' => 'Api\ApiPermissionController', 'action' => 'create']);
    // Route for viewing a specific API Permission
    $router->add('/([0-9]+)', ['controller' => 'Api\ApiPermissionController', 'action' => 'show']);
    // Route for editing a specific API Permission
    $router->add('/([0-9]+)/edit', ['controller' => 'Api\ApiPermissionController', 'action' => 'update']);
    // Route for deleting a specific API Permission
    $router->add('/([0-9]+)/delete', ['controller' => 'Api\ApiPermissionController', 'action' => 'delete']);
});

// Group of routes for the API Role Permissions
$router->group('/api-role-permissions', [], function () use ($router) {
    // Route for the api role permissions index page
    $router->add('', ['controller' => 'Relationships\ApiRolePermissionController', 'action' => 'index']);
    // Route for creating a new api role permission
    $router->add('/create', ['controller' => 'Relationships\ApiRolePermissionController', 'action' => 'create']);
    // Route for viewing a specific api role permission
    $router->add('/([0-9]+)', ['controller' => 'Relationships\ApiRolePermissionController', 'action' => 'show']);
    // Route for editing a specific api role permission
    $router->add('/([0-9]+)/edit', ['controller' => 'Relationships\ApiRolePermissionController', 'action' => 'update']);
    // Route for deleting a specific api role permission
    $router->add('/role/([0-9]+)/perm/([0-9])/delete', ['controller' => 'Relationships\ApiRolePermissionController', 'action' => 'delete']);
});


// Dispatch the URL
$router->dispatch($_SERVER['REQUEST_URI']);