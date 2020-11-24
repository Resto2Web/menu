<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h4 class="mb-0">Général</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            {{ Form::label('name') }}
                            {{ Form::text('name',$meal->name ?? '',['class'=> 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-group">
                                {{ Form::label('price') }}
                                {{ Form::number('price',$meal->price ?? 0,['class'=> 'form-control','min'=> 0,'step'=> '0.01']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="form-group">
                        <label for="meal_category_id">Catégorie</label>
                        <select class="form-control select2" name="meal_category_id" id="meal_category_id">
                            <option value="">Sans Catégorie</option>
                            @foreach ($meal_categories as $meal_category)
                                <option
                                    value="{{$meal_category->id}}"
                                    {{ $meal_category->id == request()->get('meal_category_id') ? "selected" :""}}
                                    {{ isset($meal) ? $meal->category == $meal_category ? "selected" :"" : ''}}> {{$meal_category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="">
                    <div class="custom-control custom-switch">
                        {{ Form::checkbox('active','active',$meal->active ?? true,['class'=> 'custom-control-input','id'=> 'active']) }}
                        {{ Form::label('active','Activé (visible ou non sur le site)',['class'=> 'custom-control-label']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h4 class="mb-0">Détails</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('description') }}
                    {{ Form::textarea('description',$meal->description ?? '',['class'=> 'form-control','rows'=> 2]) }}
                </div>
                <div class="form-group">
                    {{ Form::label('ingredients') }}
                    {{ Form::text('ingredients',$meal->ingredients ?? '',['class'=> 'form-control']) }}
                </div>
            </div>
        </div>
    </div>
{{--    <div class="col-md-6">--}}
{{--        <div class="card shadow mb-4">--}}
{{--            <div class="card-header">--}}
{{--                <h4 class="mb-0">Image</h4>--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <div class="form-group">--}}
{{--                    <label for="image" class="sr-only">Image</label>--}}
{{--                    <input type="file" @if ($meal->image) style="display:none;" @endif class="form-control-file" id="image"--}}
{{--                           name="image">--}}
{{--                    @if ($meal->image)--}}
{{--                        <br>--}}
{{--                        <div id="currentImage">--}}
{{--                            <img class="img-fluid w-50" src="{{ Storage::url($meal->image) }}" alt="">--}}
{{--                            <button type="button" class="btn btn-primary btn-sm" id="editImageButton"><i class="fa fa-edit"></i> Editer--}}
{{--                                l'image--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
