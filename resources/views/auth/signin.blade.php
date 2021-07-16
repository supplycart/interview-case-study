@extends('app')

@section('content')
<main class="cotainer mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <h3 class="card-header text-center">Sign in</h3>
                    <div class="card-body">
                        <form method="POST" action="{{ route('signin.custom') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" name="email" placeholder="Email" id="email" class="form-control" required
                                    autofocus>
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="password" name="password" placeholder="Password" id="password" class="form-control" required>
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <div class="flex">
                                    <div class="checkbox flex-auto">
                                        <label>
                                            <input type="checkbox" name="remember">Remember
                                        </label>
                                    </div>
                                    <div class="order-last flex-auto right-0">
                                        <a class = "text-sm text-gray-700 underline" href="{{ route('register')}}">Register new account</a>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-success">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</main>
@endsection