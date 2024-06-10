@extends('admin.layout.dashboard')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Website Home Settings</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Website Home</li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Set Website Home Settings</h5>
                <p class="card-title-desc">Set Important Requirements of the website</p>

                <form action="{{ url('/admin/updateHomeSettings') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="title" placeholder="Enter User Name" name="title">
                        <label for="title">Title</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="position" placeholder="Enter Position" name="postition">
                        <label for="position">Position</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
                        <label for="description">Description</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea name="yearsOfExperience" class="form-control" id="yearsOfExperience" cols="30" rows="10"></textarea>
                        <label for="yearsOfExperience">Years of Experience</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea name="projectsCompleted" class="form-control" id="projectsCompleted" cols="30" rows="10"></textarea>
                        <label for="projectsCompleted">Projects Completed</label>
                    </div>

                    
                    <fieldset class="mb-3">
                        <p for="image">Image</p>
                        <div class="form-floating mb-3">
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                    </fieldset>



                    <div>
                        <button type="submit" class="btn btn-primary w-md">Save</button>
                    </div>
                </form>

              

    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Current Settings</h5>
                <div class="table-responsive">
                    <table class="table table-nowrap align-middle mb-0">
                        <tbody>
                            @foreach ($setting as $item)

                            <tr>
                                <td>
                                    <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Title</a></h5>
                                </td>

                                <td>
                                    <div class="text-end">
                                        <span class="font-size-11">{{ $item->title }}</span>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Position</a></h5>
                                </td>

                                <td>
                                    <div class="text-end">
                                        <span class="font-size-11">{{   $item->position  }}</span>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Description</a></h5>
                                </td>

                                <td>
                                    <div class="text-end">
                                        <span class="font-size-11">{{ $item->description }}</span>
                                    </div>
                                </td>
                            </tr>

                              <tr>
                                <td>
                                    <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Years Of Experience</a></h5>
                                </td>

                                <td>
                                    <div class="text-end">
                                        <span class="font-size-11">{{ $item->yearsOfExperience }}</span>
                                    </div>
                                </td>
                            </tr>

                              <tr>
                                <td>
                                    <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Projects Completed</a></h5>
                                </td>

                                <td>
                                    <div class="text-end">
                                        <span class="font-size-11">{{ $item->projectsCompleted }}</span>
                                    </div>
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">General Site Image</a></h5>
                                </td>
                                <td>
                                    <div class="text-end">
                                        <img src="{{ $item->image }}" alt="" class="avatar-xl">
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->
@endsection