
@extends('style.hf')

@section('title','users | admin page')

@section('contant')
<h1>admin page</h1>
<div class="row">
    @include('admin.admin_side_list')
      <div class="col-9">
            <table class="table">
                <thead class="table-dark">
                <tr>
                <th>ID</th>
                <th>Name</th>
                <th>eamil</th>
                <th>joined at</th>
                <th>#</th>
                </tr>
                </thead>

                <tbody>
                    @foreach ($allusers as $user )
                    <tr>
                        <td>{{$user['id']}}</td>
                        <td>{{$user['name']}}</td>
                        <td>{{$user['email']}}</td>
                        <td>{{$user['created_at']->toDatestring()}}</td>
                        <td>
                            <a href="{{route('user.show',$user['id'])}}">view</a>
                            <a href="{{route('user.edit',$user['id'])}}">edit</a>
                        </td>
                        </tr>
                        @endforeach

                </tbody>
            </table>
            {{$allusers->links()}}
      </div>
</div>

@endsection
