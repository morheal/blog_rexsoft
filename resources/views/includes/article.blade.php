<div class="article">
  <h3><a href="/article/{{$article->id}}">{{$article->title}}</a></h3>
  <p>{{$article->text}}</p>
  <input type="hidden" name="article_id" value="{{$article->id}}" class="article_id">
  <p><a href="/category/{{$article->category->id}}">{{$article->category->name}}</a></p>
  @if(Auth::check() and $article->creator == Auth::user()->id)
  <p><a href="#" class="delete_article">Delete article</a></p>
  @endif
</div>
