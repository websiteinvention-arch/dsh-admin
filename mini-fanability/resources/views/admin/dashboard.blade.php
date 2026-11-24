@extends('admin.layout.layout')

@section('content')

<div class="content-wrapper">
    <section class="content pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1 class="mb-4">Admin Dashboard</h1>
                    <form action="{{ route('admin.logout') }}" method="POST" class="mb-4">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-sign-out-alt mr-1"></i>
                            Logout
                        </button>
                    </form>
                </div>

                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-globe mr-2"></i>
                                Websites
                            </h3>
                        </div>
                        <div class="card-body">
                            <p>Manage website projects and their client details.</p>
                            <a href="{{ route('admin.websites') }}" class="btn btn-primary">
                                <i class="fas fa-list mr-1"></i>
                                Manage Websites
                            </a>
                            <a href="{{ route('admin.websites.add') }}" class="btn btn-success">
                                <i class="fas fa-plus mr-1"></i>
                                Add Website
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-users mr-2"></i>
                                Admin Users
                            </h3>
                        </div>
                        <div class="card-body">
                            <p>Manage administrator accounts, roles, and access status.</p>
                            <a href="{{ route('admin.users') }}" class="btn btn-primary">
                                <i class="fas fa-list mr-1"></i>
                                Manage Users
                            </a>
                            <a href="{{ route('admin.users.add') }}" class="btn btn-success">
                                <i class="fas fa-plus mr-1"></i>
                                Add User
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
