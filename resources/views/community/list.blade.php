<ul class="list-group">
	@if(count($links))
		@foreach($links as $link)
			<li class="list-group-item">
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
		{{ $links->links() }}
	@else
		<li class="community-link">
			No contributions yet.
		</li>
	@endif
</ul>

