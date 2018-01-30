@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default content">
                <div class="page_title">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @guest
                    @else
                    {{Form::open(array('url' => '/add_article', 'method' => 'post', 'class' => 'add_article clear_fl'))}}
                        {{ Form::text('title', null, array('id'=>'title', 'placeholder' => 'Enter a title')) }}
                        {{ Form::textarea('text', null, array('id'=> 'text', 'cols' => '98', 'placeholder' => 'Enter content')) }}
                        {{ Form::select('category', $categories) }}
                        {{ Form::submit('Add article', ['class' => 'btn_style']) }}
                    {{Form::close()}}

                    <div class="subscribe">
                      <input type="checkbox" name="subscribe" class="subscribe_check">
                      <label for="subscribe" class="checkbox_label">Подписаться на рассылку</label>
                    </div>
                    @endguest

                    <div class="articles">
                      @foreach($articles as $article)
                        @include('includes.article', ['article' => $article])
                      @endforeach
                      {{$articles->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(Auth::check() and Auth::user()->subscribe)
<script type="text/javascript">
  $(document).ready(function() {
    $('.subscribe').prop('checked', true);
  });
</script>
@endif

<script type="text/javascript">
  $(document).on("submit", ".add_article", function(e) {
      e.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      console.log($(".add_article select").val());
      $.ajax({
        type: "POST",
        url: "/add_article",
        dataType: 'json',
        data: { title: $(".add_article #title").val(), text: $(".add_article #text").val(), category: $(".add_article select").val() },
        //adding new article block if ajax was success
        success: function(success) {
          $(".articles").append("<div class='article'><a href='/article/"+success.article.id+"'><h3>"+success.article.title+'</h3></a><p>'+success.article.text+"</p><p>"+success.category_name+"</p><p><a class='delete_article' href='#'>Delete article</a></p></div>");
        }
      });
  });

  //ajax for deleting articles
  $(document).on("click", ".delete_article", function(e) {
      e.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      $.ajax({
        type: "POST",
        url: "/delete_article",
        dataType: 'json',
        data: { id: $(this).parent().parent().find(".article_id").val() },
        //adding new article block if ajax was success
        success: function(success) {
          $("input[value='" + success + "']").parent().remove();
        }
      });
  });

  $(document).on("change", ".subscribe", function(e) {
      e.preventDefault();
      if(this.checked) {
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          })
          $.ajax({
            type: "POST",
            url: "/subscribe",
            dataType: 'json',
            data: { },
            //adding new article block if ajax was success
            success: function(success) { }
        });
      }
      else {
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          })
          $.ajax({
            type: "POST",
            url: "/unsubscribe",
            dataType: 'json',
            data: { },
            //adding new article block if ajax was success
            success: function(success) { }
        });
      }
  });
</script>
@endsection
