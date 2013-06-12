@if(isset($productsData))
		<div class="row" style="margin-left: 20px">
		<div class="span10">
		<form id="formAddNewProduct" onsubmit="return false">
		    <div class="well">
		    <a id="aAddProduct" role="button" data-toggle="modal" href="#modalAddProduct" class="pull-left aCustomAnchors">
		    Add new Product <i class="icon-plus-sign icon-2x"></i>
		    </a>		
			<a class="btn pull-right" id="btnSwapProducts">Swap</a>
			</div>
			<div id="modalAddProduct" class="modal hide fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="addProdModalLabel">Add new product</h3>
				</div>
				<div class="modal-body">
				
			<div class="row-fluid fieldline">
				<div class="span4">
					<label style="text-align: right">Product name</label>
				</div>
				<div class="span4">
					<input type="text" id="txtProductName" required data-id=""/>
				</div>
			</div>
			<div class="row-fluid fieldline">
				<div class="span4">
					<label style="text-align: right">Product Image</label>
				</div>
				<div class="span4">
					<input type="button" value="Add Image" id="btnAddProductImage"/>
					<input id="hdnbtnAddProductImage" type="file" style="display: none">
				</div>
			</div>
			<div class="row-fluid fieldline">
				<div class="span4 offset4" id="divNewAttachmentHolder">
					<table class="hide" id="tableImgAttachmentHolder">
						<thead>
							<tr>
								<th>Include</th>
								<th>Name</th>
								<th>Key</th>								
							</tr>
						</thead>
						<tbody id="tBodyImgAttachmentHolder">

						</tbody>	
					</table>
					<table class="hide">
					<tr id="trImgAttachmentTemplate">
						<td><input type="checkbox" id="chkIncludeFile" data-id="" data-name="" data-url=""></input></td>
						<td>
							<span id="spanIncludeFileName">File Name</span>    	
							{{HTML::image('img/ajax-loader.gif', "uploading", array('id'=>'imgUploaderTemplate'))}}
						</td>
						<td><input type="radio" id="radioKeyImage"></input></td>
					</tr>
					</table>

				</div>			
			</div>			
			<div class="row-fluid fieldline">
				<div class="span4">
					<label style="text-align: right">Category</label>
				</div>
				<div class="span4">
                   <select name="category" class="special required" id="selectProdCategory" required>
                        <option value="">Select Category</option>
                        @if(isset($categoriesData))
                        @foreach($categoriesData as $category)
                        <option value="{{$category->id}}">{{$category->description}}</option>
                        @endforeach
                        @endif
                   </select>				
				</div>
			</div>
			<div class="row-fluid fieldline">
				<div class="span4">
					<label style="text-align: right">Product tagline</label>
				</div>
				<div class="span4">
					<input type="text" id="txtProdTagline"/>
				</div>
			</div>									
			<div class="row-fluid fieldline">
				<div class="span4">
					<label style="text-align: right">Product description</label>
				</div>
				<div class="span4">
					<textarea id="txtProdDesc"></textarea>					
				</div>
			</div>
			<div class="row-fluid">
				<div class="span4">
					<label style="text-align: right">Price</label>
				</div>
				<div class="span2">
					<input class="small" style="margin-right:2px;width:60px" type="text" id="txtProdPrice"> 					 
				</div>
			</div>
																		
			</div>
			<div class="modal-footer">
			<button class="btn btn-primary" id="btnAddProduct" type="submit">Add product to etiqt</button>
			</div>
			</div>
		</form>

<div id="modalConfirmRemoveProduct" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalConfirmRemoveProduct" aria-hidden="true">
<div class="modal-body">
<p>Are you sure, you want to delete this product?</p>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
<button class="btn btn-primary" data-id="1234" id="btnDeleteProduct">Delete Product</button>
</div>
</div>			
			
		</div>
		</div>				
		@for($r=0;$r<ceil(count($productsData)/4);$r++)
			<div id="divProdRows_{{$r+1}}" class="row" style="margin:40px" data-rowVal={{$r+1}} data-lastRow={{$r==ceil(count($productsData)/4)-1}}>				
				@for($c=0;$c<4;$c++)
					@if(count($productsData)>4*$r+$c)
						<div class="span2 divProdHolder">
							<div>
							<?php 
							$keyImg=false;
							foreach($productsData[4*$r+$c]->images as $prodImage){?>

							@if($prodImage->pivot->is_key=="1")
								<img id="imgKeyProd" src="{{$prodImage->url}}">
								
								<?php $keyImg=true;?>
								<?php break;?>
							@endif
							<?php }
							if($keyImg!=true && count($productsData[4*$r+$c]->images)>0)
							{?>
								<img id="imgKeyProd" src="{{$productsData[4*$r+$c]->images[0]->url}}">
							<?php
							}
							elseif($keyImg!=true)
							{?>
								<img id="imgKeyProd" src="">
							<?php
							}
							?>
							</div>
							<div class="productInfo">
							<input type="checkbox" class="product" data-id="{{$productsData[4*$r+$c]->id}}"/>
							<span id="spanProdName" style="margin-left:20px">{{$productsData[4*$r+$c]->name}}</span>
							
							<div id="divProductActionButtons" style="visibility:hidden">
							<i class="icon-edit icon-2x iconEditProduct" data-id="{{$productsData[4*$r+$c]->id}}" data-toggle="modal"></i>
							<i class="icon-remove-sign icon-2x pull-right iconRemoveProduct" data-id="{{$productsData[4*$r+$c]->id}}" data-toggle="modal"></i>							
							</div>
							</div>
						</div>
					@endif
				@endfor
			</div>
		@endfor
		<div id="divNewProdRowTemplate" class="row hide" style="margin:40px" data-lastRow="">
		<div class="span2 divProdHolder hide" id="divNewProdTemplate">
			<div>
			<img id="imgKeyProd" src="">
			</div>
			<div class="productInfo">
			<input type="checkbox" class="product" data-id="" />
			<span id="spanProdName" class="pull-right"></span>
			
			<div id="divProductActionButtons" style="visibility:hidden">
			<i class="icon-edit icon-2x iconEditProduct" data-id="" data-toggle="modal"></i>
			<i class="icon-remove-sign icon-2x pull-right iconRemoveProduct" data-id="" data-toggle="modal"></i>							
			</div>
			</div>									
		</div>
		</div>
		@endif
	{{ HTML::script('js/adminJS/products.js') }}