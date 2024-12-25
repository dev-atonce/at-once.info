<div class="fade-in">
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-header">
                    @if (Auth::user()->role == 'super')
                        <span class="breadcrumb-item "><a href="{{ url("$segment") }}">User Mangement</a></span>
                    @endif
                    <span class="breadcrumb-item active">Change Password</span>
                </div>
                <div class="card-body">
                    <form id="changeForm" method="post" action="">
                        @csrf
                        @if (Session::has('status'))
                            <div class="alert alert-{{ Session::get('status') }} alert-dismissible fade show d-flex justify-content-center"
                                role="alert">
                                {!! Session::get('message') !!}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <input name="id" type="hidden" value="{{ Auth::id() }}">
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <div class="input-group col-mb-6">
                                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"" name="password"
                                    placeholder="Password" autocomplete="off">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary togglePassword" data-type="pass" type="button"><i class="far fa-eye"></i></button>
                                </div>
                            </div>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Confirm Password</label>
                            <div class="input-group col-mb-6">
                                <input type="password" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror""
                                    name="password_confirmation" placeholder="Confirm password" autocomplete="off">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary togglePassword" data-type="passconfirm" type="button"><i class="far fa-eye"></i></button>
                                </div>
                            </div>
                            @error('password_confirmation')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" name="signup" value="Create">Save</button>
                            @if (Auth::user()->role == 'super')
                                <a class="btn btn-danger" href="{{ url("$segment") }}">Cancel</a>
                            @endif
                        </div>
                        <hr>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
