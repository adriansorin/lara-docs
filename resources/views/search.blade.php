@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" role="form" method="GET" action="{{ url('/dashboard/search') }}">
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
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Results</div>
                <div class="panel-body">
                    <ul class="list-group">
                    @if (count($documents) > 0)
                        @foreach ($documents as $document)
                            <li class="list-group-item"><a href="/document/show/{{ $document->id }}">{{ $document->title }}</a></li>
                        @endforeach
                    @else
                        <li class="list-group-item">No results found.</li>
                    @endif
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-md-12">
            {!! $documents->appends(['word' => $word])->render() !!}
        </div>
    </div>
</div>
@endsection