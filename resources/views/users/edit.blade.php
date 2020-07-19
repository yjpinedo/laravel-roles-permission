@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white"><h5>{{ __('Update Users') }}</h5></div>

                <div class="card-body">
                    @include('custom.message')
                    <form action="{{ route('users.update', $user) }}" method="post">
                        @csrf @method('put')
                        <div class="form-group">
                            <label for="name"><strong>{{ __('Name') }}</strong></label>
                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                value="{{ old('name', $user->name) }}"
                            >
                        </div>
                        <div class="form-group">
                            <label for="name"><strong>{{ __('Email') }}</strong></label>
                            <input
                                type="text"
                                class="form-control"
                                id="email"
                                name="email"
                                value="{{ old('email', $user->email) }}"
                                >
                        </div>
                          <hr>
                        <div class="form-group">
                            <label for="inlineRadio1"><strong>{{ __('Roles') }}</strong></label><br>
                            <select class="form-control" name="roles">
                                <option>Selecciona una opción</option>
                                @forelse ($roles as $key=>$role)
                                    <option value="{{ $role->id }}" {{ is_array(old('roles')) && in_array($role->id, old('roles')) || in_array($role->id, $userRole) ? 'selected' : ''}}>{{ $role->name }}</option>
                                @empty
                                    <option>{{ __('No information to show') }}</option>
                                @endforelse
                            </select>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-success btn-block">{{ __('Update') }}</button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary btn-block">{{ __('Cancel') }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
