@extends('website.layout.layout')

@section('content')

<div class="content-wrapper">
    <section class="content pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Edit {{ $entity->name }} Record</h3>
                        </div>

                        <form action="{{ route('website.entity-records.update', [$entity->id, $record->id]) }}"
                              method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                @forelse($fields as $field)
                                    @php
                                        $fieldValue = $record->values
                                            ->where('entity_field_id', $field->id)
                                            ->first();
                                        $value = old('fields.' . $field->id, $fieldValue ? $fieldValue->value : '');
                                    @endphp

                                    <div class="form-group col-lg-12">
                                        <label for="record_field_{{ $field->id }}">
                                            {{ $field->field_name }}
                                            @if($field->is_required)
                                                <span class="text-danger">*</span>
                                            @endif
                                        </label>

                                        @if($field->field_type == 'textarea')
                                            <textarea id="record_field_{{ $field->id }}"
                                                      name="fields[{{ $field->id }}]"
                                                      class="form-control"
                                                      rows="4"
                                                      {{ $field->is_required ? 'required' : '' }}>{{ $value }}</textarea>
                                        @elseif($field->field_type == 'number')
                                            <input id="record_field_{{ $field->id }}"
                                                   type="number"
                                                   name="fields[{{ $field->id }}]"
                                                   class="form-control"
                                                   value="{{ $value }}"
                                                   {{ $field->is_required ? 'required' : '' }}>
                                        @elseif($field->field_type == 'file')
                                            @if($fieldValue && $fieldValue->value)
                                                <p>
                                                    Current File:
                                                    <a href="{{ asset('storage/' . $fieldValue->value) }}" target="_blank" rel="noopener">
                                                        View File
                                                    </a>
                                                </p>
                                            @endif
                                            <input id="record_field_{{ $field->id }}"
                                                   type="file"
                                                   name="fields[{{ $field->id }}]"
                                                   class="form-control">
                                        @elseif($field->field_type == 'date')
                                            <input id="record_field_{{ $field->id }}"
                                                   type="date"
                                                   name="fields[{{ $field->id }}]"
                                                   class="form-control"
                                                   value="{{ $value }}"
                                                   {{ $field->is_required ? 'required' : '' }}>
                                        @else
                                            <input id="record_field_{{ $field->id }}"
                                                   type="text"
                                                   name="fields[{{ $field->id }}]"
                                                   class="form-control"
                                                   value="{{ $value }}"
                                                   {{ $field->is_required ? 'required' : '' }}>
                                        @endif
                                    </div>
                                @empty
                                    <p class="text-muted">Add fields to this entity before editing a record.</p>
                                @endforelse
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">Update</button>
                                <button type="button" class="btn btn-success">Save &amp; Resume</button>
                                <a href="{{ route('website.entity-records', $entity->id) }}" class="btn btn-warning">Close</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
