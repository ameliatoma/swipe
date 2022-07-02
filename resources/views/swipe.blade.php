@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm" style ="position:relative; top: 300px;left:200px;">
        <div class="card-body" style="height: 175px">
        <div class="row mt-7">
                <div class="col-md-12">
                    <a id='likeButton' class="fa-solid fa-heart fa-5x btn btn-success btn-lg"></a>                 
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm">
            <div class="center">
                <div class="property-card">
                        <div class="property-image" style="background-image:url('{{$book->image_url}}')">
                            <div class="property-image-title">                             
                            </div>
                        </div>
                    <div class="property-description">
                        <h1> {{$book->title}} </h1>
                        <p>{{$book->author}} </p>
                    </div>
                </div>
        </div>
    </div>
    <div class="col-sm" style ="position:relative; top: 300px;left:80px;">
        <div class="card-body" style="height: 175px">
            <div class="row mt-7">
                <div class="col-md-12">                
                    <a id = "dislikeButton" class="fa-solid fa-heart-crack fa-5x btn btn-danger btn-lg"></a>
                </div>
            </div>
        </div>
    </div>
  </div>
  
</div>
<div class="container" style="color: white;margin-left: 350px; margin-bottom: 20px;">
    <div class="row">
        <div class="col-8">
            <div class="card post" style="background-color: black;">
                <div class="post-heading">
                    <div class="float-left meta">
                        <div class="title h5">
                            <b>Did you read the book? Tell us about it!</b>                    
                        </div>
                        Give it a rating:
                        <select name="rating" id="rating">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        </select>
                    </div>
                </div>
                <div class="post-description"> 
                    <textarea id="reviewBook" placeholder="Write your comment here..." style="width: 100%"></textarea>
                </div>
                <a id = "sendReview" class="btn" style="color: white;">Send</a>
            </div>
        </div>
    </div>
</div>

<div class="container" style="color:white; margin-left: 350px">
    @foreach($bookReviews as $review)
    <div class="row">
        <div class="col-8">
            <div class="card post" style="background-color: black;">
                <div class="post-heading">
                    <div class="float-left meta">
                        <div class="title h5">
                        <a href="http://127.0.0.1:8000/home/{{$review->user_id}}"><b>{{App\Http\Controllers\SwipeController::returnUserName($review->user_id)}}</b></a>
                            made a review.
                        </div>
                    </div>
                </div> 
                <div class="post-description"> 
                    <p>Score: {{$review->score}}/5</p>
                    <p>{{$review->comment}}</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>


    
@endsection 

@section('js')
    <script>
        var url = laroute.route('swipe.likeBook');
        var dislikeCurrentBook = laroute.route('dislikeBook')
        var reviewForm = laroute.route('swipe.leaveReview');
        var book = {!! $book !!};
       
        $('#likeButton').on('click', function() {
            axios({
                method: 'post',
                url: url,
                data: {
                    book_id: book['id']
                }
            }).then(function(response) {
                if (response)
                {
                    var oldUrl= window.location.href;                  
                    var newUrl = oldUrl.slice(0, oldUrl.lastIndexOf('/'));
                    var final = newUrl.concat("/",response.data);
                    window.location = final;
                }
            });
        })
        $('#dislikeButton').on('click', function() {
            axios({
                method: 'get',
                url: dislikeCurrentBook,           
            }).then(function(response) {
                if(response)
                {
                    var oldUrl= window.location.href;                  
                    var newUrl = oldUrl.slice(0, oldUrl.lastIndexOf('/'));
                    var final = newUrl.concat("/",response.data);
                    window.location = final;
                }
            });
        })
        $('#sendReview').on('click', function() {
            var rating = $("#rating").val();
            var reviewBook =$("#reviewBook").val();
            axios({
                method: 'post',
                url: reviewForm,
                data: {
                    book_id: book['id'],
                    score: rating,
                    comment: reviewBook
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