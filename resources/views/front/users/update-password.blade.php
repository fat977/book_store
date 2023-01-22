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
        <div class="row">
            <!-- Password -->
            <div class="container-fluid">
                <div class="update-password row vertical-center">
                    <p id="password-success"></p>
                    <p id="password-error"></p>
                    <form id="passwordForm" method="POST" action="javascript:;" class="col-lg-8 col-xs-offset-2">
                        @csrf
                        <h2>Update Password</h2>
                        <div class="u-s-m-b-30">
                            <label for="current-password">Current Password
                                <span class="astk">*</span>
                            </label>
                            <input type="password" id="current-password" name="current_password" class="text-field">
                            <p id="password-current-password"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="new-password">New Password
                                <span class="astk">*</span>
                            </label>
                            <input type="password" id="new-password" name="new_password" class="text-field">
                            <p id="password-new-password"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="confirm-password">Confirm Password
                                <span class="astk">*</span>
                            </label>
                            <input type="password" id="confirm-password" name="confirm_password" class="text-field">
                            <p id="password-confirm-password"></p>
                        </div>
                        <div class="u-s-m-b-45">
                            <button class="btn btn-default mb-5">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Password /- -->
        </div>
    </div>
</div>
<!-- Account-Page /- -->
@endsection