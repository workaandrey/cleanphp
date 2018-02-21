<?php

return [
    ['GET', '/', ['SchoolStore\App\Controllers\Products', 'index']],
    ['GET', '/search', ['SchoolStore\App\Controllers\Products', 'search']],
    ['GET', '/byCategory/{id:\d+}', ['SchoolStore\App\Controllers\Products', 'byCategory']],
];