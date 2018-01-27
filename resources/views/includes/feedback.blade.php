<div class="feedback">
  <p>{{$feedback->text}}</p>
  <h5>{{$feedback->user->name}}</h5>
  <input type="hidden" name="feedback_id" value="{{$feedback->id}}" class="feedback_id">
  @if(Auth::check() and $feedback->user->id == Auth::user()->id)
    <p> <a href="#" class="delete_feedback"> Delete </a> </p>
  @endif
</div>
