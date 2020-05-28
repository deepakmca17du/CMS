@extends('layouts.blog')
<style>
    .display-comment .display-comment {
        margin-left: 40px
    }
</style>

@section('title')
{{$post->title}}
@endsection

@section('header')
    <header class="header text-white h-fullscreen pb-80" style="background-image: url('{{asset('storage/'.$post->image)}}');" data-overlay="9">
        <div class="container text-center">

            <div class="row h-100">
                <div class="col-lg-8 mx-auto align-self-center">

                    <p class="opacity-70 text-uppercase small ls-1">
                        {{$post->category->name}}
                    </p>
                    <h1 class="display-4 mt-7 mb-8">{{$post->title}}</h1>
                    <p><span class="opacity-70 mr-1">By</span> <a class="text-white" href="#">{{$post->user->name}}</a></p>
                    <p><img class="avatar avatar-sm" src="{{Gravatar::src($post->user->email)}}" alt="..."></p>

                </div>

                <div class="col-12 align-self-end text-center">
                    <a class="scroll-down-1 scroll-down-white" href="#section-content"><span></span></a>
                </div>

            </div>

        </div>
    </header><!-- /.header -->
@endsection

@section('content')
    <!--
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      | Blog content
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      !-->
    <div class="section" id="section-content">
        <div class="container">
            {!! $post->content !!}
            <div class="row">
                <div class="gap-xy-2 mt-6">
                    @foreach($post->tags as $tag)
                        <a class="badge badge-pill badge-secondary" href="{{route('blog.tag',$tag->id)}}">{{$tag->name}}</a>
                    @endforeach
                </div>
            </div>


        </div>
    </div>

    <!--
     |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
     | Comments
     |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
     !-->
    <div class="section bg-gray">
        <div class="container">

            <div class="row">
                <div class="col-lg-8 mx-auto">


                    <hr>
                    <h4>Display Comments</h4>
                    @include('partials.comments_replies', ['comments' => $post->comments, 'post_id' => $post->id])
                    <hr />
                    <h4>Add comment</h4>
                    <form method="post" action="{{ route('comments.store') }}">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" name="name" id="name" value="">
                                </div>
                                <div class="col-md-6">
                                    <label for="name">Email:</label>
                                    <input type="text" class="form-control" name="email" id="email" value="">
                                </div>
                                <div class="col-md-12">
                                    <label for="comment">Comment</label>
                                    <textarea name="comment" id="comment" rows="5" cols="5" class="form-control"></textarea>
                                    <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-warning" value="Add Comment" />
                        </div>
                    </form>



                </div>
            </div>

        </div>
    </div>

@endsection
