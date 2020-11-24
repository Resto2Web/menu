@extends('resto2web-admin::layout.layout')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.meals.index') }}">Menu</a>
    </li>
    <li class="breadcrumb-item active">
        Modifier un plat
    </li>
@endsection
@section('page_header')
    <div class="">
        <div class="d-flex align-items-center">
            <h1 class="mr-auto mb-0">Modifier un plat</h1>
            <button type="button" id="submitFromTop" class="btn btn-light"><i class="fa fa-save"></i> Enregister les modifications</button>
        </div>
    </div>
@stop
@section("content")
    <form action="{{ route('admin.meals.update', $meal) }}" method="post" enctype="multipart/form-data"
          class="form-validate" id="mealUpdateForm">
        @method("PATCH")
        @csrf
        @include('resto2web-admin::pages.meals.partials._form')
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h4 class="mr-auto mb-0"></h4>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Enregister les modifications</button>
                </div>
            </div>
    </form>
@endsection

@section('scripts')
    <script>
        $imageInput = $('#image');
        $('#editImageButton').on('click', function (event) {
            event.preventDefault();
            $('#cancelEditImageButton').slideDown();
            $('#currentImage').slideUp();
            $('#image').slideDown();
        });
        $('#cancelEditImageButton').on('click', function (event) {
            event.preventDefault();
            $('#cancelEditImageButton').slideUp();
            $('#currentImage').slideDown();
            $imageInput.slideUp();
            $imageInput.val("");
        });
        $('#submitFromTop').on('click', function (event) {
            event.preventDefault();
            $('#mealUpdateForm').submit();
        });

    </script>
@endsection
