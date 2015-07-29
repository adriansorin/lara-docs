@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Create / Edit Documents</div>
                <div class="panel-body">
                	@if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif

	            	<div class="form-horizontal">
	            		<label for="idDocument" class="col-md-3 control-label"><b>Load document for editing</b></label>
	            		<div class="dropdown col-md-7">
						 	<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						    	Documents
						    	<span class="caret"></span>
						  	</button>
                            @if (count($documents) > 0)
    						  	<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    @foreach ($documents as $doc)
                                        <li><a href="/document/create/{{ $doc->id }}">{{ $doc->title }}</a></li>
                                    @endforeach
    						  	</ul>
                            @endif
						</div>
					</div>
					<br><hr><br>
					<form class="form-horizontal" role="form" method="POST" action="
						@if (isset($loadedDocument) AND $loadedDocument->id) 
							/document/update/{{ $loadedDocument->id }}
						@else
							/document/add
						@endif
					">
						<input type="hidden" name="owner" value="@if(isset($loadedDocument)){{$loadedDocument->owner}}@endif">
						{!! csrf_field() !!}
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="title"><b>Title</b></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="title" value="@if(isset($loadedDocument)){{$loadedDocument->title}}@endif">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="content"><b>Content</b></label>
                            <div class="col-md-7">
                            	<textarea class="form-control" rows="5" id="content" name="content">@if(isset($loadedDocument)){{$loadedDocument->content}}@endif</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection