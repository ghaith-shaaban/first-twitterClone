
@extends('style.hf')

@section('title','main')

@section('contant')

        <div class="row">

            <div class="col-3">
                @include('subsys.side_list')
            </div>

            <div class="col-9">
                @include('subsys.message')

                <h2>Unread Notifications</h2>
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>title</th>
                            <th>action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($UnReadNotifications as $UnReadNotification)
                        <tr>
                            <td>{{$UnReadNotification->data['message']}}</td>
                            <td>
                                <a href={{route('notification.MarkAsRead',$UnReadNotification['id'])}}>
                                    <button class="btn btn-dark">mark as read</button>
                                </a>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td> no new Notifications found! </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
                {{-- {{$UnReadNotifications->withQueryString()->links()}} --}}

                <h2>Read Notifications</h2>
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>title</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($ReadNotifications as $ReadNotification)
                        <tr>
                            <td>{{$ReadNotification->data['message']}}</td>
                        </tr>
                        @empty
                            <tr>
                                <td> no Notifications found! </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
                {{-- {{$ReadNotifications->links()}} --}}
            </div>
        </div>


@endsection
