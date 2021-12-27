<?php

namespace Jawad\Permission\Models;

use Jawad\Permission\Traits\UsesUuid;
use Jawad\Permission\Scopes\SortedScope;
use Jawad\Permission\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{
    use HasFactory;
    use UsesUuid;

    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope);
        static::addGlobalScope(new SortedScope);
    }

    protected $table = 'permissions_group';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'title', 'sort_order', 'status'];

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'permission_group_id', 'id');
    }

}
