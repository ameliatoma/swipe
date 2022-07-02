@extends('layouts.app')

@section('content')

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
                                <a class = "likeButton fa fa-heart btn btn-sm btn-success" data-id="{{$book->id}}">Add to library</a>
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



@endsection

@section('js')
    <script>
        var url = laroute.route('swipe.likebookFromLibrary');
        $('.likeButton').on('click', function() {
            var thisBookId = $(this).data('id');
            axios({
                method: 'post',
                url: url,
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