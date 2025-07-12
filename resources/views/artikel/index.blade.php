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
                <a href="/artikel/create" class="btn btn-md btn-success mb-3">TAMBAH DATA</a>
                {{-- <a href="{{ route('artikel.import') }}" class="btn btn-md btn-primary mb-3">IMPORT DATA SISWA</a> --}}
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                   <div class="row">
                      <div class="col-sm-12 col-md-6">
                         
                      </div>
                      <div class="col-sm-12 col-md-6">
                         <div id="DataTables_Table_0_filter" class="dataTables_filter">
                           
                           <form action="/siswa">
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
                                      <th>Gambar</th>
                                      <th>Judul</th>
                                      <th>Slug</th>
                                      <th>penulis</th>
                                      <th>Kategori</th>
                                      <th>Aksi</th>
                                </tr>
                             </thead>
                              <tbody>
  
                                @php  $no = (($datas->currentPage() - 1) * $datas->perPage()) +1 ; @endphp
  
                                @foreach($datas as $key => $item)
                                 <tr class="odd">
                                    <td class="sorting_1">{{ $no++ }}</td>
                                      <td>
                                       @if ($item->image)
                                             <img src="{{ asset('storage/' . $item->image) }}" width="80">
                                       @else
                                             <em>Tidak ada</em>
                                       @endif
                                    </td>
                                    <td class="text-wrap" style="max-width: 700px;">{{ $item->judul }} </td>
                                    <td>{{ $item->slug }}</td>
                                    <td>{{ $item->penulis }}</td>
                                    <td>{{ $item->kategori }}</td>
                                   <td class="text-center d-flex">
                                      <a href="{{ route('artikel.edit', $item->id) }}" data-bs-toggle="tooltip" title="Edit" class="p-2"><i class="fa fa-edit text-primary "></i></a>
                                      <a href="#" data-id="{{ $item->id }}" data-nama="{{ $item->slug }}" data-bs-toggle="tooltip" title="Hapus" class="p-2 tombolHapus"><i class="fa fa-trash text-danger"></i></a>
                                      <form action="{{ route('artikel.destroy', $item->id) }}" id="delete{{ $item->id }}" method="POST">
                                            @csrf
                                            @method('delete')
                                      </form>
                                      {{-- <a href="/artikel/{{$item->id}}" data-bs-toggle="tooltip" title="lihat" class="p-2"><i class="fas fa-eye"></i> --}}
                                      </a>
                                   </td>
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

