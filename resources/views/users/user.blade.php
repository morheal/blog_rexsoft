@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>{{$this_user->name}}</h3></div>

                <div class="panel-body">
                  <div class="articles">
                    @foreach($this_user->articles as $article)
                      @include('includes.article', ['article' => $article])
                    @endforeach
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

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
