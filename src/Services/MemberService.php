<?php

namespace KSD\Member\Services;

use KSD\Member\Repositories\MemberRepository;
use Hash;
use Log;

class MemberService
{
    use \KSD\Member\Traits\MemberManager;
    use \KSD\Member\Traits\MemberValidator;

    protected $memberRepo;

    public function __construct(MemberRepository $memberRepo)
    {
        $this->memberRepo = $memberRepo;
    }

    /**
    * 驗證成員是否合法
    * @param string $account
    * @param string $password
    * @return mixed
    */
    public function verify($account, $password, $returnMember = false)
    {
        $member = $this->memberRepo->findByAccount($account);
        if (is_null($member)) {
            return false;
        } else if (Hash::check($password, $member->password)) {
            return $returnMember === true ? $member : true;
        } else {
            return false;
        }
    }

    /**
    * 更新成員資訊
    *
    * @param integer $memberId
    * @param array $data
    * @return KSD\Member\Models\Member
    */
    public function update($memberId, $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return $this->memberRepo->update($memberId, $data);
    }

    /**
    * 分頁取得所有成員
    *
    * @param integer $page
    * @param integer $limit
    * @return Collection
    */
    public function listByPage($page = 1, $limit = 10)
    {
        return $this->memberRepo->get()->slice(($page - 1) * $limit, $limit)->values()->all();
    }
}
