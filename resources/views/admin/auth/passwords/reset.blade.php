@extends('admin.layout.auth')

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

    <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/password/reset') }}">
        @csrf
        <div class="mb-3 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="useremail" class="form-label">Email</label>
            <input id="email" type="email" class="form-control" name="email" placeholder="Enter email">
            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>

        <div class="mb-3 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="form-label">Password</label>
            <input id="email" type="email" class="form-control" placeholder="Enter Password" name="email" value="{{ old('email') }}" autofocus>
            @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>

        <div class="mb-3 form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}" mb-3">
            <label for="useremail" class="form-label">Confirm Password</label>
            <input id="password-confirm" type="password" class="form-control" placeholder="Confirm your Password" name="password_confirmation">
            @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
            @endif
        </div>

        <div class="mt-2 text-end">
            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Reset password</button>
        </div>

    </form>
</div>


@endsection










