<x-auth-design>

    <div class="row w-100 mx-0 auth-page">
        <div class="col-md-8 col-xl-6 mx-auto">
            <div class="card">
                <div class="row">
                    <div class="col-md-4 pe-md-0">
                        <div class="auth-side-wrapper">

                        </div>
                    </div>

                    <div class="col-md-8 ps-md-0">
                        <div class="auth-form-wrapper px-4 py-5">
                            <a href="#" class="noble-ui-logo logo-light d-block mb-2">Noble<span>UI</span></a>
                            <h5 class="text-muted fw-normal mb-4">Create a free account.</h5>
                            @include('admin.components.errors')
                            <form class="forms-sample" method="POST" action="{{route('register')}}">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputUsername1" class="form-label">Username</label>
                                    <input type="text" class="form-control" name="name" id="exampleInputUsername1" autocomplete="Username" placeholder="Username">
                                </div>
                                <div class="mb-3">
                                    <label for="userEmail" class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control" id="userEmail" placeholder="Email">
                                </div>
                                <div class="mb-3">
                                    <label for="userPassword" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="userPassword" autocomplete="current-password" placeholder="Password">
                                </div>

                                <div class="mb-3">
                                    <label for="userPassword" class="form-label">Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="userPassword" autocomplete="current-password" placeholder="Password">
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary text-white me-2 mb-2 mb-md-0">Sign up</button>
                                    <button type="button" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                                        <i class="btn-icon-prepend" data-feather="twitter"></i>
                                        Sign up with twitter
                                    </button>
                                </div>
                                <a href="login.html" class="d-block mt-3 text-muted">Already a user? Sign in</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-auth-design>
