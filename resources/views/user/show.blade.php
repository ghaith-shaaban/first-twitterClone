<div class="mt-3">
<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:150px" class="me-3 avatar-sm rounded-circle"
                    src={{url('storage/'.$user['image']) }} alt="{{$user['name']}} Avatar">
                <div>
                    {{-- "https://api.dicebear.com/6.x/fun-emoji/svg?seed={{$user['name']}} --}}
                    @if ($editing)
                    <form enctype="multipart/form-data" method="post" action="{{route('user.update',auth()->id())}}">
                        @csrf
                        @method('put')
                    <input name="name" type="text" value="{{$user['name']}}">
                    @error('name')
                    {{$message}}
                    @enderror
                    @else
                    <h3 class="card-title mb-0"><a href="{{route('user.show',$user['id'])}}"> {{$user['name']}}</a></h3>
                    @endif
                    <span class="fs-6 text-muted">{{$user['email']}}</span>

                </div>
            </div>
            <div>

                @can('update',$user)
                @if(!$editing)
                <a href="{{route('user.edit',$user['id'])}}">edit</a>
                @endif
                @endcan

            </div>
        </div>
        <div>
            @if ($editing)
            <label>profile image</label>
            <input name="image" type="file">
            @error('image')
            {{$massage}}
            @enderror
            @endif
        </div>
        <div class="px-2 mt-4">
            <h5 class="fs-5"> bio : </h5>
            @if ($editing)
            <textarea name="bio" class="form-control" id="bio" rows="3">{{$user['bio']}}</textarea>
                        @error('bio')
                        {{$message}}
                        @enderror
            <button type="submit">save</button>
        </form>
            @else
            <p class="fs-6 fw-light">
                {{$user['bio']}}
            </p>
            @endif
            <div class="d-flex justify-content-start">
                <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1">
                    </span> {{$user->follower()->count()}}</a>
                <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-brain me-1">
                    </span> {{$user->ideas()->count()}} </a>
                <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-comment me-1">
                    </span> {{$user->comments()->count()}}</a>
            </div>
            @auth
            @if(auth()->id() != $user['id'])
            <div class="mt-3">
                @if (Auth()->user()->follows($user))
                <form action="{{ route('user.unfollow',$user['id']) }}" method="post">
                    @csrf
                <button type="submit" class="btn btn-primary btn-sm"> unFollow </button>
                </form>
                @else
                <form action="{{ route('user.follow',$user['id']) }}" method="post">
                    @csrf
                <button type="submit" class="btn btn-primary btn-sm"> Follow </button>
                </form>
                @endif
            </div>
            @endif
            @endauth
        </div>
    </div>
</div>
<hr>
<div>
   @forelse ($ideas as $idea)
   <div class="mt-3">
    <div class="card">
        <div class="px-3 pt-4 pb-2">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                        src="{{url('storage/'.$idea->user['image'])}}" alt={{$idea->user['name']}}>
                    <div>
                        <h5 class="card-title mb-0"><a href="#"> {{$idea->user['name']}}
                            </a></h5>
                    </div>
                </div>
                <div>
                    <a href={{route('idea.show',$idea['id'])}}>view</a>

                   @can('update',$idea)
                    <a href={{route('idea.edit',$idea['id'])}}>edit</a>
                    <form method="post" action={{route('idea.destroy',$idea['id'])}}>
                        @csrf
                        @method('delete')
                    <button>x</button>
                    </form>
                    @endcan

                </div>
            </div>
        </div>
        <div class="card-body">
            <p class="fs-6 fw-light text-muted">
               {{$idea['idea']}}
            </p>
            <div class="d-flex justify-content-between">
                <div>
                    @auth
                        <form method="post" action="{{route('idea.toggle.like',$idea['id'])}}">
                            @csrf
                            @if ($idea->liked(auth()->user()))
                                <button class="fw-light nav-link fs-6"> <span class="far fa-heart me-1">
                            @else
                                <button class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1">
                            @endif
                            </span> {{$idea->likes_count}}</button>
                        </form>
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
@empty
no results found!
   @endforelse
</div>
</div>
</div>
