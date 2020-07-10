@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white">
                    <h5>{{ __('List of Roles') }}</h5>
                </div>            
                <div class="card-body">
                    @include('custom.message')
                    <a href="{{ route('roles.create') }}" class="btn btn-success btn-block">{{ __('Create') }}</a>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Full Access</th>
                                    <th colspan="3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($roles as $role)
                                    <tr>
                                        <th scope="row">{{ $role->id }}</th>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->slug }}</td>
                                        <td>{{ $role->description }}</td>
                                        <td>{{ $role['full-access'] }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('roles.show', $role) }}" class="btn btn-outline-primary btn-sm">Show</a>
                                            <a href="{{ route('roles.show', $role) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                                            <a href="#" class="btn btn-outline-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                       <td colspan="8">{{ __('Sin información para mostrar') }}</td> 
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Full Access</th>
                                    <th colspan="3">Actions</th>
                                </tr>
                            </tfoot>
                        </table>                        
                    </div>    
                    {!! $roles->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
