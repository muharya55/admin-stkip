@php
   $slug = createSlug($label) ;
   $name = isset($name)? $name : $slug;
   $id = isset($id)? $id : $slug ;
   $type = isset($type)? $type : 'text';
   $placeholder = isset($placeholder)? $placeholder : "Masukkan $label";
@endphp

<div class="form-group">
    <label class="fw-bold text-dark mb-2" for="{{ $id }}">{{ $label }}</label>
    <input  id="{{ $id }}"  type="{{ $type }}"  value="{{ $value ?? old($name) }}"  class="form-control @error($name) is-invalid @enderror"  @if(isset($disabled)) disabled @endif name="{{ $name }}"  placeholder="{{ $placeholder }}"
>

   
    @error($name)
    <div class="  text-danger " role="alert">
        {{ $message }} 
    </div>
    @enderror
</div>

{{-- <label class="fw-bold text-dark" for="">Nama Lengkap</label>
<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name='name' placeholder="Nama Lengkap"> --}}
{{-- @error('name')
<span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror --}}
{{-- @error($name)  
    <div class="row">
        <div class="col-md-2"></div>
            <div class="col-md-5 text-left mb-2">
               <div class="text-danger mb-0" role="alert">  {{$message}} </div>
            </div>
        </div>
 @enderror --}}
