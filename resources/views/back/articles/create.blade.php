@extends('back.layouts.master')
@section('title','Makale olustur')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><strong> Makale olustur.</strong></h6>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors as $error)
                        {{$error}}
                    @endforeach
                </div>
            @endif
            <form method="post" action="{{route('admin.articles.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Makale olustur</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Makale Kategory</label>
                    <select name="category_id" class="form-control" required>
                        <option>Secim yapiniz</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Makale fotorafi</label>
                    <input type="file" name="image" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Makale icerigi</label>
                    <textarea name="content" id="editor" class="form-control" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Makaleyi olustur</button>
                </div>
            </form>
        </div>
    </div>
@endsection
