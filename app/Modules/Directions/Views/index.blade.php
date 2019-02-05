@extends('layouts.admin')
@section('styles')
<!-- DataTables CSS -->
<link href="{{asset('public/theme/vendor/datatables-plugins/dataTables.bootstrap.css')}}" rel="stylesheet">
<!-- DataTables Responsive CSS -->
<link href="{{asset('public/theme/vendor/datatables-responsive/dataTables.responsive.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">
			<i class="fa fa-table"></i> {{ trans('Directions::messages.direction_guidelines')}}
			<a class="btn btn-primary pull-right" href=" {{ url('/') }}/addDirectionGuidelines">{{ trans('Directions::messages.add_direction_guideline')}}</a>
		</h3>
	</div>
</div>
<div class="row">
	@if(session()->has('status'))
	<p class="col-md-12 alert alert-success notify_msg">
		{{ session()->get('status') }}
	</p>
	@endif 
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				{{ trans('Category::messages.category_table')}}
			</div>
			<div class="panel-body">
				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
					<thead>
						<tr>
							<th>{{ trans('Directions::messages.direction_guideline_name')}}</th>
							<th>{{ trans('Directions::messages.direction_guidelines')}}</th>
							<th>{{ trans('Section::messages.action')}}</th>
						</tr>
					</thead>
					<tbody>
						@if(isset($directions))
						@foreach($directions as $key)
						<tr class="odd gradeX">
							<td>{{ ucwords($key->direction_set_name) }}</td>
							<td>{!! $key->directions !!}</td>
							<td>
								<a class="btn btn-primary" data-toggle="tooltip" title="Edit" href="{{ route('addDirectionGuidelines',Crypt::encrypt($key->id)) }}">
									<span class="fa fa-pencil"></span>
								</a>
							</td>	
						</tr>					
						@endforeach
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script src="{{asset('public/theme/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/theme/vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('public/theme/vendor/datatables-responsive/dataTables.responsive.js')}}"></script>
<script>
	$(document).ready(function() {
		$('#dataTables-example').DataTable({
			responsive: true
		});
	});
</script>
@endsection