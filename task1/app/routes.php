<?php

return [
    ['GET', '/', ['SchoolStore\App\Controllers\Products', 'index']],
    ['GET', '/byCategory/{id:\d+}', ['SchoolStore\App\Controllers\Products', 'byCategory']],
];