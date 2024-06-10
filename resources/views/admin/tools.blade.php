@extends('admin.layout.dashboard')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Tools Settings</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Tools Settings</li>
                </ol>
            </div>

        </div>
    </div>
</div>





<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h5 class="card-title">Set Tools Settings</h5>
                <p class="card-title-desc">Set Important Requirements of the Experience Settings</p>

                <div class="row g-4 mb-3">
                    <div class="col-sm-auto">

                        <!-- Button to trigger modal -->
                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#addTools">
                            <i class="ri-add-line align-bottom me-1"></i> Add Tool
                        </button>

                        <!-- Add About Modal -->
                        <div class="modal fade" id="addTools" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="addToolsLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addToolsLabel">Add Tool</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <form action="{{ url('/admin/addTools') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-floating mb-3">
                                                <p>Tools</p>
                                                <textarea name="tools" class="form-control" id="tools" cols="30" rows="5" placeholder="Enter Tool"></textarea>
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
                                Tools
                            </th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($tools as $item)
                        <tr>
                            <td>{{ $item->tools }}</td>
                          
                            <td>
                                <div class="text-end">
                                    <a class="btn btn-outline-secondary btn-sm edit" title="Edit" data-bs-toggle="modal" data-bs-target="#editTools{{ $item->id }}">
                                        <i class="bx bx-pen"></i>
                                    </a>
                                    <a class="btn btn-outline-danger btn-sm edit" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteTools{{ $item->id }}">
                                        <i class="bx bx-trash"></i>
                                    </a>
                                </div>

                                <!-- Delete About Modal -->
                                <div class="modal fade" id="deleteTools{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="deleteToolsLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="{{ url('/admin/deleteTools') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="tool_id" value="{{ $item->id }}">
                                                <div class="modal-body">
                                                    <p class="text-center">Are you sure you want to delete this tool section?</p>
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
                                <div class="modal fade" id="editTools{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editTools{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editToolsLabel{{ $item->id }}">Edit Tools Section</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <form action="{{ url('/admin/editTools') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="tool_id" value="{{ $item->id }}">
                                                <div class="modal-body">
                                                   <div class="form-floating mb-3">
                                                        <textarea name="tools" class="form-control" id="tools" cols="35" rows="5" placeholder="Enter Position">{{ $item->tools }}</textarea>
                                                        <label for="tools">Tools</label>
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