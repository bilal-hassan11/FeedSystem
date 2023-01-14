

@extends('layouts.admin')
@section('content')
<div class="main-content"> 
       <div class="row">
         <div class="col-sm-12">
           <div class="card">
             <div class="card-header">
                <h4 class="card-title"> Sales Form</h4>
             </div>

             
            <!-- Default box -->
		  <div class="box">
			
			<div class="box-body">
      @if(isset($is_update))
				<a class="popup-with-form btn btn-primary" href="#test-form">Add Sale</a>
@endif
				<!-- form itself -->
				<form id="test-form"  role="form" action="{{ route('admin.sales.store') }}" method="POST" class="mfp-hide white-popup-block">
          @csrf
          <h4>Sales Form</h4>
					<fieldset style="border:0;">
						
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Date</label>
                  <input class="form-control" type="date" name="sale_date" value="{{ (isset($is_update)) ? date('Y-m-d', strtotime($edit_sale[0]->date)) : date('Y-m-d') }}"
                  required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>G.P No</label>
                  <input class="form-control" type="text" name="gp_no" value="{{ @$edit_sale[0]->gp_no }}" required >
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label>Vehical No</label>
                    <input class="form-control" name="vehicle_no" type="text" id="vehicle_no"  value="{{ @$edit_sale[0]->vehicle_no }}"
                    required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                  <label>Account/Dealar </label>                        
                  <select class="form-control select2" style="width: 100%;"  id="account_name" type="text" name="account_name"   required>
                      <option value="">Select Accounts </option>
                      @foreach($accounts AS $account)
                        <option value="{{ $account->hashid }}" @if(@$edit_sale[0]->account_id == $account->id) selected @endif>{{ $account->name }}</option>
                      @endforeach
                  </select>
                  </div>
                </div>  
              <div class="col-md-6">
                  <div class="form-group">
                      <label>Sub Dealer / Farmer</label>
                      <input class="form-control" name="sub_dealer_name" type="text" id="sub_dealer_name"  value="{{ @$edit_sale[0]->sub_dealer_name }}"
                      required>
                  </div>
                </div>
                          
                          
            </div>
            @if(isset($is_update))
              <input type="hidden" value="{{$item_count}}" id="countingitem">
              @for ($i = 0; $i < $item_count; $i++) 
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label>Item </label>                        
                    <select class="form-control select2" style="width: 100%;"  type="text" name="item_id{{$i+1}}"  style="padding:0px;"   required>
                      <option value="">Select item</option>
                      @foreach($items AS $item)
                        <option value="{{ $item->hashid }}" @if(@$item_detail[$i]->item_id == $item->id) selected @endif>{{ $item->name }}</option>
                      @endforeach                               
                    </select>
                    </div>
                  </div>  
                  <div class="col-md-3">
                    <div class="form-group">
                    <label>Bags </label>
                    <input class="form-control" type="number"  name="bags" id="bags{{$i+1}}" value="{{ @$item_detail[$i]->quantity }}" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Rate</label>
                      <input class="form-control" name="rate" type="number" id="rate{{$i+1}}"  value="{{ @$item_detail[$i]->item->price }}"
                      required>
                    </div>
                  </div>
                </div>
                
                
                @endfor
                @endif
            <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Fare  </label>
                    <input class="form-control" type="number" name="fare_value" id="fare_val" value="{{ @$edit_sale[0]->fare }}" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Commission %</label>                        
                    <input class="form-control"  type="number" id="commission" name="commission" value="{{ @$edit_sale[0]->account->commission }}"
                    required readonly>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Discount </label>
                    <input class="form-control"  type="number" id="discount" name="discount" value="{{ @$edit_sale[0]->account['discount'] }}"
                    required readonly>
                  </div>
                </div>
                
            </div>
            <div class="row">
              <div class="col-md-4">
                  <div class="form-group">
                  <label>Fare Status </label>                        
                  <select class="form-control select2" style="width: 100%;"  type="text" name="fare_status" id="fare_status" style="padding:0px;"   required>
                  <option value="">Select fare status</option>
                                <option value="1">Paid</option>
                                <option value="0">Not paid</option>                              
                  </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Sale Amount</label>
                    <input class="form-control" type="number" name="bags_value" id="bags_value" value="{{ @$edit_sale[0]->bag_rate }}"
                    required>
                  </div>
                </div>  
              <div class="col-md-4">
                  <div class="form-group">
                    <label>Net Value </label>
                    <input class="form-control" type="number" name="net_value" id="net_val" value="{{ @$edit_sale[0]->net_ammount }}" required>
                  </div>
                </div>
              </div>
              
						<div class="form-group">
							<label class="form-label" for="textarea">Remarks</label>
							<br>
							<textarea class="form-control" id="textarea" name="remarks" type="text" id="remarks"  value="{{ @$edit_sale[0]->remarks }}"></textarea>
						</div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input type="hidden" name="sale_id" value="{{ @$edit_sale[0]->hashid }}">
                  <button type="submit" name="save_sale" class="btn btn-success "><i class="fa fa-check"></i> save</button>
                </div>
              </div>
            </div>
					</fieldset>
				</form>
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box --> 
      <div class="box">
				<div class="box-header with-border">
				  <h2 class="box-title text-dark">All Sales Entries</h2>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example" class="table text-fade table-bordered table-hover display nowrap margin-top-10 w-p100">
						<thead>
							<tr class="text-dark">
                <th>Id.No</th>
                <th>Date</th>
                <th> Vehicle No </th>
                <th>GP NO</th>
                <th> Account Name </th>
                <th> Subdealer Name</th>
                <th> Item Name </th>
                <th> No Of Bags </th>
                <th> Rate </th>
                <th> Sale Value </th>
                <th> Fare </th>
                <th> Discount </th>
                <th> Commission </th>
                <th> Net Value </th>
                <th>Action</th>
							</tr>
						</thead>
						<tbody>
              @foreach($outwards AS $outward)
                <tr style="border-color:black;">
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ date('m-D-Y', strtotime($outward->date)) }}</td>
                  <td>{{ $outward->vechicle_no }}</td>
                  <td>{{ $outward->gp_no }}</td>
                  <td>{{ @$outward->account->name }}</td>
                  <td>{{ $outward->sub_dealer_name }}</td>
                  <td>{{ @$outward->item->name }}</td>
                  <td>{{ $outward->no_of_bags }}</td>
                  <td>{{ $outward->rate }}</td>
                  <td>{{ $outward->sale_value }}</td>

                  <td>{{ $outward->fare }}</td>
                  <td>{{ @$outward->account->discount }}</td>
                  <td>{{ @$outward->account->commission }}</td>
                  <td>{{ @$outward->net_value }}</td>
                  
                  <td width="120">
                    <a href="{{route('admin.sales.edit', $outward->hashid)}}" class="popup-with-form btn btn-primary btn-xs waves-effect waves-light"  >
                        <i class="fas fa-edit"></i>
                    </a>
                    <button type="button" onclick="ajaxRequest(this)" data-url=""  class="btn btn-danger btn-xs waves-effect waves-light">
                    <i class="fa-sharp fa-solid fa-plus"></i> &nbsp Post
                    </button>
                  </td>
                </tr>
              @endforeach
						</tbody>
            	
					</table>
					</div>              
				</div>
				<!-- /.box-body -->
			  </div>
                 {{-- <div  class="row ml-2">
                   <div class="col-md-3">
                     <div class="form-group center">
                       <label>Parent Name</label>
                       <select class="form-control js-example-basic-multiple"  type="text" name="account_name"   required>
                           <option  value="" > Feed Debtor </option>
                         
                       </select>
                     </div>
                   </div>
                   <div class="col-md-3">
                     <div class="form-group center">
                       <label>Account Name</label>
                       <select class="form-control js-example-basic-single"  type="text" name="account_name"   required>
                         <option value="">Select Account</option>
                       </select>
                     </div>
                   </div>
 
                   <div class="col-md-2 ">
                     <div class="form-group ">
                       <label>Item Name</label>
                       <select class="form-control js-example-basic-multiple"  type="text" name="account_name"   required>
                         <option  value="5c" > All Sales Item</option>
                        
                         
                       </select>
                     </div>
                   </div>
                   <div class="col-md-2 mt">
                     <div class="form-group ">
                       <label>From Date</label>
                       <input class="form-control" type="date" name="sale_date" value=""
                             required>
                     </div>
                   </div>
                   <div class="col-md-2">
                     <div class="form-group ">
                       <label>To Date</label>
                       <input class="form-control" type="date" name="sale_date" value=""
                             required>
                     </div>
                   </div>
                                 
                 </div>   --}}
               {{-- <div class="card-block mcontainer">
               <table class="table table-striped table-bordered table-hover table-checkable order-column display" id="example" style="width:100%">
                 <thead>
                     <tr>
                       <th>Id.No</th>
                       <th>Date</th>
                       <th> Account Name </th>
                       <th> Item Name </th>
                       <th> No Of Bags </th>
                       <th> Bags Rate </th>
                       <th> Net Value </th>
                       <th> Remarks </th>
                       <th> Action </th>
                       
                     </tr>
                 </thead>
                 <tbody>
                 @foreach($sales AS $sale)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ date('d-M-Y', strtotime($sale->date)) }}</td>
                    <td>{{ $sale->account->name }}</td>
                    <td>{{ $sale->item->name }}</td>
                    <td>{{ @$sale->no_of_bags }}</td>
                    <td>{{ $sale->bag_rate }}</td>
                    <td>{{ $sale->net_ammount }}</td>
                    <td>{{ $sale->remarks }}</td>
                    <td width="120">
                      <a href="{{route('admin.sales.edit', $sale->hashid)}}"  class="popup-with-form btn btn-primary btn-xs waves-effect waves-light">
                          <i class="fas fa-edit"></i>
                      </a>
                      <button type="button" onclick="ajaxRequest(this)" data-url="{{ route('admin.sales.delete', $sale->hashid) }}"  class="btn btn-danger btn-xs waves-effect waves-light">
                          <i class="fas fa-trash"></i>
                      </button>
                  </td>
                  </tr>
                 @endforeach
                     
                 </tbody>
                 <tfoot>
                   
                 </tfoot>
               </table> --}}
               
             </div> 
           </div>
         </div>
      </div>
 
      
 </div>

 @endsection

@section('page-scripts')
@include('admin.partials.datatable')
	

<script>
$(document).ready(function() {
  var loop_time = $("#countingitem").val();
    for (let i = 0; i <= loop_time.length; i++) {
      console.log(i);
    }
      });

  $('#account_name').change(function(){
    var id = $(this).val();
    alert(id);
    var url = '{{ route("admin.sales.account_details", ":id") }}';
    url = url.replace(':id', id);
    $.ajax({
            url: url,
            
            type: 'GET',
            success: function(resp){
              $('#commission').val(resp.account.commission);
              $('#discount').val(resp.account.discount);
            
            },
            error: function(){
                console.log("no response");
            }
        });

  });
</script>
@endsection