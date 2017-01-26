<div class="reveal" id="upload-pic-modal" data-reveal>
    <form action="{{url('/upload-profile-picture')}}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="row">
        <div class="column medium-8 medium-offset-2 text-center">
            <h5>Select image to upload:</h5>
            <input type="file" name="image" id="image" class="hollow button success">
            <input class="button" type="submit" value="Upload" name="submit">
        </div>
    </div>
    </form>
    <button class="close-button" data-close aria-label="Close modal" type="button">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
