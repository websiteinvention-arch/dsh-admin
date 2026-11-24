@extends('website.layout.layout')

@section('content')

<div class="content-wrapper">
    <section class="content pt-5">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $entity->name }} Records</h3>

                    <a href="{{ route('website.entity-records.add', $entity->id) }}"
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
                                <th>#</th>
                                @foreach($fields as $field)
                                    <th>{{ $field->field_name }}</th>
                                @endforeach
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($records as $record)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    @foreach($fields as $field)
                                        @php
                                            $fieldValue = $record->values
                                                ->where('entity_field_id', $field->id)
                                                ->first();
                                        @endphp
                                        <td>{{ $fieldValue ? $fieldValue->value : '-' }}</td>
                                    @endforeach

                                    <td>
                                        <a href="{{ route('website.entity-records.edit', [$entity->id, $record->id]) }}"
                                           class="btn btn-sm bg-warning"
                                           aria-label="Edit record {{ $loop->iteration }}">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('website.entity-records.delete', [$entity->id, $record->id]) }}"
                                              method="POST"
                                              style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm bg-danger"
                                                    aria-label="Delete record {{ $loop->iteration }}"
                                                    onclick="return confirm('Are you sure?')">
                                                <i class="ion-android-delete"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ $fields->count() + 2 }}" class="text-center">
                                        No records found.
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
