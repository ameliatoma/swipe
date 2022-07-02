@extends('layouts.app')

@section('content')
    @if(Auth::user()->id !== $user->id)
<div class="container" style="position:relative; top: 100px;">
    <div>
       <h1> {{$user->name}}'s book collection 
        @if(App\Http\Controllers\HomeController::isFriendshipRequestSent($user->id) == 1)
            <a id='requestButton'><i class="fa-solid fa-user-plus btn btn-success"></i></a>
        @endif
       </h1>
    </div>
</div>
    @endif
    @if(App\Http\Controllers\HomeController::isFriend($user->id) == 1 || Auth::user()->id == $user->id)
<div class="container" style="position:relative; top: 100px;">
        <div class="justify-content-center">
            @foreach($bookChunks->chunk(3) as $chunk)  
                <div class="row mb-60">  
                    @foreach($chunk as $book)
                    <div class="col-sm-4">
                        <div class="card" style="background-color:black">
                            <div class="card-horizontal">
                                <div class="img-square-wrapper">
                                    <img class="" src="{{$book->image_url}}" height="175px" width="115px" alt="Card image cap">
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title" style="color:aliceblue">{{$book->title}} </h4>
                                    <p class="card-text">{{$book->author}}</p>
                                    @if(Auth::user()->id == $user->id)
                                    <a class = "removeButton fa fa-heart-crack btn btn-sm btn-danger" data-id="{{$book->id}}">Remove from library</a>
                                    @endif
                                </div>
                            </div>                      
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
        </div>
        <div style="text-align: center">{{ $bookChunks->links() }}</div>
</div>
@endif
@if(App\Http\Controllers\HomeController::isFriend($user->id) == 0)
    <div class="container" style="position:relative; top: 200px;">
         <h1 style="text-align: center">You have to be friends to see each other's books collection.</h1>
    </div>
@endif
@endsection

@section('js')
    <script>
        var url = laroute.route('friendship.makeRequest');
        var user = {!! $user !!};
       
        $('#requestButton').on('click', function() {
            axios({
                method: 'post',
                url: url,
                data: {
                    user_id: user['id']
                }
            }).then(function(response) {
                if (response.data[0] == 'success')
                {
                    window.location.reload();
                }
            });
        })
        var urlRemove = laroute.route('swipe.removeBook')
        $('.removeButton').on('click', function() {
            var thisBookId = $(this).data('id');
            axios({
                method: 'post',
                url: urlRemove,
                data: {
                    book_id: thisBookId
                }
            }).then(function(response) {
                if (response.data[0] == 'success')
                {
                    window.location.reload();
                }
            });
        })
    </script>
@endsection
