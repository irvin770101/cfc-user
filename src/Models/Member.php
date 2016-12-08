<?php

namespace KSD\Member\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'member';

    public function role()
    {
        return $this->belongsToMany('KSD\Member\Models\Role', 'member_role', 'member_id', 'role_id');
    }
}
