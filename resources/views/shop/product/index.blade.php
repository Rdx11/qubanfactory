@extends('layout.shop.main')
@section('title', $title)
@section('content')
	@if(!is_null($product))
	   <nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
	  <div class="container">
	    <div class="row">
	      <div class="col-12">
	        <div class="section-title text-center">
	          <h2 class="title pb-4 text-dark text-capitalize">
	             {{ $product->name }}
	          </h2>
	        </div>
	      </div>
	      <div class="col-12">
	        <ol
	          class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center"
	        >
	          <li class="breadcrumb-item"><a href="{{ url('/')}}">Beranda</a></li>
	          <li class="breadcrumb-item active" aria-current="page">
	            {{ $product->name }}
	          </li>
	        </ol>
	      </div>
	    </div>
	  </div>
	</nav>
	<!-- breadcrumb-section end -->
	<!-- product-single start -->
  <form action="{{ route('add-to-cart')}}" method="post">
	<section class="product-single theme1 pt-60 bg-lighten3">
	  <div class="container">
	    <div class="row">
	      <div class="col-lg-6 mb-5 mb-lg-0">
	        <div>
	          <div class="position-relative">
	            <span class="badge badge-danger top-right">New</span>
	          </div>
	          <div class="product-sync-init mb-20">
	            <div class="single-product">
	              <div class="product-thumb">
	                <img src="{{ asset($product->image) }}" alt="product-thumb" />
	              </div>
	            </div>
	          </div>
	        </div>
	 
	      </div>
	      <div class="col-lg-6">
	        <div class="single-product-info">
	          <div class="single-product-head">
	            <h2 class="title mb-20">{{ $product->name }}</h2>
	          </div>
	          <div class="product-body mb-40">
	            <div class="d-flex align-items-center mb-30">
	              	<span class="product-price mr-20">
	                	<span class="onsale">{{ $product->price }}</span>
	            	</span >
	            </div>
	          </div>
	          <div class="product-footer">
	            <div
	              class="product-count style d-flex flex-column flex-sm-row mt-30 mb-30"
	            >
	              <div class="count d-flex">
	                <input type="number" min="1" max="10" step="1" value="1" name="quantity" />
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
                   <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                   <input type='hidden' name='id_product' value='{{ $product->id_product }}'>

	                <button class="btn btn-dark btn--xl mt-5 mt-sm-0" type="submit">
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
	</section>
	</form>

	<!-- product-single end -->
	<!-- new arrival section start -->
	<section class="theme1 bg-white pb-80">
	  <div class="container">
	    <div class="row">
	      <div class="col-12">
	        <div class="section-title text-center">
	          <h2 class="title pb-3 mb-3">Produk Lainnya</h2>
	          <p class="text mt-10">Add Related products to weekly line up</p>
	        </div>
	      </div>
	      <div class="col-12">
	        <div class="product-slider-init theme1 slick-nav">
	          <div class="slider-item">
	            <div class="card product-card">
	              <div class="card-body p-0">
	                <div class="media flex-column">
	                  <div class="product-thumbnail position-relative">
	                    <span class="badge badge-danger top-right">New</span>
	                    <a href="single-product.html">
	                      <img
	                        class="first-img"
	                        src="assets/img/product/1.png"
	                        alt="thumbnail"
	                      />
	                    </a>
	                    <!-- product links -->
	                    <ul class="actions d-flex justify-content-center">
	                      <li>
	                        <a class="action" href="wishlist.html">
	                          <span
	                            data-toggle="tooltip"
	                            data-placement="bottom"
	                            title="add to wishlist"
	                            class="icon-heart"
	                          >
	                          </span>
	                        </a>
	                      </li>
	                      <li>
	                        <a
	                          class="action"
	                          href="#"
	                          data-toggle="modal"
	                          data-target="#compare"
	                        >
	                          <span
	                            data-toggle="tooltip"
	                            data-placement="bottom"
	                            title="Add to compare"
	                            class="icon-shuffle"
	                          ></span>
	                        </a>
	                      </li>
	                      <li>
	                        <a
	                          class="action"
	                          href="#"
	                          data-toggle="modal"
	                          data-target="#quick-view"
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
	                        <a href="shop-grid-4-column.html"
	                          >All Natural Makeup Beauty Cosmetics</a
	                        >
	                      </h3>
	                      <div class="star-rating">
	                        <span class="ion-ios-star"></span>
	                        <span class="ion-ios-star"></span>
	                        <span class="ion-ios-star"></span>
	                        <span class="ion-ios-star"></span>
	                        <span class="ion-ios-star de-selected"></span>
	                      </div>
	                      <div
	                        class="d-flex align-items-center justify-content-between"
	                      >
	                        <span class="product-price">$11.90</span>
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
	          <!-- slider-item end -->
	          <div class="slider-item">
	            <div class="card product-card">
	              <div class="card-body p-0">
	                <div class="media flex-column">
	                  <div class="product-thumbnail position-relative">
	                    <span class="badge badge-danger top-right">New</span>
	                    <a href="single-product.html">
	                      <img
	                        class="first-img"
	                        src="assets/img/product/2.png"
	                        alt="thumbnail"
	                      />
	                    </a>
	                    <!-- product links -->
	                    <ul class="actions d-flex justify-content-center">
	                      <li>
	                        <a class="action" href="wishlist.html">
	                          <span
	                            data-toggle="tooltip"
	                            data-placement="bottom"
	                            title="add to wishlist"
	                            class="icon-heart"
	                          >
	                          </span>
	                        </a>
	                      </li>
	                      <li>
	                        <a
	                          class="action"
	                          href="#"
	                          data-toggle="modal"
	                          data-target="#compare"
	                        >
	                          <span
	                            data-toggle="tooltip"
	                            data-placement="bottom"
	                            title="Add to compare"
	                            class="icon-shuffle"
	                          ></span>
	                        </a>
	                      </li>
	                      <li>
	                        <a
	                          class="action"
	                          href="#"
	                          data-toggle="modal"
	                          data-target="#quick-view"
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
	                        <a href="shop-grid-4-column.html"
	                          >On Trend Makeup and Beauty Cosmetics</a
	                        >
	                      </h3>
	                      <div class="star-rating">
	                        <span class="ion-ios-star"></span>
	                        <span class="ion-ios-star"></span>
	                        <span class="ion-ios-star"></span>
	                        <span class="ion-ios-star"></span>
	                        <span class="ion-ios-star de-selected"></span>
	                      </div>
	                      <div
	                        class="d-flex align-items-center justify-content-between"
	                      >
	                        <span class="product-price">$11.90</span>
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
	          <!-- slider-item end -->
	          <div class="slider-item">
	            <div class="card product-card">
	              <div class="card-body p-0">
	                <div class="media flex-column">
	                  <div class="product-thumbnail position-relative">
	                    <span class="badge badge-danger top-right">New</span>
	                    <a href="single-product.html">
	                      <img
	                        class="first-img"
	                        src="assets/img/product/3.png"
	                        alt="thumbnail"
	                      />
	                    </a>
	                    <!-- product links -->
	                    <ul class="actions d-flex justify-content-center">
	                      <li>
	                        <a class="action" href="wishlist.html">
	                          <span
	                            data-toggle="tooltip"
	                            data-placement="bottom"
	                            title="add to wishlist"
	                            class="icon-heart"
	                          >
	                          </span>
	                        </a>
	                      </li>
	                      <li>
	                        <a
	                          class="action"
	                          href="#"
	                          data-toggle="modal"
	                          data-target="#compare"
	                        >
	                          <span
	                            data-toggle="tooltip"
	                            data-placement="bottom"
	                            title="Add to compare"
	                            class="icon-shuffle"
	                          ></span>
	                        </a>
	                      </li>
	                      <li>
	                        <a
	                          class="action"
	                          href="#"
	                          data-toggle="modal"
	                          data-target="#quick-view"
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
	                        <a href="shop-grid-4-column.html"
	                          >The Cosmetics and Beauty brand Shoppe</a
	                        >
	                      </h3>
	                      <div class="star-rating">
	                        <span class="ion-ios-star"></span>
	                        <span class="ion-ios-star"></span>
	                        <span class="ion-ios-star"></span>
	                        <span class="ion-ios-star"></span>
	                        <span class="ion-ios-star de-selected"></span>
	                      </div>
	                      <div
	                        class="d-flex align-items-center justify-content-between"
	                      >
	                        <span class="product-price">$21.51</span>
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
	          <!-- slider-item end -->
	          <div class="slider-item">
	            <div class="card product-card">
	              <div class="card-body p-0">
	                <div class="media flex-column">
	                  <div class="product-thumbnail position-relative">
	                    <span class="badge badge-danger top-right">New</span>
	                    <a href="single-product.html">
	                      <img
	                        class="first-img"
	                        src="assets/img/product/4.png"
	                        alt="thumbnail"
	                      />
	                    </a>
	                    <!-- product links -->
	                    <ul class="actions d-flex justify-content-center">
	                      <li>
	                        <a class="action" href="wishlist.html">
	                          <span
	                            data-toggle="tooltip"
	                            data-placement="bottom"
	                            title="add to wishlist"
	                            class="icon-heart"
	                          >
	                          </span>
	                        </a>
	                      </li>
	                      <li>
	                        <a
	                          class="action"
	                          href="#"
	                          data-toggle="modal"
	                          data-target="#compare"
	                        >
	                          <span
	                            data-toggle="tooltip"
	                            data-placement="bottom"
	                            title="Add to compare"
	                            class="icon-shuffle"
	                          ></span>
	                        </a>
	                      </li>
	                      <li>
	                        <a
	                          class="action"
	                          href="#"
	                          data-toggle="modal"
	                          data-target="#quick-view"
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
	                        <a href="shop-grid-4-column.html"
	                          >orginal Age Defying Cosmetics Makeup</a
	                        >
	                      </h3>
	                      <div class="star-rating">
	                        <span class="ion-ios-star"></span>
	                        <span class="ion-ios-star"></span>
	                        <span class="ion-ios-star"></span>
	                        <span class="ion-ios-star"></span>
	                        <span class="ion-ios-star de-selected"></span>
	                      </div>
	                      <div
	                        class="d-flex align-items-center justify-content-between"
	                      >
	                        <span class="product-price">$11.90</span>
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
	          <!-- slider-item end -->
	          <div class="slider-item">
	            <div class="card product-card">
	              <div class="card-body p-0">
	                <div class="media flex-column">
	                  <div class="product-thumbnail position-relative">
	                    <span class="badge badge-danger top-right">New</span>
	                    <a href="single-product.html">
	                      <img
	                        class="first-img"
	                        src="assets/img/product/5.png"
	                        alt="thumbnail"
	                      />
	                      <img
	                        class="second-img"
	                        src="assets/img/product/6.png"
	                        alt="thumbnail"
	                      />
	                    </a>
	                    <!-- product links -->
	                    <ul class="actions d-flex justify-content-center">
	                      <li>
	                        <a class="action" href="wishlist.html">
	                          <span
	                            data-toggle="tooltip"
	                            data-placement="bottom"
	                            title="add to wishlist"
	                            class="icon-heart"
	                          >
	                          </span>
	                        </a>
	                      </li>
	                      <li>
	                        <a
	                          class="action"
	                          href="#"
	                          data-toggle="modal"
	                          data-target="#compare"
	                        >
	                          <span
	                            data-toggle="tooltip"
	                            data-placement="bottom"
	                            title="Add to compare"
	                            class="icon-shuffle"
	                          ></span>
	                        </a>
	                      </li>
	                      <li>
	                        <a
	                          class="action"
	                          href="#"
	                          data-toggle="modal"
	                          data-target="#quick-view"
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
	                        <a href="shop-grid-4-column.html"
	                          >orginal Clear Water Cosmetics On Trend</a
	                        >
	                      </h3>
	                      <div class="star-rating">
	                        <span class="ion-ios-star"></span>
	                        <span class="ion-ios-star"></span>
	                        <span class="ion-ios-star"></span>
	                        <span class="ion-ios-star"></span>
	                        <span class="ion-ios-star de-selected"></span>
	                      </div>
	                      <div
	                        class="d-flex align-items-center justify-content-between"
	                      >
	                        <span class="product-price">$11.90</span>
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
	          <!-- slider-item end -->
	        </div>
	      </div>
	    </div>
	  </div>
	</section>
	<!-- new arrival section end -->
	@else

	@endif
@endsection
@section('scripts')
	
@endsection

