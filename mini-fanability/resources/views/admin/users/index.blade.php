@extends('admin.layout.layout')

@section('content')

<div class="content-wrapper">
    <section class="content pt-5">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Users</h3>

                    <a href="{{ route('admin.users.add') }}"
                       class="btn btn-success float-right mr-2">
                        <i class="fa fa-plus"></i>
                        Add New
                    </a>

                    <a href="#"
                       class="btn btn-primary float-right mr-2">
                        <i class="fa fa-upload"></i>
                        Export Excel File
                    </a>

                    <a href="#"
                       class="btn btn-primary float-right mr-2">
                        <i class="fa fa-download"></i>
                        Import Excel File
                    </a>
                </div>

                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>User Name</th>
                                <th>User Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <input type="checkbox"
                                               {{ $user->status ? 'checked' : '' }}
                                               data-bootstrap-switch
                                               data-off-color="danger"
                                               data-on-color="success">
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                           class="btn btn-sm bg-warning"
                                           aria-label="Edit {{ $user->name }}">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="#"
                                           class="btn btn-sm bg-teal"
                                           aria-label="Copy {{ $user->name }}">
                                            <i class="fas fa-copy"></i>
                                        </a>

                                        <form action="{{ route('admin.users.delete', $user->id) }}"
                                              method="POST"
                                              style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm bg-danger"
                                                    aria-label="Delete {{ $user->name }}"
                                                    onclick="return confirm('Are you sure?')">
                                                <i class="ion-android-delete"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Users Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
