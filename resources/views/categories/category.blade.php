@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>{{$articles[0]->category->name}}</h3></div>

                <div class="panel-body">
                  <div class="articles">
                    @foreach($articles as $article)
                      @include('includes.article', ['article' => $article])
                    @endforeach
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
