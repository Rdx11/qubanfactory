
<div id="offcanvas-mobile-menu" class="offcanvas theme1 offcanvas-mobile-menu">
  <div class="inner">
    <div class="border-bottom mb-4 pb-4 text-right">
      <button class="offcanvas-close">×</button>
    </div>
    <div class="offcanvas-head mb-4">
      <nav class="offcanvas-top-nav">
        <ul class="d-flex flex-wrap">
          <li class="my-2 mx-2">
            <a href="wishlist.html">
              <i class="icon-bag"></i> Wishlist <span>(0)</span></a
            >
          </li>
          <li class="my-2 mx-2">
            <a class="search search-toggle" href="javascript:void(0)">
              <i class="icon-magnifier"></i> Search</a
            >
          </li>
        </ul>
      </nav>
    </div>
    <nav class="offcanvas-menu">
      <ul>
        <li>
          <a href="{{ url('/')}}"><span class="menu-text">Beranda</span></a>
        </li>
         <li>
          <a href="#"><span class="menu-text">Produk</span></a>
          <ul class="offcanvas-submenu">
            <li><a href="about-us.html">Sapi</a></li>
            <li><a href="cart.html">Kambing</a></li>
            <li><a href="checkout.html">Unta</a></li>
          </ul>
        </li>
        <li>
          <a href="#"><span class="menu-text">Halaman</span></a>
          <ul class="offcanvas-submenu">
            <li><a href="about-us.html">About Page</a></li>
            <li><a href="cart.html">Cart Page</a></li>
            <li><a href="checkout.html">Checkout Page</a></li>
            <li><a href="compare.html">Compare Page</a></li>
            <li><a href="login.html">Login &amp; Register Page</a></li>
            <li><a href="myaccount.html">Account Page</a></li>
            <li><a href="wishlist.html">Wishlist Page</a></li>
          </ul>
        </li>
        <li><a href="contact.html">Kontak Kami</a></li>
      </ul>
    </nav>
    <div class="offcanvas-social py-30">
      <ul>
        <li>
          <a href="#"><i class="icon-social-facebook"></i></a>
        </li>
        <li>
          <a href="#"><i class="icon-social-twitter"></i></a>
        </li>
        <li>
          <a href="#"><i class="icon-social-instagram"></i></a>
        </li>
        <li>
          <a href="#"><i class="icon-social-google"></i></a>
        </li>
        <li>
          <a href="#"><i class="icon-social-instagram"></i></a>
        </li>
      </ul>
    </div>
  </div>
</div>
<!-- OffCanvas Cart Start -->
<div id="offcanvas-cart" class="offcanvas offcanvas-cart theme1">
  <div class="inner">
    <div class="head d-flex flex-wrap justify-content-between">
      <span class="title">Cart</span>
      <button class="offcanvas-close">×</button>
    </div>
    <ul class="minicart-product-list">
     @php
        $carts = getUserCart();
        $subTotal = 0;
        $countProduct = 0;
     @endphp

     @foreach($carts as $cart)
      <li>
        <a href="single-product.html" class="image"
          ><img src="{{ asset($cart->getProduct->image)}}" alt="Cart product Image"
        /></a>
        <div class="content">
          <a href="single-product.html" class="title"> {{ $cart->getProduct->name }} </a>
          <span class="quantity-price"
            >{{ $cart->quantity }} x <span class="amount">Rp. {{ $cart->getProduct->price }}</span></span
          >
          @php
             $subTotalProduct = $cart->quantity * $cart->getProduct->price;
             $subTotal += $subTotalProduct;
             $countProduct += 1;
          @endphp
          <a href="#" class="remove">×</a>
        </div>
      </li>
      @endforeach
    </ul>
    <div class="sub-total d-flex flex-wrap justify-content-between">
      <strong>Subtotal :</strong>
      <span class="amount">{{ $subTotal }}</span>
    </div>
    <a
      href="{{ route('cart')}}"
      class="btn btn-primary btn--lg d-block d-sm-inline-block mr-sm-2">view cart</a
    >
    <a
      href="checkout.html"
      class="btn btn-dark btn--lg d-block d-sm-inline-block mt-4 mt-sm-0"
      >checkout</a
    >
    <p class="minicart-message">Free Shipping on All Orders Over $100!</p>
  </div>
