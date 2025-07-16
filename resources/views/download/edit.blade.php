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
                    <form action="{{ route('download.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                         
                        @component('components.textInput',['label'=>'Judul' ,'name'=>'judul','value'=>$data->judul ]) @endcomponent 
 
 
                        <div class="mb-3">
                            <label class="form-label">File Lama</label><br>
                            <a href="{{ asset('storage/downloads/' . $data->nama_file) }}" target="_blank">{{ $data->nama_file }}</a>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ganti File (opsional)</label>
                            <input type="file" name="file" class="form-control">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti file.</small>
                        </div>

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

