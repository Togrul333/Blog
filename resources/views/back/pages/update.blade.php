@extends('back.layouts.master')
@section('title','Guncelle')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><strong> Page olustur.</strong></h6>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors as $error)
                        {{$error}}
                    @endforeach
                </div>
            @endif
            <form method="post" action="{{route('admin.page.update.post',$page->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Page basligi</label>
                    <input type="text" name="title" class="form-control" value="{{$page->title}}" required>
                </div>
                <div class="form-group">
                    <label>Page fotorafi</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group">
                    <label>Page icerigi</label>
                    <textarea name="content" id="editor" class="form-control" rows="4">{{$page->content}}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Page olustur</button>
                </div>
            </form>
        </div>
    </div>
@endsection
