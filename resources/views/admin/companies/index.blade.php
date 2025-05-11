@extends('layout')

@section('content')

<div class="container-fluid py-4">
    @include('partials.statistics')

    <div class="container-fluid py-4">
        <a href="{{route('companies.create')}}" class="btn bg-gradient-primary submit" id="create">إضافة</a>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>قائمة الشركات</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الشعار</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">الاسم</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الحالة</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">تاريخ الاشتراك</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">نهاية الاشتراك</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($companies as $company)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    @if ($company->logo && $company->logo->path)
                                                        <img src="{{ asset('storage/' . $company->logo->path) }}" alt="Logo" width="50" height="50" class="rounded-circle border border-2 border-primary shadow-sm">
                                                    @else
                                                        <img src="{{ asset('assets/img/small-logos/logo-jira.svg') }}" alt="No Logo" width="50" height="50" class="rounded-circle border border-2 border-primary shadow-sm">
                                                    @endif
    
                                                </div>
                                                <div class="d-flex flex-column justify-content-center me-4">
                                                    <h6 class="mb-0 text-sm">{{$company->email}}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{$company->phone}}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{$company->name}}</p>
                                            <a href="" class="text-xs text-secondary mb-0 text-decoration-underline">{{$company->domain}}</a>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm {{ $company->status_badge_class }}">
                                                {{ $company->status_label }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$company->start_date}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$company->expire_date}}</span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('companies.edit', $company->id) }}" 
                                            class="text-secondary font-weight-bold">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" class="text-danger font-weight-bold m-3"
                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $company->id }}').submit();">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <form id="delete-form-{{ $company->id }}" 
                                                action="{{ route('companies.destroy', $company->id) }}" 
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
