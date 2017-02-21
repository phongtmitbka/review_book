<div class="col-md-2">
    <h3>@lang('front.label.member')</h2>
    <div class="list-group">
        @foreach ($users as $user)
            <a href="{{ route('member', $user->id) }}" class="list-group-item">{{ $user->name }}</a>
        @endforeach
        <br>
    </div>
</div>
