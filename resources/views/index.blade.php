@extends('marketing::layouts.app')

@section('title', __('News'))

@section('heading')
    {{ __('News') }}
@endsection

@section('content')

    <!-- Nav !-->
    @include('news::partials.nav')
    <div id="accordion">

        <!-- Trending Terms !-->
        <!-- Google News API !-->
        <div class="card">
            <div class="card-header" id="headingThree">
                <h3>
                    <a class="btn btn-link" data-toggle="collapse" data-target="#collapseThird" aria-expanded="true"
                       aria-controls="collapseThird">
                        Google News - {{ ($topic) }} news
                    </a>
                </h3>
            </div>
            <div id="collapseThird" class="collapse show" aria-labelledby="headingThree" data-parent="#accordion">
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
                        @foreach($google_news as $item)
                            <tr>
                                <td>
                                    <a href="{{ $item["link"] }}" target="_blank">
                                        {{ $item["title"] }}
                                    </a>
                                </td>
                                <td>
                                    <a href="#">
                                        {{ $item["media"] }}
                                    </a>
                                </td>
                                <td>
                                    {{ $item["date"] }}
                                </td>
                                <td>
                                    <a href="{{ route('news.extract', ['url' => base64_encode($item["link"])]) }}">
                                        {{ __('Extract') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- News API !-->
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h3>
                    <a class="btn btn-link" data-toggle="collapse" data-target="#collapseSecond" aria-expanded="true"
                       aria-controls="collapseSecond">
                        NewsApi.org - {{ Str::camel($topic) }} news
                    </a>
                </h3>
            </div>
            <div id="collapseSecond" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
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
                        @foreach($news_api as $item)

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
                                    <a href="{{ route('news.extract', ['url' => base64_encode($item->url)]) }}">
                                        {{ __('Extract') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
@endsection
