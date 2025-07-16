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
 <link rel="stylesheet" href="../../assets/vendor/ckeditor5.css">

@endpush
      <div class="container">
         <div class="row">
            @component('components.backButton') @endcomponent

            <div class="col-md-12">
               <div class="card border-0 shadow rounded">
                  <div class="card-body">
                    <form action="{{ route('prodi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                   
                        @component('components.textInput',['label'=>'Nama' ,'name'=>'nama' ]) @endcomponent 
                        @component('components.select',['label'=>'Fakultas','name'=>'fakultas_id','isupdate'=>true ,"type"=>"obj" ,'key1'=>'id','key2'=>'nama','key3'=>'singkatan', "options"=>$fakultas])
                        @endcomponent
                        @for ($i = 1; $i <= 8; $i++)
                            @component('components.textInput', ['label' => ' UKT ' . $i,'name' => 'ukt' . $i])
                            @endcomponent
                        @endfor
                        
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
      $('#editor').summernote({
        placeholder: 'Silahkan Masukkan Konten',
        tabsize: 2,
        height: 320,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
    </script>
<script>
    
        for (let i = 1; i <= 8; i++) {
            $('#_ukt_' + i).on('keyup', function () {
                var harga = $(this).val().replace(/\D/g, '');
                $(this).val(formatRupiah(harga));
            });
        }

   function formatRupiah(angka) {
            var formatted = new Intl.NumberFormat('id-ID', { 
                style: 'currency', 
                currency: 'IDR', 
                minimumFractionDigits: 0 
            }).format(angka);
            
            return formatted.replace('Rp', 'Rp. '); // Menambahkan Rp dengan titik
        }
    $(document).ready(function() {
        $("#kelas").select2({
                theme: 'bootstrap4',
                placeholder: "-- Pilih Kelas --",
        }); 
    })
     
    
</script>
  
@endpush

