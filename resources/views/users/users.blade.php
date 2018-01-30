@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default content">
                <div class="page_title">users</div>

                <div class="panel-body">
                  <div class="users">
                    @foreach($users as $user)
                    <div class="user">
                      <h4>{{$user->name}}</h4>
                      <input type="hidden" name="user_id" value="{{$user->id}}" class="user_id">
                      <p> <a href="#" class="delete_user">Ban user</a> </p>
                    </div>
                    @endforeach
                  </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

  //ajax for deleting users
  $(document).on("click", ".ban_user", function(e) {
      e.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      $.ajax({
        type: "POST",
        url: "/ban_user",
        dataType: 'json',
        data: { id: $(this).parent().parent().find(".user_id").val() },
        //adding new user block if ajax was success
        success: function(success) {
          $("input[value='" + success + "']").parent().remove();
        }
      });
  });
</script>

@endsection
