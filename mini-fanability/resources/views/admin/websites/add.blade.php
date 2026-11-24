@extends('admin.layout.layout')

@section('content')

<div class="content-wrapper">
    <section class="content pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Add New Website</h3>
                        </div>

                        <form action="{{ route('admin.websites.store') }}" method="POST">
                            @csrf

                            <div class="card-body">
                                <div class="form-group col-lg-5">
                                    <label for="client_name">Client Name</label>
                                    <input type="text"
                                           id="client_name"
                                           class="form-control"
                                           name="client_name"
                                           value="{{ old('client_name') }}"
                                           placeholder="Enter Client Name">
                                </div>

                                <div class="form-group col-lg-5">
                                    <label for="project_name">Project Name</label>
                                    <input type="text"
                                           id="project_name"
                                           class="form-control"
                                           name="project_name"
                                           value="{{ old('project_name') }}"
                                           placeholder="Enter Project Name">
                                </div>

                                <div class="form-group col-lg-5">
                                    <label for="website_email">Login Email</label>
                                    <input type="email"
                                           id="website_email"
                                           class="form-control"
                                           name="email"
                                           value="{{ old('email') }}"
                                           placeholder="Enter Email">
                                </div>

                                <div class="form-group col-lg-5">
                                    <label for="website_password">Password</label>
                                    <input type="password"
                                           id="website_password"
                                           class="form-control"
                                           name="password"
                                           placeholder="Enter Password">
                                </div>

                                <div class="form-group col-lg-5">
                                    <label for="website_description">Description</label>
                                    <textarea id="website_description"
                                              class="form-control"
                                              name="description"
                                              rows="4"
                                              placeholder="Enter Description">{{ old('description') }}</textarea>
                                </div>

                                <div class="form-group col-lg-5">
                                    <label for="website_status">Status</label>
                                    <select id="website_status" class="form-control" name="status">
                                        <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', 1) == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">Save</button>
                                <button type="button" class="btn btn-success">Save &amp; Resume</button>
                                <a href="{{ route('admin.websites') }}" class="btn btn-warning">Close</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
