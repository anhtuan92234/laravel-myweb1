<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
        $post = $this->route('post');
        return [
             'title' => [
                'required',
                'min:5',
                'max:200',
                Rule::unique('posts', 'title')->ignore($post),
            ],

            'slug' => [
                'required',
                'min:5',
                'max:255',
                Rule::unique('posts', 'slug')->ignore($post),
                'regex:/^[a-z0-9-]+$/',
            ],

            'user_id' => [
                'required',
                'exists:users,id',
            ],

            'status' => 'required|in:0,1',
        ];
    }

     public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống.',
            'min' => ':attribute phải từ :min ký tự trở lên.',
            'max' => ':attribute không vượt quá :max ký tự.',
            'unique' => ':attribute đã tồn tại.',
            'exists' => ':attribute không tồn tại.',
            'slug.regex' => ':attribute chỉ được chứa chữ thường, số và dấu gạch ngang (-).',
            'status.in' => ':attribute không hợp lệ.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Tiêu đề',
            'slug' => 'Đường dẫn (Slug)',
            'user_id' => 'Người đăng',
            'status' => 'Trạng thái',
        ];
    }
}
