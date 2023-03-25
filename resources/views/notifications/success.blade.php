<div class="notification success">
    @section('success')
        @if(Session::get('success message'))
            <p>{{Session::pull('success message')}}</p>
        @endif
    @show
</div>