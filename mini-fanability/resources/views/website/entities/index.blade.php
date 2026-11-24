@extends('website.layout.layout')

@section('content')

<div class="content-wrapper">
    <section class="content pt-5">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Entities</h3>

                    <a href="{{ route('website.entities.add') }}"
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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Entity Id</th>
                                <th>Entity Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($entities as $entity)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $entity->id }}</td>
                                    <td>{{ $entity->name }}</td>
                                    <td>
                                        <a href="{{ route('website.entities.edit', $entity->id) }}"
                                           class="btn btn-sm bg-warning"
                                           aria-label="Edit {{ $entity->name }}">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="{{ route('website.entity-fields', $entity->id) }}"
                                           class="btn btn-sm bg-teal"
                                           aria-label="Manage fields for {{ $entity->name }}">
                                            <i class="fas fa-list"></i>
                                        </a>

                                        <form action="{{ route('website.entities.delete', $entity->id) }}"
                                              method="POST"
                                              style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm bg-danger"
                                                    aria-label="Delete {{ $entity->name }}"
                                                    onclick="return confirm('Are you sure?')">
                                                <i class="ion-android-delete"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">
                                        No Entities Found
                                    </td>
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
