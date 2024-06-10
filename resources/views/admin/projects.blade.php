@extends('admin.layout.dashboard')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-projects-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Projects Settings</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-project active">Projects Settings</li>
                </ol>
            </div>

        </div>
    </div>
</div>





<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h5 class="card-title">Set Projects Settings</h5>
                <p class="card-title-desc">Set Important Requirements of the Projects Settings</p>

                <div class="row g-4 mb-3">
                    <div class="col-sm-auto">

                        <!-- Button to trigger modal -->
                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#addProjects">
                            <i class="ri-add-line align-bottom me-1"></i> Add Project
                        </button>

                        <!-- Add Projects Modal -->
                        <div class="modal fade" id="addProjects" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="addProjectsLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addProjectsLabel">Add Project</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <form action="{{ url('/admin/addProjects') }}" method="POST" enctype="multipart/form-data">
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
                        @foreach($projects as $project)
                        <tr>
                            <td>{{ $project->title }}</td>
                            
                            <td>{{ $project->description }}</td>
                          

                            <td>
                                <div class="text-end">
                                    <a class="btn btn-outline-secondary btn-sm edit" title="Edit" data-bs-toggle="modal" data-bs-target="#editProjects{{ $project->id }}">
                                        <i class="bx bx-pen"></i>
                                    </a>
                                    <a class="btn btn-outline-danger btn-sm edit" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteProjects{{ $project->id }}">
                                        <i class="bx bx-trash"></i>
                                    </a>
                                </div>

                                <!-- Delete Projects Modal -->
                                <div class="modal fade" id="deleteProjects{{ $project->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="deleteProjectsLabel{{ $project->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="{{ url('/admin/deleteProjects') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="project_id" value="{{ $project->id }}">
                                                <div class="modal-body">
                                                    <p class="text-center">Are you sure you want to delete this Project section?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-outline-danger">Yes, Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Projects Modal -->
                                <div class="modal fade" id="editProjects{{ $project->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editProjects{{ $project->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editProjectsLabel{{ $project->id }}">Edit Projects Section</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <form action="{{ url('/admin/editProjects') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="project_id" value="{{ $project->id }}">
                                                <div class="modal-body">
                                                   <div class="form-floating mb-3">
                                                        <textarea name="title" class="form-control" id="title" cols="35" rows="5" placeholder="Enter Position">{{ $project->title }}</textarea>
                                                        <label for="title">Title</label>
                                                    </div>

                                                     <div class="form-floating mb-3">
                                                        <textarea name="description" class="form-control" id="description" cols="35" rows="5" placeholder="Enter Position">{{ $project->description }}</textarea>
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