@extends('back.layouts.master')
@section('title','Tum makaleler')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <strong>{{$articles->count()}} Makale bulundu.</strong>
                <a href="{{route('admin.trashed.article')}}" class="btn btn-success btn-sm"><i class="fa fa-trash">
                        Silinen Makaleler</i></a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>image</th>
                        <th>Makale Basligi</th>
                        <th>Kategoriyas</th>
                        <th>goruntulenme sayisi</th>
                        <th>Olusturma tarixi</th>
                        <th>Durum</th>
                        <th>Islemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td>
                                <img src="{{$article->image}}" width="200">
                            </td>
                            <td>{{$article->title}}</td>
                            <td>{{$article->category->name}}</td>
                            <td>{{$article->hit}}</td>
                            <td>{{$article->created_at->diffForHumans()}}</td>
                            <td>
                                <input class="switch" article-id="{{$article->id}}" type="checkbox" data-on="Aktif"
                                       data-off="Pasif" @if($article->ctatus==1) checked
                                       @endif data-toggle="toggle" data-onstyle="outline-danger"
                                       data-offstyle="outline-warning">
                            </td>
                            <td>
                                <a target="_blank" href="{{route('single',[$article->category->slug,$article->slug])}}"
                                   title="Goruntule" class="btn btn-sm btn-success"><i
                                        class="fa fa-eye"></i></a>

                                <a href="{{route('admin.articles.edit',$article->id)}}" title="Dizenle"
                                   class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                                <form method="post" action="{{route('admin.articles.destroy',$article->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Sil" class="btn btn-sm btn-danger"><i
                                            class="fa fa-times"></i></button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
          rel="stylesheet">
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script>
        {{--const article = document.querySelectorAll('.sil')--}}
        {{--article.forEach(function (item) {--}}
        {{--    item.addEventListener('click',function () {--}}
        {{--    const id = this.getAttribute('article-id');--}}
        {{--        $.ajax({--}}
        {{--            url: '{{route('admin.articles.destroy')}}',--}}
        {{--            type: 'DELETE',--}}
        {{--            data:{id:id},--}}
        {{--            success: function(data) {--}}
        {{--                console.log(data);--}}
        {{--            }--}}
        {{--        });--}}
        {{--    })--}}
        {{--})--}}



        {{--$(function (){--}}
        {{--    $('.switch').change(function () {--}}
        {{--        id = $(this)[0].getAttribute('article-id');--}}
        {{--        $.get("{{route('')}}",{id:id},function (data,status) {--}}

        {{--        })--}}
        {{--    })--}}
        {{--})--}}


    </script>
@endsection
