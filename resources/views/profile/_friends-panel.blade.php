<div class="tabs-panel small-up-1 medium-up-3 large-up-5" id="friends-panel">
    <div class="row">
        <div class="column">
            @if(!$user->friends()->count())
            @if(Auth::user()->id === $user->id)
                <p>You have no friends.</p>
            @else
                <p>{{ $user->first_name }} has no friends.</p>
            @endif
        @else
            <p>{{ $user->first_name }} has {{ $user->friends()->count() }} friend(s).</p>
            @foreach($user->friends() as $user)
                <a href="{{ url('/user',[$user->username]) }}" class="column medium-5">
                    <img class="thumbnail friend-pic" src="{{ $user->profile_pic }}">
                    <p>{{ $user->first_name }} {{ $user->last_name }}</p>
                </a>
            @endforeach
        @endif
        </div>
    </div>
</div>
