
@extends('layouts.admin')

@section('main-content')

    <h1 class="h3 mb-4 text-gray-800">{{ __('Blog') }}</h1>

    <div id="editor">
        <p>This is some sample content.</p>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>

@endsection
```