@extends('admin.layout.dashboard')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-testimonials-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Testimonials Settings</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-testimonial active">Testimonials Settings</li>
                </ol>
            </div>

        </div>
    </div>
</div>





<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h5 class="card-title">Set Testimonials Settings</h5>
                <p class="card-title-desc">Set Important Requirements of the Testimonials Settings</p>

                <div class="row g-4 mb-3">
                    <div class="col-sm-auto">

                        <!-- Button to trigger modal -->
                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#addTestimonials">
                            <i class="ri-add-line align-bottom me-1"></i> Add Testimonial
                        </button>

                        <!-- Add Testimonials Modal -->
                        <div class="modal fade" id="addTestimonials" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="addTestimonialsLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addTestimonialsLabel">Add Testimonial</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <form action="{{ url('/admin/addTestimonials') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-floating mb-3">
                                                <p>Title</p>
                                                <textarea name="title" class="form-control" id="title" cols="30" rows="5" placeholder="Enter Title"></textarea>
                                            </div>

                                             <div class="form-floating mb-3">
                                                <p>Description</p>
                                                <textarea name="description" class="form-control" id="description" cols="30" rows="5" placeholder="Enter Description"></textarea>
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




                    </div>
                </div>

                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>
                                Title
                            </th>

                             <th>
                                Description
                            </th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($testimonials as $testimonial)
                        <tr>
                            <td>{{ $testimonial->title }}</td>
                            
                            <td>{{ $testimonial->description }}</td>
                          

                            <td>
                                <div class="text-end">
                                    <a class="btn btn-outline-secondary btn-sm edit" title="Edit" data-bs-toggle="modal" data-bs-target="#editTestimonials{{ $testimonial->id }}">
                                        <i class="bx bx-pen"></i>
                                    </a>
                                    <a class="btn btn-outline-danger btn-sm edit" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteTestimonials{{ $testimonial->id }}">
                                        <i class="bx bx-trash"></i>
                                    </a>
                                </div>

                                <!-- Delete Testimonials Modal -->
                                <div class="modal fade" id="deleteTestimonials{{ $testimonial->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="deleteTestimonialsLabel{{ $testimonial->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="{{ url('/admin/deleteTestimonials') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="testimonial_id" value="{{ $testimonial->id }}">
                                                <div class="modal-body">
                                                    <p class="text-center">Are you sure you want to delete this Testimonial section?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-outline-danger">Yes, Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Testimonials Modal -->
                                <div class="modal fade" id="editTestimonials{{ $testimonial->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editTestimonials{{ $testimonial->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editTestimonialsLabel{{ $testimonial->id }}">Edit Testimonials Section</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <form action="{{ url('/admin/editTestimonials') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="testimonial_id" value="{{ $testimonial->id }}">
                                                <div class="modal-body">
                                                   <div class="form-floating mb-3">
                                                        <textarea name="title" class="form-control" id="title" cols="35" rows="5" placeholder="Enter Position">{{ $testimonial->title }}</textarea>
                                                        <label for="title">Title</label>
                                                    </div>

                                                     <div class="form-floating mb-3">
                                                        <textarea name="description" class="form-control" id="description" cols="35" rows="5" placeholder="Enter Position">{{ $testimonial->description }}</textarea>
                                                        <label for="description">Description</label>
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

@endsection