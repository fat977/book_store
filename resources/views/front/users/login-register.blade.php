@extends('front.layout.layout')
@section('content')

<!-- Account-Page -->
<div class="page-account u-s-p-t-80">
    <div class="container">
        @if (Session::has('success_message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success :</strong> {{Session::get('success_message')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        @if (Session::has('error_message'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error :</strong> {{Session::get('error_message')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error :</strong> <?php echo implode('',$errors->all('<div>:message</div>')); ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        <section id="form"><!--form-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-1">
                        <div class="login-form"><!--login form-->
                            <h2>Login to your account</h2>
                            <form  action="javascript:;" method="POST" id="loginForm">
                                @csrf
                                <p id="login-error"></p>
                                <div class="u-s-m-b-30">
                                    <label for="user-email">Email
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="email" name="email" id="users-email" class="text-field" placeholder="Email">
                                    <p id="login-email"></p>
                                </div>
                                <div class="u-s-m-b-30">
                                    <label for="user-password">Password
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="password" name="password" id="users-password" class="text-field" placeholder="Password">
                                    
                                </div>
                                <div class="group-inline u-s-m-b-30">
                                    <div class="group-2 text-right">
                                        <div class="page-anchor">
                                            <a href="{{ url('user/forgot-password') }}">
                                                <i class="fas fa-circle-o-notch u-s-m-r-9"></i>Forgot password?</a>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-default">Login</button>
                            </form>
                        </div><!--/login form-->
                    </div>
                    <div class="col-sm-1">
                        <h2 class="or">OR</h2>
                    </div>
                    <div class="col-sm-4">
                        <div class="signup-form"><!--sign up form-->
                            <h2>New User Signup!</h2>
                            <form action="javascript:;" method="POST" id="registerForm">
                                @csrf
                                <p id="register-success"></p>
                                <div class="u-s-m-b-30">
                                    <label for="user_name">Name
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="user-name" name="name" class="text-field" placeholder="user Name" required>
                                    <p id="register-name"></p>
                                </div>
                                <div class="u-s-m-b-30">
                                    <label for="user_mobile">Mobile
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="user-mobile" name="mobile" class="text-field" placeholder="user Mobile">
                                    <p id="register-mobile"></p>
                                </div>
                                <div class="u-s-m-b-30">
                                    <label for="user_email">Email
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="email" id="user-email" name="email" class="text-field" placeholder="user Email">
                                    <p id="register-email"></p>
                                </div>
                                <div class="u-s-m-b-30">
                                    <label for="user_password">Password
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="password" id="user-password" name="password" class="text-field" placeholder="user Password">
                                    <p id="register-password"></p>
                                </div>
                        
                                <button type="submit" class="btn btn-default">Signup</button>
                            </form>
                        </div><!--/sign up form-->
                    </div>
                </div>
            </div>
        </section><!--/form-->
    </div>
</div>
<!-- Account-Page /- -->
@endsection