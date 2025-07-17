@extends('layouts.main')
@section('title', 'DATA HAU CU')

@section('content')
@php
   $success = session('success') ;
@endphp
@push('css')
<style>
   
</style>
@endpush
<div class="container">
    <div class="row">
       <div class="col-md-12">
          <div class="card border-0 shadow rounded">
             <div class="card-body"> 
                {{-- <a href="/utilities/create" class="btn btn-md btn-success mb-3">TAMBAH DATA</a> --}}
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                   <div class="row">
                      <div class="col-sm-12 col-md-6">
                         
                      </div>
                      <div class="col-sm-12 col-md-6">
                         <div id="DataTables_Table_0_filter" class="dataTables_filter">
                           
                           <form action="/utilities">
                              <label>
                                Search:
                                <input type="search" name="search" value="{{ request('search') }}"class="form-control form-control-sm" placeholder=""
                                aria-controls="DataTables_Table_0">
                              </label>
                            </form>
                        </div>
                      </div>
                   </div>
                   <div class="row dt-row mt-3">
                      <div class="col-sm-12">
                        <div class="table-responsive">
                           <table class="table table-bordered  no-footer" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
                              <thead>
                                <tr>
                                      <th>No</th>
                                      <th>Nama </th>
                                      <th>Nim </th>
                                      <th>Email </th>
                                      <th>Pesan </th>
                                </tr> 
                             </thead>
                              <tbody>
  
                                @php  $no = (($datas->currentPage() - 1) * $datas->perPage()) +1 ; @endphp
  
                                @foreach($datas as $key => $item)
                                 <tr class="odd">
                                    <td class="sorting_1">{{ $no++ }}</td>
                                    
                                    <td class="text-wrap" style="max-width: 700px;">{{ $item->nama }} </td>
                                    <td class="text-wrap" style="max-width: 700px;">{{ $item->nim }} </td>
                                    <td class="text-wrap" style="max-width: 700px;">{{ $item->email }} </td>
                                    <td class="text-wrap" style="max-width: 700px;">{{ $item->pesan }} </td>
                                     
                                 </tr>
                                @endforeach
                              </tbody>
                           </table>
                        </div>
                      </div>
                   </div>
                   <div class="row justify-content-between">
                     <div class="col-sm-12 col-md-5 mb-3">
                       <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
                         Showing {{ $datas->firstItem() }}  to {{ $datas->lastItem() }}  of  {{ $datas->total() }}  entries
                       </div>
                     </div>
                     <div class="col-sm-12 col-md-5 d-flex justify-content-end mb-3">
                       {{ $datas->links() }}
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
        hapus(id, nama);
    })

    function hapus(id, nama) {
        Swal.fire({
            title: "Yakin Ingin Menghapus data ini?"
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
    const success = @json($success); 
    console.log(success);
     
        if (success) {
          Swal.fire({
                icon: 'success',
                title: success,
                text : '',
                showConfirmButton: false,  
                showCancelButton: true,    
                cancelButtonText: 'Tutup'  
          });
        }
</script>
@endpush

