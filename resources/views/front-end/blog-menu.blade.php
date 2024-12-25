     




<h5 class="bold mb-4">บทความที่น่าสนใจ</h5>
<div class="row">
	<div class="col-lg-12">

		@if(!empty($blog_menu))
			@foreach ($blog_menu as $menu )
			 
				<a href="/{{Session('lang')}}/{{$module}}/blog/{{$menu->url}}">
					<div class="card-blog">
						<div class="card-img">
							<img src="{{$menu->images}}" alt="img"/></div>
							<div class="card-text">
								<h5>{{$menu->name}}</h5>
							</div>             
					</div>
				</a>

			@endforeach
		@endif

	</div>
</div>



