@extends('resto2web-admin::layout.layout')

@section('breadcrumbs')
    <li class="breadcrumb-item active"> Catégories</li>
@endsection

@section('page_header')
    <h1 class="">
        <i class="fa fa-star"></i>
        Catégories de plats
    </h1>
    <div class="lead">Gérez ici les catégories de plats dans votre menu.</div>
@stop

@section("content")
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @include("resto2web-admin::layout.alerts")
                    <table class="table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Nom</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="mealCategories">
                        @foreach ($mealCategories->sortBy('position') as $mealCategory)
                            <tr data-line-id="{{ $mealCategory->id }}">
                                <td class="align-middle" style="width: 70px;">
                                    <span class="my-handle text-muted"><i class="fa fa-grip-lines"></i></span>
                                </td>
                                <td class="align-middle">{{ $mealCategory->name }}</td>
                                <td class="text-right">
                                    <a class="btn btn-sm btn-primary"
                                       href="{{ route('admin.meal-categories.edit', $mealCategory) }}"><i
                                            class="fa fa-edit"></i> Editer</a>
                                    <button class="btn btn-sm btn-danger deleteConfirm" data-id="{{ $mealCategory->id }}"><i
                                            class="fa fa-trash"></i> Supprimer</button>
                                    <form action="{{ route('admin.meal-categories.destroy', $mealCategory) }}" method="post"
                                          id="destroy-form-{{ $mealCategory->id }}">
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
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body ">
                    <form class="form-validate" action="{{ route('admin.meal-categories.store') }}"
                          method="post"
                          id="add-category-form">
                        @csrf
                        <div class="form-group mb-0">
                            <div class="input-group">
                                <label for="name" class="sr-only">Nom de la catégorie</label>
                                <input type="text" class="form-control mr-sm-2" name="name" id="name" required
                                       placeholder="Ajouter une catégorie" value="{{ old('name') }}">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Ajouter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <h4><i class="fa fa-info-circle"></i> Aide</h4>
                    <p class="mb-0">
                        Vous pouvez ajouter, éditer ou supprimer vos catégories de plats dans lesquelles sont rangés vos plats.
                    </p>
                    <p class="mb-0">Pour changer l'ordre affiché de vos catégories, il suffit de cliquer glisser les catégories au moyen des petites lignes <i class="fa fa-grip-lines"></i> et de les placer dans l'ordre voulu.
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var el = document.getElementById('mealCategories');
        var sortable = Sortable.create(el, {
            animation: 150,
            // Element dragging ended
            onEnd: function (/**Event*/evt) {
                if (evt.oldIndex !== evt.newIndex){
                    axios.patch('/admin/meal-categories/position/' + evt['item'].dataset.lineId, {
                            'new_pos': evt.newIndex + 1
                        }
                    ).then(response => {
                        toastr.success(response.data.message, 'Succès');
                    }).catch(error => {
                        toastr.error('Il y a eu une erreur', 'Erreur');
                    });
                }
            },
            handle: ".my-handle"
        });
    </script>
@endpush
