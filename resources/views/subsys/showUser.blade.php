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
</div>

