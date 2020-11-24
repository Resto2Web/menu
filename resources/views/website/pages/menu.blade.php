@extends('resto2web::layout.app')

@section('content')
    <div class="container">
        Menu Page
        @foreach ($mealCategories as $category)
            <h2>{{ $category->name }}</h2>
            <ul>
                @foreach ($category->meals as $meal)
                    <li>{{ $meal->name }}</li>
                @endforeach
            </ul>
        @endforeach
    </div>

@endsection
