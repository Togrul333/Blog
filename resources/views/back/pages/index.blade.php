@extends('back.layouts.master')
@section('title','Tum makaleler')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <strong>{{$pages->count()}} Makale bulundu.</strong>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Siralama</th>
                        <th>image</th>
                        <th>Makale Basligi</th>
                        <th>durum</th>
                        <th>Islemler</th>
                    </tr>
                    </thead>
                    <tbody id="siralama">
                    @foreach($pages as $page)
                        <tr id="page_{{$page->id}}">
                            <td class="text-center" style="width: 5px !important;"><i class="fa fa-3x fa-arrows-alt-v handle" style="cursor: move"></i></td>
                            <td>
                                <img src="{{$page->image}}" width="200">
                            </td>
                            <td>{{$page->title}}</td>
                            <td>
                                <input type="checkbox" data-on="Aktif" data-off="Pasif" @if($page->ctatus==1) checked
                                       @endif data-toggle="toggle" data-onstyle="outline-danger"
                                       data-offstyle="outline-warning">
                            </td>
                            <td>
                                <a target="_blank" href="{{route('page',$page->slug)}}" title="Goruntule" class="btn btn-sm btn-success"><i
                                        class="fa fa-eye"></i></a>
                                <a href="{{route('admin.page.update',$page->id)}}" title="Duzenle"
                                   class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                                <a href="{{route('admin.page.delete',$page->id)}}" title="Sil"
                                   class="btn btn-sm btn-danger"><i class="fa fa-pen"></i></a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sortable/0.9.13/jquery-sortable-min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script>
        $('#siralama').sortable({
        handle:'.handle',
        update:function (){
            var siralama = $('#orders').sortable('serialize')
            $.get("{{route('admin.page.orders')}}",{orders:siralama},function (data,status){
                console.log(data);
            })
        }
        });

    </script>
@endsection
