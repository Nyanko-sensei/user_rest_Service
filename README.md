# Practical Exercise for open position

## Requirements

Create user Restful api (only index and show methods). Data must be read from given json or csv  files. Index method  should support limit, offset and filters as get parameters.

## Running project

After pulling this project you should run 
```
composer install
```
Entry point (to use in Apache vhost settings) is 
> <project_dir>/public/index.php

`testtaker.json` and `testtaker.csv` should be added to:
> <project_dir>/data/

## Testing project

Tests can be run by:
```
vendor/bin/phpunit
```

Tests can be found in:
> <project_dir>/tests

## Main points to have in mind when working  with this project

### Routing

For routing I used [nikic/fast-route](https://github.com/nikic/FastRoute).
Routes can be found in:
> <project_dir>/bootstrap/routes.php

Route naming convention is as in laravel:
>\<metthodName>@\<controllerName>

### Dependency injection

For  dependency injection container I used [symfony/dependency-injection](https://symfony.com/doc/current/components/dependency_injection.html).
 It lets easily interchange implemantations.
 Classes, Interfaces and which class is used for which interface implementation is registered in :
 > <project_dir>/bootstrap/app.php
 
 In this project there are 2 diferent UserLoader implementations. In bootstrap/app.php we can choose wich one to use:
```
//User loaders
$containerBuilder->setAlias(
    UserListRest\Interfaces\UserLoaderInterface::class,
//    UserListRest\Components\UserCSVLoader::class
    UserListRest\Components\UserJsonLoader::class
);
```

### Project structure

bootstrap - main structure/settings for project   
data - files from which user loaders loads info   
public - dir to which server should point  
src - main code base   
tests -  phpunit tests