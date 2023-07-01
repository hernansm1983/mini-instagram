@if(\Auth::user()->image)
<div class="container-avatar">
    <img src="{{ url('../storage/app/users', ['filename'=>Auth::user()->image]) }}" alt="alt" class="avatar" />   
</div>
@endif