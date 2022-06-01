@extends('front.layouts.master')
@section('title',$category->name .' | '.count($articles).' yazi tapildi')
@section('content')
    <div class="col-md-9 mx-auto">
    @include('front.Widget.articleList')
    <!-- Pager-->
        <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts
                →</a></div>
    </div>
    @include('front.Widget.categoryWidget')
@endsection
