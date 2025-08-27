<div>
    <div class="mb-3">
        <form method="POST" action={{route('idea.comment.store',$idea['id'])}}>
            @csrf
            <textarea name="comment" class="fs-6 form-control" rows="1"></textarea>
            @error('comment')
            {{$message}}
            @enderror
            <div>
                <button class="btn btn-primary btn-sm"> Post Comment </button>
            </div>
        </form>
        @if($idea->comments()->exists())
        <hr>
        @endif
        <div class="d-flex align-items-start">
            @foreach ($idea->comments as $comment)
                <img style="width:35px" class="me-2 avatar-sm rounded-circle"
                    src="{{url('storage/'.$comment->user['image'])}}"
                    alt={{$comment->user['name']}}>
                <div class="w-100">
                    <div class="d-flex justify-content-between">
                        <h6 class="">{{$comment->user['name']}}
                        </h6>
                        <small class="fs-6 fw-light text-muted"> {{$comment['created_at']->diffforhumans()}}</small>
                    </div>
                    <p class="fs-6 mt-3 fw-light">
                    {{$comment['content']}}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</div>
