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
                    <form action="{{ route('struktur-organisasi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @component('components.textInput',['label'=>'Nama' ]) @endcomponent
                        @component('components.textInput',['label'=>'Jabatan' ]) @endcomponent
                        @component('components.fileinput',['label'=>'Gambar ',"name"=>"gambar","accept"=>"image/*","col"=>"col-md-5"]) @endcomponent
                         
                       @component('components.textInput',['label'=>'Kategori' ]) @endcomponent
                       
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
   
    $(document).ready(function() {
        $("#kelas").select2({
                theme: 'bootstrap4',
                placeholder: "-- Pilih Kelas --",
        }); 
    })
     
    
</script>
  
@endpush

