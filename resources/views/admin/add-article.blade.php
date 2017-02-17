@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">ADMINISTRATOR</div>
                    @include('partials.admin-menu')
                    <div class="panel-body">
                        <h2>ADD ARTICLE</h2>
                        <form  method="post" action="{{route('adding-new-article')}}">
                            {{ csrf_field() }}
                            <canvas style="display: none;" id="canvas"></canvas>
                            <input type="hidden" name="resizedImage" id="resizedImage">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Title" required>
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                <textarea type="text" name="articleContent" id="content" class="form-control" placeholder="Content" required>New article</textarea>
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control" name="category">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="isActive">IS POSTED</label>
                                <input id="isActive" type="checkbox" class="" name="isActive">
                            </div>
                            <div class="form-group">
                                <label>Image</label><br>
                                <img src="" id="imagePreview">
                                <img src="" id="imageData">
                                <input type="file" name="image" id="articleImage" class="btn btn-info" placeholder="Image">
                            </div>
                            <button type="submit" class="btn btn-success" id="submitArticle" disabled>ADD NEW ARTICLE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')

    <script src="{{ asset('js/libraries/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(document).ready(function () {

            newsTask.loadImage('articleImage','imagePreview');
            newsTask.loadImage('articleImage','imageData');

            $('#articleImage').on('change',function(){

                $('#imageData').off();
                $('#imageData').on('load',function () {

                    let currentImage = $('#imageData')[0].currentSrc;
                    let canvas = $('#canvas')[0];

                    newsTask.imageResizer(canvas,$('#imageData')[0],500,500);
                        let img = new Image();
                        img.src = canvas.toDataURL();
                        img.onload = function () {
                            $('#resizedImage').val(img.src);
                            $('#submitArticle').removeAttr('disabled');
                        };
                });
            });

            CKEDITOR.replace( 'content' );

        })
    </script>
@endsection