@if(isset($posts) && is_array($posts) && !empty($posts))
  <div 
    id="{{ $block->block->anchor ?? $block->block->id }}"
    @class([
      $block->classes,
    ])
    style="{{ $style }}"
  >
    <ul class="list-none flex flex-col gap-y-1">
      @foreach($posts as $post)
        <li>
          <a href="{{ $post['permalink'] ?? '#' }}" title="{{ $post['title'] ?? '' }}" class="font-main no-underline hover:underline">
            {{ $post['title'] ?? '' }}
          </a>
        </li>
      @endforeach
    </ul>
  </div>
@endif