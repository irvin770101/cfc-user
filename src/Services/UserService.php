<?php

namespace CFC\User\Services;

use CFC\User\Repositories\UserRepository;
use Hash;
use Log;

class UserService
{

    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    
    /**
     * 新增會員
     *  @param array $user_data 使用者資料
     */
    public function addUser($user_data){
        $user_data =[
            'name' => 'irvin',
            'account' => 'irvin',
            'password' => Hash::make('123456'),
            'email' => 'chuang.f.c@gmail.com',
        ];
        return $this->userRepo->add($user_data);
        
    }
    
//
//    /**
//    * 驗證成員是否合法
//    * @param string $account
//    * @param string $password
//    * @return mixed
//    */
//    public function verify($account, $password, $returnUser = false)
//    {
//        $user = $this->userRepo->findByAccount($account);
//        if (is_null($user)) {
//            return false;
//        } else if (Hash::check($password, $user->password)) {
//            return $returnUser === true ? $user : true;
//        } else {
//            return false;
//        }
//    }
//
//    /**
//    * 更新成員資訊
//    *
//    * @param integer $userId
//    * @param array $data
//    * @return CFC\User\Models\User
//    */
//    public function update($userId, $data)
//    {
//        if (isset($data['password'])) {
//            $data['password'] = Hash::make($data['password']);
//        }
//        return $this->userRepo->update($userId, $data);
//    }
//
//    /**
//    * 分頁取得所有成員
//    *
//    * @param integer $page
//    * @param integer $limit
//    * @return Collection
//    */
//    public function listByPage($page = 1, $limit = 10)
//    {
//        return $this->userRepo->get()->slice(($page - 1) * $limit, $limit)->values()->all();
//    }
}
