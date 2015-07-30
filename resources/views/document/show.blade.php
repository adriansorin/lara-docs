@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Document Details</div>
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

                    <table class="table table-hover">
                    	@if ($document)
						<tr>
     						<th>Owner</th>     
						    <td>{{ $ownerName }}</td>     
						</tr>
						<tr>
     						<th>Title</th>     
						    <td>{{ $document->title }}</td>     
						</tr>     
						<tr>         
						    <th>Content</th> 
						    <td>{{ $document->content }}</td>     
						</tr>    
						<tr>         
						    <th>Words</th> 
						    <td>{{ implode(", ", $document->words) }}</td>     
						</tr> 
						@endif
					</table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection