
@extends('style.hf')

@section('title','main')

@section('contant')

        <div class="row">
            @include('subsys.side_list')
            @include('subsys.message')
            @include('subsys.add_idea')
            @include('subsys.show_idea')
            @include('subsys.search')
        </div>

@endsection
