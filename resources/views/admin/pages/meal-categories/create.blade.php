@extends('resto2web-admin::layout.layout')

@section("content")
    <div class="card shadow mb-4">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="mx-auto w-100 mb-0">Ajouter un plat</h4>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.meals.store') }}" method="post" enctype="multipart/form-data" class="form-validate">
                @csrf
                @include("admin.layout.alerts")
                @include('admin.pages.meals.partials._form')
                <div class="text-right">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Enregister l'élément</button>
                </div>
            </form>
        </div>
    </div>
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
    </script>
@endsection
