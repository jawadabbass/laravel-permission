Laravel Package for role based permissions with UUID

## Installation

First, install the package through Composer.

```
php composer require jawadabbass/laravel-permission-uuid
```

Publish config and migrations

```
php artisan vendor:publish --provider="Jawadabbass\LaravelPermissionUuid\LaravelPermissionUuidServiceProvider"
```

Configure the published config in

```
config\jawad_permission_uuid.php
```

Finally, migrate the database

```
php artisan migrate
```
