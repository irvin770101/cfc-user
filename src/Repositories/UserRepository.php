<?php

namespace CFC\User\Repositories;

use CFC\User\Models\User;
use Log;

class UserRepository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }
    
    /**
     * 新增會員帳號
     * @param $array $data 新增資料
     */
    public function add($data){
        return $this->model->insertGetId($data);
    }
//
//    /**
//    * 使用id查找成員
//    * @param integer $id
//    */
//    public function find($id)
//    {
//        return $this->model->find($id);
//    }
//
//    /**
//    * 使用帳戶名稱查找成員
//    * @param string $account
//    */
//    public function findByAccount($account)
//    {
//        return $this->model
//                    ->where('account', $account)
//                    ->get()
//                    ->first();
//    }
//
//    /**
//    * 更新成員資訊
//    *
//    * @param integer $id
//    * @param array $data
//    * @return CFC\User\Models\Mmeber
//    */
//    public function update($id, $data)
//    {
//        $member = $this->find($id);
//        if (is_null($member)) {
//            return false;
//        }
//        foreach($data as $k => $v) {
//            $member->$k = $v;
//        }
//        $member->save();
//        return $member;
//    }
//
//    /**
//    * 取得所有成員
//    *
//    * @return Collection
//    */
//    public function get()
//    {
//        return $this->model->get();
//    }
}
