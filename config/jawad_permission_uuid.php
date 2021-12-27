<?php

return [
    'route_middleware' => ['auth', 'jpu_is_super_admin'],
    'route_prefix' => 'admin',
    'route_name' => 'admin.',
    'route_domain' => null,
    'guard' => null,
];
