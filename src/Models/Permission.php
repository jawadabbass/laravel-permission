<?php

namespace Jawadabbass\LaravelPermissionUuid\Models;

use Jawadabbass\LaravelPermissionUuid\Traits\UsesUuid;
use Jawadabbass\LaravelPermissionUuid\Scopes\SortedScope;
use Jawadabbass\LaravelPermissionUuid\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    use UsesUuid;

    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope);
        static::addGlobalScope(new SortedScope);
    }

    protected $table = 'permissions';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'title', 'sort_order', 'status'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role', 'permission_id', 'role_id');
    }
}
