<div class="col-3">
    <div class="card overflow-hidden">
        <div class="card-body pt-3">
            <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
                <li class="nav-item">
                    <a class="nav-link {{Route::is('admin')? 'text-white bg-primary rounded':''}}" href="{{route('admin')}}">
                        <span>main</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Route::is('admin.users')? 'text-white bg-primary rounded':''}}" href="{{route('admin.users')}}">
                        <span>users</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Route::is('admin.ideas')? 'text-white bg-primary rounded':''}}" href="{{route('admin.ideas')}}">
                        <span>ideas</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Route::is('admin.comments')? 'text-white bg-primary rounded':''}}" href="{{route('admin.comments')}}">
                        <span>comments</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
