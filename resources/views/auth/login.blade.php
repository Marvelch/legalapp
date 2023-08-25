<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

@include('components.head')

<body>
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <div class="auth-main">
        <div class="auth-wrapper v3">
            <div class="auth-form">
                <div class="card my-5">
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <a href="#" class="d-flex justify-content-center">
                                <img src="https://sekarbumi.com/wp-content/uploads/2022/10/Logo-SKB-Horizontal-01-1-1.png"
                                    width="100%" />
                            </a>
                            <h6 class="my-3 d-flex justify-content-center">Management Of Company Legal Reports</h6>
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                    id="floatingInput" placeholder="Email address / Username" required />
                                <label for="floatingInput">Email address / Username</label>
                            </div>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                    id="floatingInput" required placeholder="Password" />
                                <label for="floatingInput">Password</label>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="d-flex mt-1 justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input input-primary" type="checkbox" id="customCheckc1"
                                        checked="" />
                                    <label class="form-check-label text-muted" for="customCheckc1">Remember me</label>
                                </div>
                                @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    <h5 class="text-secondary">Forgot Password?</h5>
                                </a>
                                @endif
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-secondary">Sign In</button>
                            </div>
                            <hr />
                            <h5 class="d-flex justify-content-center">Don't have an account?</h5>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
    @@include('../layouts/footer-js.html')
</body>
<!-- [Body] end -->

</html>
