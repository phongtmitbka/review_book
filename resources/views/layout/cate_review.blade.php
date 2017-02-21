<h3>@lang('front.label.category')</h3>
@foreach ($cates as $cate)
    <a href="{{ route('reviewCate', $cate->id) }}" class="list-group-item">
        {{ $cate->name }}
    </a>
@endforeach
