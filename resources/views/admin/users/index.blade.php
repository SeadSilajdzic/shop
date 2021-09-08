@extends('layouts.app')

@section('content')
    <div class="container pt-4">
        <div class="row mb-2 mb-xl-3">
            <div>
                <h1 class="h3 mb-3">Users management</h1>
            </div>
            <div class="col-auto ml-auto text-right mt-n1">

                <!-- Button trigger modal for user create -->
                <button type="button" name="btn-create-new-user" class="btn-primary-custom" data-toggle="modal"
                    data-target="#createUser">
                    Add new user
                </button>

                <!-- Create user modal -->
                <div class="modal fade" id="createUser" tabindex="-1" aria-labelledby="createUserLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add new user</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.user.store') }}" method="post">
                                    @csrf

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-2 text-sm-right">Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="name" class="form-control" placeholder="Name"
                                                        value="{{ old('name') }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-2 text-sm-right">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" name="email" class="form-control"
                                                        placeholder="Email" value="{{ old('email') }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-2 text-sm-right">Role</label>
                                                <div class="col-sm-10">
                                                    <select name="role_id" id="role_id" class="form-control">
                                                        <option selected disabled>Select users role</option>
                                                        @foreach ($roles as $role)

                                                            <option value="{{ $role->id }}">{{ $role->name }}</option>

                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-2 text-sm-right">Password</label>
                                                <div class="col-sm-10">
                                                    <input type="password" name="password" class="form-control"
                                                        placeholder="Password">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" name="btn-create-new-user" class="btn-primary-custom">Store
                                            user</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container table-container">

        <table class="table">
            <thead>
                <tr>
                    <th class="lead">Name</th>
                    <th class="lead">Email</th>
                    <th class="lead">Role</th>
                    <th class="lead">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td class="lead">{{ $user->name }}</td>
                        <td class="lead">{{ $user->email }}</td>
                        <td class="lead">{{ $user->role->name }}</td>
                        <td class="table-action d-flex align-items-center">
                            <!-- Button trigger modal for user update -->
                            <a href="#" class="mr-2"><i class="fas fa-pen" data-toggle="modal"
                                    data-target="#updateUser{{ $user->id }}"></i></a>

                            <form action="{{ route('admin.user.destroy', $user) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-link mr-2"><i class="fas fa-trash"></i></button>
                            </form>

                            <!-- Update user modal -->
                            <div class="modal fade" id="updateUser{{ $user->id }}" tabindex="-1"
                                aria-labelledby="updateUser{{ $user->id }}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add new user</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.user.update', $user->id) }}" method="post">
                                                @csrf
                                                @method('PUT')

                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="form-group row">
                                                            <label
                                                                class="col-form-label col-sm-2 text-sm-right">Name</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="name" class="form-control"
                                                                    placeholder="Name" value="{{ $user->name }}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label
                                                                class="col-form-label col-sm-2 text-sm-right">Email</label>
                                                            <div class="col-sm-10">
                                                                <input type="email" name="email" class="form-control"
                                                                    placeholder="Email" value="{{ $user->email }}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label
                                                                class="col-form-label col-sm-2 text-sm-right">Role</label>
                                                            <div class="col-sm-10">
                                                                <select name="role_id" id="role_id" class="form-control">
                                                                    <option disabled>Select users role</option>
                                                                    @foreach ($roles as $role)
                                                                        <option value="{{ $role->id }}"
                                                                            @if ($user->role->id == $role->id) selected @endif>
                                                                            {{ $role->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label
                                                                class="col-form-label col-sm-2 text-sm-right">Password</label>
                                                            <div class="col-sm-10">
                                                                <input type="password" name="password"
                                                                    class="form-control" placeholder="Password">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="submit" name="btn-update-new-user"
                                                    class="btn btn-sm btn-info">Update user</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>There are no users!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="my-5 d-flex justify-content-center">
        {{ $users->links() }}
    </div>

    @include('partials.errors')

@endsection
