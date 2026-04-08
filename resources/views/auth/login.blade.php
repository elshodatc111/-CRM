<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>{{ __('auth.title') }}</title> 
  <link href="{{ asset('assets/img/logo1.png') }}" rel="icon">
  <link href="{{ asset('assets/img/logo1.png') }}" rel="apple-touch-icon">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  <style> .logo-container i { line-height: 1; } .invalid-feedback { font-size: 0.8rem; } </style>
</head>
<body>
    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">                            
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2 text-center">
                                        <div class="logo-container mb-3"><img src="{{ asset('assets/img/logo.png') }}" alt=""></div>
                                        <h5 class="card-title text-center pb-0 fs-4">{{ __('auth.welcome') }}</h5>
                                    </div>
                                    @if($errors->has('error') || $errors->has('phone'))
                                        <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                                            <i class="bi bi-exclamation-octagon me-1"></i>
                                            {{ $errors->first('error') ?: $errors->first('phone') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <form action="{{ route('login_post') }}" method="POST" class="row g-3 needs-validation" novalidate>
                                        @csrf                                      
                                        <div class="col-12">
                                            <label for="yourphone" class="form-label">{{ __('auth.phone') }}</label>
                                            <div class="input-group has-validation">
                                                <input type="text"  name="phone"  class="form-control phone @error('phone') is-invalid @enderror"  id="yourphone"  value="{{ old('phone', '+998') }}"  placeholder="+998 __ ___ ____" required>                                                
                                                @error('phone') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">{{ __('auth.password') }}</label>
                                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="yourPassword" required>                                            
                                            @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">{{ __('auth.login') }}</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <div class="credits">
                                <ul class="list-inline small">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <li class="list-inline-item">
                                            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                {{ $properties['native'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".phone").inputmask("+998 99 999 9999");
        });
    </script>
</body>
</html>