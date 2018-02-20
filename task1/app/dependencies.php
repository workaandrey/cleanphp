<?php

$injector = new \Auryn\Injector;

$injector->alias('Http\Request', 'Http\HttpRequest');
$injector->share('Http\HttpRequest');
$injector->define('Http\HttpRequest', [
    ':get' => $_GET,
    ':post' => $_POST,
    ':cookies' => $_COOKIE,
    ':files' => $_FILES,
    ':server' => $_SERVER,
]);

$injector->alias('Http\Response', 'Http\HttpResponse');
$injector->share('Http\HttpResponse');

$injector->alias('\SchoolStore\Domain\Repository\ProductRepositoryInterface', '\SchoolStore\Persistence\MySql\ProductTable');
$injector->share('\SchoolStore\Persistence\MySql\ProductTable');

$injector->alias('\SchoolStore\Domain\Repository\CategoryRepositoryInterface', '\SchoolStore\Persistence\MySql\CategoryTable');
$injector->share('\SchoolStore\Persistence\MySql\CategoryTable');

$injector->alias('\SchoolStore\Domain\Repository\AttributeRepositoryInterface', '\SchoolStore\Persistence\MySql\AttributeTable');
$injector->share('\SchoolStore\Persistence\MySql\AttributeTable');

$injector->alias('\SchoolStore\Domain\Repository\ValueRepositoryInterface', '\SchoolStore\Persistence\MySql\ValueTable');
$injector->share('\SchoolStore\Persistence\MySql\ValueTable');

return $injector;