@extends('front.layouts.app')
@section('title','Homepage')
    
@section('content')
    
	<!-- Page Content Start -->
	<div class="page-content space-top p-b65">
		<div class="container fixed-full-area">
			<div class="dzSwipe_card-cont dz-gallery-slider">
				<div class="dzSwipe_card">
					<div class="dz-media">
						<img src="{{asset('assets')}}/images/w3tinder/slider/male.jpg" alt="">
					</div>
					<div class="dz-content">
						<div class="left-content">
							<span class="badge badge-primary d-inline-flex gap-1 mb-2"><i class="icon feather icon-map-pin"></i>Nearby</span>
							<h4 class="title"><a href="profile-detail.html">Harleen , 24</a></h4>
							<p class="mb-0"><i class="icon feather icon-map-pin"></i> 3 miles away</p>
						</div>
						<a href="javascript:void(0);" class="dz-icon dz-sp-like"><i class="flaticon flaticon-star-1"></i></a>
					</div>
					<div class="dzSwipe_card__option dzReject">
						<i class="fa-solid fa-xmark"></i>
					</div>
					<div class="dzSwipe_card__option dzLike">
						<i class="fa-solid fa-check"></i>
					</div>
					<div class="dzSwipe_card__option dzSuperlike">
						<h5 class="title mb-0">Super Like</h5>
					</div>
					<div class="dzSwipe_card__drag"></div>
				</div>
				
				<div class="dzSwipe_card">
					<div class="dz-media">
						<img src="{{asset('assets')}}/images/w3tinder/slider/male.jpg" alt="">
					</div>
					<div class="dz-content">
						<div class="left-content">
							<span class="badge badge-primary d-inline-flex gap-1 mb-2"><i class="icon feather icon-map-pin"></i>Nearby</span>
							<h4 class="title"><a href="profile-detail.html">Richard , 21</a></h4>
							<p class="mb-0"><i class="icon feather icon-map-pin"></i> 5 miles away</p>
						</div>
						<a href="javascript:void(0);" class="dz-icon dz-sp-like"><i class="flaticon flaticon-star-1"></i></a>
					</div>
					<div class="dzSwipe_card__option dzReject">
						<i class="fa-solid fa-xmark"></i>
					</div>
					<div class="dzSwipe_card__option dzLike">
						<i class="fa-solid fa-check"></i>
					</div>
					<div class="dzSwipe_card__option dzSuperlike">
						<h5 class="title mb-0">Super Like</h5>
					</div>
					<div class="dzSwipe_card__drag"></div>
				</div>
				
				<div class="dzSwipe_card">
					<div class="dz-media">
						<img src="{{asset('assets')}}/images/w3tinder/slider/female.jpg" alt="">
					</div>
					<div class="dz-content">
						<div class="left-content">
							<h4 class="title"><a href="profile-detail.html">Natasha , 22</a></h4>
							<p class="mb-0"><i class="icon feather icon-map-pin"></i> 2 miles away</p>
						</div>
						<a href="javascript:void(0);" class="dz-icon dz-sp-like"><i class="flaticon flaticon-star-1"></i></a>
					</div>
					<div class="dzSwipe_card__option dzReject">
						<i class="fa-solid fa-xmark"></i>
					</div>
					<div class="dzSwipe_card__option dzLike">
						<i class="fa-solid fa-check"></i>
					</div>
					<div class="dzSwipe_card__option dzSuperlike">
						<h5 class="title mb-0">Super Like</h5>
					</div>
					<div class="dzSwipe_card__drag"></div>
				</div>
				
				<div class="dzSwipe_card">
					<div class="dz-media">
						<img src="{{asset('assets')}}/images/w3tinder/slider/male.jpg" alt="">
					</div>
					<div class="dz-content">
						<div class="left-content">
							<h4 class="title"><a href="profile-detail.html">Lisa Ray , 25</a></h4>
							<ul class="intrest">
								<li><span class="badge">Photography</span></li>
								<li><span class="badge">Street Food</span></li>
								<li><span class="badge">Foodie Tour</span></li>
							</ul>
						</div>
						<a href="javascript:void(0);" class="dz-icon dz-sp-like"><i class="flaticon flaticon-star-1"></i></a>
					</div>
					<div class="dzSwipe_card__option dzReject">
						<i class="fa-solid fa-xmark"></i>
					</div>
					<div class="dzSwipe_card__option dzLike">
						<i class="fa-solid fa-check"></i>
					</div>
					<div class="dzSwipe_card__option dzSuperlike">
						<h5 class="title mb-0">Super Like</h5>
					</div>
					<div class="dzSwipe_card__drag"></div>
				</div>
				
				<div class="dzSwipe_card">
					<div class="dz-media">
						<img src="{{asset('assets')}}/images/w3tinder/slider/female.jpg" alt="">
					</div>
					<div class="dz-content">
						<div class="left-content">
							<span class="badge badge-primary mb-2">New here</span>
							<h4 class="title"><a href="profile-detail.html">Richard , 22</a></h4>
							<ul class="intrest">
								<li><span class="badge intrest">Climbing</span></li>
								<li><span class="badge intrest">Skincare</span></li>
								<li><span class="badge intrest">Dancing</span></li>
								<li><span class="badge intrest">Gymnastics</span></li>
							</ul>							
						</div>
						<a href="javascript:void(0);" class="dz-icon dz-sp-like"><i class="flaticon flaticon-star-1"></i></a>
					</div>
					<div class="dzSwipe_card__option dzReject">
						<i class="fa-solid fa-xmark"></i>
					</div>
					<div class="dzSwipe_card__option dzLike">
						<i class="fa-solid fa-check"></i>
					</div>
					<div class="dzSwipe_card__option dzSuperlike">
						<h5 class="title mb-0">Super Like</h5>
					</div>
					<div class="dzSwipe_card__drag"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- Page Content End -->
	
@endsection
