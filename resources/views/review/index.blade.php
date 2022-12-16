@extends('base')
@section('modalContent')
<div class="w3_content_agilleinfo_inner">
		<div class="agile_featured_movies">
			<div class="w3_agile_latest_movies">
				<div id="owl-demo" class="owl-carousel owl-theme" >
				    @foreach($reviews as $review)
					<div class="item">
						<div class="w3l-movie-gride-agile w3l-movie-gride-slider" style="border: 1px solid black; margin-bottom: 30px; margin-left: 20px; width: 280px">
							<a href="{{ url('review/' . $review->id) }}" class="hvr-sweep-to-bottom"><div style=" width:280px; height:280px; background-image: url('data:image/jpeg;base64,{{ $review->thumbnail }}'); background-size:cover;"></div><!--<img src="data:image/jpeg;base64,{{ $review->thumbnail }}" title="Movies Pro" class="img-responsive" alt="" />-->
								<div class="w3l-action-icon"><i class="fa fa-play-circle-o" aria-hidden="true"></i></div>
							</a>
							<div class="mid-1 agileits_w3layouts_mid_1_home">
								<div class="w3l-movie-text">
									<h6><a href="#" style="color: white">{{ $review->nombre }}</a></h6>					
								</div>
								<div class="mid-2 agile_mid_2_home">
									<p>{{ \Str::substr($review->created_at, 0,10); }}</p>
									<div class="block-stars">
										<ul class="w3l-ratings">
											<li>{{ $review->user->name }}</li>
										</ul>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
							
						</div>
					</div>
					
					@endforeach
				</div>
			</div>
		</div>
	</div>
@endsection