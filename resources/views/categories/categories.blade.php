@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default content">
                <div class="page_title">Categories</div>

                <div class="panel-body">

                  {{Form::open(array('url' => '/add_category', 'method' => 'post', 'class' => 'add_category clear_fl'))}}
                      {{ Form::text('name', null, array('id'=>'name')) }}
                      {{ Form::submit('Add category') }}
                  {{Form::close()}}

                  <div class="categories">
                    @foreach($categories as $category)
                    <div class="category">
                      <h4 class="name">{{$category->name}}</h4>
                      <input type="hidden" name="category_id" value="{{$category->id}}" class="category_id">
                      <p> <a href="#" class="delete_category">Delete category</a> </p>
                    </div>
                    @endforeach
                  </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  $(document).on("submit", ".add_category", function(e) {
      e.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      $.ajax({
        type: "POST",
        url: "/add_category",
        dataType: 'json',
        data: { name: $(".add_category #name").val() },
        //adding new category block if ajax was success
        success: function(success) {
          $(".categories").append("<div class='category'><h4>"+success.name+"</h4><p><a class='delete_category' href='#'>Delete category</a></p></div>");
        }
      });
  });

  //ajax for deleting categorys
  $(document).on("click", ".delete_category", function(e) {
      e.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      $.ajax({
        type: "POST",
        url: "/delete_category",
        dataType: 'json',
        data: { id: $(this).parent().parent().find(".category_id").val() },
        //adding new category block if ajax was success
        success: function(success) {
          $("input[value='" + success + "']").parent().remove();
        }
      });
  });
</script>

@endsection
