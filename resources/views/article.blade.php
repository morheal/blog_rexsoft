@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default content">
                <div class="page_title">{{$article->title}}</div>

                <div class="panel-body">
                  <p class="article_text">{{$article->text}}</p>
                  <h4 class="article_creator">Article creator: <a href="/user/{{$article->user->id}}">{{$article->user->name}}</a></h4>
                  <input type="hidden" name="article_id" value="{{$article->id}}" class="article_id">
                  <p><a href="/category/{{$article->category->id}}" class="article_category">{{$article->category->name}}</a></p>
                  @if(Auth::check() and $article->creator == Auth::user()->id)
                    <p><a href="#" class="delete_article">Delete article</a></p>
                  @endif
                </div>
            </div>
            <!--Feedback section-->
            <div class="panel panel-default content">
                <div class="panel-heading"><h3>Feedbacks to this article</h3></div>

                @guest
                @else
                {{Form::open(array('url' => '/add_feedback', 'method' => 'post', 'class' => 'add_feedback clear_fl'))}}
                    {{ Form::text('text', null, array('id'=>'text')) }}
                    {{ Form::submit('Add feedback') }}
                {{Form::close()}}
                @endguest

                @if(isset($article->feedbacks))
                <div class="panel-body feedbacks">
                  @foreach($article->feedbacks as $feedback)
                    @include('includes.feedback', ['feedback' => $feedback])
                  @endforeach
                @endif
                </div>
            </div>
            <!----------------------------->
        </div>
    </div>
</div>

<script type="text/javascript">

$(document).on("submit", ".add_feedback", function(e) {
    e.preventDefault();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
    console.log('alo blya');
    $.ajax({
      type: "POST",
      url: "/add_feedback",
      dataType: 'json',
      data: { text: $(".add_feedback #text").val(), article_id: $('.article_id').val() },
      //adding new article block if ajax was success
      success: function(success) {
        console.log(success);
        $(".feedbacks").append("<div class='feedback'><p>"+success.feedback.text+"</p><h5>"+success.name+"</h5><p> <a href='#' class='delete_feedback'> Delete </a> </p></div>");
      }
    });
});

  $(document).on("click", ".delete_article", function(e) {
      e.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      $.ajax({
        type: "POST",
        url: "/delete_article_redirect",
        dataType: 'json',
        data: { id: $('.article_id').val() },
        //adding new article block if ajax was success
        success: function(success) {
          $("input[value='" + success + "']").parent().remove();
        }
      });
  });

  $(document).on("click", ".delete_feedback", function(e) {
      e.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      $.ajax({
        type: "POST",
        url: "/delete_feedback",
        dataType: 'json',
        data: { id: $(this).parent().parent().find(".feedback_id").val() },
        //adding new article block if ajax was success
        success: function(success) {
          $(".feedbacks input[value='" + success + "']").parent().remove();
        }
      });
  });

</script>

@endsection
