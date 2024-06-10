@extends('admin.layout.dashboard')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Education Settings</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Education Settings</li>
                </ol>
            </div>

        </div>
    </div>
</div>





<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h5 class="card-title">Set Education Settings</h5>
                <p class="card-title-desc">Set Important Requirements of the Education Settings</p>

                <div class="row g-4 mb-3">
                    <div class="col-sm-auto">

                        <!-- Button to trigger modal -->
                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#addEducation">
                            <i class="ri-add-line align-bottom me-1"></i> Add Education
                        </button>

                        <!-- Add About Modal -->
                        <div class="modal fade" id="addEducation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="addEducationLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addEducationLabel">Add Education</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <form action="{{ url('/admin/addEducation') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-floating mb-3">
                                                <p>Degree</p>
                                                <textarea name="degree" class="form-control" id="degree" cols="30" rows="5" placeholder="Enter Degree"></textarea>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <p>School</p>
                                                <textarea name="school" class="form-control" id="school" cols="30" rows="5" placeholder="Enter School"></textarea>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <p>Year</p>
                                                <textarea name="year" class="form-control" id="year" cols="25" rows="30" placeholder="Enter Year"></textarea>
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
                            <th>Degree</th>
                            <th>School</th>
                            <th>Year</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($educations as $education)
                        <tr>
                            <td>{{ $education->degree }}</td>
                            <td>{{ $education->school }}</td>
                            <td>{{ $education->year }}</td>
                            <td>
                                <div class="text-end">
                                    <a class="btn btn-outline-secondary btn-sm edit" title="Edit" data-bs-toggle="modal" data-bs-target="#editEducation{{ $education->id }}">
                                        <i class="bx bx-pen"></i>
                                    </a>
                                    <a class="btn btn-outline-danger btn-sm edit" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteEducation{{ $education->id }}">
                                        <i class="bx bx-trash"></i>
                                    </a>
                                </div>

                                <!-- Delete About Modal -->
                                <div class="modal fade" id="deleteEducation{{ $education->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="deleteEducationLabel{{ $education->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="{{ url('/admin/deleteEducation') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="education_id" value="{{ $education->id }}">
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
                                <div class="modal fade" id="editEducation{{ $education->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editEducationLabel{{ $education->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editEducationLabel{{ $education->id }}">Edit Education Section</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <form action="{{ url('/admin/editEducation') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="education_id" value="{{ $education->id }}">
                                                <div class="modal-body">
                                                   <div class="form-floating mb-3">
                                                        <textarea name="degree" class="form-control" id="degree" cols="35" rows="5" placeholder="Enter Degree">{{ $education->degree }}</textarea>
                                                        <label for="degree">Degree</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <textarea name="school" class="form-control" id="school" cols="35" rows="5" placeholder="Enter School">{{ $education->school }}</textarea>
                                                        <label for="about">School</label>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <textarea name="year" class="form-control" id="year" cols="35" rows="5" placeholder="Enter Year">{{ $education->year }}</textarea>
                                                        <label for="about">Year</label>
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