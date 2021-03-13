@extends('layout.shop.main')
@section('title', $title)
@section('content')
<!-- main slider start -->
<section class="bg-light">
  <div class="main-slider dots-style theme1">
    <div class="slider-item bg-img bg-img1">
      <div class="container">
        <div class="row align-items-center slider-height">
          <div class="col-12">
            <div class="slider-content">
              <p
                class="text animated"
                data-animation-in="fadeInLeft"
                data-delay-in=".300"
              >
                Tagline here
              </p>

              <h2 class="title">
                <span
                  class="animated font-weight-bold"
                  data-animation-in="fadeInUp"
                  data-delay-in=".800" style="color: #fff !important"
                  >Qurban Factory</span
                >
              </h2>
              <a
                href="shop-grid-4-column.html"
                class="btn btn-outline-primary btn--lg animated mt-45 mt-sm-25"
                data-animation-in="fadeInLeft"
                data-delay-in="1.9" style="color: #fff !important; border-color: #fff !important"
                >Shop now</a
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- main slider end -->

<!-- common banner  start -->
<div class="common-banner bg-white pb-30 pt-80">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-6 mb-30">
        <div class="banner-thumb">
          <a
            class="zoom-in d-block overflow-hidden position-relative"
            href="shop-grid-4-column.html"
            ><img src="https://htmldemo.hasthemes.com/looki/looki/assets/img/banner/5.jpg" alt="banner-thumb-naile"
          /></a>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-30">
        <div class="banner-thumb">
          <a
            class="zoom-in d-block overflow-hidden position-relative"
            href="shop-grid-4-column.html"
          >
            <img src="https://htmldemo.hasthemes.com/looki/looki/assets/img/banner/6.jpg" alt="banner-thumb-naile"
          /></a>
        </div>
      </div>
      <div class="col-lg-6 col-md-12 mb-30">
        <div class="banner-thumb">
          <a
            class="zoom-in d-block overflow-hidden position-relative"
            href="shop-grid-4-column.html"
          >
            <img src="https://htmldemo.hasthemes.com/looki/looki/assets/img/banner/4.jpg" alt="banner-thumb-naile"
          /></a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- product tab start -->
<section class="product-tab bg-white pt-30 pb-40">
  <div class="container">
    <!-- product-tab-nav end -->
    <div class="row">
      <div class="col-12">
        <div class="tab-content" id="pills-tabContent">
          <!-- first tab-pane -->
          <div
            class="tab-pane fade show active"
            id="pills-home"
            role="tabpanel"
            aria-labelledby="pills-home-tab"
          >
            <div class="product-slider-init theme1 slick-nav">
            @foreach($products as $product)
              <div class="slider-item">
                <div class="card product-card">
                  <div class="card-body p-0">
                    <div class="media flex-column">
                      <div class="product-thumbnail position-relative">
                        <span class="badge badge-danger top-right">New</span>
                        <a href="{{ url('')}}/detail/{{$product->name}}">
                          <img
                            class="first-img"
                            src="{{ $product->image }}"
                            alt="thumbnail"
                          />
                        </a>

                        <!-- product links -->
                        <ul class="actions d-flex justify-content-center">
                          <li>
                            <a
                              class="action"
                              href="#"
                              onclick='quickView({{$product->id_product}})'
                            >
                             
                              <span
                                data-toggle="tooltip"
                                data-placement="bottom"
                                title="Quick view"
                                class="icon-magnifier"
                              ></span>
                            </a>
                          </li>
                        </ul>
                        <!-- product links end-->
                      </div>
                      <div class="media-body">
                      <div class="product-desc">
                        <h3 class="title">
                          <a href="shop-grid-4-column.html">
                            {{$product->name}}</a
                          >
                        </h3>
                        <div
                          class="d-flex align-items-center justify-content-between"
                        >
                          <span class="product-price">{{$product->price}}</span>
                          <button
                            class="pro-btn"
                            data-toggle="modal"
                            data-target="#add-to-cart"
                          >
                            <i class="icon-basket"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
             @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- product tab end -->
