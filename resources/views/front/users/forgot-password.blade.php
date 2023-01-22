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
        <!-- Forgot -->
        <div class="update-password  row vertical-center">
            
            <form  action="javascript:;" method="POST" id="forgotForm" class="col-lg-8 col-xs-offset-2">
                @csrf 
                <h2 class="account-h2 u-s-m-b-20">Forgot Password</h2>
                <h4 class="account-h6 u-s-m-b-30">Welcome back! Sign in to your account.</h4>
                <p id="forgot-error"></p>
                <p id="forgot-success"></p>
                <div class="u-s-m-b-30">
                    <label for="user-email">Email
                        <span class="astk">*</span>
                    </label>
                    <input type="email" name="email" id="users-email" class="text-field" placeholder="Email">
                    <p id="forgot-email"></p>
                </div>
                <div class="group-inline u-s-m-b-30">
                    <div class="group-2 text-right">
                        <div class="page-anchor">
                            <a href="{{ url('user/login-register') }}">
                                <i class="fas fa-circle-o-notch u-s-m-r-9"></i>Back to Login</a>
                        </div>
                    </div>
                </div>
                <div class="m-b-45">
                    <button type="submit" class="button button-outline-secondary w-100">Submit</button>
                </div>
            </form>
        </div>
        <!-- Forgot /- -->
    </div>
</div>
<!-- Account-Page /- -->
@endsection