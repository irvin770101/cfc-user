<?php

namespace KSD\Member\Traits;

use Session;

trait MemberManager
{
    /**
    * 登出目前成員
    * @return void
    */
    public function signOut()
    {
        Session::forget('member');
    }

    /**
    * 取得當前登入的成員資訊
    * @return KSD\Member\Models\Member
    */
    public function getCurrentMember()
    {
        return Session::get('member');
    }
}
