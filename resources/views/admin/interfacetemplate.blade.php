@php
$pageName = 'About Page Settings';
@endphp
@extends('admin.layout.dashboard')

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">About</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                            <li class="breadcrumb-item active">About</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- Add About Modal -->
        <div class="modal fade" id="addAbout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="addAboutLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAboutLabel">Add About</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ url('/admin/addAbout') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <input type="file" class="form-control" id="image" name="image" placeholder="Upload Image">
                                <label for="image">Image</label>
                            </div>
                            <div class="form-floating mb-3">
                                <p>About Text</p>
                                <textarea name="about" class="form-control" id="about" cols="35" rows="5" placeholder="Enter About"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#addAbout">
                                    <i class="ri-add-line align-bottom me-1"></i> Add
                                </button>
                            </div>
                        </div>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>About</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($abouts as $about)
                                <tr>
                                    <td>
                                        <div class="flex-shrink-0 me-3">
                                            <img class="rounded avatar-md" src="{{ asset($about->image) }}" alt="{{ $about->about }}">
                                        </div>
                                    </td>
                                    <td>{{ Illuminate\Support\Str::limit(strip_tags($about->about), 30) }}</td>
                                    <td>
                                        <div class="text-end">
                                            <a class="btn btn-outline-secondary btn-sm edit" title="Edit" data-bs-toggle="modal" data-bs-target="#editAbout{{ $about->id }}">
                                                <i class="bx bx-pen"></i>
                                            </a>
                                            <a class="btn btn-outline-danger btn-sm edit" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteAbout{{ $about->id }}">
                                                <i class="bx bx-trash"></i>
                                            </a>
                                        </div>

                                        <!-- Delete About Modal -->
                                        <div class="modal fade" id="deleteAbout{{ $about->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="deleteAboutLabel{{ $about->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ url('/admin/deleteAbout') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="about_id" value="{{ $about->id }}">
                                                        <div class="modal-body">
                                                            <p class="text-center">Are you sure you want to delete this about section?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-outline-danger">Yes, Delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Edit About Modal -->
                                        <div class="modal fade" id="editAbout{{ $about->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editAboutLabel{{ $about->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editAboutLabel{{ $about->id }}">Edit About Section</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <form action="{{ url('/admin/editAbout') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="about_id" value="{{ $about->id }}">
                                                        <div class="modal-body">
                                                            <div class="form-floating mb-3">
                                                                <input type="file" class="form-control" id="image" name="image" placeholder="Upload Image">
                                                                <label for="image">Image</label>
                                                            </div>
                                                            <div class="form-floating mb-3">
                                                                <textarea name="about" class="form-control" id="about" cols="35" rows="5" placeholder="Enter About">{{ $about->about }}</textarea>
                                                                <label for="about">About</label>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->



    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
@endsection