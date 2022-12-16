@extends('base')
@section('modalContent')
            <div class="w3_content_agilleinfo_inner">
						<div class="agile_featured_movies">
							@error('message')
				        		<span class="alert alert-danger" style="margin-top: 50px; margin-left: 810px">{{ $message }}</span>
				        	@enderror
				            <div class="inner-agile-w3l-part-head">
					            <h3 class="w3l-inner-h-title" style="margin-left: 50px">{{ $review->nombre }}</h3>
					            <h5 class="w3l-inner-h-title" style="margin-top: 50px; margin-left: 50px">{{ $review->tipo }}</h3>
							</div>
							   <div class="latest-news-agile-info">
								   <div class="col-md-8 latest-news-agile-left-content">
								   	<div class="single video_agile_player" >
										            <div class="video-grid-single-page-agileits" style="margin-top:40px;">
										            	<div style="background-image: url('data:image/jpeg;base64,{{ $review->thumbnail }}'); background-size:cover; background-repeat:no-repeat; width:100%; height:650px; margin-left: 50px"></div>
														 
													</div>
										    </div>
								   	<p style="font-size:18px; margin-top:50px; margin-left: 50px; font-size: 1.4em">{{$review->review}}</p>
								   			
											<div class="single video_agile_player" style="height:auto; display:flex; flex-wrap:wrap; gap:5px;" >
												
											       @foreach($review->images as $image)
										            <div class="video-grid-single-page-agileits" style="margin-top:40px;">
										            	<div style="background-image: url('{{ asset('storage/images/' . $image->name) }}'); background-size:cover; background-repeat:no-repeat; width:200px; height:200px;"></div>
														 <!--<img src="{{ asset('storage/images/' . $image->name) }}" alt="" class="img-responsive" style="width:240px; height:240px;"/> -->
													</div>
													@endforeach
										    </div>
											
											
											<button type="submit" class="btn" style="background-color:black; width:80px; margin-top: 20px; margin-left:800px">
                                    			<a href="{{ url('review/'. $review->id . '/edit') }}" style="text-decoration:none; color:white;">{{ __('EDIT') }}</a>
                                			</button>
                                			<button type="submit" class="btn" style="background-color:black; color:white; width:80px; margin-top:20px; margin-left:30px;">
                                    			<a href="javascript: void(0);"
			                                        class = "deleteRow"
			                                        data-name="review about {{ $review->nombre }}"
			                                        data-url="{{ url('review/' . $review->id ) }}"
			                                        data-toggle="modal"
			                                        data-target="#modalDelete"
			                                        style="text-decoration:none; color:white;">{{ __('DELETE') }}</a>
                                			</button>
											
										
							   </div>
					    </div>
						</div>
				</div>
<form action="" method="post" id="deleteForm">
            @csrf
            @method('delete')
        </form>
@endsection