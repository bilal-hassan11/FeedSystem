@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Items</li>
                    <li class="breadcrumb-item active">All</li>

                </ol>
            </div>
            <h4 class="page-title">All Items</h4>
        </div>
    </div>
</div>

<div class="row">       
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="header-title">Items</h4>
                    {{-- <a href="{{ route('admin.staffs.add') }}" class="btn btn-primary">Add Ac</a> --}}
                </div>
                <p class="sub-header">Following is the list of all the items.</p>
                <table class="table dt_table table-bordered w-100 nowrap table-responsive" id="laravel_datatable">
                    <thead>
                        <tr>
                            <th width="20">S.No</th>
                            <th>Category</th>
                            <th>Item <br />Name</th>
                            <th>Available <br />Stock</th>
                            <th>Rate</th>
                            <th>Item <br /> Type</th>
                            <th>Stock <br /> Status</th>
                            <th>Item <br />Status</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items AS $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->category->name }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->stock_qty }}</td>
                                <td>{{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->type }}</td>
                                <td>
                                    @if($item->stock_status == 1)
                                        Enabled
                                    @else
                                        Disabled
                                    @endif
                                </td>
                                <td>
                                    @if($item->status == 1)
                                        Active
                                    @else
                                        Deactive
                                    @endif
                                </td>
                                <td>{!! wordwrap($item->remarks, 10, "<br />\n", true) !!}</td>
                                <td width="120">
                                    <a href="{{route('admin.items.edit', $item->hashid)}}" class="btn btn-warning btn-xs waves-effect waves-light">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" onclick="ajaxRequest(this)" data-url="{{ route('admin.items.delete', $item->hashid) }}"  class="btn btn-danger btn-xs waves-effect waves-light">
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