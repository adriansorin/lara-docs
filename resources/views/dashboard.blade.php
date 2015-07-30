@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" role="form" method="GET" action="{{ url('/dashboard/search') }}">
            {!! csrf_field() !!}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <label class="col-md-4 control-label">Search documents that contain the word: </label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="word">
                    </div>

                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Owned by me</div>
                <div class="panel-body">
                    <ul class="list-group">
                    @if (isset($documents))
                        @foreach ($documents as $document)
                            @if ($document->owner == Auth::user()->id)
                                <li class="list-group-item"><a href="/document/show/{{ $document->id }}">{{ $document->title }}</a></li>
                            @endif
                        @endforeach
                    @else
                        <li class="list-group-item">No results found.</li>
                    @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Owned by others</div>
                <div class="panel-body">
                    <ul class="list-group">
                    @if (isset($documents))
                        @foreach ($documents as $document)
                            @if ($document->owner != Auth::user()->id)
                                <li class="list-group-item">{{ $document->title }}</li>
                            @endif
                        @endforeach
                    @else
                        <li class="list-group-item">No results found.</li>
                    @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            {!! $documents->render() !!}
        </div>
    </div>
</div>
@endsection