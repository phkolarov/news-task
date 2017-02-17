@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">ADMINISTRATOR</div>
                    @include('partials.admin-menu')
                    <div class="panel-body">
                        <h3>Articles</h3>
                        <table class="table">
                            <tr>
                                <td>#</td>
                                <td><span>Title</span></td>
                                <td><span>Date added</span></td>
                                <td><span>Category</span></td>
                                <td><span>Is Posted</span></td>
                                <td><span>Image</span></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @foreach($articles as $article)

                                <tr>
                                    <td>
                                        <span>{{$article->id}}</span>
                                    </td>
                                    <td>
                                        <span>{{$article->title}}</span>
                                    </td>
                                    <td>
                                        <span>{{$article->date_added}}</span>
                                    </td>
                                    <td>
                                        <span>
                                            {{$article->category->name}}
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            @if($article->posted == 1)
                                                published
                                            @else
                                                unpublished
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <img src="images/articles/small_thumbnails/{{$article->image_name}}"
                                             style="width: 80px">
                                        <span></span>
                                    </td>
                                    <td>
                                        <a class="btn btn-warning" href="{{route('edit-article',['id' => $article->id])}}">Edit</a>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger modalDeleteArticle" data-toggle="modal" data-target="#deleteNotification" article-id="{{$article->id}}">Delete</button>
                                    </td>
                                </tr>

                            @endforeach

                        </table>
                        <div class="form-group">
                            {{ $articles->links() }}
                        </div>
                        <a href="{{route('add-article')}}" class="btn btn-success">ADD ARTICLE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="deleteNotification" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">System message</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this article?</p>
                </div>
                <div class="modal-footer">
                    <form method="post" action="{{route('delete-article')}}">
                        {{ csrf_field() }}
                        <input type="hidden" value="" name="deletingArticleId" id="deletingArticleId">
                        <button type="submit" class="btn btn-danger">Yes</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
@section('javascript')
    <script>

       $(document).ready(function () {
           $('.modalDeleteArticle').on('click',function () {
               let articleId = $(this).attr('article-id');
               $('#deletingArticleId').val(articleId);

           });
           newsTask.checkForNotification();
       })

    </script>
@endsection