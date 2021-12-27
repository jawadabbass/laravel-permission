Laravel Package for role based permissions

## Installation

First, install the package through Composer.

```
php composer require jawadabbass/laravel-permission
```

Publish config and migrations

```
php artisan vendor:publish --provider="Jawad\Permission\PermissionServiceProvider"
```

Configure the published config in

```
config\jawad_permission.php
```

Finally, migrate the database

```
php artisan migrate
```
