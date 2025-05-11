@extends('layout')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-12">
                <h2 class="page-title">تعديل شركة</h2>
                <div class="card shadow mb-4 mt-3">
                    <div class="card-header">
                        <strong class="card-title">معلومات الشركة</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name">الاسم</label>
                                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $company->name) }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email">الإيميل</label>
                                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $company->email) }}">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="start_date">تاريخ البدء</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control"
                                        value="{{ old('start_date', \Carbon\Carbon::parse($company->start_date)->format('Y-m-d')) }}">
                                    @error('start_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="example-password">كلمة المرور (اتركه فارغاً إذا لا تريد تغييره)</label>
                                    <input type="password" id="example-password" name="password" class="form-control">
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="example-fileinput">الشعار</label>
                
                                    @if($company->logo && $company->logo->path)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $company->logo->path) }}" alt="Logo" width="80" height="80"
                                                class="rounded border p-1 bg-white shadow-sm">
                                        </div>
                                    @endif

                                    <input type="file" id="example-fileinput" name="logo" class="form-control">
                                    @error('logo')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div> 
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="example-domain">الدومين</label>
                                    <input type="text" id="example-domain" name="domain" class="form-control" value="{{ old('domain', $company->domain) }}">
                                    @error('domain')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="example-phone">رقم الهاتف</label>
                                    <input type="text" id="example-phone" name="phone" class="form-control" value="{{ old('phone', $company->phone) }}">
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="expire_date">تاريخ الانتهاء</label>
                                    <input type="date" id="expire_date" name="expire_date" class="form-control"
                                        value="{{ old('expire_date', \Carbon\Carbon::parse($company->expire_date)->format('Y-m-d')) }}">
                                    @error('expire_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="status">الحالة</label><br>
                                    <div class="form-check form-switch mt-2">
                                        <input type="hidden" name="status" value="0">
                                        <input class="form-check-input status-toggle" type="checkbox" id="status" name="status" value="1"
                                            {{ old('status', $company->status) ? 'checked' : '' }}>
                                    </div>
                                    @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn bg-gradient-primary" type="submit">حفظ</button>
            </div>
        </form>
    </div>
</div>
@endsection
