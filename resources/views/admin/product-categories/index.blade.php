@extends('layout.admin.main')
@section('title', $title)
@section('content')
<section id="row-grouping">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Kategori Produk</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <a onclick="loadModal(this)" target="/product-categories/form" class="btn btn-primary mb-2" title="Tambah Kategori Produk" style="color: #fff">
                            <i class="feather icon-plus"></i>&nbsp; Tambah Kategori Produk
                        </a>
                        <div class="table-responsive">
                            <table class="table" id="table-data">
                                <thead>
                                    <tr>
                                        <th style="width: 2%">No.</th>
                                        <th style="width: 10%">Name</th>
                                        <th style="width: 20%" class="center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
     function deleteData(id) {
        var data = new FormData();
        data.append('id', id);

        modalConfirm("Konfirmasi", "Apakah anda yakin ingin menghapusnya?", function () {
            ajaxTransfer("/product-categories/delete", data, "#modal-output");
        });
    }

    $(document).ready(function () {
       $('#table-data').DataTable({
            "columnDefs": [{
                "visible": false,
                "targets": 2
              }],
            responsive: true,
            "processing": true,
            "serverSide": true,
            "ajax":{
            "url": "{{ url('product-categories/data-table') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "no" },
                { "data": "name" },                    
                { "data": "opsi" }
            ],
            "pageLength": 10,
            "responsive": true,
            "order": [[1, "asc"]],
         });
    });
</script>
@endsection

