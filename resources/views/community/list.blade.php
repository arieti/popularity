<ul class="list-group">
	@if(count($links))
		@foreach($links as $link)
			<li class="list-group-item communityLink">

				<form method="POST" action="/votes/{{ $link->id }}">
			        {{ csrf_field() }}
					
					<button class="btn {{ Auth::check() && Auth::user()->votedFor($link) ? 'btn-success' : 'btn-default' }} ">
						{{ $link->votes->count() }}
					</button>
			    </form>

				<a href="/community/{{ $link->channel->slug }}" class="label label-default" style="background: {{ $link->channel->color }}; ">
					{{ $link->channel->title }}
				</a>
				<a href="{{ $link->link }}">
					{{ $link->title }}
				</a>

				<small>
					Contributed by {{ $link->creator->name }}
					{{ $link->updated_at->diffForHumans() }}
				</small>
			</li>				
		@endforeach
		{{ $links->appends(request()->query())->links() }}
	@else
		<li class="community-link">
			No contributions yet.
		</li>
	@endif
</ul>

