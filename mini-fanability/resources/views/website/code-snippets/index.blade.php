@extends('website.layout.layout')

@section('content')

<div class="content-wrapper">

    <section class="content pt-5">

        <div class="container-fluid">

            <div class="card">

                <div class="card-header">

                    <h3 class="card-title">
                        Code Snippets
                    </h3>

                    <a href="{{ route('website.code-snippets.add') }}"
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
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($snippets as $snippet)

                                <tr>

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        {{ $snippet->name }}
                                    </td>

                                    <td>
                                        {{ $snippet->slug }}
                                    </td>

                                    <td>

                                        <a href="{{ route('website.code-snippets.edit', $snippet->id) }}"
                                           class="btn btn-sm bg-warning">

                                            <i class="fas fa-edit"></i>

                                        </a>

                                        <form action="{{ route('website.code-snippets.duplicate', $snippet->id) }}"
                                              method="POST"
                                              style="display:inline-block;">

                                            @csrf

                                            <button type="submit"
                                                    class="btn btn-sm bg-teal"
                                                    title="Duplicate code snippet"
                                                    aria-label="Duplicate {{ $snippet->name }}">

                                                <i class="fas fa-copy"></i>

                                            </button>

                                        </form>


                                        <form action="{{ route('website.code-snippets.delete', $snippet->id) }}"
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
                                    <td colspan="4" class="text-center">
                                        No Code Snippets Found
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