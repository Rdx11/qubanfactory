<?php

namespace App\BusinessLayer;

use App\DTO\ProductCategoriesDTO;
use App\DTO\DatatableDTO;
use App\Models\ProductCategories;
use App\PresentationLayer\ResponseCreatorPresentationLayer;
use Illuminate\Contracts\Encryption\DecryptException;
use Validator, DB, JWTAuth, Carbon\Carbon, File;

class ProductCategoriesBusinessLayer extends GenericBusinessLayer
{
    public function getProductCategories(ProductCategoriesDTO $params)
    {
        try{
            $encryptedId = $params->getIdProductCategory();
            $decryptedId = decrypt($encryptedId);

            $data = ProductCategories::find($decryptedId);

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

    public function getProductCategoriess()
    {
        $data = ProductCategories::all();

        $response = new ResponseCreatorPresentationLayer(200,'Data tersedia!',$data);

        return $response->getResponse();
    }

    public function actionSave(ProductCategoriesDTO $params)
    {
        try{
            $encryptedId = $params->getIdProductCategory();
            $decryptedId = decrypt($encryptedId); 

            $name = $params->getName();                   

            $data = [
              'name' => $name,
            ];   

            // if(!is_null($params->getIcon())) {
            //     if ($params->getIcon()) {
            //         $checkedParams = [
            //         'file' => $params->getIcon()
            //         ];
            //         $rules = [
            //             'file' => 'mimes:jpeg,bmp,png,gif,jpg|max:5000',
            //         ];
            //         $validator = Validator::make($checkedParams, $rules);
            //         if ($validator->fails()) {
            //             DB::rollback();
            //             $error = $validator->errors()->first();
            //             $response = new ResponseCreatorPresentationLayer(401, $error, null);
            //             return $response->getResponse();
            //         } else {
            //             if (!file_exists('app/product-categories/')) {
            //                 File::makeDirectory('app/product-categories', 0755, true);
            //             }
                        
            //             $destinationPath = 'app/product-categories/';
            //             $fileName = date('YmdHis') . '_' . $params->getIcon()->getClientOriginalName();
            //             $fileName = str_replace(' ', '_', $fileName);
            //             $params->getIcon()->move($destinationPath, $fileName);
            //         }
            //         $data['icon'] = config('config.app_url').'app/product-categories/'.$fileName;
            //     }else{
            //         DB::rollback();
            //         $response = new ResponseCreatorPresentationLayer(400, 'Silakan mengupload user/photo', null);
            //         return $response->getResponse();
            //     }
            //  }

            $rules = $this->rules();            
            $rulesUpdate = $this->rulesUpdate();  
            if(is_null($decryptedId)){  
                $validator = Validator::make($data,$rules);   
                if ($validator->fails()) {
                    $error = $validator->errors()->first();
                    $response = new ResponseCreatorPresentationLayer(404, $error, null);
                    return $response->getResponse();    
                }
                ProductCategories::create($data);
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

                    ProductCategories::find($decryptedId)->update($data);
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

    public function actionDelete(ProductCategoriesDTO $params)
    {
        try{
             try {
                $id = decrypt($params->getIdProductCategory());
            } catch (DecryptException $e) {
                $id = 0;
            }

            $data = ProductCategories::find($id);
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
            $data = new ProductCategories();
            $response = new ResponseCreatorPresentationLayer(200, 'Data berhasil dibuat', $data);
        }catch (\Exception $e){
            $data = null;
            $response = new ResponseCreatorPresentationLayer(500, 'Terjadi kesalahan pada server', $data);
        }

        return $response->getResponse();
    }

    private function validate($id,$uniqueField)
    {
          $checkProductCategories = ProductCategories::where('id_product_category','<>',$id)->where('name','=',$uniqueField);
          if ($checkProductCategories->count() > 0) {
              $response = new ResponseCreatorPresentationLayer(500, 'Data has been already taken', null);          
          }else{
              $response = new ResponseCreatorPresentationLayer(200, 'Data tersedia!', null);
          }
          return $response->getResponse();
    }

    private function rules()
    {
        $rules = [
            'name' => 'required|unique:product_categories',
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
                2 => 'opsi'
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

            $numberOfRows = ProductCategories::count();

            $totalFiltered = $numberOfRows;
    
            if(empty($search)){
                $productCategoriesData = ProductCategories::offset($start)
                                                ->limit($limit)
                                                ->orderBy($order, $dir)
                                                ->get();
            }else{
                $productCategoriesData =  ProductCategories::whereRaw("lower(name) LIKE '%".strtolower($search)."%' ")
                                                ->offset($start)
                                                ->limit($limit)
                                                ->orderBy($order,$dir)
                                                ->get();


                $totalFiltered =  ProductCategories::whereRaw("lower(name) LIKE '%".strtolower($search)."%' ")
                                                 ->count();
            }

            $data = [];
            if(count($productCategoriesData) > 0){
                foreach($productCategoriesData as $num => $productCategories){
                    $currentData = [];
                    $currentData['no'] = $num+1;
                    $currentData['name'] = $productCategories->name;                    
                    $currentData['opsi'] = "
                    <a onclick=loadModal(this) data='id=".encrypt($productCategories->id_product_category)."'  target='/product-categories/form' class='btn btn-warning mr-1 mb-1'><i class='fa fa-edit'></i> Edit</a>

                    <a onclick=deleteData('".encrypt($productCategories->id_product_category)."') class='btn btn-danger mr-1 mb-1'><i class='fa fa-trash'></i> Hapus</a>";

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

                $productCategoriesData =  ProductCategories::where('id', $dataId)
                                                ->where('name', 'LIKE',"%{$search}%")
                                                ->offset($start)
                                                ->limit($limit)
                                                ->orderBy($order,$dir)
                                                ->get();

               foreach($productCategoriesData as $num => $productCategories){
                    $currentData = [];
                    $currentData['id'] = $productCategories->id;                    
                    $currentData['name'] = $productCategories->name;                    
                  
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

     public function getOptions(ProductCategoriesDTO $params){
        try{
            $key = $params->getName();
            
            $data = ProductCategories::whereRaw("lower(name) LIKE '%".strtolower($key)."%' ")
                            ->get();
            $response = new ResponseCreatorPresentationLayer(200, 'Data tersedia!', $data);
        }catch(\Exception $e){
            $response = new ResponseCreatorPresentationLayer(500, 'Terjadi kesalahan pada server', null);
        }

        return $response->getResponse();
    }

}
