@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @guest
                    @else
                    {{Form::open(array('url' => '/add_article', 'method' => 'post', 'class' => 'add_article'))}}
                        {{ Form::text('title', null, array('id'=>'title')) }}
                        {{ Form::text('text', null, array('id'=> 'text')) }}
                        {{ Form::select('category', $categories) }}
                        {{ Form::submit('Add article') }}
                    {{Form::close()}}
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
          $(".articles").append("<div class='article'><h3>"+success.article.title+'</h3><p>'+success.article.text+"</p><p>"+success.category_name+"</p><p><a class='delete_article' href='#'>Delete article</a></p></div>");
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
</script>
@endsection
