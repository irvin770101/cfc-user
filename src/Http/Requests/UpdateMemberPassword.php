<?php

namespace KSD\Member\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Hash;
use Log;

class UpdateMemberPassword extends FormRequest
{
    use \KSD\Member\Traits\MemberManager;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // 驗證舊密碼
        if (Hash::check($this->input('old_password'), $this->getCurrentMember()->password)) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:8|max:12',
            'new_password_confirmation' => 'required|min:8|max:12'
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => '請輸入舊密碼',
            'new_password.required' => '請輸入新密碼',
            'new_password.min' => '新密碼請輸入至少8個字元',
            'new_password.max' => '新密碼請輸入最多12個字元',
            'new_password.confirmed' => '密碼確認錯誤',
            'new_password_confirmation.required' => '請輸入密碼確認',
            'new_password_confirmation.min' => '密碼確認請輸入至少8個字元',
            'new_password_confirmation.max' => '密碼確認請輸入最多12個字元',
        ];
    }

    public function forbiddenResponse()
    {
        return back()->withErrors(['舊密碼驗證錯誤']);
    }
}
