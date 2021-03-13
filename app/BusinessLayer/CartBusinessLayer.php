<?php

namespace App\BusinessLayer;

use App\DTO\CartDTO;
use App\DTO\DatatableDTO;
use App\Models\Cart;
use App\PresentationLayer\ResponseCreatorPresentationLayer;
use Illuminate\Contracts\Encryption\DecryptException;
use Validator, DB, JWTAuth, Carbon\Carbon, File;

class CartBusinessLayer extends GenericBusinessLayer
{
    public function actionSave(CartDTO $params)
    {
        try{
            $idCart = $params->getIdCart();
            $idUser = $params->getIdUser();                   
            $quantity = $params->getQuantity();                   
            $idProduct = $params->getIdProduct();                   

            $data = [
              'id_user' => $idUser,
              'id_product' => $idProduct,
              'quantity' => $quantity,
            ];   

            if(is_null($idCart)){  
            	$validate = $this->validate($idUser, $idProduct);  

                if($validate['code'] == 200){  
	                Cart::create($data);
	                $response = new ResponseCreatorPresentationLayer(200, 'Data berhasil disimpan!', null);
                }else{
                	$data = $validate['data']->first();
	                Cart::find($data->id_cart)->update(['quantity' => $quantity]);
	                $response = new ResponseCreatorPresentationLayer(200, 'Data berhasil diperbarui!', null);
                }
            }

        }catch (\Exception $e){
            $data = null;
            $response = new ResponseCreatorPresentationLayer(500, 'Terjadi kesalahan pada server'.$e->getMessage(), $data);
        }

        return $response->getResponse();
    }

    private function validate($idUser,$idProduct)
    {
          $checkCart = Cart::where('id_user', $idUser)->where('id_product', $idProduct);
          if ($checkCart->count() > 0) {
              $response = new ResponseCreatorPresentationLayer(500, 'Data sudah tersedia', $checkCart);          
          }else{
              $response = new ResponseCreatorPresentationLayer(200, 'Data bisa direcord!', null);
          }
          return $response->getResponse();
    }


}
