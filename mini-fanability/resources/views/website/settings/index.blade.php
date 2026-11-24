@extends('website.layout.layout')

@section('content')
<div class="content-wrapper">
    <section class="content pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Website Settings</h3>
                        </div>

                        <form action="{{ route('website.settings.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="mb-4">
                                    <h5 class="mb-3">Website Branding</h5>
                                    <div class="row">
                                        <div class="form-group col-lg-4">
                                            <label for="logo">Logo</label>
                                            <input type="file" name="logo" id="logo" class="form-control">
                                            @if($settings && $settings->logo)
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $settings->logo) }}" alt="Current logo" class="img-thumbnail" style="max-width: 200px; max-height: 100px;">
                                                </div>
                                            @endif
                                        </div>

                                        <div class="form-group col-lg-4">
                                            <label for="white_logo">White Logo</label>
                                            <input type="file" name="white_logo" id="white_logo" class="form-control">
                                            @if($settings && $settings->white_logo)
                                                <div class="mt-2 p-2 bg-dark">
                                                    <img src="{{ asset('storage/' . $settings->white_logo) }}" alt="Current white logo" class="img-thumbnail" style="max-width: 200px; max-height: 100px;">
                                                </div>
                                            @endif
                                        </div>

                                        <div class="form-group col-lg-4">
                                            <label for="favicon">Favicon</label>
                                            <input type="file" name="favicon" id="favicon" class="form-control">
                                            @if($settings && $settings->favicon)
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $settings->favicon) }}" alt="Current favicon" class="img-thumbnail" style="width: 50px; height: 50px;">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h5 class="mb-3">Contact Information</h5>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $settings->email ?? '') }}" placeholder="example@email.com">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="phone">Phone</label>
                                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $settings->phone ?? '') }}" placeholder="+92 300 0000000">
                                        </div>

                                        <div class="form-group col-12">
                                            <label for="address">Address</label>
                                            <textarea name="address" id="address" class="form-control" rows="3" placeholder="Website address">{{ old('address', $settings->address ?? '') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h5 class="mb-3">Website Information</h5>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="domain">Domain</label>
                                            <input type="text" name="domain" id="domain" class="form-control" value="{{ old('domain', $settings->domain ?? '') }}" placeholder="example.com">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="destination_url">Destination URL</label>
                                            <input type="url" name="destination_url" id="destination_url" class="form-control" value="{{ old('destination_url', $settings->destination_url ?? '') }}" placeholder="https://example.com">
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h5 class="mb-3">Social Media Links</h5>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="youtube">YouTube</label>
                                            <input type="url" name="youtube" id="youtube" class="form-control" value="{{ old('youtube', $settings->youtube ?? '') }}" placeholder="https://youtube.com/...">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="instagram">Instagram</label>
                                            <input type="url" name="instagram" id="instagram" class="form-control" value="{{ old('instagram', $settings->instagram ?? '') }}" placeholder="https://instagram.com/...">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="linkedin">LinkedIn</label>
                                            <input type="url" name="linkedin" id="linkedin" class="form-control" value="{{ old('linkedin', $settings->linkedin ?? '') }}" placeholder="https://linkedin.com/...">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="facebook">Facebook</label>
                                            <input type="url" name="facebook" id="facebook" class="form-control" value="{{ old('facebook', $settings->facebook ?? '') }}" placeholder="https://facebook.com/...">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="twitter">Twitter / X</label>
                                            <input type="url" name="twitter" id="twitter" class="form-control" value="{{ old('twitter', $settings->twitter ?? '') }}" placeholder="https://x.com/...">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">Save Settings</button>
                                <button type="reset" class="btn btn-success">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
