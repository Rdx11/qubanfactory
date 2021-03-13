<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DTO\ProductDTO;
use App\DTO\DatatableDTO;
use App\DTO\ProductCategoriesDTO;
use App\BusinessLayer\ProductBusinessLayer;
use App\BusinessLayer\ProductCategoriesBusinessLayer;

class ProductController extends Controller
{
    private $productBusinessLayer;
    private $productCategoriesBusinessLayer;

    public function __construct()
    {
        $this->productBusinessLayer = new ProductBusinessLayer();
        $this->productCategoriesBusinessLayer = new ProductCategoriesBusinessLayer();
    }

    public function index()
    {   
        $params = [
            'title' => 'Product ',
        ];

        return view('admin.product.index', $params);
    }

    public function form(Request $request)
    {
        $id = $request->input('id');
        if(is_null($id)){
            $result = $this->productBusinessLayer->actionCreateNewInstance();
            $title = "Tambah Product ";
            $resultProductCategoriesOption = null;
        }else{
            $params = new ProductDTO();
            $params->setIdProduct($id);

            $result = $this->productBusinessLayer->getProduct($params);

            $productCategoriesParams = new ProductCategoriesDTO();
            $productCategoriesParams->setIdProductCategory(encrypt($result['data']->id_product_category));
            $resultProductCategoriesOption =  $this->productCategoriesBusinessLayer->getProductCategories($productCategoriesParams);

            $resultProductCategoriesOption = $resultProductCategoriesOption['data'];

            $title = "Ubah Product ";
        }

        $params = [
            'title' => $title,
            'data' => $result['data'],
            'categoryOption' => $resultProductCategoriesOption,
        ];

        return view('admin.product.form', $params);
    }


    public function save(Request $request)
    {
        $id = $request->input('id');
        $idProductCategory = $request->input('id_product_category');
        $name = $request->input('name');     
        $image = $request->file('image');     
        $weight = $request->input('weight');     
        $price = $request->input('price');     
        $stock = $request->input('stock');     

        $params = new ProductDTO();
        $params->setIdProduct($id);
        $params->setIdProductCategory($idProductCategory);
        $params->setName($name);
        $params->setImage($image);
        $params->setWeight($weight);
        $params->setPrice($price);
        $params->setStock($stock);

        $result = $this->productBusinessLayer->actionSave($params);
        
        if($result['code'] == 200){
            return '
                 <script>
                     toastr.success("'.$result['message'].'", "Berhasil!", 
                        { 
                            "showMethod": "fadeIn", 
                            "hideMethod": "fadeOut", 
                            timeOut: 2000, 
                            positionClass: "toast-bottom-right", 
                            containerId: "toast-bottom-right"
                         }
                     );
                     reload(1000);
                     $("#modal-target .close").click();
                </script>'; 
        }else{
             return '
             <script>
                 toastr.error("'.$result['message'].'", "Error !", 
                    { 
                        "showMethod": "fadeIn", 
                        "hideMethod": "fadeOut", 
                        timeOut: 2000, 
                        positionClass: "toast-bottom-right", 
                        containerId: "toast-bottom-right"
                     }
                 );
            </script>'; 
        }
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $params = new ProductDTO();
        $params->setIdProduct($id);
        $result = $this->productBusinessLayer->actionDelete($params);

        if($result['code'] == 200){
            return '
                 <script>
                     toastr.success("'.$result['message'].'", "Berhasil!", 
                        { 
                            "showMethod": "fadeIn", 
                            "hideMethod": "fadeOut", 
                            timeOut: 2000, 
                            positionClass: "toast-bottom-right", 
                            containerId: "toast-bottom-right"
                         }
                     );
                     reload(1000);
                     $("#modal-target .close").click();
                </script>'; 
        }else{
             return '
             <script>
                 toastr.error("'.$result['message'].'", "Error !", 
                    { 
                        "showMethod": "fadeIn", 
                        "hideMethod": "fadeOut", 
                        timeOut: 2000, 
                        positionClass: "toast-bottom-right", 
                        containerId: "toast-bottom-right"
                     }
                 );
            </script>'; 
        }
    }

    public function dataTable(Request $request)
    {
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $request->input('order.0.column');
        $dir = $request->input('order.0.dir');
        $search=$request->input('search.value');
        $draw =$request->input('draw');

        $params = new DatatableDTO();
        $params->setLimit($limit);
        $params->setStart($start);
        $params->setOrder($order);
        $params->setDir($dir);
        $params->setSearch($search);
        $params->setDraw($draw);

        $result = $this->productBusinessLayer->actionDatatable($params);

        return json_encode($result['data']);
    }

    public function getOption(Request $request)
    {
        $key = $request->get('key');

        $params = new ProductDTO();
        $params->setName($key);

        $result = $this->productBusinessLayer->getOptions($params);

        if($result['code'] == 200){
            $productOptions = [];
            foreach($result['data'] as $num => $item){
                $productOptions[] = [
                    'id' => encrypt($item->id_Product),
                    'text' => $item->product_name
                ];
            }

        }else{
            $productOptions = [];
        }

        if(count($productOptions) == 0){
            $productOptions[] = [
                'id' => encrypt("0"),
                'text' => 'Data not found'
            ];
        }

        return response()->json($productOptions);
    }

   
}