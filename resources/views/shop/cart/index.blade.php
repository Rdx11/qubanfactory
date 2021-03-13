@extends('layout.shop.main')
@section('title', $title)
@section('content')
<!-- product tab start -->
 <!-- breadcrumb-section start -->
<nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title text-center">
          <h2 class="title pb-4 text-dark text-capitalize">cart</h2>
        </div>
      </div>
      <div class="col-12">
        <ol
          class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center"
        >
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">cart</li>
        </ol>
      </div>
    </div>
  </div>
</nav>
<!-- breadcrumb-section end -->
<section class="whish-list-section theme1 pt-80 pb-80 bg-lighten3">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h3 class="title mb-30 pb-25 text-capitalize">Your cart items</h3>
        <div class="table-responsive">
          <table class="table">
            <thead class="thead-light">
              <tr>
                <th class="text-center" scope="col">Product Image</th>
                <th class="text-center" scope="col">Product Name</th>
                <th class="text-center" scope="col">Stock Status</th>
                <th class="text-center" scope="col">Qty</th>
                <th class="text-center" scope="col">Price</th>
                <th class="text-center" scope="col">action</th>
              </tr>
            </thead>
            <tbody>
              @php
                $carts = getUserCart();
                $subTotal = 0;
                 $countProduct = 0;
              @endphp
              @foreach($carts as $cart)
              <tr>
                <th class="text-center" scope="row">
                  <img src="{{ asset($cart->getProduct->image)}}" alt="img" />
                </th>
                <td class="text-center">
                  <span class="whish-title" >{{ $cart->getProduct->name }}</span
                  >
                </td>
                <td class="text-center">
                  <span class="badge badge-danger position-static"
                    >In Stock</span
                  >
                </td>
                <td class="text-center">
                  <div class="product-count style">
                    <div class="count d-flex justify-content-center">
                      <input
                        type="number"
                        min="1"
                        max="10"
                        step="1"
                        value="{{ $cart->quantity }}"
                      />
                      <div class="button-group">
                        <button class="count-btn increment">
                          <i class="fas fa-chevron-up"></i>
                        </button>
                        <button class="count-btn decrement">
                          <i class="fas fa-chevron-down"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </td>
                <td class="text-center">
                  <span class="whish-list-price"> Rp. {{ $cart->getProduct->price }} </span>
                </td>
                @php
                   $subTotalProduct = $cart->quantity * $cart->getProduct->price;
                   $subTotal += $subTotalProduct;
                   $countProduct += 1;
                @endphp
                <td class="text-center">
                  <a href="#">
                    <span class="trash"><i class="fas fa-trash-alt"></i> </span
                  ></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- product tab end -->
<div class="check-out-section pb-80 bg-lighten3">
  <div class="container">
    <div class="row">
      <div class="col-lg-7">
        <div class="billing-info-wrap">
          <h3 class="title">Pilih Alamat</h3>
          <form class="personal-information" action="assets/php/contact.php">
            <div class="row">
              <div class="col-lg-6 col-md-6">
                <div class="billing-select mb-20px">
                  <select id="inputState" class="form-select mb-3">
                    <option>Pilih Alamat</option>
                    <option>Azerbaijan</option>
                    <option>Bahamas</option>
                    <option>Bahrain</option>
                    <option>Bangladesh</option>
                    <option>Barbados</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="billing-select mb-20px">
                  <a href="#" class="btn btn-primary check-out-btn">Tambah Alamat</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-lg-5 mt-4 mt-lg-0">
        <div class="your-order-area">
          <div class="your-order-wrap gray-bg-4">
            <div class="your-order-product-info">
              <div class="your-order-top">
                <ul>
                  <li>Product</li>
                  <li>Total</li>
                </ul>
              </div>
              <div class="your-order-total mb-0">
                <ul>
                  <li class="order-total">Total</li>
                  <li>{{ $subTotal }}</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="Place-order mt-25">
            <a class="btn btn--lg btn-primary my-2 my-sm-0" href="#"
              >checkout</a
            >
          </div>
        </div>
      </div>
    </div>
  </div>
</div>  
@endsection
@section('scripts')

@endsection