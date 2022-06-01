@extends('back.layouts.master')
@section('title','Tum Kategoriler')
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Yeni kategory olustur</h6>
            </div>
            <div class="card-body">
                <form method="post" action="{{route('admin.category.create')}}" >
                    @csrf
                    <div class="form-group">
                        <label for="">Kategori adi</label>
                        <input type="text" class="form-control" name="category" required>
                    </div>
                    <div class="form-group">
                       <button type="submit" class="btn btn-block btn-primary ">Ekle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Yeni kategory olustur</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" >
                        <thead>
                        <tr>
                            <th>Ktagori adi</th>
                            <th>Makale sayisi</th>
                            <th>Durum</th>
                            <th>islemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->name}}</td>
                                <td>{{$category->articleCount()}}</td>
                                <td>
                                    <input type="checkbox" data-on="Aktif" data-off="Pasif" @if($category->ctatus==1) checked
                                           @endif data-toggle="toggle" data-onstyle="outline-danger"
                                           data-offstyle="outline-warning">
                                </td>
                                <td>
                                    <a  category-id="{{$category->id}}" class="btn btn-sm btn-primary edit-click" title="Kategoriyi duzenle">
                                        <i class="fa fa-edit text-white"></i>
                                    </a>
                                    <a class="btn btn-sm btn-danger remove-click" title="Kategoriyi sil">
                                        <i class="fa fa-times text-white"></i>
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kategorii duzenle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label >Kategori adi</label>
                        <input id="category" type="text" class="form-control" name="category">
                    </div>
                    <div class="form-group">
                        <label >Kategori slug</label>
                        <input id="slug" type="text" class="form-control" name="category">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>

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
        $(function (){
           $('.edit-click').click(function () {
               id = $(this)[0].getAttribute('category-id');
               $.ajax({
                   type:'GET',
                   url:'{{route('admin.category.getData')}}',
                   data:{id:id},
                   success:function (data) {
                       console.log(data);
                   }
               });
           });
        });
    </script>
@endsection
