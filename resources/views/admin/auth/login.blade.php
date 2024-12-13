<x-auth-design>
    <div class="row w-100 mx-0 auth-page">
        <div class="col-md-8 col-xl-6 mx-auto">
            <div class="card">
                <div class="row">
                    <div class="col-md-4 pe-md-0">
                        <div class="auth-side-wrapper">
                            <!-- Место для изображений, иллюстраций или дополнительного контента -->
                        </div>
                    </div>

                    <div class="col-md-8 ps-md-0">
                        <div class="auth-form-wrapper px-4 py-5">
                            <a href="#" class="noble-ui-logo logo-light d-block mb-2">Noble<span>UI</span></a>
                            <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>

                            @include('admin.components.errors')
                            <form class="forms-sample" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="userEmail" class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control" id="userEmail" placeholder="Email" >
                                </div>

                                <div class="mb-3">
                                    <label for="userPassword" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="userPassword" autocomplete="current-password" placeholder="Password" >
                                </div>

                                <div class="form-check mb-3">
                                    <input type="checkbox" name="remember" class="form-check-input" id="authCheck">
                                    <label class="form-check-label" for="authCheck">Remember me</label>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary text-white">Login</button>
                                    <button type="button" class="btn btn-outline-primary btn-icon-text">
                                        <i class="btn-icon-prepend" data-feather="twitter"></i>Login with Twitter
                                    </button>
                                </div>
                                <a href="{{ route('register') }}" class="d-block mt-3 text-muted">Not a user? Sign up</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-auth-design>
