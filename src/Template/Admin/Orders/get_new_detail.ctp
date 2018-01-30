<script> $(".chzn-select").chosen(); </script>

<div id="collapseOne" class="accordion-body collapse in body">
        <div class="col-sm-12">
            <div class="row">
		    <fieldset>
		        <legend><?= __('Items') ?> <a href="javascript:void(0)" onclick="addExpPhotos();" class="btn btn-default">Add More Item</a></legend>
				<div class="form-group">
					<div class="input col-md-6">
						<label>Product</label>	
						<select data-placeholder="Choose Products" name="product_idn[]"
						class="form-control chzn-select" onchange="change_price(this.value, 0)">
						<option value="">Choose Products</option>
						<?php $price_product = array(); 
								foreach($products as $pval) {
									$price_product[$pval->id] = array('p1'=>$pval->p1, 'p2'=>$pval->p2, 'p3'=>$pval->p3, 'p4'=>$pval->p4, 'p5'=>$pval->p5); 
							?>
							<option value="<?=$pval->id?>"> <?=$pval->description?></option>
						<?php } ?>

						
						</select>
						
					</div>
					
					<input type="hidden" id="product_price" name="product_price">
					<input type="hidden" id="old_val" name="old_val" value= "0">
					<div class="input col-md-5">
						<label>Qty</label> <input class="form-control" type="text" name="product_qtyn[]" id="product_qtyn0" onchange="setFinalVAl(this.value,0)">
					</div>	
					<div class="clearfix"></div>
					<div id="prodDetail"> </div>
					
							
				</div>
                <div id="expPhoto"></div>		        
		    </fieldset>
            </div>
        </div>
    </div>
</div> 

<div class="box">
    <div id="collapseOne" class="accordion-body collapse in body">
        <div class="col-sm-12">
            <div class="row">
		    <fieldset>
		        <legend><?= __('Summery') ?></legend>
				<div class="form-group">
					<div class="input">
						<label>Value of Order : </label> $ <div id="valOrder" >  0.00 </div>
					</div>
				</div>
				<div class="form-group" id="location">
					<div class="input">
						<label>Run : </label> <div id="runValf" >  </div>
					</div>
				</div>
				<!--
				<div class="form-group">
					<div class="input">
						<div id="valOrder" >  
							<?php echo '<div class="form-group">'.$this->Form->input('payment_status', array('empty' => 'Choose Payment Status', 'label'=>'is Paid ?', 'type'=>'select', 
								'class'=>'form-control', 'options'=>$yesNoCond)).'</div>';?></div>
					</div>
				</div>
				<div class="form-group" id="location">
					<div class="input">
						<label>Comment : </label> <textarea name="comment" id="comment" rows="4" cols="60"></textarea>  </div>
					</div>
				</div>
				-->
		   </fieldset>
            </div>
        </div>
    </div>
</div> 
