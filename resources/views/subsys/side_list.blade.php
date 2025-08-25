<div class="col-3">
    <div class="card overflow-hidden">
        <div class="card-body pt-3">
            <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
                <li class="nav-item">
                    <a class="nav-link {{Route::is('main')? 'text-white bg-primary rounded':''}}" href="{{route('main')}}">
                        <span>Home</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Route::is('profile')? 'text-white bg-primary rounded':''}}" href="{{route('profile')}}">
                        <span>profile</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Route::is('feed')? 'text-white bg-primary rounded':''}}" href="{{route('feed')}}">
                        <span>Feed</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span>Terms</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span>Support</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span>Settings</span></a>
                </li>
            </ul>
        </div>
        <div class="card-footer text-center py-2">
            <a class="btn btn-link btn-sm" href="{{route('profile')}}">View Profile </a>
        </div>
    </div>
</div>
