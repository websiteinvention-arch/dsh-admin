@extends('website.layout.layout')

@section('content')

<div class="content-wrapper">


    <section class="content pt-5">

        <div class="container-fluid">

            <div class="card">

                <div class="card-header">

                    <h3 class="card-title">
                        Pages
                    </h3>

                        <a href="{{ route('website.pages.add') }}"
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
                                <th>Page Name</th>
                                <th>Slug</th>
                                <th>Status Switch</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>

                        </thead>


                        <tbody>

                            @forelse($pages as $page)

                                <tr>

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        {{ $page->page_name }}
                                    </td>

                                    <td>
                                        {{ $page->slug }}
                                    </td>


                                    <td>
        <input type="checkbox"
               {{ $page->status ? 'checked' : '' }}
               data-bootstrap-switch
               data-off-color="danger"
               data-on-color="success">
    </td>


                                    <td>

                                        @if($page->status == 1)

                                            <span class="badge badge-success">
                                                Active
                                            </span>

                                        @else

                                            <span class="badge badge-danger">
                                                Inactive
                                            </span>

                                        @endif

                                    </td>


                                    <td>

                                        <a href="{{ route('website.pages.edit', $page->id) }}"
                                           class="btn btn-sm bg-warning">

                                            <i class="fas fa-edit"></i>

                                        </a>

                                        <form action="{{ route('website.pages.duplicate', $page->id) }}"
                                              method="POST"
                                              style="display:inline-block;">

                                            @csrf

                                            <button type="submit"
                                                    class="btn btn-sm bg-teal"
                                                    title="Duplicate page"
                                                    aria-label="Duplicate {{ $page->page_name }}">

                                                <i class="fas fa-copy"></i>

                                            </button>

                                        </form>


                                        <form action="{{ route('website.pages.delete', $page->id) }}"
                                              method="POST"
                                              style="display:inline-block;">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm bg-danger"
                                                    onclick="return confirm('Are you sure?')">

                                                <i class="ion-android-delete"></i>

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5"
                                        class="text-center">

                                        No Pages Found

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