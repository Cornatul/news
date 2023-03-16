@php
    $topics = ['business', 'entertainment', 'general', 'health', 'science', 'sports', 'technology'];
@endphp


<ul class="nav nav-pills mb-4">
    @foreach($topics as $topic)
    <li class="nav-item">
        <a class="nav-link"
           href="{{ route('news.index', ['topic' => $topic]) }}">{{ __( Str::camel($topic)) }}</a>
    </li>
    @endforeach
</ul>
