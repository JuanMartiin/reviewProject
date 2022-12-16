@extends('base')
@section('modalContent')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="width:80%;">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ url('review/' . $review->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row mb-3" style="margin-top:20px;">
                            <label for="nombre" class="col-md-4 col-form-label text-md-end" style="font-size:20px; color:black">{{ __('Name') }}</label>
                            
                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{ $review->nombre }}" required>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3" style="margin-top:20px;">
                            <label for="tipo" class="col-md-4 col-form-label text-md-end" style="font-size:20px; color:black">{{ __('Type') }}</label>
                                
                            <div class="col-md-6">
                                <select name="tipo" id="tipo" required>
                                    <option value=""selected>{{ $review->tipo }}</option>
                                        @foreach($types as $index => $type)
                                            <option value="{{ $index }}">{{ $type }}</option>
                                        @endforeach
                                </select>
                                @error('tipo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3" style="margin-top:20px;">
                            <label for="review" class="col-md-4 col-form-label text-md-end" style="font-size:20px; color:black">{{ __('Review') }}</label>

                            <div class="col-md-6">
                                <textarea id="review" rows="20" class="form-control" name="review" required style="width:500px; color:black">{{ $review->review }}</textarea>

                                @error('review')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3" style="margin-top:20px;">
                            <label for="thumbnail" class="col-md-4 col-form-label text-md-end" style="font-size:20px; color:black">{{ __('Thumbnail') }}</label>
                            <div class="col-md-6">
                                <input type="file" name="thumbnail" id="thumbnail" accept="image/jpeg" />
                                <div style=" width:140px; height:140px; background-image: url('data:image/jpeg;base64,{{ $review->thumbnail }}'); background-size:cover; margin:20px auto;"></div>
                            </div>
                        </div>
                        
                        <div class="row mb-3" style="margin-top:20px;">
                            <label for="images" class="col-md-4 col-form-label text-md-end" style="font-size:20px; color:black">{{ __('Review images') }}</label>
                            <div class="col-md-6">
                                <input type="file" name="images[]" id="images" accept="image/jpeg" multiple />
                                <div style="width:100%; display:flex; flex-wrap:wrap; gap:5px; margin-top:20px;">
                                @foreach($review->images as $image)
                                    <div dataImg="{{ $image->id }}" class="deleteEdit" style="background-image: url('{{ asset('storage/images/' . $image->name) }}'); background-size:cover; background-position:center center; background-repeat:no-repeat; flex:1; box-sizing:border-box; padding-bottom:50%;"></div>
                                @endforeach
                                </div>
                            </div>
                        </div>
                        <input class="toRemove" type=hidden name="toRemove[]"/>
                        <div class="row mb-0" style="margin-top:30px;">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn" style="background-color:black; color:white; width:80px;">
                                    {{ __('EDIT') }}
                                </button>
                                <a class="btn" href="{{ url('reviews/film') }}" style="background-color:black; color:white; width:80px;">BACK</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection