
<div class="mt-3">
    <div class="card">
        <div class="px-3 pt-4 pb-2">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                    src="{{url('storage/'.$idea->user['image'])}}" alt={{$idea->user['name']}}>
                    <div>
                        <h5 class="card-title mb-0"><a href="{{route('user.show',$idea->user['id'])}}"> {{$idea->user['name']}}
                            </a></h5>
                    </div>
                </div>
                <div>

                    @can('update',$idea)
                         @if (!$editing)
                           <a href={{route('idea edit',$idea['id'])}}>edit</a>
                         @endif
                    <form method="post" action={{route('idea destroy',$idea['id'])}}>
                        @csrf
                        @method('delete')
                    <button>x</button>
                    </form>
                    @endcan

                </div>
            </div>
        </div>
        <div class="card-body">

            @if ($editing)
            <form action={{route('idea update',$idea['id'])}} method="post">
                @csrf
                @method('put')
            <textarea name="cont" class="form-control" id="idea" rows="3">{{$idea['idea']}}</textarea>
            @error('cont')
            {{$message}}
            @enderror
        <div class="">
            <button class="btn btn-dark"> update </button>
        </div>
    </form>
            @else
            <p class="fs-6 fw-light text-muted">
               {{$idea['idea']}}
            </p>
            @endif
            <div class="d-flex justify-content-between">
                <div>
                    @auth
                        @if ($idea->liked(auth()->user()))
                        <form method="post" action="{{route('idea.unlike',$idea['id'])}}">
                            @csrf
                        <button class="fw-light nav-link fs-6"> <span class="far fa-heart me-1">
                            </span> {{$idea->likes_count}}</button>
                        </form>
                        @else
                        <form method="post" action="{{route('idea.like',$idea['id'])}}">
                            @csrf
                        <button class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1">
                            </span> {{$idea->likes_count}}</button>
                        </form>
                        @endif
                        @endauth

                        @guest
                        <span class="fas fa-heart me-1">
                         {{$idea->likes()->count()}}
                        @endguest
                </div>
                <div>
                    <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                      {{$idea->created_at->diffforhumans()}} </span>
                </div>
            </div>
            @include('subsys.comment')
        </div>
    </div>
</div>
</div>
