@extends('layouts.main')
@section('title', 'DATA HAU CU')

@section('content')
 @php
     $success = session('success') ;
 @endphp
@push('css')
<style>
    .dataTables_info {
        display: none;
    }

    #simpan {
        text-decoration: none;
    }

    #simpan:hover {
        opacity: 70%;
        text-decoration: none;
    }

    .select2-container {
        width: 100% !important;
        padding: 0;
    }

    .select2-selection {

        padding: 5px !important;
        height: 40px !important;
    }

    label {
        font-size: 13px;
    }

    input {
        padding: 5px !important;
    }
</style>
@endpush
      <div class="container">
         <div class="row">
            @component('components.backButton') @endcomponent

            <div class="col-md-12">
               <div class="card border-0 shadow rounded">
                  <div class="card-body">
                    <table id="w0" class="table table-striped table-bordered detail-view">
                        <tbody>
                        
                           <tr>
                              <th>Nama </th>
                              <td>{{$item->nama}}</td>
                           </tr>
                           <tr>
                              <th>Nim</th>
                              <td>{{$item->nim}}</td>
                           </tr>
                           <tr>
                              <th>Email</th>
                              <td>{{$item->email}}</td>
                           </tr>
                           <tr>
                              <th>Pesan</th>
                              <td>{{$item->pesan}}</td>
                           </tr>
                             
                          
                           
                          
                        </tbody>
                     </table>  
                     
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
    $(function() {
       $(".flatpickr_datetime").flatpickr({
           enableTime: false

       })

   })
</script>
 
<script>
   // $(function() {
   //     $('.select2').select2()
       
   // })

</script>
@endpush

