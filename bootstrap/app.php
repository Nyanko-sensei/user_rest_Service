<?php

/**
 * There we register classes, interfaces and which class to use for which interface.
 * It's done, to enable auto wiring and make interface implementations easily changeable
 */

use Symfony\Component\DependencyInjection\ContainerBuilder;

$containerBuilder = new ContainerBuilder();

// Controllers
$containerBuilder->autowire(UserListRest\Controllers\UserController::class)->setPublic(true);
$containerBuilder->autowire(UserListRest\Controllers\HomeController::class)->setPublic(true);

//User repositories
$containerBuilder->autowire(UserListRest\Components\LoadedUserRepository::class);
$containerBuilder->setAlias(
    UserListRest\Interfaces\UserRepositoryInterface::class,
    UserListRest\Components\LoadedUserRepository::class
);

//User loaders
$containerBuilder->autowire(UserListRest\Components\UserCSVLoader::class);
$containerBuilder->setAlias(
    UserListRest\Interfaces\UserLoaderInterface::class,
    UserListRest\Components\UserCSVLoader::class
//    UserListRest\Components\UserJsonLoader::class
);

//Response handler
$containerBuilder->autowire(UserListRest\Components\JsonResponse::class);
$containerBuilder->setAlias(
    UserListRest\Interfaces\ResponseInterface::class,
    UserListRest\Components\JsonResponse::class
)->setPublic('true');


$containerBuilder->compile();

return $containerBuilder;