@auth
            <h4> Share yours ideas </h4>
                <div class="row">
                    <div class="mb-3">
                        <form action={{route('submit')}} method="post">
                            @csrf
                        <textarea name="idea" class="form-control" id="idea" rows="3"></textarea>
                        @error('idea')
                        {{$message}}
                        @enderror
                    </div>
                    <div class="">
                        <button class="btn btn-dark"> Share </button>
                    </div>
                </form>
                </div>
@endauth

@guest
                <h4>login to Share yours ideas </h4>
@endguest
