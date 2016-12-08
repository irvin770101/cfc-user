<?php

namespace KSD\Member\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';

    public function acl()
    {
        return $this->belongsToMany('KSD\Member\Models\Acl', 'role_acl', 'role_id', 'acl_id');
    }
}
