@extends('layout')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-12">
                <h2 class="page-title">إضافة شركة</h2>
                <div class="card shadow mb-4 mt-3">
                    <div class="card-header">
                        <strong class="card-title">معلومات الشركة</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name">الاسم</label>
                                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="مكعب" value="{{ old('name') }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="email">الإيميل</label>
                                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="example@email.com" value="{{ old('email') }}">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                    <div class="form-group mb-3">
                                        <label for="start_date">تاريخ البدء</label>
                                        <input type="date" id="start_date" name="start_date"
                                            class="form-control @error('start_date') is-invalid @enderror"
                                            value="{{ old('start_date', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                                        @error('start_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                <div class="form-group mb-3">
                                    <label for="password">كلمة المرور</label>
                                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="domain">الدومين</label>
                                    <input type="text" id="domain" name="domain" class="form-control @error('domain') is-invalid @enderror" placeholder="example.domain" value="{{ old('domain') }}">
                                    @error('domain')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="phone">رقم الهاتف</label>
                                    <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="0750000000" value="{{ old('phone') }}">
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="expire_date">تاريخ الانتهاء</label>
                                    <input type="date" id="expire_date" name="expire_date"
                                        class="form-control @error('expire_date') is-invalid @enderror"
                                        value="{{ old('expire_date', \Carbon\Carbon::now()->addYear()->format('Y-m-d')) }}">
                                    @error('expire_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="logo">الشعار</label>
                                    <input type="file" id="logo" name="logo" class="form-control @error('logo') is-invalid @enderror">
                                    @error('logo')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
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
