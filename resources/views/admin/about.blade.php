@extends('admin.layout.dashboard')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">About Settings</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">About Settings</li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Set About Settings</h5>
                <p class="card-title-desc">Set Important Requirements of the About Section</p>

                <form action="{{ url('/admin/updateAbout') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingnameInput" placeholder="Enter Title" name="title">
                        <label for="title">Title</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="biography" placeholder="Enter Biography" name="biography">
                        <label for="biography">Biography</label>
                    </div>

                    <fieldset class="mb-3">
                        <p>Image</p>
                        <div class="form-floating mb-3">
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                    </fieldset>


                    <div>
                        <button type="submit" class="btn btn-primary w-md">Save</button>
                    </div>
                </form>

            
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->

    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Current Settings</h5>
                <div class="table-responsive">
                    <table class="table table-nowrap align-middle mb-0">
                        <tbody>
                        @foreach ($about as $item)
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
                                    <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Biography</a></h5>
                                </td>

                                <td>
                                    <div class="text-end">
                                        <span class="font-size-11">{{ $item->biography }}</span>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Image</a></h5>
                                </td>
                                <td>
                                    <div class="text-end">
                                        <img src="{{ asset($item->image)  }}" alt="" class="avatar-xl">
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