<!-- brand slider start -->
<div class="brand-slider-section theme1 bg-white pb-80">
  <div class="container">
     <div class="product-tab-nav mb-10">
      <div class="row align-items-center">
        <div class="col-12">
          <div class="section-title text-center">
            <h2 class="title pb-3 mb-3">Berqurban Digerai Mitra Qurban</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="brand-init slick-nav-brand">
          <div class="slider-item">
            <div class="single-brand">
              <a
                href="https://tokopedia.com"
                class="brand-thumb"
              >
                <img src="https://globalqurban.com/img/logomitra/tokopedia.png" alt="brand-thumb-nail" />
              </a>
            </div>
          </div>
          <!-- slider-item end -->
          <div class="slider-item">
            <div class="single-brand">
              <a
                href="https://shopee.com"
                class="brand-thumb"
              >
                <img src="https://globalqurban.com/img/logomitra/shopee.png" alt="brand-thumb-nail" />
              </a>
            </div>
          </div>
          <!-- slider-item end -->
          <div class="slider-item">
            <div class="single-brand">
              <a
                href="https://lazada.com"
                class="brand-thumb"
              >
                <img src="https://globalqurban.com/img/logomitra/lazada.png" alt="brand-thumb-nail" />
              </a>
            </div>
          </div>
          <!-- slider-item end -->
          <div class="slider-item">
            <div class="single-brand">
              <a
                href="https://kitabisa.com"
                class="brand-thumb"
              >
                <img src="https://globalqurban.com/img/logomitra/kitabisa.png" alt="brand-thumb-nail" />
              </a>
            </div>
          </div>
          <!-- slider-item end -->
          <div class="slider-item">
            <div class="single-brand">
              <a
                href="https://google.com"
                class="brand-thumb"
              >
                <img src="https://globalqurban.com/img/logomitra/gs_global_sadaqah_logo.png" alt="brand-thumb-nail" />
              </a>
            </div>
          </div>
          <!-- slider-item end -->
          <div class="slider-item">
            <div class="single-brand">
              <a
                href="https://google.com"
                class="brand-thumb"
              >
                <img src="https://globalqurban.com/img/logomitra/bni_syariah.png" alt="brand-thumb-nail" />
              </a>
            </div>
          </div>
          <!-- slider-item end -->
          <div class="slider-item">
            <div class="single-brand">
              <a
                href="https://blibli.com"
                class="brand-thumb"
              >
                <img src="https://globalqurban.com/img/logomitra/blibli.png" alt="brand-thumb-nail" />
              </a>
            </div>
          </div>
          <!-- slider-item end -->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- brand slider end -->
@endsection
@section('scripts')
<script type="text/javascript">
    function formatRupiah(angka){
          var number_string = angka.toString(),
          sisa  = number_string.length % 3,
          rupiah  = number_string.substr(0, sisa),
          ribuan  = number_string.substr(sisa).match(/\d{3}/g);
              
          if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
          }

          return 'Rp. ' + rupiah ;
      }

    function quickView(id_product) {
        $.ajax({
            type:"GET",
            url:'{{url('')}}/product/'+id_product,
            success:function(response){
                var id_product = response['data'].id_product;
                var name = response['data'].name;
                var image = response['data'].image;
                var id_product_category = response['data'].id_product_category;
                var price = formatRupiah(response['data'].price, 'Rp.');
                var stock = response['data'].stock;
                var weight = response['data'].weight;

                $("#name-product1").text(name);
                $("#name-product").text(name);
                $("#price-product").text(price);
                $("#stock-product").text(stock);
                $("#weight-product").text(weight);
                $("#image-product").attr("src", image);

                $("#quick-view").modal("show");
            },
            error: function() {
                alert("No");
            }
       });
    }

    function addToCart(id_product, quantity, image) {
      $.ajax({
         url : url,
         type : 'post',
         data : {id},
         dataType: 'json',
         success : function (response) {
                doSomethingWith(response.company)
         }
      });
    }
</script>
@endsection

