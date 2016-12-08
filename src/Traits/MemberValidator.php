<?php

namespace KSD\Member\Traits;

use Session;
use Log;
use Config;

trait MemberValidator
{
    /**
    * 確認目前登入的成員是否有效
    * @return boolean
    */
    public function isMemberValid()
    {
        if (Session::has('member')) {
            // TODO: 更細節的驗證，是否會員被刪除或權限有被修改需要登出
            return true;
        }
        return false;
    }

    /**
    * 確認成員有指定的權限
    * @param array $acl
    * @return boolean
    */
    public function memberHasAcl($requiredAcl = [])
    {
        // 只要是身份在此清單內，全部放行
        $adminer = Config::get('acl.adminer');
        // 確認成員是否有在管理員身份內
        // 在名單內代表全面放行
        if (array_intersect($this->getMemberRawRole(), $adminer)) {
            return true;
        }

        // 聯集
        $diff = array_intersect($this->getMemberRawAcl(), $requiredAcl);
        $matchNum = count($diff);
        // 吻合數一定要一樣
        if ($matchNum === count($requiredAcl)) {
            return true;
        }
        return false;
    }

    /**
    * 取得純粹的身份字串
    * @return array
    */
    public function getMemberRawRole()
    {
        $memberRoles = Session::get('member.role');
        // 整理出單純的字串
        // ex: ['role_1', 'role_2']
        return $memberRoles->map(function($role) {
            return $role->name;
        })->all();
    }

    /**
    * 取得純粹的權限字串
    * @return array
    */
    public function getMemberRawAcl()
    {
        $memberRoles = Session::get('member.role');
        $result = [];
        foreach($memberRoles as $role) {
            foreach($role->acl as $acl) {
                if (!in_array($acl->name, $result)) {
                    $result[] = $acl->name;
                }
            }
        }
        return $result;
    }
}
