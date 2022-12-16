@extends('base')
@section('modalContent')

<div class="w3_content_agilleinfo_inner">
	<div class="agile_featured_movies">
        <div class="wthree_agile-requested-movies tv-movies">
            @foreach($reviews as $review)
                @if($review->tipo == 'film')
			        <div class="col-md-2 w3l-movie-gride-agile requested-movies" style="border: 1px solid black; margin-bottom: 30px; margin-left: 20px; width: 280px">
				        <a href="{{ url('review/' . $review->id) }}" class="hvr-sweep-to-bottom"><div style=" width:280px; height:280px; background-image: url('data:image/jpeg;base64,{{ $review->thumbnail }}'); background-size:cover;"></div>
					        <div class="w3l-action-icon"><i class="fa fa-play-circle-o" aria-hidden="true"></i></div>
				        </a>
				        <div class="mid-1 agileits_w3layouts_mid_1_home">
					        <div class="w3l-movie-text">
					            <h6><a href="{{ url('review/' . $review->id) }}" style="color: white">{{ $review->nombre }}</a></h6>							
					        </div>
							<div class="mid-2 agile_mid_2_home">
								<p>{{ \Str::substr($review->created_at, 0,10); }}</p>
								<div class="block-stars">
									<ul class="w3l-ratings">
									 <!--   <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>-->
										<!--<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>-->
						    <!--            <li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>-->
							   <!--         <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>-->
								  <!--      <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>-->
								        <li>{{ $review->user->name }}</li>
							        </ul>
								</div>
							    <div class="clearfix"></div>
						    </div>
					    </div>
					
		        </div>		
		      @endif
	        @endforeach   
	        <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--<a class=" btn w3_play_icon1" href="{{ url('review/create') }}" style="background-color:#fe423f; color:white; width:120px; margin:20px 46%;">ADD POST</a>-->
@auth
<div style="border: 2px solid black; width: 150px; margin: 0 auto; background-color: white">
	<a class="btn" href="{{ url('review/create') }}" style="text-decoration: none; color: black; font-size: 1.5em">ADD POST</a>
</div>
@endauth
@endsection
