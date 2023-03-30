@php
    $topics = ['business', 'entertainment', 'general', 'health', 'science', 'sports', 'technology'];
@endphp


<ul class="nav nav-pills mb-4">

    <li class="nav-item">
        <a class="nav-link" style="color: green;text-transform: capitalize"
           href="{{ route('news.trending') }}">{{ __('Trending terms') }}</a>
    </li>

    @foreach($topics as $topic)
    <li class="nav-item">
        <a class="nav-link" style="color: #000;text-transform: capitalize"
           href="{{ route('news.topic', ['topic' => $topic]) }}">{{ __(($topic)) }}</a>
    </li>
    @endforeach


</ul>
