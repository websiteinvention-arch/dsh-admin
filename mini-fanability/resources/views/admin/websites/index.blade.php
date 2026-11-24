@extends('admin.layout.layout')

@section('content')

<div class="content-wrapper">
    <section class="content pt-5">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Websites</h3>

                    <a href="{{ route('admin.websites.add') }}"
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
                                <th>Project Id</th>
                                <th>Project Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($websites as $website)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $website->id }}</td>
                                    <td>{{ $website->project_name }}</td>
                                    <td>
                                        <input type="checkbox"
                                               {{ $website->status ? 'checked' : '' }}
                                               data-bootstrap-switch
                                               data-off-color="danger"
                                               data-on-color="success">
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.websites.edit', $website->id) }}"
                                           class="btn btn-sm bg-warning"
                                           aria-label="Edit {{ $website->project_name }}">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="#"
                                           class="btn btn-sm bg-teal"
                                           aria-label="Copy {{ $website->project_name }}">
                                            <i class="fas fa-copy"></i>
                                        </a>

                                        <form action="{{ route('admin.websites.delete', $website->id) }}"
                                              method="POST"
                                              style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm bg-danger"
                                                    aria-label="Delete {{ $website->project_name }}"
                                                    onclick="return confirm('Are you sure?')">
                                                <i class="ion-android-delete"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Websites Found</td>
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
