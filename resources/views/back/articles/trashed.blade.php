@extends('back.layouts.master')
@section('title','Silinen makaleler')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <strong>{{$articles->count()}} Makale bulundu.</strong>
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
                            <td>
                                <a href="{{route('admin.recover.article',$article->id)}}" title="Qaytar" class="btn btn-sm btn-success"><i class="fa fa-recycle"></i></a>
                                <a href="{{route('admin.hard.delete.article',$article->id)}}" title="sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                            </td>
                            <td>
                                {{$article->created_at->diffForHumans()}}
                               </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

