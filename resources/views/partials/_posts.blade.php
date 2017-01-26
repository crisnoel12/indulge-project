@if (!$posts->count())
    <p>Nothing in your docket yet.</p>
@else
    @foreach ($posts as $post)
    {{-- POSTS --}}
    <div class="media-object pos-relative">
        {{-- DELETE Post BTN --}}
        @if (Auth::user()->id === $post->user_id)
            @include('partials._rmv-post-form', array('variable' => $post->id))
        @endif
        {{-- USER Image POST Likes --}}
        <div class="media-object-section">
            <div class="thumbnail">
              <a href="{{url('/user', [$post->user->username])}}">
                  <img class="thumb" src="{{$post->user->profile_pic}}">
              </a>
            </div>
            <br>
            <a href="{{$post->user->id == Auth::user()->id ? '#' : url('/post/like', [$post->id])}}" title="Love It!"><img src="/img/loveit.png"></a>
            <strong class="loveCount">+{{$post->likes->count()}}</strong>
        </div>
        {{-- USER Name POST Body --}}
        <div class="media-object-section post-body">
            <a href="{{url('/user',[$post->user->username])}}">{{$post->user->first_name}} {{$post->user->middle_name}} {{$post->user->last_name}}</a><span> | {{$post->created_at->diffForHumans()}}</span>
            <p>{{$post->body}}</p>
        </div>
        {{-- COMMENTS --}}
        <div class="column medium-10 medium-offset-1">
            @if(!$post->comments->isEmpty())
                <div class="callout primary column">
                  @foreach($post->comments as $comment)
                      <div class="media-object pos-relative">

                          {{-- DELETE Post BTN --}}
                          @if (Auth::user()->id === $comment->user_id)
                              @include('partials._rmv-post-form', array('variable' => $comment->id))
                          @endif

                          {{-- USER Image --}}
                          <div class="media-object-section">
                              <div class="thumbnail">
                                  <a href="{{url('/user', [$comment->user->username])}}">
                                      <img class="thumb" src="{{$comment->user->profile_pic}}">
                                  </a>
                              </div>
                              <br>
                          </div>

                          {{-- USER Name & Comment --}}
                          <div class="media-object-section">
                              <a href="#">{{$comment->user->first_name}} {{$comment->user->last_name}}</a><span> | {{$comment->created_at->diffForHumans()}}</span>
                              <p>{{$comment->body}}</p>
                          </div>
                      </div>
                      {{-- Make <hr> after every comment except last  --}}
                     @if($comment !== $post->comments->last())
                        <hr>
                     @endif
                  @endforeach
                </div>
            @endif

            {{-- ADD New Comment Form --}}
            <form method="post" action="{{url('post/comment', [$post->id])}}">
                <textarea name="comment-{{$post->id}}"></textarea>
                <button class="hollow button" type="submit">Comment</button>
                {!! csrf_field() !!}
            </form>
        </div>
        <hr>
    </div>
    @endforeach
    {!! url()->current()===url('/home') ? $posts->render() : '' !!}
@endif
