<?php

namespace Jawadabbass\LaravelPermissionUuid\Models;

use Jawadabbass\LaravelPermissionUuid\Traits\UsesUuid;
use Jawadabbass\LaravelPermissionUuid\Scopes\SortedScope;
use Jawadabbass\LaravelPermissionUuid\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    use UsesUuid;

    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope);
        static::addGlobalScope(new SortedScope);
    }

    protected $table = 'roles';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'title', 'created_by_user_id', 'created_by_company_id'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }

    public function getRolePermissionIds()
    {
        $permissionIdsArray = [];
        if ($this->permissions->count() > 0) {
            $permissions = $this->permissions;
            foreach ($permissions as $permission) {
                $permissionIdsArray[] = $permission->id;
            }
        }
        return $permissionIdsArray;
    }


}
