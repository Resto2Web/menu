@extends('resto2web-admin::layout.layout')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.meal-categories.index') }}">Catégories</a>
    </li>
    <li class="breadcrumb-item active">
        {{$meal_category->name}}
    </li>
@endsection

@section("content")



@endsection

