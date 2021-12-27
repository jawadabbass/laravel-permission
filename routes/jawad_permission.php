<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Jawad\Permission\Http\Controllers')
    ->prefix(config('jawad_permission.route_prefix', null))
    ->name(config('jawad_permission.route_name_prefix', null))
    ->middleware([config('jawad_permission.route_middleware'), 'jawad_permission_is_super_admin'])
    ->domain(config('jawad_permission.route_domain', null))
    ->group(function () {

        /* Permissions Routes */
        Route::resource('permissions', PermissionController::class);
        Route::get('fetchPermissionsAjax', [PermissionController::class, 'fetchPermissionsAjax'])->name('fetchPermissionsAjax');
        Route::put('make-active-permission', [PermissionController::class, 'makeActivePermission'])->name('make.active.permission');
        Route::put('make-not-active-permission', [PermissionController::class, 'makeNotActivePermission'])->name('make.not.active.permission');
        Route::get('permissions-sort', [PermissionController::class, 'sortPermissions'])->name('permissions.sort');
        Route::get('permissions-sort-data', [PermissionController::class, 'permissionSortData'])->name('permissions.sort.data');
        Route::put('permissions-sort-update', [PermissionController::class, 'permissionSortUpdate'])->name('permissions.sort.update');
        Route::put('updatePermissionGroupId', [PermissionController::class, 'updatePermissionGroupId'])->name('updatePermissionGroupId');

        /* Permission Groups Routes */
        Route::resource('permissionGroup', PermissionGroupController::class);
        Route::get('fetchPermissionGroupsAjax', [PermissionGroupController::class, 'fetchPermissionGroupsAjax'])->name('fetchPermissionGroupsAjax');
        Route::put('make-active-permissionGroup', [PermissionGroupController::class, 'makeActivePermissionGroup'])->name('make.active.permissionGroup');
        Route::put('make-not-active-permissionGroup', [PermissionGroupController::class, 'makeNotActivePermissionGroup'])->name('make.not.active.permissionGroup');
        Route::get('permissionGroup-sort', [PermissionGroupController::class, 'sortPermissionGroups'])->name('permissionGroup.sort');
        Route::get('permissionGroup-sort-data', [PermissionGroupController::class, 'permissionGroupSortData'])->name('permissionGroup.sort.data');
        Route::put('permissionGroup-sort-update', [PermissionGroupController::class, 'permissionGroupSortUpdate'])->name('permissionGroup.sort.update');

        /* Roles Routes */
        Route::resource('roles', RoleController::class);
        Route::get('fetchRolesAjax', [RoleController::class, 'fetchRolesAjax'])->name('fetchRolesAjax');
        Route::put('make-active-roles', [RoleController::class, 'makeActiveRole'])->name('make.active.roles');
        Route::put('make-not-active-roles', [RoleController::class, 'makeNotActiveRole'])->name('make.not.active.roles');
        Route::get('roles-sort', [RoleController::class, 'sortRoles'])->name('roles.sort');
        Route::get('roles-sort-data', [RoleController::class, 'rolesSortData'])->name('roles.sort.data');
        Route::put('roles-sort-update', [RoleController::class, 'rolesSortUpdate'])->name('roles.sort.update');

        /* Users Routes */
        Route::resource('users', UserController::class);
        Route::get('fetchUsersAjax', [UserController::class, 'fetchUsersAjax'])->name('fetchUsersAjax');
    });
