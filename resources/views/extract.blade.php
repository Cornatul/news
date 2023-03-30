@extends('marketing::layouts.app')

@section('title', __('Articles | Imported'))

@section('heading')
    {{ __('Article ') }}
@endsection

@section('content')
    <!-- Insert here a partials !-->
    @include('feeds::partials.nav')
    <!-- Cards !-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.11/clipboard.min.js"></script>
    <div class="card">
        <div class="card-table table-responsive p-5">

            <!-- Button trigger modal -->

            <img src="{{ $article->banner }}" width="100%" alt="">

            <br>
            <br>
            <br>

            <button id="copy" class="btn btn-primary" data-clipboard-target="#editor">
                <i class="fa fa-robot"></i>
                Copy to OpenAI
            </button>


            <br>
            <br>
            <br>


            <form method="POST" action="{{ route('feeds.article.update', [$article->id]) }}">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea id="editor" class="form-control"  name="markdown"  style="height: 100vh"  rows="3">{{ $article->markdown }}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>

                </div>
            </form>
            <div id="gridDemo" class="col">

                @foreach($article->images as $item)
                    <div class="grid-square">
                        <img width="125px" src="{{ $item }}" alt="">
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@toast-ui/editor@3.2.2/dist/toastui-editor-viewer.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@toast-ui/editor@3.2.2/dist/toastui-editor.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
    <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>

    <script>
        const easyMDE = new EasyMDE({element: document.getElementById('editor')});
        const copy = new ClipboardJS('#copy');
        copy.on('success', function(e) {
            console.info('Action:', e.action);
            console.info('Text:', e.text);
            console.info('Trigger:', e.trigger);


        });
        // Grid demo
        gridDemo = document.getElementById('gridDemo');
        new Sortable(gridDemo, {
            animation: 150,
            ghostClass: 'blue-background-class'
        });
    </script>
@endsection
