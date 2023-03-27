@extends('marketing::layouts.app')

@section('title', __('News'))

@section('heading')
    {{ __('News') }}
@endsection

@section('content')

    <!-- Nav !-->
    @include('news::partials.nav')

    @if(@$trending)
   <div class="card">
       <div class="card-header">
           <h3>
               Trending Terms
           </h3>
       </div>
       <div class="card-table table-responsive">
           <ul>
               @foreach($trending as $keyword)
                   <li>
                       <h6>
                           <a href="{{ route('news.topic', ['topic' => $keyword]) }}">
                               {{ $keyword }}
                           </a>
                       </h6>
                   </li>
               @endforeach
           </ul>
       </div>
   </div>
    @endif

    <!-- News !-->
    <div class="card">
        <div class="card-header">
            <h3>
                {{ Str::camel($topic) }} news
            </h3>
        </div>
        <div class="card-table table-responsive">

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Author') }}</th>
                    <th>{{ __('Date') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)

                    <tr>
                        <td>
                            <a href="{{ $item->url }}" target="_blank">
                                {{ $item->title }}
                            </a>
                        </td>
                        <td>
                            <a href="#">
                                {{ $item->author }}
                            </a>
                        </td>
                        <td>
                            {{ $item->publishedAt }}
                        </td>
                        <td>
                            <a href="{{ route('news.show', ['url' => base64_encode($item->url)]) }}">
                                {{ __('Extract') }}
                            </a>
                    </tr>
                @endforeach
        </div>
    </div>

@endsection
