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
			<i class="fa fa-table"></i> {{ trans('messages.package')}}
			<a class="btn btn-primary pull-right" href=" {{ url('/') }}/addPackage">{{ trans('Package::messages.add_package')}}</a>
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
				{{ trans('Package::messages.package_table')}}
			</div>
			<div class="panel-body">
				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
					<thead>
						<tr>
							<th>{{ trans('Package::messages.package_name')}}</th>
							<th>{{ trans('Package::messages.package_type')}}</th>
							<th>{{ trans('Package::messages.package_price')}}</th>
							<th>{{ trans('Package::messages.package_validity')}}</th>
							<th>{{ trans('Section::messages.action')}}</th>
						</tr>
					</thead>
					<tbody>
						@if(isset($packages))
						@foreach($packages as $key)
						<tr class="odd gradeX">
							<td>{{$key->package_name}}</td>
							<td>{{$key->package_type}}</td>
							<td>{{$key->package_price}}</td>
							<td>{{$key->package_validity}}</td>
							<td>
								<a class="btn btn-primary" data-toggle="tooltip" title="Edit" href="{{ route('addPackage',Crypt::encrypt($key->id)) }}">
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