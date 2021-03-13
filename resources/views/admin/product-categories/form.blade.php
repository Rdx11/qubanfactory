<div id="result-form-konten"></div>
<form onsubmit="return false;" id="form-konten" class='form-horizontal'>
    <div class="box-body">
        <div class='form-group'>
            <label for='name' class='control-label'>Name :</label>
            <input type="text" name="name" class="form-control" value="{{$data->name}}" required="">
        </div>     
        
     <!--     <div class="form-group">
              <label for="Icon">Icon</label>
             <input type="file" id="input-file-now-custom-1" name="icon" class="dropify" data-default-file="{{ (!is_null($data->icon)) ? asset($data->icon) : ''}}" />
              <p class="help-block">Tipe Icon : jpeg,png,jpg,bmp <br>maks file: 5mb.</p>
        </div> -->

        <input type='hidden' name='id' value='{{  encrypt($data->id_product_category) }}'>
        <input type='hidden' name='_token' value='{{ csrf_token() }}'>
    </div>

   <div class="box-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <input type="submit" class="btn btn-primary pull-right" value="Simpan">
    </div>
</form>

<script>
    $(document).ready(function () {
        // $('.dropify').dropify();

        $('#form-konten').submit(function () {
            var data = getFormData('form-konten');
            ajaxTransfer('/product-categories/save', data, '#result-form-konten');
        })
    })
</script>