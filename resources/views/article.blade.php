@extends('layouts.pub')

@section('content')
    <div class="container articleWrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <h2>{{$articleData->title}}</h2>
                        <div class="article_info">
                            <p><u><b>Date added:</b> {{$articleData->date_added}} <b>Category:</b> {{$articleData->category->name}}</u></p>
                        </div>
                        <img src="../images/articles/big_thumbnails/{{$articleData->image_name}}">
                        <p>{!! $articleData->content !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
