@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
        @foreach($bookChunks as $chunk)
            <div class="row mb-40">  
                @foreach($chunk as $book)
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-horizontal">
                            <div class="img-square-wrapper">
                                <img class="" src="{{$book->image_url}}" height="175px" width="115px" alt="Card image cap">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">{{$book->author}}</h4>
                                <p class="card-text">{{$book->title}}</p>
                            </div>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Last updated {{$book->updated_at}}</small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
@endsection