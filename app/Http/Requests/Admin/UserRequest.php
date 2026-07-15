<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = $this->route('user');
        return [
             'fullname' => [
                'required',
                'string',
                'min:3',
                'max:100',
            ],

            'username' => [
                'required',
                'min:3',
                'max:50',
                Rule::unique('users', 'username')->ignore($user),
            ],

            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('users', 'email')->ignore($user),
            ],

            'password' => [
                Rule::requiredIf($this->isMethod('post')),
                'nullable',
                'min:6',
                'max:100',
            ],

            'phone' => [
                'nullable',
                'regex:/^[0-9]{10}$/',
            ],

            'role' => [
                'required',
                'in:1,2',
            ],

            'status' => [
                'required',
                'in:0,1',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống.',
            'min' => ':attribute phải từ :min ký tự trở lên.',
            'max' => ':attribute không vượt quá :max ký tự.',
            'unique' => ':attribute đã tồn tại.',
            'email' => ':attribute không đúng định dạng.',
            'regex' => ':attribute không hợp lệ.',
            'role.in' => ':attribute không hợp lệ.',
            'status.in' => ':attribute không hợp lệ.',
        ];
    }

    public function attributes(): array
    {
        return [
            'fullname' => 'Họ và tên',
            'username' => 'Tên đăng nhập',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'phone' => 'Số điện thoại',
            'role' => 'Vai trò',
            'status' => 'Trạng thái',
        ];
    }
}
