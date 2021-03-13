<?php

namespace App\Http\Controllers\ProductCategories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DTO\ProductCategoriesDTO;
use App\DTO\DatatableDTO;
use App\BusinessLayer\ProductCategoriesBusinessLayer;

class ProductCategoriesController extends Controller
{
    private $productCategoriesBusinessLayer;

    public function __construct()
    {
        $this->productCategoriesBusinessLayer = new ProductCategoriesBusinessLayer();
    }

    public function index()
    {   
        $params = [
            'title' => 'Product Categories',
        ];

        return view('admin.product-categories.index', $params);
    }

    public function form(Request $request)
    {
        $id = $request->input('id');
        if(is_null($id)){
            $result = $this->productCategoriesBusinessLayer->actionCreateNewInstance();
            $title = "Tambah Product Categories";
        }else{
            $params = new ProductCategoriesDTO();
            $params->setIdProductCategory($id);

            $result = $this->productCategoriesBusinessLayer->getProductCategories($params);
            $title = "Ubah Product Categories";
        }

        $params = [
            'title' => $title,
            'data' => $result['data'],
        ];

        return view('admin.product-categories.form', $params);
    }


    public function save(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');     
        // $icon = $request->file('icon');     

        $params = new ProductCategoriesDTO();
        $params->setIdProductCategory($id);
        $params->setName($name);
        // $params->setIcon($icon);

        $result = $this->productCategoriesBusinessLayer->actionSave($params);
        
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
        $params = new ProductCategoriesDTO();
        $params->setIdProductCategory($id);
        $result = $this->productCategoriesBusinessLayer->actionDelete($params);

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

        $result = $this->productCategoriesBusinessLayer->actionDatatable($params);

        return json_encode($result['data']);
    }

    public function getOption(Request $request)
    {
        $key = $request->get('key');

        $params = new ProductCategoriesDTO();
        $params->setName($key);

        $result = $this->productCategoriesBusinessLayer->getOptions($params);

        if($result['code'] == 200){
            $productCategoriesOptions = [];
            foreach($result['data'] as $num => $item){
                $productCategoriesOptions[] = [
                    'id' => encrypt($item->id_product_category),
                    'text' => $item->name
                ];
            }

        }else{
            $productCategoriesOptions = [];
        }

        if(count($productCategoriesOptions) == 0){
            $productCategoriesOptions[] = [
                'id' => encrypt("0"),
                'text' => 'Data not found'
            ];
        }

        return response()->json($productCategoriesOptions);
    }

   
}