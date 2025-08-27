
@extends('style.hf')

@section('title','user')


@section('contant')

        <div class="row">

            <div class="col-3">
                @include('subsys.side_list')
            </div>



            <div class="col-6">
                @include('subsys.message')
                @include('subsys.showUser')
                @forelse ($ideas as $idea)
                    @include('subsys.ideaCard')
                @empty
                    no results found!
                @endforelse
                {{$ideas->withQueryString()->links()}}
            </div>

            <div class="col-3">
                @include('subsys.search')
                @include('subsys.topUsers')
            </div>

        </div>

@endsection
