<?php

namespace App\Http\Controllers\Cart;

use Illuminate\Http\Request;
use App\BusinessLayer\CartBusinessLayer;
use App\Http\Controllers\Controller;
use App\DTO\CartDTO;
Use Alert;

class CartController extends Controller
{
    private $cartBusinessLayer;

    public function __construct()
    {
        $this->cartBusinessLayer = new CartBusinessLayer();
    }

    public function index(Request $request)
    {
        $params = [
            'title' => 'Cart',
        ];

        return view('shop.cart.index', $params);
    }

    public function addProductToCart(Request $request)
    {
        $idProduct = $request->input('id_product');
        $quantity = $request->input('quantity');
        $image = $request->input('image');

    	if ($request->session()->exists('activeUser')) {
            $user = $request->session()->get('activeUser');

            $params = new CartDTO();
            $params->setIdUser($user->id_user);
            $params->setIdProduct($idProduct);
            $params->setQuantity($quantity);

            $result = $this->cartBusinessLayer->actionSave($params);

            return redirect()->back()->with('success', 'Berhasil Menambahkan Produk Ke Keranjang!');   
        }else{
            $request->session()->put('idProduct', $idProduct);
            $request->session()->put('quantityProduct', $quantity);
            $request->session()->put('image', $image);
			
            return redirect()->back()->with('success', 'Berhasil Menambahkan Produk Ke Keranjang!');   
        }
    }


     public function detail(Request $request, $name)
    {
        $params = new CartDTO();
        $params->setName($name);

        $dataCart = $this->cartBusinessLayer->getCartByName($params);
        $params = [
            'title' => 'Product',
            'Cart' => $dataCart['data']
        ];

        
        return view('user.cart.index', $params);
    }
}
