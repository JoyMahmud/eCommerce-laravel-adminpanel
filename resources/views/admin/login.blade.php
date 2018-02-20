{{--*/ $logo = \App\CommonSettings::where('option_key','logo')->select('option_value')->first() /*--}}
@extends('layout.authentication_master')
@section('content')
        <body class="hold-transition login-page">
        <div class="login-box">
                <div class="login-logo">
                        <img style="max-width: 250px" src="{{asset($logo->option_value)}}" alt="">
                </div><!-- /.login-logo -->
                <div class="login-box-body">
                        @if (count($errors))
                                <ul>
                                        @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                        @endforeach
                                </ul>
                        @endif
                        <p class="login-box-msg">Sign in to enter admin panel</p>
                        {!! Form::open()  !!}
                        <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error':'' }}">
                                <input type="email" class="form-control" name="email" placeholder="Email">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                {{ $errors->has('email') ? $errors->first('email'): '' }}
                        </div>

                        <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error':'' }}">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                {{ $errors->has('password') ? $errors->first('password'): '' }}
                        </div>
                        <div class="row">

                                <div class="col-xs-4">
                                        <button type="submit" class="btn btn-primary btn-block btn-flat"> <i class="fa fa-sign-in"></i> Sign In</button>
                                </div><!-- /.col -->
                        </div>
                        </form>

                        {{--    <a href="#">I forgot my password</a><br>
                            <a href="register.html" class="text-center">Register a new membership</a>--}}

                </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->


@stop