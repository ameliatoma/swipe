@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="row">
            <div class="col-md-10">
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
                </div>
            </div>
            <div class="col-md-2">
                <div class="card like-menu">
                    <div class="card-body" style="height: 175px">
                        <div class="row mt-7">
                            <div class="col-md-12">
                                <a id='likeButton' class="fa fa-heart btn btn-success"></a>
                                <span>Like</span>
                            </div>
                        </div>

                        <div class="row mt-72">
                            <div class="col-md-12">
                                <a class="fa fa-heart btn btn-danger"></a>
                                <span>Dislike</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <br> 
        <br>
        <br>
        <br>

        <!-- begin wwww.htmlcommentbox.com -->
            <div id="HCB_comment_box"><a href="http://www.htmlcommentbox.com">Widget</a> is loading comments...</div>
            <link rel="stylesheet" type="text/css" href="https://www.htmlcommentbox.com/static/skins/bootstrap/twitter-bootstrap.css?v=0" />
            <script type="text/javascript" id="hcb"> /*<!--*/ if(!window.hcb_user){hcb_user={};} (function(){var s=document.createElement("script"), l=hcb_user.PAGE || (""+window.location).replace(/'/g,"%27"), h="https://www.htmlcommentbox.com";s.setAttribute("type","text/javascript");s.setAttribute("src", h+"/jread?page="+encodeURIComponent(l).replace("+","%2B")+"&mod=%241%24wq1rdBcg%24vGbmoJZcS6KjQcACF0vhi%2F"+"&opts=16798&num=10&ts=1653154484086");if (typeof s!="undefined") document.getElementsByTagName("head")[0].appendChild(s);})(); /*-->*/ </script>
        <!-- end www.htmlcommentbox.com -->
    </div>
</div>
@endsection 

@section('js')
    <script>
        var url = laroute.route('swipe.likeBook');
        var book = {!! $book !!}

        $('#likeButton').on('click', function() {
            axios({
                method: 'post',
                url: url,
                data: {
                    book_id: book['id']
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