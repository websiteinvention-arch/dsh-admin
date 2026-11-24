@extends('website.layout.layout')

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>File Manager</h1>
                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>

                        <li class="breadcrumb-item active">
                            File Manager
                        </li>

                    </ol>

                </div>

            </div>

        </div>

    </section>


    <section class="content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-header">

                    <h3 class="card-title">
                        Website File Manager
                    </h3>

                </div>

                <div class="card-body p-0">

                    <iframe
                        src="{{ url('/laravel-filemanager?type=Files') }}"
                        style="width: 100%; height: 700px; border: 0;">
                    </iframe>

                </div>

            </div>

        </div>

    </section>

</div>

@endsection