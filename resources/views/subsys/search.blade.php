
    <div class="card">
        <div class="card-header pb-0 border-0">
            <h5 class="">Search</h5>
        </div>
        <div class="card-body">
            @if(Route::is('main'))
                <form method="GET" action={{route('main')}} >
                <input name="search" value ="{{request('search','')}}" placeholder="..." class="form-control w-100" type="text"id="search">
                <button class="btn btn-dark mt-2"> Search</button>
                </from>
            @elseif (Route::is('feed'))
                <form method="GET" action={{route('feed')}} >
                <input name="search" value ="{{request('search','')}}" placeholder="..." class="form-control w-100" type="text"id="search">
                <button class="btn btn-dark mt-2"> Search</button>
                </from>
            @elseif (Route::is(['profile','user.show']))
                <form method="GET" action={{route('user.show',$user->id)}} >
                <input name="search" value ="{{request('search','')}}" placeholder="..." class="form-control w-100" type="text"id="search">
                <button class="btn btn-dark mt-2"> Search</button>
                </from>
            @endif
        </div>
    </div>

