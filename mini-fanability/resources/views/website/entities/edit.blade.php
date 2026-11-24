@extends('website.layout.layout')

@section('content')

<div class="content-wrapper">
    <section class="content pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Edit Entity</h3>
                        </div>

                        <form action="{{ route('website.entities.update', $entity->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="form-group col-lg-5">
                                    <label for="entity_name">Entity Name</label>
                                    <input type="text"
                                           id="entity_name"
                                           class="form-control"
                                           name="name"
                                           value="{{ old('name', $entity->name) }}"
                                           placeholder="Enter Entity Name"
                                           required>
                                </div>

                                <div class="form-group col-lg-5">
                                    <label for="entity_description">Description</label>
                                    <textarea id="entity_description"
                                              class="form-control"
                                              name="description"
                                              rows="4"
                                              placeholder="Enter Description">{{ old('description', $entity->description) }}</textarea>
                                </div>

                                <div class="form-group col-lg-5">
                                    <label for="entity_status">Status</label>
                                    <select id="entity_status" class="form-control" name="status">
                                        <option value="1" {{ old('status', $entity->status) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $entity->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">Update</button>
                                <button type="button" class="btn btn-success">Save &amp; Resume</button>
                                <a href="{{ route('website.entities') }}" class="btn btn-warning">Close</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
