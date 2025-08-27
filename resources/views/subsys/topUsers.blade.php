    <div class="card mt-3">
        <div class="card-header pb-0 border-0">
            <h5 class="">top users</h5>
        </div>
        <div class="card-body">
            @foreach($topUsers as $topuser)
            <div class="hstack gap-2 mb-3">
                <div class="avatar">
                    <a href="{{route('user.show',$topuser['id'])}}">
                        <img style="width:50px" class="avatar-img rounded-circle"
                            src="{{url('storage/'.$topuser['image'])}}" alt=""></a>
                </div>
                <div class="overflow-hidden">
                    <a class="h6 mb-0" href="{{route('user.show',$topuser['id'])}}">{{$topuser['name']}}</a>
                    <p class="mb-0 small text-truncate">{{$topuser['email']}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>



{{-- <div class="d-grid mt-3">
    <a class="btn btn-sm btn-primary-soft" href="#!">Show More</a>
</div> --}}
