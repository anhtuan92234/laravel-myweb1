<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
        $product = $this->route('product');
        return [     
            'productname' => [
                'required',
                'string',
                'min:5',
                'max:150',
                Rule::unique('products', 'productname')->ignore($product),
            ],
            
            'slug' => [
                'required',
                'string',
                'min:5',
                'max:200',
                Rule::unique('products', 'slug')->ignore($product),
                'regex:/^[a-zA-Z0-9_-]+$/',
            ],
            
            'price' => [
                'required',
                'numeric',
                'min:0',
                'max:10000000',
            ],
                
            'pricediscount' => [
                'required',
                'numeric',
                'min:0',
                'lte:price',
            ],
            
            'status' => [
                'required',
                'in:0,1',
            ],
            
            'cateid' => [
                'required',
                'exists:categories,cateid',
            ],
            
            'brandid' => [
                'required',
                'exists:brands,id',
            ],
            
            'description' => [
                'nullable',
                'regex:/^[^@!$^]*$/',
            ],   
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống.',
            'string' => ':attribute phải là chuỗi.',
            'numeric' => ':attribute phải là số.',
            'min' => ':attribute phải lớn hơn hoặc bằng :min.',
            'max' => ':attribute không được vượt quá :max.',
            'unique' => ':attribute đã tồn tại.',
            'exists' => ':attribute không tồn tại.',
            'in' => ':attribute không hợp lệ.',
            'slug.regex' => ':attribute chỉ được chứa chữ, số, dấu gạch ngang (-) và gạch dưới (_).',
            'description.regex' => ':attribute không được chứa các ký tự @, !, $, ^.',
            'pricediscount.lte' => 'Giá giảm không được lớn hơn giá bán.',
        ];
    }

    public function attributes(): array
    {
        return [
             'productname' => 'Tên sản phẩm',
             'slug' => 'Đường dẫn (Slug)',
             'price' => 'Giá',
             'pricediscount' => 'Giá giảm',
             'cateid' => 'Loại sản phẩm',
             'brandid' => 'Thương hiệu',
             'status' => 'Trạng thái',
             'description' => 'Mô tả',
        ];
    }
}
