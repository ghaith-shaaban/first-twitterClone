
@extends('style.hf')

@section('title','idea | admin page')

@section('contant')
<h1>admin page</h1>
<div class="row">
    @include('admin.admin_side_list')
      <div class="col-9">
        <table class="table">
            <thead class="table-dark">
            <tr>
            <th>ID</th>
            <th>idea</th>
            <th>user</th>
            <th>created at</th>
            <th>#</th>
            </tr>
            </thead>

            <tbody>
                @foreach ($allideas as $idea )
                <tr>
                    <td>{{$idea['id']}}</td>
                    <td>{{$idea['idea']}}</td>
                    <td><a href="{{route('user.show',$idea['user_id'])}}">{{$idea->user['name']}}</a></td>
                    <td>{{$idea['created_at']->toDatestring()}}</td>
                    <td>
                        <a href="{{route('idea show',$idea['id'])}}">view</a>
                        <a href="{{route('idea edit',$idea['id'])}}">edit</a>
                    </td>
                    </tr>
                    @endforeach

            </tbody>
        </table>
        {{$allideas->links()}}
      </div>
</div>

@endsection
