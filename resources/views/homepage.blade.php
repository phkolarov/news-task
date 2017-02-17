@extends('layouts.pub')

<div class="content">

    <div class="row">
        <div class="col-md-12">
            <ul>
                @foreach($articles as $key => $article)

                    @if($key != 0)
                        <li class="col-lg-2 col-md-3 col-sm-5 col-xs-12 pubArticleWrapper">
                            <a href="{{route('current-article',['id'=> $article->id])}}" >
                                <div class="titleContainer">
                                    <span>{{$article->title}}</span>
                                </div>
                                <img class="articleSmallThumb" src="images/articles/small_thumbnails/{{$article->image_name}}">

                            </a>
                        </li>
                    @else
                        <li class="col-lg-4 col-md-3 col-sm-5 col-xs-12 pubArticleWrapper" style="margin-right: -1px;">
                            <a href="{{route('current-article',['id'=> $article->id])}}" class="firstArticle">
                                <div class="titleContainer">
                                    <span>{{$article->title}}</span>
                                </div>
                                <img class="articleSmallThumb" src="images/articles/small_thumbnails/{{$article->image_name}}">

                            </a>
                        </li>
                    @endif


                @endforeach
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 paginationWrapper">
            {{$articles->links()}}
        </div>
    </div>
</div>