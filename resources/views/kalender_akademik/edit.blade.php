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
                    <form action="{{ route('kalender-akademik.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        @component('components.textInput',['label'=>'Kegiatan',"value"=>$data->kegiatan ,]) @endcomponent
                        @component('components.textInput',['label'=>'Tanggal',"value"=>$data->tanggal ,]) @endcomponent
                        @component('components.select',['label'=>'Semester',"type"=>"arr","value"=>$data->semester ,"name"=>"semester" ,'key1'=>'nama','key2'=>'nama','col'=>'col-lg-8 col-sm-6',"placeholder"=>"Pilih Semester", "options"=>[["nama"=>"Ganjil"],["nama"=>"Genap"]]])
                        @endcomponent
                         @component('components.select',['label'=>'Is Active',"type"=>"arr","name"=>"is_active" ,'key1'=>'id',
                         "value"=>$data->is_active ,'key2'=>'nama','col'=>'col-lg-8 col-sm-6',"placeholder"=>"Pilih Is Active", "options"=>[["id"=>"1","nama"=>"Aktif"],["id"=>"0","nama"=>"Tidak Aktif"]]])
                        @endcomponent
                        <button type="submit" class="btn btn-primary">
                           Simpan
                        </button>


                     </form>
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
   $('#biaya').on('keyup', function() {
        const biaya = $(this).val().replace(/\D/g, ''); // Menghapus semua karakter non-angka
        const formatted = formatRupiah(biaya)
        // console.log(formatted);
        const hasil = $(this).val(formatted);

    });
    $(document).ready(function() {
        const biaya = formatRupiah(@json($data->biaya));
        $('#biaya').val(biaya)
        $("#kelas").select2({
                theme: 'bootstrap4',
                placeholder: "-- Pilih Kelas --",
        });
        $("#jenis_kelamin").select2({
                theme: 'bootstrap4',
                placeholder: "-- Pilih Jenis Kelamin --",
        });
    })
    function formatRupiah(angka) {
        var formatted = new Intl.NumberFormat('id-ID', { 
            style: 'currency', 
            currency: 'IDR', 
            minimumFractionDigits: 0 
        }).format(angka);
        
        return formatted.replace('Rp', 'Rp. '); // Menambahkan Rp dengan titik
    }
</script>
 
<script>
   // $(function() {
   //     $('.select2').select2()
       
   // })

</script>
@endpush

