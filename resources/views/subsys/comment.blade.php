
    <div class="mb-3">
        @auth
        <form method="POST" action={{route('comment.store',$idea['id'])}}>
            @csrf
            <textarea name="comment" class="fs-6 form-control" rows="1"></textarea>
            @error('comment')
            {{$message}}
            @enderror
            <div>
                <br>
                <button class="btn btn-primary btn-sm"> Post Comment </button>
            </div>
        </form>
        @endauth
        @if($idea->comments()->exists())
        <br>
        @endif
         @foreach ($idea->comments as $comment)
        <div class="d-flex align-items-start">
                <img style="width:35px" class="me-2 avatar-sm rounded-circle"
                    src="{{url('storage/'.$comment->user['image'])}}"
                    alt={{$comment->user['name']}}>
                <div class="w-100">
                    <div class="d-flex justify-content-between">
                        <h6 class="">{{$comment->user['name']}}
                        </h6>
                        <small class="fs-6 fw-light text-muted"> {{$comment['created_at']->diffforhumans()}}</small>
                    </div>
                    <div class="d-flex justify-content-between mt-3">

                        @if(Route::is(['comment.edit'])&& $comment->id==$editedcomment->id)
                            <form action={{route('comment.update',$comment['id'])}} method="post">
                            @csrf
                            @method('put')
                            <textarea name="content" class="form-control" id="comment" rows="1">{{$comment['content']}}</textarea>
                            @error('content')
                                {{$message}}
                            @enderror

                            <button class="btn btn-dark"> update </button>

                        </form>
                        @else
                        <p class="fs-6 fw-light">
                        {{$comment['content']}}
                        </p>
                        @endif

                        @can('update',$comment)
                            @if(!(Route::is('comment.edit')))
                        <a  href={{route('comment.edit',$comment['id'])}}><button>edit</button></a>
                            @endif
                        @endcan
                        @can('delete',$comment)
                        <form method="post" action={{route('comment.destroy',$comment['id'])}}>
                            @csrf
                            @method('delete')
                            <button >delete</button>
                        </form>
                        @endcan
                    </div>
                </div>
        </div>
        @endforeach
    </div>
