@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
           
            <h4 class="page-title">Consumption Details</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="header-title"> Consumption</h4>
                </div>
                <form action="{{ route('admin.consumptions.store') }}" class="ajaxForm" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Consumption Date</label>
                            <input type="date" class="form-control" name="date" id="date" value="{{ isset($is_update) ? date('Y-m-d', strtotime(@$edit_consumption->date)) : date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="">Items</label>
                            <select class="form-control" name="item_id" id="item_id" required>
                                <option value="">Select Item</option>
                                @foreach($items AS $item)
                                    <option value="{{ $item->hashid }}" @if(@$edit_consumption->item_id == $item->id) selected @endif>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Quantity</label>
                            <input type="number" class="form-control" name="quantity" id="quantity" value="{{ @$edit_consumption->qunantity }}" required>
                        </div>
                    </div>
                    <input type="hidden" name="consumption_id" id="consumption_id" value="{{ @$edit_consumption->hashid }}">
                    <input type="submit" class="btn btn-primary mt-3" value="{{ isset($is_update) ? 'Update' : 'Add' }}">
                </form>
            </div>
        </div>
    </div>        
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="header-title">Consumption</h4>
                    {{-- <a href="{{ route('admin.staffs.add') }}" class="btn btn-primary">Add Ac</a> --}}
                </div>
                <p class="sub-header">Following is the list of all the consumptions.</p>
                <table id="example1" class="table dt_table table-bordered w-100 nowrap"  width="100%">
                    <thead>
                        <tr>
                            <th >S.No</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($consumptions AS $consumption)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $consumption->item->name }}</td>
                                <td>{{ $consumption->qunantity}}</td>
                                <td>{{ date('d-M-Y', strtotime($consumption->date)) }}</td>
                                <td >
                                    <a href="{{route('admin.consumptions.edit', $consumption->hashid)}}" class="btn btn-warning btn-xs waves-effect waves-light">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" onclick="ajaxRequest(this)" data-url="{{ route('admin.consumptions.delete', $consumption->hashid) }}"  class="btn btn-danger btn-xs waves-effect waves-light">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    
</div>
@endsection

@section('page-scripts')
@include('admin.partials.datatable')
@endsection