<?php

namespace App\Http\Requests\Company;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::guard('web')->check();
    }

    public function rules(): array
    {
        $companyId = $this->route('company');

        return [
            'name' => 'required|string',
            'domain' => 'required|string|unique:companies,domain,' . $companyId,
            'email' => 'nullable|email|unique:companies,email,' . $companyId,
            'phone' => 'nullable|string|unique:companies,phone,' . $companyId,
            'password' => 'nullable|string|min:6',
            'status' => 'nullable|boolean',
            'start_date' => 'required|date',
            'expire_date' => 'required|date|after_or_equal:start_date',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'حقل الاسم مطلوب.',
            'domain.required' => 'حقل الدومين مطلوب.',
            'domain.unique' => 'هذا الدومين مستخدم من قبل.',
            'email.email' => 'صيغة البريد الإلكتروني غير صحيحة.',
            'email.unique' => 'هذا البريد الإلكتروني مستخدم من قبل.',
            'phone.unique' => 'رقم الهاتف مستخدم من قبل.',
            'password.min' => 'كلمة المرور يجب أن تكون على الأقل 6 أحرف.',
            'logo.image' => 'الملف يجب أن يكون صورة.',
            'logo.mimes' => 'الملف يجب أن يكون من نوع: jpeg, png, jpg, gif.',
            'logo.max' => 'الملف يجب ألا يتجاوز 2 ميغابايت.',
            'status.boolean' => 'قيمة الحالة يجب أن تكون إما مفعلة أو غير مفعلة.',
        ];
    }
}
