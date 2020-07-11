@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white"><h5>{{ __('Create Roles') }}</h5></div>

                <div class="card-body">
                    @include('custom.message')
                    <form action="{{ route('roles.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name"><strong>{{ __('Name') }}</strong></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="name"><strong>{{ __('Slug') }}</strong></label>
                            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="description"><strong>{{ __('Description') }}</strong></label>
                            <textarea class="form-control" id="description" rows="3" name="description">{{ old('description') }}</textarea>
                        </div>
                          <hr>
                        <div class="form-group">
                            <label for="inlineRadio1"><strong>{{ __('Full Access') }}</strong></label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="full-access" id="inlineRadio1" value="yes" {{ old('full-access') == 'yes' ? 'checked' : ''}}>
                                <label class="form-check-label" for="inlineRadio1">{{ __('Yes') }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="full-access" id="inlineRadio2" value="not" {{ is_null(old('full-access')) ? 'checked' : old('full-access') == 'not' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio2">{{ __('Not') }}</label>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="inlineRadio1"><strong>{{ __('Permissions') }}</strong></label><br>
                            @forelse ($permissions as $key=>$permission)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $permission->id }}" id="permissions {{ $key }}" name="permissions[]" {{ is_array(old('permissions')) && in_array($permission->id, old('permissions')) ? 'checked' : ''}}>
                                    <label class="form-check-label" for="permissions {{ $key }}">
                                        {{ $permission->name }}
                                        <em class="text-black-50">{ {{ $permission->description }} }</em>
                                    </label>
                                </div>
                            @empty
                                <label class="form-label">
                                    {{ __('No information to show') }}
                                </label>
                            @endforelse
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-success btn-block">{{ __('Send') }}</button>
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary btn-block">{{ __('Cancel') }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(function() {
            $('#name').keyup(function () {
               $('#slug').val($('#name').val().toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,''));
           });

            $("#inlineRadio1").on("click", function() {  
                checkboxes = document.getElementsByName('permissions[]');
                for(var i=0, n=checkboxes.length;i<n;i++) {
                    checkboxes[i].checked = true;
                }
            });

            $("#inlineRadio2").on("click", function() {  
                checkboxes = document.getElementsByName('permissions[]');
                for(var i=0, n=checkboxes.length;i<n;i++) {
                    checkboxes[i].checked = false;
                }
            });

        });
    </script>
@endsection
