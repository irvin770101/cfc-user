<?php

namespace KSD\Member\Http\Middleware;

use KSD\Member\Services\MemberService;
use KSD\Member\Exceptions\SigninWrongInputException;
use Closure;
use Log;
use Validator;
use Session;

class VerifyMemberSignin
{
    use \KSD\Member\Traits\MemberValidator;

    protected $memberServ;

    public function __construct(MemberService $memberServ)
    {
        $this->memberServ = $memberServ;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->isMemberValid()) {
            // 登入時效還有用，且成員是合法的
            // 直接跳至下一頁
            return $next($request);
        }

        // 目前確實沒有登入狀況
        // 執行帳號密碼驗證程序
        $validator = Validator::make($request->all(), [
            'account'  => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            throw new SigninWrongInputException('請輸入帳號及密碼');
        }

        $account = $request->input('account');
        $password = $request->input('password');
        if ($member = $this->memberServ->verify($account, $password, true)) {
            Session::put('member', $member);
            return $next($request);
        }
        throw new SigninWrongInputException('帳號或密碼錯誤');
    }
}
