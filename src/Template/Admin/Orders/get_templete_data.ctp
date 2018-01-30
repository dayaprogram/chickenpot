 <script> $(".chzn-select").chosen(); </script>
          <div class="box">
            <div id="collapseOne" class="accordion-body collapse in body">
                <div class="col-sm-12">
                    <div class="row">
				    <fieldset>
				        <legend><?= __('Items') ?> <a href="javascript:void(0)" onclick="addExpPhotos();" class="btn btn-default">Add More Item</a></legend>
						
						<?php $delids = 1; $final_vals = 0; ?>
						<?php foreach ($tmpOrderJson as $tmpOrderJsonData) { ?>
							
						
						<div class="form-group" id="del<?=$delids?>">
							<div class="input col-md-6">
								<label>Product</label>	
								<select data-placeholder="Choose Products" name="product_idn[]"
								class="form-control chzn-select" onchange="change_price(this.value, 0)">
								<option value="">Choose Products</option>
								<?php $price_product = array(); 
										foreach($products as $pval) {
											$price_product[$pval->id] = array('p1'=>$pval->p1, 'p2'=>$pval->p2, 'p3'=>$pval->p3, 'p4'=>$pval->p4, 'p5'=>$pval->p5); 
									?>
									
									<?php if($tmpOrderJsonData['id'] != $pval->id){ ?>
										<option value="<?=$pval->id?>"> <?=$pval->description?></option>
									<?php } else { ?>
										<option value="<?=$pval->id?>" selected > <?=$pval->description?></option>
									<?php } ?>
								<?php } ?>
								</select>	
							</div>
							
							
							<?php if($tmpOrderJsonData['pricestd'] == 1){ ?>
								<input type="hidden" id="product_price<?=$delids?>" name="product_price" value="<?php echo $tmpOrderJsonData['detail']->p1;?>">
							
							<?php } else if($tmpOrderJsonData['pricestd'] == 2){ ?>
								<input type="hidden" id="product_price<?=$delids?>" name="product_price" value="<?php echo $tmpOrderJsonData['detail']->p2;?>">
							<?php } else if($tmpOrderJsonData['pricestd'] == 3){ ?>
								<input type="hidden" id="product_price<?=$delids?>" name="product_price" value="<?php echo $tmpOrderJsonData['detail']->p3;?>">
							<?php } else if($tmpOrderJsonData['pricestd'] == 4){ ?>
								<input type="hidden" id="product_price<?=$delids?>" name="product_price" value="<?php echo $tmpOrderJsonData['detail']->p4;?>">
							<?php } else if($tmpOrderJsonData['pricestd'] == 5){ ?>
								<input type="hidden" id="product_price<?=$delids?>" name="product_price" value="<?php echo $tmpOrderJsonData['detail']->p5;?>">
							<?php } ?>
							<input type="hidden" id="old_val<?=$delids?>" name="old_val" value= "0">
							<div class="input col-md-5">

 
							<label>Qty</label> <input class="form-control" type="text" name="product_qtyn[]" id="product_qtyn<?=$delids?>" value="<?=$tmpOrderJsonData['qty']?>" onchange="setFinalVAl(this.value,<?=$delids?>)">
							</div>	
							<div class="clearfix"></div>
							
							<?php
								if($tmpOrderJsonData['pricestd'] == "1") {
									$tmpOrderJsonData['finpricestd'] = $tmpOrderJsonData['detail']->p1;
									$new_vals = $tmpOrderJsonData['finpricestd'] * $tmpOrderJsonData['qty'];
								} else if($tmpOrderJsonData['pricestd'] == "2") {
									$tmpOrderJsonData['finpricestd'] = $tmpOrderJsonData['detail']->p2;
									$new_vals = $tmpOrderJsonData['finpricestd'] * $tmpOrderJsonData['qty'];
								} else if($tmpOrderJsonData['pricestd'] == "3") {
									$tmpOrderJsonData['finpricestd'] = $tmpOrderJsonData['detail']->p3;
									$new_vals = $tmpOrderJsonData['finpricestd'] * $tmpOrderJsonData['qty'];
								} else if($tmpOrderJsonData['pricestd'] == "4") {
									$tmpOrderJsonData['finpricestd'] = $tmpOrderJsonData['detail']->p4;
									$new_vals = $tmpOrderJsonData['finpricestd'] * $tmpOrderJsonData['qty'];
								} else if($tmpOrderJsonData['pricestd'] == "5") {
									$tmpOrderJsonData['finpricestd'] = $tmpOrderJsonData['detail']->p5;
									$new_vals = $tmpOrderJsonData['finpricestd'] * $tmpOrderJsonData['qty'];
									
								}

							?>
							
							
							
							
							<div id="prodDetail"> <label class="col-md-6"> <?php echo $tmpOrderJsonData['id']." | ".$tmpOrderJsonData['detail']->description." | ".$tmpOrderJsonData['detail']->weight." | Price : ".$tmpOrderJsonData['finpricestd'];?></label> </div>
							<a href="javascript:void(0)" onclick="delExpPhotos(this.value,'<?=$delids?>')" class="btn btn-default">Remove</a>
									
						</div>
						<?php $final_vals = $final_vals + $new_vals; $delids ++; } ?>
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
								<label>Value of Order : </label> $ <div id="valOrder" ><?=$final_vals?></div>
							</div>
						</div>
						<div class="form-group" id="location">
							<div class="input">
								<label>Run : </label> <div id="runValf" > <?=$tmpOrderJsonData['runData']?> </div>
							</div>
						</div>
				   </fieldset>
                    </div>
                </div>
            </div>
        </div>
