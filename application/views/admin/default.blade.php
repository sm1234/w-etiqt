@layout('layouts.base')
@section('title')
{{$title}}
@endsection
@section('h_style')
@parent
        <style type="text/css">
        	body {
        		padding-top: 75px;
        	}
        </style>
@endsection
@section('content')
 <div class="container-fluid" style="max-width: 1000px; margin: 0 auto;">
    	<div class="row-fluid">
  	
		  	<!-- DISPLAY A SELECTOR AND SHOW THE PRODUCTS ACCORDING TO THE SELECTED CATEGORY -->
		  	
			<div class="span4 offset4">
		  	<label class="pull-left">Category&nbsp;</label>
			  <select class="pull-left">
			  <option value="1">Seafood</option>
			  <option value="2">Deserts</option>
			  <option value="3">Snacks</option>
			  <option value="4">Dairy</option>
			  </select>
			</div>
			<div class="span4">
		    <a id="aAddProduct" role="button" data-toggle="modal" href="#myModal" class="pull-right">
		    Add new Product <i class="icon-plus-sign icon-2x"></i>
		    </a>
		    <!-- Modal -->
		<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">Add new product</h3>
			</div>
			<div class="modal-body">
			<div class="row-fluid fieldline">
				<div class="span4">
					<label style="text-align: right">Product name</label>
				</div>
				<div class="span4">
					<input type="text"/>
				</div>
			</div>
			<div class="row-fluid fieldline">
				<div class="span4">
					<label style="text-align: right">Product Image</label>
				</div>
				<div class="span4">
					<input type="button" value="Add Image"/>
				</div>
			</div>
			<div class="row-fluid fieldline">
				<div class="span4">
					<label style="text-align: right">Category</label>
				</div>
				<div class="span4">
                   <select name="category" class="special required">
                        <option value="">Select Category</option>
                        <option value="35">ACCESSORIES</option>
                        <option value="36">ART &amp; MEDIA</option>
                        <option value="39">CLOTHING &amp; SHOES</option>
                        <option value="37">HOME &amp; DECOR</option>
                        <option value="42">KIDS</option>
                        <option value="38">OFFICE &amp; WORKSPACE</option>
                        <option value="43">PETS</option>
                        <option value="41">SPORTS &amp; OUTDOORS</option>
                        <option value="40">TECH &amp; GADGETS</option>
                   </select>				
				</div>
			</div>
			<div class="row-fluid fieldline">
				<div class="span4">
					<label style="text-align: right">Product tagline</label>
				</div>
				<div class="span4">
					<input type="text"/>
				</div>
			</div>									
			<div class="row-fluid fieldline">
				<div class="span4">
					<label style="text-align: right">Product description</label>
				</div>
				<div class="span4">
					<textarea></textarea>					
				</div>
			</div>
			<div class="row-fluid">
				<div class="span4">
					<label style="text-align: right">Price</label>
				</div>
				<div class="span2">
					<input class="small" style="margin-right:2px;width:60px" type="text"> 					 
				</div>
			</div>																		
			</div>
			<div class="modal-footer">
			<button class="btn btn-primary" id="btnAddProduct">Add product to etiqt</button>
			</div>
		</div>			
			</div>
		  </div>
		  
		  	<!-- DIV CONTAINING ALL THE PRODUCT TILES -->
		  
		<div class="row-fluid">
		
		<table class="table table-bordered">
			<tr>
				<td>
					<div>
						<div class="row" style="margin:0px;">
						<div class="span2">
							<img src="{{URL::to_asset('img/em2.jpg')}}" class="img-rounded">
						</div>
						<div class="span10">
							<p class="text-info lead">Product Title1</p>
							<p class="text-info"><small><strong><span>Category1</span></strong></small></p>
							<p class="text-info"><small><strong><span>Tagline of the product1</span></strong></small></p>
							<div class="span2" style="margin-left: 0">
								<p class="text-info"><small><strong><span>Price1</span></strong></small></p>
							</div>
							<div class="span5"></div>
							<div class="span2" style="margin-left: 0">
								<a class="btn btn-info pull-right"><i class="icon-edit icon-large"></i>Edit</a>
							</div>
							<div class="span2" style="margin-left: 0">
								<a class="btn btn-danger pull-right" id="btnRemoveProduct"><i class="icon-trash icon-large"></i>Remove</a>
							</div>
						</div>
						</div>
					</div>
				</td>
			</tr>			
			<tr>
				<td>
					<div>
						<div class="row" style="margin:0px;">
						<div class="span2">
							<img src="{{URL::to_asset('img/em1.jpg')}}" class="img-rounded">
						</div>
						<div class="span10">
							<p class="text-info lead">Product Title2</p>
							<p class="text-info"><small><strong><span>Category2</span></strong></small></p>
							<p class="text-info"><small><strong><span>Tagline of the product2</span></strong></small></p>
							<div class="span2" style="margin-left: 0">
								<p class="text-info"><small><strong><span>Price2</span></strong></small></p>
							</div>
							<div class="span5"></div>
							<div class="span2" style="margin-left: 0">
								<a class="btn btn-info pull-right"><i class="icon-edit icon-large"></i>Edit</a>
							</div>
							<div class="span2" style="margin-left: 0">
								<a class="btn btn-danger pull-right"><i class="icon-trash icon-large"></i>Remove</a>
							</div>
						</div>
						</div>
					</div>
				</td>
			</tr><tr>
				<td>
					<div>
						<div class="row" style="margin:0px;">
						<div class="span2">
							<img src="{{URL::to_asset('img/fancy4.jpg')}}" class="img-rounded">
						</div>
						<div class="span10">
							<p class="text-info lead">Product Title3</p>
							<p class="text-info"><small><strong><span>Category3</span></strong></small></p>
							<p class="text-info"><small><strong><span>Tagline of the product3</span></strong></small></p>
							<div class="span2" style="margin-left: 0">
								<p class="text-info"><small><strong><span>Price3</span></strong></small></p>
							</div>
							<div class="span5"></div>
							<div class="span2" style="margin-left: 0">
								<a class="btn btn-info pull-right"><i class="icon-edit icon-large"></i>Edit</a>
							</div>
							<div class="span2" style="margin-left: 0">
								<a class="btn btn-danger pull-right"><i class="icon-trash icon-large"></i>Remove</a>
							</div>
						</div>
						</div>
					</div>
				</td>
			</tr><tr>
				<td>
					<div>
						<div class="row" style="margin:0px;">
						<div class="span2">
							<img src="{{URL::to_asset('img/fancy6.jpg')}}" class="img-rounded">
						</div>
						<div class="span10">
							<p class="text-info lead">Product Title4</p>
							<p class="text-info"><small><strong><span>Category4</span></strong></small></p>
							<p class="text-info"><small><strong><span>Tagline of the product4</span></strong></small></p>
							<div class="span2" style="margin-left: 0">
								<p class="text-info"><small><strong><span>Price4</span></strong></small></p>
							</div>
							<div class="span5"></div>
							<div class="span2" style="margin-left: 0">
								<a class="btn btn-info pull-right"><i class="icon-edit icon-large"></i>Edit</a>
							</div>
							<div class="span2" style="margin-left: 0">
								<a class="btn btn-danger pull-right"><i class="icon-trash icon-large"></i>Remove</a>
							</div>
						</div>
						</div>
					</div>
				</td>
			</tr>
					
		</table>	
		
		</div>
		
		
    </div>           
@endsection
@section('footer_script')
@parent
{{ HTML::script('js/admin_default.js') }}
@endsection