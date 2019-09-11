<html class="body-full-height" lang="en">
    <head>        
    <title>Login</title>            
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('/img/logo.png')}}" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" id="theme" href="{{ asset('/admin/css/theme-default.css')}}"/>                                  
    </head>
    <body>
        
        <div class="login-container lightmode">
        
            <div class="login-box animated fadeInDown">
                
                <div class="login-body">
                    <div class="login-title"><strong>Log In</strong> to your account</div>
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        @csrf
                    <div class="form-group">
                        <div class="col-md-12">
                            <input placeholder="E-mail" type="email"class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span style="color:red" class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input placeholder="Password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style="color:red" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-info btn-block">Log In</button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        © {{date('Y')}} Aplikasi Keuangan
                    </div>
                </div>
            </div>
        </div>
</body></html>
