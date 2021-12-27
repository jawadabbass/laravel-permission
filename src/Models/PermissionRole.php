<?php

namespace Jawadabbass\LaravelPermissionUuid\Models;

use Jawadabbass\LaravelPermissionUuid\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    use HasFactory;
    use UsesUuid;

    protected $table = 'permission_role';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'permission_id', 'role_id',
    ];

}
