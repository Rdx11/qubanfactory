@extends('layout.shop.main')
@section('title', $title)
@section('content')
<!-- breadcrumb-section start -->
<nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title text-center">
          <h2 class="title pb-4 text-dark text-capitalize">login & register</h2>
        </div>
      </div>
      <div class="col-12">
        <ol
          class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center"
        >
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">
            Log in to your account
          </li>
        </ol>
      </div>
    </div>
  </div>
</nav>
<!-- breadcrumb-section end -->

<!-- login area start -->
<div class="login-register-area pt-80 pb-80 bg-lighten3">
  <div class="container">
    <div class="row">
      <div class="col-lg-7 col-md-12 ml-auto mr-auto">
        <div class="login-register-wrapper">
          <div class="login-register-tab-list nav">
            <a class="active" data-toggle="tab" href="#lg1">
              <h4>login</h4>
            </a>
            <a data-toggle="tab" href="#lg2">
              <h4>register</h4>
            </a>
          </div>
          <div class="tab-content">
            <div id="lg1" class="tab-pane active">
              <div class="login-form-container">
                <div class="login-register-form">
                  <form action="{{ route('validate-login')}}" method="post">
                    <input
                      type="email"
                      name="email"
                      placeholder="Email"
                    />
                    <input
                      type="password"
                      name="password"
                      placeholder="Password"
                    />
                   <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                    <div class="button-box">
                      <div class="login-toggle-btn">
                        <a href="#">Forgot Password?</a>
                      </div>
                      <button type="submit" class="btn btn-dark btn--md">
                        <span>Login</span>
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div id="lg2" class="tab-pane">
              <div class="login-form-container">
                <div class="login-register-form">
                  <form action="{{ route('register')}}" method="post">
                    <input
                      type="text"
                      name="name"
                      placeholder="Nama"
                    />
                    <input
                      type="email"
                      name="email"
                      placeholder="Email"
                    />
                    <input
                      type="number"
                      name="phone_number"
                      placeholder="Nomor Telefon"
                    />
                    <input
                      type="password"
                      name="password"
                      placeholder="Password"
                  />
                   <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                    <div class="button-box">
                      <button type="submit" class="btn btn-dark btn--md">
                        <span>Register</span>
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- login area end -->
@endsection
@section('scripts')

@endsection