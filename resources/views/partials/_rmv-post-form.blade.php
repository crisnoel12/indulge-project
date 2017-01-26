<form method="post" action="{{ url('/post', [$variable])}}">
    <input type="hidden" name="_method" value="DELETE" >
    <button title="Delete Post" class="rmv-post" type="submit">
        <span aria-hidden="true">×</span>
    </button>
    {!! csrf_field() !!}
</form>
