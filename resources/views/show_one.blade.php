
@extends('style.hf')

@section('title','show one')

@section('contant')

        <div class="row">
            @include('subsys.side_list')
            @include('subsys.message')
            @include('subsys.show_one')
            @include('subsys.search')
        </div>

@endsection
