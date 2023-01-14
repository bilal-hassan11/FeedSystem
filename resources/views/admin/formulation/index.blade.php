@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Formulatiosn</li>
                    <li class="breadcrumb-item active">All</li>

                </ol>
            </div>
            <h4 class="page-title">All Formulations</h4>
        </div>
    </div>
</div>

<div class="row">       
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="header-title">Formulations</h4>
                    {{-- <a href="{{ route('admin.staffs.add') }}" class="btn btn-primary">Add Ac</a> --}}
                </div>
                <p class="sub-header">Following is the list of all the formulations.</p>
                <table class="table dt_table table-bordered w-100 nowrap table-responsive" id="laravel_datatable">
                    <thead>
                        <tr>
                            <th width="20">S.No</th>
                            <th>Sale Item</th>
                            <th>Sale Weight</th>
                            <th>Total Purchase Weight</th>
                            <th>View</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($formulations AS $formulation)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $formulation->item->name }}</td>
                                <td>{{  $formulation->sale_weight }}</td>
                                <td>{{  $formulation->total_purchase_weight }}</td>
                                <td>
                                    <a href="{{route('admin.formulations.view', $formulation->hashid)}}" class="btn btn-warning btn-xs waves-effect waves-light">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                                <td width="120">
                                    <a href="{{route('admin.formulations.edit', $formulation->hashid)}}" class="btn btn-warning btn-xs waves-effect waves-light">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" onclick="ajaxRequest(this)" data-url="{{ route('admin.formulations.delete', $formulation->hashid) }}"  class="btn btn-danger btn-xs waves-effect waves-light">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        {{-- @foreach($accounts AS $account)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ @$account->grand_parent->name }}</td>
                                <td>{{ @$account->parent->name }}</td>
                                <td>{{ $account->name }}</td>
                                <td>{{ number_format($account->opening_balance, 2) }}</td>
                                <td>{{ date('d-M-Y', strtotime($account->opening_date)) }}</td>
                                <td>{{ $account->account_nature }}</td>
                                <td>{{ $account->ageing }}</td>
                                <td>{{ $account->commission }} %</td>
                                <td>{{ $account->discount }} %</td>
                                <td>{!! wordwrap($account->address, 10, "<br />\n", true) !!}</td>
                                <td width="120">
                                    <a href="{{route('admin.accounts.edit', $account->hashid)}}" class="btn btn-warning btn-xs waves-effect waves-light">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" onclick="ajaxRequest(this)" data-url="{{ route('admin.accounts.delete', $account->hashid) }}"  class="btn btn-danger btn-xs waves-effect waves-light">
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