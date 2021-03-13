<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="" />
    <title>{{ $title }} - Qurban Factory</title>
    <link rel="shortcut icon" href="{{ asset('admin/app-assets/images/ico/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('shop/assets/css/fontawesome.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('shop/assets/css/ionicons.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('shop/assets/css/simple-line-icons.css')}}" />
    <link rel="stylesheet" href="{{ asset('shop/assets/css/plugins/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{ asset('shop/assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('shop/assets/css/plugins/plugins.css')}}" />
    <link rel="stylesheet" href="{{ asset('shop/assets/css/style.css')}}" />
    @yield('style')
</head>
<body>
<div class="offcanvas-overlay"></div>
  @include('layout.shop.menu')
 
  @yield('content')

  @include('sweetalert::alert')
<!-- blog-section end -->
<!-- footer strat -->
<footer class="bg-light theme1 position-relative">
  <!-- footer bottom start -->
  <div class="footer-bottom pt-80 pb-30">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-6 col-lg-6 mb-30">
          <div class="footer-widget mx-w-400">
            <div class="footer-logo mb-25">
              <a href="{{ url('/')}}">
                <img src="{{ asset('shop/assets/img/logo/logo-qf.png')}}" alt="footer logo" />
              </a>
            </div>
            <p class="text mb-30">
              Qurban Factory menawarkan kemudahan dalam bertransaksi, kemudahan dalam memilih hewan Qurban, Insya Allah jaringan kebermanfaatan yang luas, dari pelosok Indonesia hingga internasional. <br><br>
              Kami selalu memastikan hewan qurban Sahabat, sampai kepada pihak yang benar-benar membutuhkan.
            </p>

            <div class="social-network">
              <ul class="d-flex">
                <li>
                  <a href="https://www.facebook.com/" target="_blank"
                    ><span class="icon-social-facebook"></span
                  ></a>
                </li>
                <li>
                  <a href="https://twitter.com/" target="_blank"
                    ><span class="icon-social-twitter"></span
                  ></a>
                </li>
                <li>
                  <a href="https://www.youtube.com/" target="_blank"
                    ><span class="icon-social-youtube"></span
                  ></a>
                </li>
                <li class="mr-0">
                  <a href="https://www.instagram.com/" target="_blank"
                    ><span class="icon-social-instagram"></span
                  ></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 mb-30">
          <div class="footer-widget">
            <div class="border-bottom cbb1 mb-25">
              <div class="section-title">
                <h2 class="title">Information</h2>
              </div>
            </div>
            <!-- footer-menu start -->
            <ul class="footer-menu">
              <li><a href="about-us.html">About us</a></li>
              <li><a href="#">payment</a></li>
              <li><a href="contact.html">Contact us</a></li>
              <li><a href="#">Stores</a></li>
            </ul>
            <!-- footer-menu end -->
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 mb-30">
          <div class="footer-widget">
            <div class="border-bottom cbb1 mb-25">
              <div class="section-title">
                <h2 class="title">social Links</h2>
              </div>
            </div>
            <!-- footer-menu start -->
            <ul class="footer-menu">
              <li><a href="#">New products</a></li>
              <li><a href="#">Best sales</a></li>
              <li><a href="login.html">Login</a></li>
              <li><a href="myaccount.html">My account</a></li>
            </ul>
            <!-- footer-menu end -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- footer bottom end -->
  <!-- coppy-right start -->
  <div class="coppy-right bg-dark py-15">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6 col-xl-4 order-last order-md-first">
          <div class="text-md-left text-center mt-3 mt-md-0">
            <p>
              &copy; 2021 - Qurban Factory 
            </p>
          </div>
        </div>
        <div class="col-12 col-md-6 col-xl-8">
          <div class="text-md-right text-center">
            <!-- <img src="assets/img/payment/1.png" alt="img" /> -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- coppy-right end -->
