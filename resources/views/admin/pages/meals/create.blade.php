@extends('resto2web-admin::layout.layout')
@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.meals.index') }}">Menu</a>
    </li>
    <li class="breadcrumb-item active">
        Ajouter un plat
    </li>
@endsection


@section("content")
    <div class="row ">
        <div class="col-12">
            <form action="{{ route('admin.meals.store') }}" method="post" enctype="multipart/form-data" class="form-validate" id="createMealForm">
                @csrf
                @include("resto2web-admin::layout.alerts")
                @include('resto2web-admin::pages.meals.partials._form')
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h4 class="mr-auto mb-0"></h4>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Ajouter le plat</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
