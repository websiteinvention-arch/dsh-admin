@extends('admin.layout.layout')

@section('content')

<div class="content-wrapper">
    <section class="content pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Add New User</h3>
                        </div>

                        <form action="{{ route('admin.users.store') }}" method="POST">
                            @csrf

                            <div class="card-body">
                                <div class="form-group col-lg-5">
                                    <label for="user_name">Name</label>
                                    <input type="text"
                                           id="user_name"
                                           class="form-control"
                                           name="name"
                                           value="{{ old('name') }}"
                                           placeholder="Enter Name">
                                </div>

                                <div class="form-group col-lg-5">
                                    <label for="user_email">User Email</label>
                                    <input type="email"
                                           id="user_email"
                                           class="form-control"
                                           name="email"
                                           value="{{ old('email') }}"
                                           placeholder="Enter Email">
                                </div>

                                <div class="form-group col-lg-5">
                                    <label for="user_password">Password</label>
                                    <input type="password"
                                           id="user_password"
                                           class="form-control"
                                           name="password"
                                           placeholder="Enter Password">
                                </div>

                                <div class="form-group col-lg-5">
                                    <label for="user_role">User Role</label>
                                    <select id="user_role" class="form-control" name="role">
                                        <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-5">
                                    <label for="user_status">Status</label>
                                    <select id="user_status" class="form-control" name="status">
                                        <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', 1) == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">Save</button>
                                <button type="button" class="btn btn-success">Save &amp; Resume</button>
                                <a href="{{ route('admin.users') }}" class="btn btn-warning">Close</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
