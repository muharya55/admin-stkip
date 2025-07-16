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
                    @if(session('success'))
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <div class="text-success">
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif
                    @if(session('failed'))
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <div class="text-danger">
                                {{ session('failed') }}
                            </div>
                        </div>
                    @endif 
                    <form action="{{ route('siswa.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="customFile">Upload</label>
                            <input type="file" name="file" class="form-control" id="customFile">
                        </div>
                        <a class="text-primary pt-3" href="/download/excel_siswa.xlsx">Download Format Excel</a>
                        <br><br><br>
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
 