</div>

 <header>
    <!-- header top end -->
    <!-- header-middle satrt -->
    <div id="sticky" class="header-middle theme1 py-15 py-lg-0">
      <div class="container position-relative">
        <div class="row align-items-center">
          <div class="col-6 col-lg-3">
            <div class="logo">
              <a href="{{ url('/')}}">
                <img src="{{ asset('shop/assets/img/logo/logo-qf.png')}}" alt="logo"
              /></a>
            </div>
          </div>
          <div class="col-lg-6 d-none d-lg-block">
            <ul class="main-menu d-flex justify-content-center">
              <li class="active ml-0">
                <a href="{{ url('/')}}" class="pl-0"
                  >Beranda</a>
              </li>
             <li>
                <a href="#">Produk <i class="ion-ios-arrow-down"></i></a>
                <ul class="sub-menu">
                  <li><a href="about-us.html">Sapi</a></li>
                  <li><a href="cart.html">Kambing</a></li>
                  <li><a href="checkout.html">Unta</a></li>
                </ul>
              </li>
              <li>
                <a href="#">Halaman <i class="ion-ios-arrow-down"></i></a>
                <ul class="sub-menu">
                  <li><a href="about-us.html">About Page</a></li>
                  <li><a href="cart.html">Cart Page</a></li>
                  <li><a href="checkout.html">Checkout Page</a></li>
                  <li><a href="compare.html">Compare Page</a></li>
                  <li><a href="login.html">Login &amp; Register Page</a></li>
                  <li><a href="myaccount.html">Account Page</a></li>
                  <li><a href="wishlist.html">Wishlist Page</a></li>
                </ul>
              </li>
              <li><a href="contact.html">Kontak Kami</a></li>
            </ul>
          </div>
          <div class="col-6 col-lg-3">
            <!-- search-form end -->
            <div class="d-flex align-items-center justify-content-end">
              <!-- static-media end -->
              <div class="cart-block-links theme1 d-none d-sm-block">
                <ul class="d-flex">
                  <li>
                    <a href="javascript:void(0)" class="search search-toggle">
                      <i class="icon-magnifier"></i>
                    </a>
                  </li>
                  <li>
                    @if(Session::get('activeUser'))
                    <a class="" href="{{ route('dashboard-user')}}">
                        <i class="icon-user"></i> {{Session::get('activeUser')->name}}
                    </a>
                    @else
                    <a class="" href="{{ url('login')}}">
                      <span class="position-relative">
                        <i class="icon-user"></i>
                      </span>
                    </a>
                    @endif
                  </li>
                  <li class="mr-xl-0 cart-block position-relative">
                    <a class="offcanvas-toggle" href="#offcanvas-cart">
                      <span class="position-relative">
                        <i class="icon-bag"></i>
                        <span class="badge cbdg1">{{ $countProduct }}</span>
                      </span>
                    </a>
                  </li>
                  <!-- cart block end -->
                </ul>
              </div>
              <div class="mobile-menu-toggle theme1 d-lg-none">
                <a href="#offcanvas-mobile-menu" class="offcanvas-toggle">
                  <svg viewbox="0 0 700 550">
                    <path
                      d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200"
                      id="top"
                    ></path>
                    <path d="M300,320 L540,320" id="middle"></path>
                    <path
                      d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190"
                      id="bottom"
                      transform="translate(480, 320) scale(1, -1) translate(-480, -318)"
                    ></path>
                  </svg>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- header-middle end -->
  </header>