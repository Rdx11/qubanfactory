<div id="result-form-konten"></div>
<form onsubmit="return false;" id="form-konten" class='form-horizontal'>
    <div class="box-body">
        <div class='form-group'>
            <label for='name' class='control-label'>Name</label>
            <input type="text" name="name" class="form-control" value="{{$data->name}}" required="">
        </div>  

        <div class='form-group' id="row-product-categories">
           <label for='name' class='control-label'>Category</label>
           <select name="id_product_category" id="id_product_category" class="form-control" >
              @if($categoryOption != "")
                   <option selected="selected" value="{{encrypt($categoryOption->id_product_category)}}">{{$categoryOption->name}}</option>
              @else
                  <option disabled selected="selected" value="{{encrypt("0")}}">Choose Product Category</option>
              @endif
          </select>
        </div>    

        <div class='form-group'>
            <label for='weight' class='control-label'>Weight</label>
            <input type="text" name="weight" class="form-control" value="{{$data->weight}}" required="">
        </div>     

        <div class='form-group'>
            <label for='price' class='control-label'>Price</label>
            <input type="text" name="price" class="form-control" value="{{$data->price}}" required="">
        </div>     

        <div class='form-group'>
            <label for='stock' class='control-label'>Stock</label>
            <input type="text" name="stock" class="form-control" value="{{$data->stock}}" required="">
        </div>     
        
         <div class="form-group">
              <label for="image">Image</label>
             <input type="file" id="input-file-now-custom-1" name="image" class="dropify" data-default-file="{{ (!is_null($data->image)) ? asset($data->image) : ''}}" />
              <p class="help-block">Tipe image : jpeg,png,jpg,bmp <br>maks file: 5mb.</p>
        </div>

        <input type='hidden' name='id' value='{{  encrypt($data->id_product) }}'>
        <input type='hidden' name='_token' value='{{ csrf_token() }}'>
    </div>

   <div class="box-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <input type="submit" class="btn btn-primary pull-right" value="Simpan">
    </div>
</form>

<script>
    $(document).ready(function () {
        $('.dropify').dropify();

        $('#form-konten').submit(function () {
            var data = getFormData('form-konten');
            ajaxTransfer('/product/save', data, '#result-form-konten');
        })

        $("#id_product_category").select2({
            dropdownParent: $("#row-product-categories"),
            ajax: {
                type: "GET",
                url: "{{url('/product-categories/get-option')}}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        key: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
        });
    })
</script>