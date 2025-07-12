@extends('layouts.main')
@section('title', 'DATA HAU CU')

@section('content')
<div class="container">
    <div class="row">
       <div class="col-md-12">
          <div class="card border-0 shadow rounded">
             <div class="card-body">
                <a href="http://127.0.0.1:8001/kendaraan/create" class="btn btn-md btn-success mb-3">TAMBAH DATA</a>
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                   <div class="row">
                      <div class="col-sm-12 col-md-6">
                         <div class="dataTables_length" id="DataTables_Table_0_length">
                            <label>
                               Show 
                               <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select form-select-sm">
                                  <option value="10">10</option>
                                  <option value="25">25</option>
                                  <option value="50">50</option>
                                  <option value="100">100</option>
                               </select>
                               entries
                            </label>
                         </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                         <div id="DataTables_Table_0_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="DataTables_Table_0"></label></div>
                      </div>
                   </div>
                   <div class="row dt-row">
                      <div class="col-sm-12">
                         <table class="table table-bordered dataTable no-footer" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
                            <thead>
                               <tr>
                                  <th scope="col">NAMA SISWA</th>
                                  <th scope="col">NO INDUK</th>
                                  <th scope="col">ALAMAT</th>
                                  <th scope="col">AKSI</th>
                               </tr>
                            </thead>
                            <tbody>
                               <tr class="odd">
                                  <td class="sorting_1">AMBULANCE-01</td>
                                  <td>BK 0304 AL</td>
                                  <td>AMBULANCE</td>
                                  <td class="text-center">
                                  </td>
                               </tr>
                               <tr class="even">
                                  <td class="sorting_1">BUS AC</td>
                                  <td>BK 2099 BB</td>
                                  <td>BUS</td>
                                  <td class="text-center">
                                  </td>
                               </tr>
                            </tbody>
                         </table>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-sm-12 col-md-5">
                         <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to 2 of 2 entries</div>
                      </div>
                      <div class="col-sm-12 col-md-7">
                         <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                            <ul class="pagination">
                               <li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous"><a aria-controls="DataTables_Table_0" aria-disabled="true" aria-role="link" data-dt-idx="previous" tabindex="0" class="page-link">Previous</a></li>
                               <li class="paginate_button page-item active"><a href="#" aria-controls="DataTables_Table_0" aria-role="link" aria-current="page" data-dt-idx="0" tabindex="0" class="page-link">1</a></li>
                               <li class="paginate_button page-item next disabled" id="DataTables_Table_0_next"><a aria-controls="DataTables_Table_0" aria-disabled="true" aria-role="link" data-dt-idx="next" tabindex="0" class="page-link">Next</a></li>
                            </ul>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection

@push('script')
<script>
    $('.tombolHapus').click(function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        deletekategori(id, nama);
    })

    function deletekategori(id, nama) {
        Swal.fire({
            title: "Yakin Ingin Menghapus"
            , text: "Data " + nama
            , icon: "warning"
            , showCancelButton: true
            , confirmButtonColor: "#3085d6"
            , cancelButtonColor: "#d33"
            , cancelButtonText: "Batal"
            , confirmButtonText: "Ya, Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                $(`#delete${id}`).submit();
            }
        });
    }

</script>
@endpush

