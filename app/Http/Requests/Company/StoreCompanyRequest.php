<?php

namespace App\Http\Requests\Company;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::guard('web')->check();
    }

    public function rules(): array
    {
        return [
            'name' => 'string|required',
            'domain' => 'string|required|unique:companies',
            'email' => 'email|nullable|unique:companies',
            'phone' => 'string|nullable|unique:companies',
            'password' => 'string|required|min:6',
            'start_date' => 'required|date',
            'expire_date' => 'required|date|after_or_equal:start_date',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'حقل الاسم مطلوب.',
            'name.string' => 'حقل الاسم يجب أن يكون نصاً.',

            'domain.required' => 'حقل الدومين مطلوب.',
            'domain.string' => 'حقل الدومين يجب أن يكون نصاً.',
            'domain.unique' => 'الدومين مستخدم بالفعل.',

            'email.email' => 'يجب إدخال بريد إلكتروني صحيح.',
            'email.unique' => 'هذا البريد مستخدم بالفعل.',

            'phone.string' => 'رقم الهاتف يجب أن يكون نصاً.',
            'phone.unique' => 'رقم الهاتف مستخدم بالفعل.',

            'password.string' => 'كلمة المرور مطلوبة.',
            'password.required' => 'كلمة المرور مطلوبة.',
            'password.min' => 'كلمة المرور يجب أن تكون 6 أحرف على الأقل.',

            'logo.image' => 'الملف يجب أن يكون صورة.',
            'logo.mimes' => 'صيغة الصورة يجب أن تكون jpeg أو png أو jpg أو gif.',
            'logo.max' => 'حجم الصورة يجب ألا يتجاوز 2 ميغابايت.',
        ];
    }
}
