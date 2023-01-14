<nav class="main-nav" role="navigation">

	  <!-- Mobile menu toggle button (hamburger/x icon) -->
	  <input id="main-menu-state" type="checkbox" />
	  <label class="main-menu-btn" for="main-menu-state">
		<span class="main-menu-btn-icon"></span> Toggle main menu visibility
	  </label>

	  <!-- Sample menu definition -->
	  <ul id="main-menu" class="sm sm-blue">			
		<li><a href="#"><i data-feather="home"></i>Dashboard</a>
			<ul>
				<li><a href="index.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Dashboard 1</a></li>
				<li><a href="index2.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Dashboard 2</a></li>	
				<li><a href="index3.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Dashboard 3</a></li>		
			</ul>
		</li>
		<li>
			<a href="{{route('admin.account_types.index')}}">
				<i data-feather="home"></i>
				<span> Account Type </span>
			</a>
		</li>
		<li><a href="#"><i data-feather="file-plus"></i>Items</a>					
		  	<ul>					
			  	<li><a href="{{route('admin.items.add')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Item</a></li>
            	<li><a href="{{route('admin.items.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>All Items</a></li>			
		  	</ul>
		</li> 
		<li>
			<a href="{{route('admin.cash.index')}}">
			<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
				<span> Cash BooK </span>
			</a>
		</li>  
		
		<li>
			<a href="{{route('admin.sales.index')}}">
				<i data-feather="home"></i>
				<span> Sales BooK </span>
			</a>
		</li>
		<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Reports</a>
			  <ul>
					<li>
						<a href="{{route('admin.reports.item')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Item Purchase Report</a>
						<a href="{{route('admin.reports.purchase_book')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Purchase Book Report</a>
						<a href="{{route('admin.reports.sale_book')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Sale Book Report</a>
						<a href="{{route('admin.reports.inward')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Inward Report</a>
						<a href="{{route('admin.reports.outward')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Outward Report</a>
						<a href="{{route('admin.reports.account')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Account Report</a>
					</li>
			  </ul>			  
			</li> 
		<li><a href="#"><i data-feather="box"></i>Purchase BooK</a>			
		  <ul>
						
			<li><a href="{{route('admin.purchases.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Purchase BooK</a>
			  			  
			</li>		
			
		  </ul>		  
		</li>
		<li><a href="#"><i data-feather="lock"></i>Staff &amp; Permission</a>
		  <ul>
			<li><a href="{{route('admin.staffs.all')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Staff</a>
			</li>
			<li><a href="{{route('admin.permissions.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Permissions</a>
			  		  
			</li>
		  </ul>		  
		</li>
		<li>
			<a href="{{route('admin.consumptions.index')}}">
			<i class="fa fa-minus-circle" aria-hidden="true"></i>
				<span> Consumption </span>
			</a>
		</li>
				  
		<li><a href="#"><i data-feather="mail"></i>Formulation</a>
		  <ul>
			<li><a href="{{route('admin.formulations.add')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Formulation</a>			  
			</li>
			<li><a href="{{route('admin.formulations.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>All Formulation</a>	
			</li>			
		  </ul>		  	
		</li>  
		
		
		
		<li><a href="#"><i data-feather="mail"></i>Accounts</a>
			<ul>
			@foreach($grand_parents AS $grand)
						@if($grand->childs->isNotEmpty())
							<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>{{ $grand->name }}</a>

								
									<ul class="nav-second-level">
										@foreach($grand->childs()->get() AS $child)
											<li><a href="{{ route('admin.accounts.add', ['grand_parent_id'=>$grand->hashid, 'parent_id'=>$child->hashid]) }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>{{ $child->name }}</a></li>
										@endforeach
									</ul>
								
							</li>
						@endif
					@endforeach 	
			</ul>
			
		</li> 
	  </ul>
	</nav>

 

