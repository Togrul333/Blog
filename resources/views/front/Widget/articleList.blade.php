@if(count($articles)>0)
    @foreach($articles as $article)
        <div class="post-preview">
            <a href="{{route('single',[$article->category->slug,$article->slug])}}">
                <h2 class="post-title">{{$article->title}}</h2>
                <img src="{{$article->image}}">
                <h3 class="post-subtitle">{{ \Illuminate\Support\Str::limit($article->content, 75)}}</h3>
            </a>
            <p class="post-meta">Kategori :<a href="#!">{{$article->category->name}}</a>
                <span class="float-right">{{$article->created_at->diffForHumans()}}</span></p>
        </div>
        @if(!$loop->last)
            <hr class="my-4"/>
        @endif
    @endforeach
            {{$articles->links()}}
@else
    <div class="alert alert-danger">
        <h1>Bu kategoriaya aid yazi bulunamadi .</h1>
    </div>
@endif
