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
                    <form action="{{ route('biro.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                   
                        @component('components.fileinput',['label'=>'Gambar Ketua Biro',"name"=>"gambar_pimpinan","accept"=>"image/*","col"=>"col-md-5"]) @endcomponent
                        @component('components.textInput',['label'=>'Nama Biro' ,'name'=>'nama' ]) @endcomponent
                        @component('components.textInput',['label'=>'Nama Ketua Biro' ,'name'=>'nama_pimpinan'  ]) @endcomponent
                        @component('components.textInput',['label'=>'Email Ketua Biro' ,'name'=>'email_pimpinan'  ]) @endcomponent
                        @component('components.textArea',['label'=>'Konten' ,'name'=>'content','id'=>'editor'  ]) @endcomponent

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
   
    $(document).ready(function() {
        $("#kelas").select2({
                theme: 'bootstrap4',
                placeholder: "-- Pilih Kelas --",
        }); 
    })
     
    
</script>
  
@endpush

