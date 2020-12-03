@extends('resto2web-admin::layout.layout')

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        Menu
    </li>
@endsection

@section('subheader')
    <a href="{{ route('admin.meals.create') }}" class="btn btn-primary btn-lg">
        <i class="fa fa-plus"></i> Ajouter un plat
    </a>
@endsection

@section("content")
    <div class="row ">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-info">
                        <div class="d-flex">
                            <div class="align-self-center mr-2">
                                <i class="fa fa-info-circle"></i>
                            </div>
                            <div class="">
                                <p class="mb-0">La colonne "activé" désactive l'affichage du plat dans le menu.</p>
                            </div>
                        </div>

                    </div>
                    <table class="dataTable table">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Catégorie</th>
                            <th>Prix</th>
                            <th class="text-center">Activé</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($meals->sortBy('meal_category_id')->sortBy('position') as $meal)
                            <tr>
                                <td class="align-middle">{{ $meal->name }}</td>
                                <td class="align-middle">{{ \Illuminate\Support\Str::limit($meal->description,20) }}</td>
                                <td class="align-middle">
                                    @if ($meal->category)
                                        <a href="{{route("admin.meal-categories.edit", $meal->category)}}">
                                            {{ $meal->category->name}}</a>
                                    @else
                                        <p class="mb-0">
                                            Pas de catégorie
                                        </p>
                                    @endif
                                </td>
                                <td class="align-middle">{{ $meal->formattedPrice }}</td>
                                <td class="align-middle text-center">
                                    <i id="mealAvailableIcon{{ $meal->id }}" class="fa {{$meal->active ? "fa-check" : "fa-times"}}"></i>

                                </td>
                                <td class="text-right align-middle">
                                    <a class="btn btn-sm btn-primary" href="{{ route('admin.meals.edit', $meal) }}"><i
                                            class="fa fa-edit"></i> Editer le plat</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-body">
                    <h4><i class="fa fa-info-circle"></i> Aide</h4>
                    <p class="mb-0">
                        Vous pouvez ajouter, éditer ou supprimer vos plats. Vos plats sont rangés par catégories.
                    </p>
                    <p class="mb-0">Pour changer l'ordre affiché de vos plats, cliquez sur le nom de sa catégorie, et vous accèderez à la page pour changer l'ordre</p>
                </div>
            </div>
        </div>
    </div>
@endsection
