@extends('layouts.admin')
@section('content')


<div class="row">
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            
            <h4 class="page-title">All Permissions</h4>
        </div>
    </div>
</div>
    <div class="col-lg-12">
        <div class="card-box">
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="header-title">Permissions Detail</h4>
                <a href="javascript:void(0)" onclick="add_permission()" class="btn btn-sm btn-primary">Add New Permission</a>
            </div>
            <p class="sub-header">Following is the list of all the permissions.</p>
            <table class="table dt_table table-bordered w-100 nowrap" id="laravel_datatable">
                <thead>
                    <tr>
                        <th width="20">S.No</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Added On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $k => $permission)
                    <tr>
                        <td>
                            <p class="m-0 text-center">{{ $k + 1 }}</p>
                        </td>
                        <td>{{ $permission->name }}</td>
                        <td><small>{{ $permission->slug }}</small></td>
                        <td>
                            <p class="m-0"><small>{{ get_date($permission->created_on) }}</small></p>
                        </td>
                        <td>
                            <a onclick="add_permission(true, '{{$permission->hashid}}', '{{$permission->name}}')" href="javascript:void(0)" class="btn btn-warning btn-xs waves-effect waves-light">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button type="button" onclick="ajaxRequest(this)" data-url="{{ route('admin.permissions.delete', $permission->hashid) }}"  class="btn btn-danger btn-xs waves-effect waves-light">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Center modal content -->
<div class="modal fade" id="permission_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mypermission_modalLabel"><span id="modal_title"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="ajaxForm" action="{{route('admin.permissions.save')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="permission_name">Permission Name</label>
                        <input class="form-control" name="name" type="text" id="permission_name"  required="required" />
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="permission_id" type="hidden" id="permission_id" />
                        <button class="btn btn-xs btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection

@section('page-scripts')
@include('admin.partials.datatable')
<script type="text/javascript">
    function add_permission(is_update = false, permission_id = null, permission_name = null){
        $("#permission_id").val(permission_id);
        $("#permission_name").val(permission_name);
        if(is_update){
            $("#modal_title").html('Update '+permission_name);
        }else{
            $("#modal_title").html('Add New Permission');
        }

        $("#permission_modal").modal('show');
    }
</script>
@endsection