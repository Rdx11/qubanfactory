<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BusinessLayer\ProductBusinessLayer;
use App\DTO\ProductDTO;
use Alert;

class HomeController extends Controller
{
    private $productBusinessLayer;

    public function __construct()
    {
        $this->productBusinessLayer = new ProductBusinessLayer();
    }

    public function home(Request $request)
    {
        $dataProduct = $this->productBusinessLayer->getProductsHome();

        $params = [
            'title' => 'Home',
            'products' => $dataProduct['data'],
        ];

        return view('shop.home.index', $params);
    }


    public function detail($name)
    {
        $params = new ProductDTO();
        $params->setName($name);

        $dataProduct = $this->productBusinessLayer->getProductByName($params);

        $params = [
            'title' => 'Product',
            'product' => $dataProduct['data']
        ];
        
        return view('shop.product.index', $params);
    }

    public function getProduct($idProduct)
    {
        $params = new ProductDTO();
        $params->setIdProduct(encrypt($idProduct));

        $result = $this->productBusinessLayer->getProduct($params);
       
        return response()->json($result, $result['code']);
    }

  
}
