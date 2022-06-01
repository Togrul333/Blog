@extends('front.layouts.master')
@section('title','Contact')
@section('bg',asset('front/assets/img/contact-bg.jpg'))
@section('content')
    <div class="col-md-8" xmlns="http://www.w3.org/1999/html">
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        <p>Bizimle iletisime kece bilersiz!</p>
        <div class="my-5">
            <form method="post" action="{{route('contact.post')}}">
                @csrf
                <div class="form-floating">
                    <input class="form-control" name="name" value="{{old('name')}}" type="text" placeholder="Enter your name..." />
                    <label>Name</label>
                </div>
                <div class="form-floating">
                    <input class="form-control" name="email" value="{{old('email')}}" type="email" placeholder="Enter your email..." required/>
                    <label for="email">Email address</label>
                </div>
                <select class="form-select" name="topic">
                    <option  selected>Konu</option>
                    <option @if(old('topic')=="Bilgi") selected @endif value="1">Bilgi</option>
                    <option @if(old('topic')=="Destek") selected @endif value="2">Destek</option>
                    <option @if(old('topic')=="Genel") selected @endif value="3">Genel</option>
                </select>
                <div class="form-group">
                    <br/>
                    <textarea class="form-control" name="message" placeholder="Enter your message here..." required
                              style="height: 12rem">{{old('email')}}</textarea>
                </div>
                <br/>
                <button class="btn btn-primary" type="submit">Send</button>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                panel content
            </div>
        </div>
    </div>
@endsection

