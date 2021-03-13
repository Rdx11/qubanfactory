<?php

namespace App\BusinessLayer;

use App\DTO\ProductDTO;
use App\DTO\DatatableDTO;
use App\Models\Product;
use App\PresentationLayer\ResponseCreatorPresentationLayer;
use Illuminate\Contracts\Encryption\DecryptException;
use Validator, DB, JWTAuth, Carbon\Carbon, File;

class ProductBusinessLayer extends GenericBusinessLayer
{
    public function getProduct(ProductDTO $params)
    {
        try{
            $encryptedId = $params->getIdProduct();
            $decryptedId = decrypt($encryptedId);

            $data = Product::find($decryptedId);

            if ($data != null) {
                $response = new ResponseCreatorPresentationLayer(200, 'Data ditemukan!', $data);
            }else{
                $response = new ResponseCreatorPresentationLayer(500, 'data tidak ditemukan!', null);
            }
        }catch(\Exception $e){
            $response = new ResponseCreatorPresentationLayer(500, 'Terjadi kesalahan pada server', $e->getMessage());
        }

        return $response->getResponse();
    }

    public function getProducts()
    {
        $data = Product::all();

        $response = new ResponseCreatorPresentationLayer(200,'Data tersedia!',$data);

        return $response->getResponse();
    }

    public function getProductsHome()
    {
        $data = Product::take(3)->get();
        $response = new ResponseCreatorPresentationLayer(200,'Data tersedia!',$data);

        return $response->getResponse();
    }

    public function getProductByName(ProductDTO $params)
    {
        $name = $params->getName();
        $data = Product::where('name', $name)->first();

        $response = new ResponseCreatorPresentationLayer(200,'Data tersedia!',$data);

        return $response->getResponse();
    }

    public function actionSave(ProductDTO $params)
    {
        try{
            $encryptedId = $params->getIdProduct();
            $decryptedId = decrypt($encryptedId); 

            $encryptedIdProductCategory = $params->getIdProductCategory();
            $decryptedIdProductCategory = decrypt($encryptedIdProductCategory); 

            $name = $params->getName();                   
            $weight = $params->getWeight();                   
            $stock = $params->getStock();                   
            $price = $params->getPrice();                   

            $data = [
              'name' => $name,
              'weight' => $weight,
              'stock' => $stock,
              'price' => $price,
              'id_product_category' => $decryptedIdProductCategory,
            ];   

            if(!is_null($params->getImage())) {
                if ($params->getImage()) {
                    $checkedParams = [
                    'file' => $params->getImage()
                    ];
                    $rules = [
                        'file' => 'mimes:jpeg,bmp,png,gif,jpg|max:5000',
                    ];
                    $validator = Validator::make($checkedParams, $rules);
                    if ($validator->fails()) {
                        DB::rollback();
                        $error = $validator->errors()->first();
                        $response = new ResponseCreatorPresentationLayer(401, $error, null);
                        return $response->getResponse();
                    } else {
                        if (!file_exists('app/product/')) {
                            File::makeDirectory('app/product', 0755, true);
                        }
                        
                        $destinationPath = 'app/product/';
                        $fileName = date('YmdHis') . '_' . $params->getImage()->getClientOriginalName();
                        $fileName = str_replace(' ', '_', $fileName);
                        $params->getImage()->move($destinationPath, $fileName);
                    }
                    $data['image'] = config('config.app_url').'app/product/'.$fileName;
                }else{
                    DB::rollback();
                    $response = new ResponseCreatorPresentationLayer(400, 'Silakan mengupload user/photo', null);
                    return $response->getResponse();
                }
             }

            $rules = $this->rules();            
            $rulesUpdate = $this->rulesUpdate();  
            if(is_null($decryptedId)){  
                $validator = Validator::make($data,$rules);   
                if ($validator->fails()) {
                    $error = $validator->errors()->first();
                    $response = new ResponseCreatorPresentationLayer(404, $error, null);
                    return $response->getResponse();    
                }
                Product::create($data);
                $response = new ResponseCreatorPresentationLayer(200, 'Data berhasil disimpan!', null);
            }else{ 
                $id          = $decryptedId;
                $uniqueField = $name;
                $validate = $this->validate($id,$uniqueField);    
                if($validate['code'] == 200){  
                    $validator = Validator::make($data,$rulesUpdate);   
                    if ($validator->fails()) {
                        $error = $validator->errors()->first();
                        $response = new ResponseCreatorPresentationLayer(404, $error, null);
                        return $response->getResponse();    
                    }                  

                    Product::find($decryptedId)->update($data);
                    $response = new ResponseCreatorPresentationLayer(200, 'Data berhasil diperbarui!', null);  
                }
                else{
                    $response = new ResponseCreatorPresentationLayer(500, 'Data sudah tersedia!.', null);
                }        
            } 

        }catch (\Exception $e){
            $data = null;
            $response = new ResponseCreatorPresentationLayer(500, 'Terjadi kesalahan pada server'.$e->getMessage(), $data);
        }

        return $response->getResponse();
    }

    public function actionDelete(ProductDTO $params)
    {
        try{
             try {
                $id = decrypt($params->getIdProduct());
            } catch (DecryptException $e) {
                $id = 0;
            }

            $data = Product::find($id);
            if(is_null($data)){
                $response = new ResponseCreatorPresentationLayer(404, 'Data product categories tidak ditemukan', $data);
                return $response->getResponse();
            }

            $data->delete();
            $response = new ResponseCreatorPresentationLayer(200, 'Data berhasil dihapus', null);

        }catch(\Exception $e){
            $response = new ResponseCreatorPresentationLayer(500, 'Operation is not allowed! Data is in used by another entities ', null);
        }

        return $response->getResponse();
    }

