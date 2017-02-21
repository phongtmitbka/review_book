<div class="col-md-2">
    <h3>@lang('front.label.follow')</h2>
    <div class="list-group">
        @foreach ($user_login->user_followeds as $user_followed)
            <a href="{{ route('member', $user_followed->user_followed->id) }}" class="list-group-item">
                {{ $user_followed->user_followed->name }}
            </a>
        @endforeach
    </div>
</div>