</footer>

    <div
      class="modal fade theme1 style1"
      id="quick-view"
      tabindex="-1"
      role="dialog"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-8 mx-auto col-lg-5 mb-5 mb-lg-0">
                <div class="product-sync-init mb-20">
                  <div class="single-product">
                    <div class="product-thumb">
                      <img
                        src="assets/img/slider/thumb/1.jpg"
                        alt="product-thumb"
                        id="image-product"
                      />
                    </div>
                  </div>
                  <!-- single-product end -->
                </div>
              </div>
              <div class="col-lg-7">
                <div class="modal-product-info">
                  <div class="product-head">
                    <h2 class="title" id="name-product">
                        Nama Product
                    </h2>
                    <h4 class="sub-title">Kategori</h4>
                  </div>
                  <div class="product-body">
                    <span class="product-price text-center">
                      <span class="new-price" id="price-product">Rp. ,-</span>
                    </span>
                    <ul>
                      <li>Nama : <span id="name-product1">Nama Produk</span></li>
                      <li>Stock: <span id="stock-product">0</span></li>
                      <li>Berat: <span id="weight-product">0kg</span></li>
                    </ul>
                  </div>
                  <div class="product-footer">
                    <div
                      class="product-count style d-flex flex-column flex-sm-row my-4"
                    >
                      <div class="count d-flex">
                        <input type="number" min="1" max="10" step="1" value="1" />
                        <div class="button-group">
                          <button class="count-btn increment">
                            <i class="fas fa-chevron-up"></i>
                          </button>
                          <button class="count-btn decrement">
                            <i class="fas fa-chevron-down"></i>
                          </button>
                        </div>
                      </div>
                      <div>
                        <button class="btn btn-dark btn--xl mt-5 mt-sm-0">
                          <span class="mr-2"><i class="ion-android-add"></i></span>
                          Add to cart
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- second modal -->
    <div class="modal fade style2" id="compare" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h5 class="title">
              <!-- <i class="fa fa-check"></i> Product added to compare. -->
            </h5>
          </div>
        </div>
      </div>
    </div>
    <!-- second modal -->
    <div class="modal fade style3" id="add-to-cart" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header justify-content-center bg-dark">
            <h5 class="modal-title" id="add-to-cartCenterTitle">
              Berhasil Menambahkan Product 
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-lg-12 justify-content-center">
                    <center>
                      <img src="http://qurbanfactory.test/app/product/20201217002838_HomeSapiNegeriC.png" alt="img" width="30%" id="image-price" />
                   </center>
                    <h4 class="product-name " id="name-product">
                      New Balance Running Arishi trainers in triple
                    </h4>
                    <h5 class="price" id="price-product">$29.00</h5>
                    <h6 class="quantity"><strong>Quantity:</strong>&nbsp;1</h6>
                    <div class="cart-content-btn">
                        <button
                          type="button"
                          class="btn btn-secondary btn--md mt-4"
                          data-dismiss="modal"
                        >
                          Lanjut Berbelanja
                        </button>
                        <button class="btn btn-dark btn--md mt-4">
                          Bayar Sekarang
                        </button>
                    </div>
                </div>
             </div>
           </div>
      </div>
      </div>
    </div>
    <!-- modals end -->
    <!-- search-box and overlay start -->
    <div class="overlay">
      <div class="scale"></div>
      <form class="search-box" action="#">
        <input type="text" name="search" placeholder="Search products..." />
        <button id="close" type="submit">
          <i class="ion-ios-search-strong"></i>
        </button>
      </form>
      <button class="close"><i class="ion-android-close"></i></button>
    </div>

    <script src="{{ asset('shop/assets/js/vendor/jquery-3.5.1.min.js')}}"></script>
    <script src="{{ asset('shop/assets/js/vendor/modernizr-3.7.1.min.js')}}"></script>
    <script src="{{ asset('shop/assets/js/popper.min.js')}}"></script>
    <script src="{{ asset('shop/assets/js/plugins/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('shop/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('shop/assets/js/plugins/plugins.js')}}"></script>
    <script src="{{ asset('shop/assets/js/plugins/ajax-contact.js')}}"></script>
    <script src="{{ asset('shop/assets/js/main.js')}}"></script>
    <script src="{{ asset('admin/app-assets/js/core/core.js') }}"></script>
    {{ csrf_field() }}
    @yield('scripts')
</body>

</html>