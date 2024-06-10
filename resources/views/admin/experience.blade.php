@extends('admin.layout.dashboard')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Experience Settings</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Experience Settings</li>
                </ol>
            </div>

        </div>
    </div>
</div>





<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h5 class="card-title">Set Experience Settings</h5>
                <p class="card-title-desc">Set Important Requirements of the Experience Settings</p>

                <div class="row g-4 mb-3">
                    <div class="col-sm-auto">

                        <!-- Button to trigger modal -->
                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#addExperience">
                            <i class="ri-add-line align-bottom me-1"></i> Add Experience
                        </button>

                        <!-- Add About Modal -->
                        <div class="modal fade" id="addExperience" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="addExperienceLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addExperienceLabel">Add Experience</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <form action="{{ url('/admin/addExperience') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-floating mb-3">
                                                <p>Position</p>
                                                <textarea name="position" class="form-control" id="position" cols="30" rows="5" placeholder="Enter Position"></textarea>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <p>Duration</p>
                                                <textarea name="duration" class="form-control" id="duration" cols="30" rows="5" placeholder="Enter Duration"></textarea>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <p>City</p>
                                                <textarea name="city" class="form-control" id="city" cols="25" rows="30" placeholder="Enter City"></textarea>
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
                            <th>Position</th>
                            <th>Duration</th>
                            <th>City</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($experiences as $experience)
                        <tr>
                            <td>{{ $experience->position }}</td>
                            <td>{{ $experience->duration }}</td>
                            <td>{{ $experience->city }}</td>
                            <td>
                                <div class="text-end">
                                    <a class="btn btn-outline-secondary btn-sm edit" title="Edit" data-bs-toggle="modal" data-bs-target="#editExperience{{ $experience->id }}">
                                        <i class="bx bx-pen"></i>
                                    </a>
                                    <a class="btn btn-outline-danger btn-sm edit" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteExperience{{ $experience->id }}">
                                        <i class="bx bx-trash"></i>
                                    </a>
                                </div>

                                <!-- Delete About Modal -->
                                <div class="modal fade" id="deleteExperience{{ $experience->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="deleteExperienceLabel{{ $experience->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="{{ url('/admin/deleteExperience') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="experience_id" value="{{ $experience->id }}">
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
                                <div class="modal fade" id="editExperience{{ $experience->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editExperienceLabel{{ $experience->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editExperienceLabel{{ $experience->id }}">Edit Experience Section</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <form action="{{ url('/admin/editExperience') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="experience_id" value="{{ $experience->id }}">
                                                <div class="modal-body">
                                                   <div class="form-floating mb-3">
                                                        <textarea name="position" class="form-control" id="position" cols="35" rows="5" placeholder="Enter Position">{{ $experience->position }}</textarea>
                                                        <label for="position">Position</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <textarea name="duration" class="form-control" id="duration" cols="35" rows="5" placeholder="Enter Duration">{{ $experience->duration }}</textarea>
                                                        <label for="about">Duration</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <textarea name="city" class="form-control" id="city" cols="35" rows="5" placeholder="Enter City">{{ $experience->city }}</textarea>
                                                        <label for="about">City</label>
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

@endsection