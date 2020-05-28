@foreach($comments as $comment)
    <div class="display-comment">
        <strong>{{ $comment->name }}</strong>
        <p>{{ $comment->comment }}</p>



        <a href="" id="reply"></a>
        <form method="post" action="{{ route('reply.store') }}">
            @csrf
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="name" class="form-control" placeholder="Name" />
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="email" class="form-control" placeholder="Email" />
                    </div>
                </div>
                <input type="text" name="comment" class="form-control" />
                <input type="hidden" name="post_id" value="{{ $post_id }}" />
                <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" value="Reply" />
            </div>
        </form>




        @include('partials.comments_replies', ['comments' => $comment->replies])
    </div>



@endforeach
