@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white">
                    <h5>{{ __('List of Users') }}</h5>
                </div>
                <div class="card-body">
                    @include('custom.message')
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Update At</th>
                                    <th colspan="5">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $user->id }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if(count($user->roles))
                                                {{ $user->roles[0]->name }}
                                            @else
                                                <span>Sin rol</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->created_at->format('d-m-Y') }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                @csrf @method('delete')
                                                <a href="{{ route('users.show', $user) }}" class="btn btn-outline-primary btn-sm">Show</a>
                                                <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                                                <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                            </form>
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
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Update At</th>
                                    <th colspan="5">Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    {!! $users->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
