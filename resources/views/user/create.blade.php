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
                    <form class='mt-2'action="{{ route('user.store') }}" id="myForm"enctype="multipart/form-data" method="POST">
                        @csrf                           
                        @component('components.textInput',['label'=>'Username','name'=>'name']) @endcomponent
                             
                        @component('components.textInput',['label'=>'Password','name'=>'password','type'=>'text']) @endcomponent 
                            <hr>
                            <div class="row d-flex">
                                <div class="col-md-6 d-flex">
                                    
                                    <button  class="btn btn-primary w-50"  type="submit">Register</button>
                                </div>
                            </div>
                                                    
                                    
                                            
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

