@if(count($errors)>0)
    <div class="toast toast jam btn-danger" aria-hidden="true">
        <span class="close-toast" aria-role="button" tabindex="0">&times;</span>
        {{$errors->all()[0]}}
    </div>
@endif

@if(session('message'))
    <div class="toast toast jam btn-success" aria-hidden="true">
        <span class="close-toast" aria-role="button" tabindex="0">&times;</span>
        {{session('message')}}
    </div>
@endif
@if(session('message-fail'))
    <div class="toast toast jam btn-warning" aria-hidden="true">
        <span class="close-toast" aria-role="button" tabindex="0">&times;</span>
        {{session('message-fail')}}
    </div>
@endif
@if(session('message-error'))
    <div class="toast toast jam btn-danger" aria-hidden="true">
        <span class="close-toast" aria-role="button" tabindex="0">&times;</span>
        {{session('message-error')}}
    </div>
@endif
