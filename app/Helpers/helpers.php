<?php

	use App\Models\Cart;

	function getUserCart()
    {
    	if (Session::exists('activeUser')) {
            $user = Session::get('activeUser');

            $data = Cart::where('id_user', $user->id_user)->get();
            
            if ($data->isEmpty()) {
            	$data = [];
            	return $data;
            }else{
            	return $data;
            }
        }else{

        	//get guest session
            // $request->Session::put('idProduct', $idProduct);
            // $request->Session::put('quantityProduct', $quantity);
            // $request->Session::put('image', $image);
            return $data = [];
			
            // return redirect()->back()->with('success', 'Berhasil Menambahkan Produk Ke Keranjang!');   
        }
    }