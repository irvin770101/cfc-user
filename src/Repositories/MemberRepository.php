<?php

namespace KSD\Member\Repositories;

use KSD\Member\Models\Member;
use Log;

class MemberRepository
{
    protected $model;

    public function __construct(Member $model)
    {
        $this->model = $model;
    }

    /**
    * 使用id查找成員
    *
    * @param integer $id
    * @return KSD\Member\Models\Mmeber
    */
    public function find($id)
    {
        return $this->model->with(['role.acl'])->find($id);
    }

    /**
    * 使用帳戶名稱查找成員
    *
    * @param string $account
    * @return KSD\Member\Models\Mmeber
    */
    public function findByAccount($account)
    {
        return $this->model
                    ->where('account', $account)
                    ->with(['role.acl'])
                    ->get()
                    ->first();
    }

    /**
    * 更新成員資訊
    *
    * @param integer $id
    * @param array $data
    * @return KSD\Member\Models\Mmeber
    */
    public function update($id, $data)
    {
        $member = $this->find($id);
        if (is_null($member)) {
            return false;
        }
        foreach($data as $k => $v) {
            $member->$k = $v;
        }
        $member->save();
        return $member;
    }

    /**
    * 取得所有成員
    *
    * @return Collection
    */
    public function get()
    {
        return $this->model->with(['role.acl'])->get();
    }
}
