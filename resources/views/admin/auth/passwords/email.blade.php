@extends('admin.layout.auth')

<!-- Main Content -->
@section('content')



<div class="bg-primary-subtle">
    <div class="row">
        <div class="col-7">
            <div class="text-primary p-4">
                <h5 class="text-primary"> Reset Password</h5>
                <p>Reset Password with Skote.</p>
            </div>
        </div>
        <div class="col-5 align-self-end">
            <img src="assets/images/profile-img.png" alt="" class="img-fluid">
        </div>
    </div>
</div>
<div class="card-body pt-0">
    <div>
        <a href="index.html">
            <div class="avatar-md profile-user-wid mb-4">
                <span class="avatar-title rounded-circle bg-light">
                    <img src="assets/images/logo.svg" alt="" class="rounded-circle" height="34">
                </span>
            </div>
        </a>
    </div>

    <div class="p-2">
        <div class="alert alert-success text-center mb-4" role="alert">
            Enter your Email and instructions will be sent to you!
        </div>

        <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/password/email') }}">
            @csrf
            <div class="mb-3">
                <label for="useremail" class="form-label">Email</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="Enter email">
                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>

            <div class="text-end">
                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Reset</button>
            </div>

        </form>
    </div>

</div>

<div class="mt-5 text-center">
    <p>Remember It ? <a href="auth-login.html" class="fw-medium text-primary"> Sign In here</a> </p>
    <p>© <script>
            document.write(new Date().getFullYear())
        </script> Skote. Crafted with <i class="mdi mdi-heart text-danger"></i> by {{ env('APP_AUTHOR')}}</p>
</div>

@endsection