
@extends('layouts.admin')
@section('content')

<div class="main-content">

  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">  
          <div class="card-block">
            <div class="item_row">
              <div class="row">
              </div>
              <h1>Cash Book</h1><br />
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label style="font-size:20px;">Cash In Hand</label>
                    <input class="form-control" type="number" name="open_balance" value="00000" readonly>
                  </div>
                </div>

              </div>
              <br />
              <h3>Receipts</h3><br />
              <form class="ajaxForm" role="form" action="{{ route('admin.cash.store') }}" method="POST" novalidate>
              @csrf
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Date</label>
                      <input class="form-control" type="date" required data-validation-required-message="This field is required"  name="date" value="{{ (isset($is_update)) ? date('Y-m-d', strtotime($edit_cash->date)) : date('Y-d-d') }}" required>
                      
                    </div>
                  </div>
                  <input type="hidden" name="cash_id" value="{{ @$edit_cash->hashid }}">
                  <input type="hidden" name="status" value="receipt">

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Account </label>
                      <select class="form-control select2" style="width: 100%;" id="payment_account" type="text" name="account_id" >
                        <option value="">Select account </option>
                        @foreach($accounts AS $account)
                          <option value="{{ $account->hashid }}" @if(@$edit_cash->account_id == $account->id) selected @endif>{{ $account->name }}</option>
                        @endforeach
                        </select>
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Instrument No </label>
                      <input class="form-control" name="bil_no" value="{{ @$edit_cash->bil_no }}" required>
                    </div>
                  </div>

                </div>
                <div class="row">
                  <div class="col-md-8">
                      <div class="form-group">
                        <label style="margin-right:10px;">Narration</label>                     
                          <datalist id="cityname" >
                          @forelse($accounts AS $account)
                            <option style="width:300px;" value="{{ $account->name }}">{{ $account->name }}</option>
                            @empty
                            <option style="width:300px;" value="">No Account Found!</option>
                            
                          @endforelse
                          </datalist>
                          <input  class="form-control" name="city" autocomplete="on" style="width:920px;" list="cityname">
                      </div>
                    </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Amount </label>
                      <input class="form-control" type="number" name="receipt_ammount" value="{{ @$edit_cash->receipt_ammount }}" >
                    </div>
                  </div>
                  <div class="col-md-1 mt-3">
                    <div class="form-group">
                      <button type="reset" class="btn btn-danger "><i class="fa fa-repeat" aria-hidden="true"></i>&nbsp Reset</button>
                    </div>
                  </div>
                  <input type="hidden" name="cash_id" value="">
                  <div class="col-md-1 mt-3">
                    <div class="form-group">
                      <button type="submit" name="save_receipt" class="btn btn-success">&nbsp Save </button>

                    </div>
                  </div>
                </div>
              </form>
              
              <br />
              <h3>Payments</h3><br />
              <form class="ajaxForm" role="form" action="{{ route('admin.cash.store') }}" method="POST" novalidate>
              @csrf
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Date</label>
                      <input class="form-control" type="date" name="date" value="{{ (isset($is_update)) ? date('Y-m-d', strtotime($edit_cash->date)) : date('Y-d-d') }}" required>
                    </div>
                  </div>
                  <input type="hidden" name="cash_id" value="{{ @$edit_cash->hashid }}">
                  <input type="hidden" name="status" value="payment">
                  <div class="col-md-6">
                    <div class="form-group ">
                      <label>Account </label>
                      <select class="form-control select2" id="payment_account" type="text" name="account_id"   >
                        <option value="">Select account </option>
                        @foreach($accounts AS $account)
                          <option value="{{ $account->hashid }}" @if(@$edit_purchase->account_id == $account->id) selected @endif>{{ $account->name }}</option>
                        @endforeach
                        </select>
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Instrument No </label>
                      <input class="form-control" name="bil_no" value="" required>
                    </div>
                  </div>

                </div>
                
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label style="margin-right:10px;">Narration</label>                     
                        <datalist id="cityname" >
                        @forelse($accounts AS $account)
                          <option style="width:300px;" value="{{ $account->name }}">{{ $account->name }}</option>
                          @empty
                          <option style="width:300px;" value="">No Account Found!</option>
                          
                        @endforelse
                        </datalist>
                        <input  class="form-control" name="city" autocomplete="on" style="width:920px;" list="cityname">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Amount </label>
                      <input class="form-control" name="payment_ammount" value="" required>
                    </div>
                  </div>
                  <div class="col-md-1 mt-3 ">
                    <div class="form-group">
                      <button type="reset" class="btn btn-danger "><i class="fa fa-repeat" aria-hidden="true"></i>&nbsp Reset</button>
                    </div>
                  </div>
                  <input type="hidden" name="cash_id" value="">
                  <div class="col-md-1 mt-3 ">
                    <div class="form-group">

                      <button type="submit" name="save_payment" class="btn btn-success">&nbsp Save </button>
                    </div>

                  </div>
                </div>
              </form>
              <br /><br />
            </div>

          </div>
        
               
             </div> 
           </div>
         </div>
        </div>
      </div>
    </div>
    <div class="box">
				<div class="box-header with-border">
				  <h2 class="box-title text-dark">All Cash Book Entries</h2>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
          <table id="example" class="table text-fade table-bordered table-hover display nowrap margin-top-10 w-p100">
          <thead>
                <tr style="border-color:black;">
                  <th>Id.No</th>
                  <th>Date</th>
                  <th> Account Name </th>
                  <th> Payment </th>
                  <th> Receipt </th>
                  </tr>
            </thead>
            <tbody>
              <?php $total_receipt = 0; $total_payment = 0; ?>
              @foreach($cash AS $c)
                <tr style="border-color:black;">
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ date('d-M-Y', strtotime($c->date)) }}</td>
                  <td>{{ @$c->account->name }}</td>
                  <?php $total_receipt += $c->receipt_ammount; $total_payment +=$c->payment_ammount; ?>
                  <td>{{ $c->payment_ammount }}</td>
                  <td>{{ $c->receipt_ammount }}</td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
            <tr style="border-color:black;">
                  <td colspan="3">Total:</td>
                  <td><strong><?= @$total_payment ?></strong></td>
                  <td><strong><?= @$total_receipt ?></strong></td>
                  
                </tr>
            </tfoot>
          </table>
					</div>              
				</div>
				<!-- /.box-body -->
			  </div>
</div>
@endsection

@section('page-scripts')

@include('admin.partials.datatable')
@endsection