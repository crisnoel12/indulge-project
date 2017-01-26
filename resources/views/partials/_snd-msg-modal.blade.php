<div class="reveal" id="msg-modal" data-reveal>
  <h1>New Message</h1>
  <form method="post" action="{{url('/messages/post', [$user->id])}}">
      <label>To: {{ $user->first_name }} {{ $user->last_name }}
          <textarea name="message" rows="5"></textarea>
      </label>
      <input class="button" type="submit" value="Send">
      {!! csrf_field() !!}
  </form>
  <button class="close-button" data-close aria-label="Close reveal" type="button">
  <span aria-hidden="true">&times;</span>
  </button>
</div>
