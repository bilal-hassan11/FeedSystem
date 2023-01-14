@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Account Type</li>
                </ol>
            </div>
            <h4 class="page-title">All Account Types</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="header-title">Add Account Type</h4>
                </div>
                <form action="{{ route('admin.account_types.store') }}" class="ajaxForm" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-5 form-group">
                            <label for="">Account Type</label>
                            <select class="form-control" name="parent_id" id="" required>
                                <option value="">Select Account Type</option>
                                <option value="{{ hashids_encode('0') }}" @if(isset($is_update) &&@$edit_account->parent_id == null) selected @endif>Grand Parent</option>
                                @foreach($grand_parents AS $parent)
                                    <option value="{{ $parent->hashid }}" @if(@$edit_account->parent_id == $parent->id) selected @endif>{{ $parent->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label for="">Account Type name</label>
                            <input type="text" class="form-control" placeholder="Enter account type name" value="{{ @$edit_account->name }}" name="name" id="name" required>
                        </div>
                        <div class="col-md-2 mt-2">
                            <input type="hidden" value="{{ @$edit_account->hashid }}" name="account_type_id" id="account_type_id">
                            <input type="submit" class="btn btn-primary" value="{{ (isset($is_update)) ? 'Update' : 'Add' }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>        
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="header-title">Staffs</h4>
                    {{-- <a href="{{ route('admin.staffs.add') }}" class="btn btn-primary">Add Ac</a> --}}
                </div>
                <p class="sub-header">Following is the list of all the staffs.</p>
                <table class="table dt_table table-bordered w-100 nowrap" id="laravel_datatable">
                    <thead>
                        <tr>
                            <th width="20">S.No</th>
                            <th>Grand Parent</th>
                            <th>Parent</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($accounts AS $account)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ @$account->grand_parent->name }}</td>
                                <td>{{ $account->name }}</td>
                                <td width="120">
                                    <a href="{{route('admin.account_types.edit', $account->hashid)}}" class="btn btn-warning btn-xs waves-effect waves-light">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" onclick="ajaxRequest(this)" data-url="{{ route('admin.account_types.delete', $account->hashid) }}"  class="btn btn-danger btn-xs waves-effect waves-light">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        {{-- @foreach($staffs as $k => $staff)
                        <tr>
                            <td>
                                <p class="m-0 text-center">{{ $k + 1 }}</p>
                            </td>
                            <td>{{ $staff->full_name }}</td>
                            <td><small>{{ $staff->email }}</small></td>
                            <td><small class="badge bg-{{$staff->user_type == 'admin' ? 'danger' : 'info'}}">{{ ucwords($staff->user_type) }}</small></td>
                            <td>
                                <p class="m-0"><small>{{ get_date($staff->created_at) }}</small></p>
                            </td>
                            
                            <td class="text-center">
                                <div class="form-check form-switch">
                                    <input type="checkbox" onchange="ajaxRequest(this)" data-url="{{ route('admin.staffs.update_status', $staff->hashid) }}" {{ $staff->is_active ? 'checked' : ''}} class="form-check-input nopopup" id="staff_status_{{$k}}">
                                    <label class="form-check-label" for="staff_status_{{$k}}">{{$staff->is_active ? 'Active' : 'Disabled'}}</label>
                                </div>
                            </td>
                            <td width="120">
                                <a href="{{route('admin.staffs.edit', $staff->hashid)}}" class="btn btn-warning btn-xs waves-effect waves-light">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" onclick="ajaxRequest(this)" data-url="{{ route('admin.staffs.delete', $staff->hashid) }}"  class="btn btn-danger btn-xs waves-effect waves-light">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-scripts')
@include('admin.partials.datatable')
@endsection