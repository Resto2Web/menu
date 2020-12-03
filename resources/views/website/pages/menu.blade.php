@extends('resto2web::layout.app')

@section('content')
    <div class="container py-6">
        <h1>Menu du restaurant</h1>
        <div class="row">
            <div class="col-lg-8">
                @foreach ($mealCategories as $category)
                    <h2>{{ $category->name }}</h2>
                    <ul>
                        @foreach ($category->meals as $meal)
                            @livewire('website.components.meal-item',compact('meal'),key($meal->id))
                        @endforeach
                    </ul>
                    <hr>
                @endforeach
            </div>
            <div id="sidebar" class="col-lg-4 sidebar p-0">
                <div class="p-3" id="sidebar__inner">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0">Résumé de ma commande</h3>
                        </div>
                        <div class="card-body">
                            @livewire('website.components.cart-sidebar')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var sidebar = new StickySidebar('#sidebar', {
            containerSelector: '#main-content',
            innerWrapperSelector: '.sidebar__inner',
            topSpacing: 150,
            bottomSpacing: 45,
            resizeSensor: true,
            minWidth: 991,
        });
    </script>
@endpush
