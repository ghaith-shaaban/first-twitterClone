
@extends('style.hf')

@section('title','user')


@section('contant')

        <div class="row">
            @include('subsys.side_list')
            @include('subsys.message')
            @include('user.show')
            @include('subsys.search')
        </div>

@endsection
