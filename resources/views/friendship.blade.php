@extends('layouts.app')

@section('content')
<div class="container" style="position: relative; top: 100px;">
    <div class="row">
        <div class="col">
            <div class="content-friendship">
            <h1>Pending requests</h1>
            @if(!$pendingRequestsReceived->isEmpty())
                @foreach($pendingRequestsReceived as $pendingUser)
                <ul style="color:aliceblue">
                    <li><a href="http://127.0.0.1:8000/home/{{$pendingUser->id}}">{{$pendingUser->name}}</a> <a class="accept" data-id="{{$pendingUser->id}}"><i class="fa-solid fa-check-double btn btn-success"></i></a> <a class="delete" data-id="{{$pendingUser->id}}"><i class="fa-solid fa-trash-can btn btn-danger"></i></a></li>
                </ul>
                @endforeach
            @endif
        </div>
        </div>
        <div class="col">
            <div class="content-friendship">
                <h1>Sent requests</h1>
                @foreach($pendingRequestsSent as $pendingSentUser)
                <ul style="color:aliceblue">
                    <li><a href="http://127.0.0.1:8000/home/{{$pendingSentUser->id}}">{{$pendingSentUser->name}}</a> <a class="delete" data-id="{{$pendingSentUser->id}}"><i class="fa-solid fa-trash-can btn btn-danger "></i></a></li>
                </ul>
                @endforeach
            </div>
        </div>
        
        <div class="col">
            <div class="content-friendship">
                <h1>Your friends</h1>
                @foreach($acceptedFriends as $friend)
                <ul style="color:aliceblue">
                    <li><a href="http://127.0.0.1:8000/home/{{$friend->id}}">{{$friend->name}}</a> <a class="delete" data-id="{{$friend->id}}"><i class="fa-solid fa-trash-can btn btn-danger "></i></a> </li>
                </ul>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        var url_accept = laroute.route('friendship.acceptRequest');
        var url_decline = laroute.route('friendship.declineFriendship');
     
        $('.accept').on('click', function() {
            var id = $(this).data('id');
            axios({
                method: 'post',
                url: url_accept,
                data: {
                    user_id: id
                }
            }).then(function(response) {
                if (response.data[0] == 'success')
                {
                    window.location.reload();
                }
            });
        })
        $('.delete').on('click', function() {
            var id = $(this).data('id');
            axios({
                method: 'post',
                url: url_decline,
                data: {
                    user_id: id
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
