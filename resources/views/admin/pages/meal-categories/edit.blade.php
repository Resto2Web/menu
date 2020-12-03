@extends('resto2web-admin::layout.layout')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.meal-categories.index') }}">Catégories</a>
    </li>
    <li class="breadcrumb-item active">
        Modifier une catégorie
    </li>
@endsection
@section('page_header')
    <div class="">
        <div class="d-flex align-items-center">
            <h1 class="mr-auto mb-0">Modifier une catégorie de plat</h1>
        </div>
    </div>
@stop
@section("content")
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="mx-auto w-100 mb-0">Editer la catégorie</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.meal-categories.update', $meal_category) }}" method="post" enctype="multipart/form-data" class="form-validate">
                        @method("PATCH")
                        @csrf
                        @include('resto2web-admin::pages.meal-categories.partials._form')
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Enregister les modifications</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3 class="mb-0 mr-auto">Plat associés</h3>
                    <div>
                        <a class="btn btn-sm btn-primary" href="{{ route("admin.meals.create", ['meal_category_id'=>$meal_category]) }}"><i
                                class="fa fa-plus"></i> Ajouter un plat à la catégorie</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <table class="table">
                            <thead>
                            <tr >
                                <th></th>
                                <th>Plat</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="meals">
                            @foreach ($meal_category->meals->sortBy('position') as $meal)
                                <tr data-line-id="{{ $meal->id }}">
                                    <td>
                                        <span class="my-handle text-muted"><i class="fa fa-grip-lines"></i></span>
                                    </td>
                                    <td>
                                        {{ $meal->name }}
                                    </td>
                                    <td class="text-right">
                                        <a class="btn btn-sm btn-primary" href="{{ route("admin.meals.edit", $meal) }}"><i
                                                class="fa fa-edit"></i> Editer le plat </a>
{{--                                        <form action="{{ route('admin.meals.remove_from_category', $meal) }}" method="post"--}}
{{--                                              class="d-inline">--}}
{{--                                            @csrf--}}
{{--                                            @method('PATCH')--}}
{{--                                            <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-minus"></i> Enlever--}}
{{--                                                de la catégorie--}}
{{--                                            </button>--}}
{{--                                        </form>--}}
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    @if (Auth::user()->type == 'super_admin')
                        <form action="{{ route("admin.meal-categories.resetPositions", $meal_category) }}" method="post" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-sm btn-primary"><i
                                    class="fa fa-sync"></i> Réinitialiser la numérotation</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var el = document.getElementById('meals');
        var sortable = Sortable.create(el, {
            animation: 150,
            // Element dragging ended
            onEnd: function (/**Event*/evt) {
                if (evt.oldIndex !== evt.newIndex) {
                    axios.patch('/admin/meals/position/' + evt['item'].dataset.lineId, {
                            'new_pos': evt.newIndex + 1
                        }
                    ).then(response => {
                        toastr.success('Modification d\'ordre enregistrée!', 'Succès');
                    }).catch(error => {
                        toastr.error('Il y a eu une erreur', 'Erreur');
                    });
                }
            },
            handle: ".my-handle"
        });
    </script>
@endpush

