@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">Post Approval Requests</div>

        <div class="card-body">
            @if($posts->count()>0)
                <table class="table">
                    <thead>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th></th>
                    <th></th>
                    </thead>

                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>
                                <img src="{{asset('storage/'.$post->image)}}" width="120px" height="60px" alt="">
                            </td>
                            <td>
                                {{$post->title}}
                            </td>
                            <td>
                                <a href="{{route('categories.edit',$post->category->id)}}">{{$post->category->name}}</a>
                            </td>

                            <td>
                                <a href="{{route('blog.show',$post->id)}}" class="btn btn-info btn-sm">View</a>
                            </td>

                            <td>
                                <form action="{{route('approve-posts',$post)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm">
                                        Approve
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div>No pending requests!</div>
            @endif
        </div>
    </div>

@endsection
