@extends('website.layout.layout')

@section('content')

<div class="content-wrapper">
    <section class="content pt-5">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Fields for {{ $entity->name }}</h3>

                    <a href="{{ route('website.entity-fields.add', $entity->id) }}"
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
                                <th>Entity Field Name</th>
                                <th>Entity Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($fields as $field)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $field->field_name }}</td>
                                    <td>{{ $field->field_type }}</td>
                                    <td>
                                        <a href="{{ route('website.entity-fields.edit', [$entity->id, $field->id]) }}"
                                           class="btn btn-sm bg-warning"
                                           aria-label="Edit {{ $field->field_name }}">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="#"
                                           class="btn btn-sm bg-teal"
                                           aria-label="View {{ $field->field_name }}">
                                            <i class="fas fa-list"></i>
                                        </a>

                                        <form action="{{ route('website.entity-fields.delete', [$entity->id, $field->id]) }}"
                                              method="POST"
                                              style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm bg-danger"
                                                    aria-label="Delete {{ $field->field_name }}"
                                                    onclick="return confirm('Are you sure?')">
                                                <i class="ion-android-delete"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">
                                        No Entity Fields Found
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