    public function actionCreateNewInstance()
    {
        try{
            $data = new Product();
            $response = new ResponseCreatorPresentationLayer(200, 'Data berhasil dibuat', $data);
        }catch (\Exception $e){
            $data = null;
            $response = new ResponseCreatorPresentationLayer(500, 'Terjadi kesalahan pada server', $data);
        }

        return $response->getResponse();
    }

    private function validate($id,$uniqueField)
    {
          $checkProduct = Product::where('id_product','<>',$id)->where('name','=',$uniqueField);
          if ($checkProduct->count() > 0) {
              $response = new ResponseCreatorPresentationLayer(500, 'Data has been already taken', null);          
          }else{
              $response = new ResponseCreatorPresentationLayer(200, 'Data tersedia!', null);
          }
          return $response->getResponse();
    }

    private function rules()
    {
        $rules = [
            'name' => 'required|unique:product',
            'price' => 'required',                   
            'stock' => 'required',                   
        ];
        
        return $rules;
    }

    private function rulesUpdate()
    {
        $rules = [
            'name' => 'required',                   
        ];
        
        return $rules;
    }

    public function actionDatatable(DatatableDTO $params)
    {
        try{
            $columDescriptions = [
                0 => 'no',
                1 => 'name',            
                2 => 'weight',            
                3 => 'price',            
                4 => 'stock',            
                5 => 'image',            
                6 => 'opsi'
            ];
    
            $limit = $params->getLimit();            
            $start = $params->getStart();            
            $order = $columDescriptions[$params->getOrder()];
            $dir = $params->getDir();
            $search=$params->getSearch();
            $draw=$params->getDraw();

            if ($params->getFrom() != null) {
                $getFrom = $params->getFrom();
                $from = decrypt($getFrom);
            }

            $numberOfRows = Product::count();

            $totalFiltered = $numberOfRows;
    
            if(empty($search)){
                $productData = Product::offset($start)
                                                ->limit($limit)
                                                ->orderBy($order, $dir)
                                                ->get();
            }else{
                $productData =  Product::whereRaw("lower(name) LIKE '%".strtolower($search)."%' ")
                                                ->offset($start)
                                                ->limit($limit)
                                                ->orderBy($order,$dir)
                                                ->get();


                $totalFiltered =  Product::whereRaw("lower(name) LIKE '%".strtolower($search)."%' ")
                                                 ->count();
            }

            $data = [];
            if(count($productData) > 0){
                foreach($productData as $num => $product){
                    $currentData = [];
                    $currentData['no'] = $num+1;
                    $currentData['name'] = $product->name;     
                    $currentData['weight'] = $product->weight;     
                    $currentData['price'] = $product->price;     
                    $currentData['stock'] = $product->stock;     
                    $currentData['image'] = ($product->image) ? '<img class="round" src="'.asset($product->image).'" alt="'.$product->name.'" height="45" width="45">' : '-';                    
                    $currentData['opsi'] = "
                    <a onclick=loadModal(this) data='id=".encrypt($product->id_product)."'  target='/product/form' class='btn btn-warning mr-1 mb-1'><i class='fa fa-edit'></i> Edit</a>

                    <a onclick=deleteData('".encrypt($product->id_product)."') class='btn btn-danger mr-1 mb-1'><i class='fa fa-trash'></i> Hapus</a>";

                    $data[] = $currentData;
                }
            }

            $jsonData = [
                "draw"            => intval($draw),
                "recordsTotal"    => intval($numberOfRows),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $data
            ];

            $response = new ResponseCreatorPresentationLayer(200, 'Data ditemukan!', $jsonData);

        }catch(\Exception $e){
            $jsonData = [
                "draw"            => 0,
                "recordsTotal"    => 0,
                "recordsFiltered" => 0,
                "data"            => []
            ];

            $response = new ResponseCreatorPresentationLayer(200, 'Data ditemukan!', $e->getMessage());
        }

        return $response->getResponse();
    }

      public function getOption(DatatableDTO $params)
    {
        try{
            if($params->getIsForApi() == 1){
                $start = $params->getStart();            
                $limit = $params->getLimit();            
                $order = $params->getOrder();
                $search =$params->getSearch();
                $dir = $params->getDir();
                $dataId = $params->getData();

                $productData =  Product::where('id', $dataId)
                                                ->where('name', 'LIKE',"%{$search}%")
                                                ->offset($start)
                                                ->limit($limit)
                                                ->orderBy($order,$dir)
                                                ->get();

               foreach($productData as $num => $product){
                    $currentData = [];
                    $currentData['id'] = $product->id;                    
                    $currentData['name'] = $product->name;                    
                  
                    $data[] = $currentData;
                }
            }

            if ($data != null) {
                $response = new ResponseCreatorPresentationLayer(200, 'Data found', $data);
            }else{
                $response = new ResponseCreatorPresentationLayer(500, 'Data not found', null);
            }
        }catch(\Exception $e){
            $response = new ResponseCreatorPresentationLayer(500, 'There was an error on the server', $e->getMessage());
        }

        return $response->getResponse();
    }

     public function getOptions(ProductDTO $params){
        try{
            $key = $params->getName();
            
            $data = Product::whereRaw("lower(name) LIKE '%".strtolower($key)."%' ")
                            ->get();
            $response = new ResponseCreatorPresentationLayer(200, 'Data tersedia!', $data);
        }catch(\Exception $e){
            $response = new ResponseCreatorPresentationLayer(500, 'Terjadi kesalahan pada server', null);
        }

        return $response->getResponse();
    }

}
