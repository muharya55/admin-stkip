
 <div class="form-group row mt-2">
    <div class="col-sm-2">
        <label for="{{$label}}" class="col-form-label"> {{$label}} </label>      
    </div>
    <div class="{{$col}} input-group">
        <input type="file" name="{{$name}}"   class="form-control-file" id="{{$label}}">
        
        @if(isset($value))
            <!-- Display image preview if $value (file path) is set -->
            <img src="{{ asset('storage/' . $value) }}" class="img-thumbnail w-50" alt="Image Preview">
        @elseif(old($name)) 
            <!-- Display image preview if the old file (temporary file URL) is present -->
            <img src="{{ old($name) }}" class="img-thumbnail" alt="Image Preview">
        @endif
    </div>
</div>