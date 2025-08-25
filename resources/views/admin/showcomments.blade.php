
@extends('style.hf')

@section('title','comment | admin page')

@section('contant')
<h1>admin page</h1>
<div class="row">
    @include('admin.admin_side_list')
      <div class="col-9">
        <table class="table">
            <thead class="table-dark">
            <tr>
            <th>ID</th>
            <th>comment</th>
            <th>idea_id</th>
            <th>user</th>
            <th>created at</th>
            <th>#</th>
            </tr>
            </thead>

            <tbody>
                @foreach ($allcomments as $comment )
                <tr>
                    <td>{{$comment['id']}}</td>
                    <td>{{$comment['content']}}</td>
                    <td><a href="{{route('idea.show',$comment['idea_id'])}}">{{$comment['idea_id']}}</a></td>
                    <td><a href="{{route('user.show',$comment['user_id'])}}">{{$comment->user['name']}}</a></td>
                    <td>{{$comment['created_at']->toDatestring()}}</td>
                    <td>
                        {{-- <a href="{{route('idea.show',$comment['id'])}}">view</a>
                        <a href="{{route('idea.edit',$comment['id'])}}">edit</a> --}}
                        <form action="{{route('admin.comment.destroy',$comment['id'])}}" method="post">
                            @csrf
                            @method('delete')
                        <button >delete</button>
                        </form>
                    </td>
                    </tr>
                    @endforeach

            </tbody>
        </table>
        {{$allcomments->links()}}
      </div>
</div>

@endsection
