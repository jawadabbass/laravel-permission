<?php

namespace Jawad\Permission\Models;

use Jawad\Permission\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;
    use UsesUuid;

    protected $table = 'role_user';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'role_id', 'user_id',
    ];

}
