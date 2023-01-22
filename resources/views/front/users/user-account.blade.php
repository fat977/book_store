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
            <!-- update account details -->
            <div class="container-fluid">
                <div class="update-user row vertical-center">
                    <form  action="javascript:;" method="POST" id="accountForm" class="col-lg-8 col-xs-offset-2">
                        @csrf 
                        <h2>Update User Details</h2>
                        <p id="account-error"></p>
                        <p id="account-success"></p>
                        <div class="u-s-m-b-30">
                            <label for="user-email">Email
                                <span class="astk">*</span>
                            </label>
                            <input class="text-field" value="{{ Auth::user()->email }}" readonly disabled
                            style="background-color: #f9f9f9">
                            <p id="account-email"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="user-password">Password
                                <span class="astk">*</span>
                            </label>
                            <input class="text-field" value="{{ Auth::user()->password }}" readonly disabled
                            style="background-color: #f9f9f9">
                            <a href="{{ url('user/update-password') }}">Update Password</a>
                            <p id="account-password"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="user-name">Name
                                <span class="astk">*</span>
                            </label>
                            <input class="text-field" value="{{ Auth::user()->name }}" id="user-name"
                            name="name">
                            <p id="account-name"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="user-address">Address
                                <span class="astk">*</span>
                            </label>
                            <input class="text-field" value="{{ Auth::user()->address }}" id="user-address"
                            name="address">
                            <p id="account-address"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="user-city">City
                                <span class="astk">*</span>
                            </label>
                            <input class="text-field" value="{{ Auth::user()->city }}" id="user-city"
                            name="city">
                            <p id="account-city"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="user-state">State
                                <span class="astk">*</span>
                            </label>
                            <input class="text-field" value="{{ Auth::user()->state }}" id="user-state"
                            name="state">
                            <p id="account-state"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="user-country">Country
                                <span class="astk">*</span>
                            </label>
                            <select name="country" id="user-country" class="text-field">
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country['country_name'] }}" 
                                     @if ($country['country_name']== Auth::user()->country)
                                    selected
                                    @endif>{{ $country['country_name'] }}</option>
                                @endforeach
                            </select>
                            <p id="account-country"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="user-pincode">Pincode
                                <span class="astk">*</span>
                            </label>
                            <input class="text-field" value="{{ Auth::user()->pincode }}" id="user-pincode"
                            name="pincode">
                            <p id="account-pincode"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="user-mobile">Mobile
                                <span class="astk">*</span>
                            </label>
                            <input class="text-field" value="{{ Auth::user()->mobile }}" id="user-mobile"
                            name="mobile">
                            <p id="account-mobile"></p>
                        </div>
                        <div class="pb-5">
                            <button class="btn btn-default">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- update contaact details /- -->
          
        </div>
    </div>
</div>
<!-- Account-Page /- -->
@endsection