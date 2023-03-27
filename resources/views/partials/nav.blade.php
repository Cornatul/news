@php
    $topics = ['business', 'entertainment', 'general', 'health', 'science', 'sports', 'technology'];
@endphp


<ul class="nav nav-pills mb-4">
    @foreach($topics as $topic)
    <li class="nav-item">
        <a class="nav-link" style="color: #000;text-transform: capitalize"
           href="{{ route('news.index', ['topic' => $topic]) }}">{{ __(($topic)) }}</a>
    </li>
    @endforeach
</ul>
