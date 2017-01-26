@if (Auth::user())
    <div class="row expanded">
        <form role="search" action="{{ url('/search') }}">
            <div class="input-group">
                <input class="search-bar input-group-field" type="text" name="query" placeholder="Search"/>
                <div class="input-group-button">
                    <button class="icon-search button" type="submit" ></button>
                </div>
            </div>
        </form>
        @if(count($errors) > 0)
            <div class="alert callout column" data-closable>
                @foreach ($errors->all() as $error)
                    <p>{{$error}}</p>
                    <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                        <span aria-hidden="true">&times;</span>
                    </button>
                @endforeach
            </div>
        @elseif(Session::has('flash_message'))
            <div class="success callout column" data-closable>
                <p>{{ Session('flash_message') }}</p>
                <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(Session::has('flash_message_error'))
            <div class="alert callout column" data-closable>
                <p>{{ Session('flash_message_error') }}</p>
                <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
@endif
