@extends('resto2web-admin::layout.layout')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.orders.index') }}">Commandes</a>
    </li>
    <li class="breadcrumb-item active">
        Ajouter une commande manuellement
    </li>
@endsection

@section("content")
    @include("resto2web-admin::layout.alerts")
    <div class="row" id="main-content">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    @foreach ($mealCategories as $category)
                        <h2>{{ $category->name }}</h2>
                        <ul class="list-unstyled">
                            @foreach ($category->active_meals as $meal)
                                @livewire('admin.orders.components.create-order-menu-meal-item',compact('meal'),key($meal->id))
                            @endforeach
                        </ul>
                        <hr>
                    @endforeach
                </div>
            </div>

        </div>
        <div id="sidebar" class="col-lg-4 sidebar p-0">
            <div class="p-3" id="sidebar__inner">
                <div class="card">
                    <div class="card-body">
                        @livewire('admin.orders.components.create-order-sidebar')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
