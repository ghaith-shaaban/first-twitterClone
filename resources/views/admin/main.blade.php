
@extends('style.hf')

@section('title','admin page')

@section('contant')
<h1>admin page</h1>
<div class="row">
    @include('admin.admin_side_list')
      <div class="col-9">

        <div class="row">
            <div class="col-sm-6 col-md-4">
                 @include('admin.widgets',[
                    'title'=>'total users',
                    'icon'=>'fas fa-users',
                    'data'=>$totalusers
                 ])
            </div>

            <div class="col-sm-6 col-md-4">
                @include('admin.widgets',[
                   'title'=>'total ideas',
                   'icon'=>'fas fa-lightbulb',
                   'data'=>$totalideas
                ])
           </div>

           <div class="col-sm-6 col-md-4">
            @include('admin.widgets',[
               'title'=>'  total comments',
               'icon'=>'far fa-comment',
               'data'=>$totalcomments
            ])
       </div>

        </div>

      </div>
</div>

        {{-- <div class="row">

            @include('subsys.message')
            @include('subsys.add_idea')
            @include('subsys.show_idea')
            @include('subsys.search')
        </div> --}}

@endsection
