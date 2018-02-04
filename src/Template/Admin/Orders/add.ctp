<?php use Cake\Routing\Router; 
$price_product = array();
foreach($products as $pval) {
	$price_product[$pval->id] = array('p1'=>$pval->p1, 'p2'=>$pval->p2, 'p3'=>$pval->p3, 'p4'=>$pval->p4, 'p5'=>$pval->p5); 
}
									
?>

<script>
	var final_price = 0; 
	var countBoxPhotos = 1000 ;
	var customer_dtls = JSON.parse('<?php echo json_encode($customers->toArray());?>');
	
	function getFinalDetail(tempId){
		//alert('ok');
		var runVal = document.getElementById("runVal").innerHTML;
		var gpVal = document.getElementById("gpVal").value;
		var custId = document.getElementById("customer_id").value;
		var runData = document.getElementById("run_name").value;		

		$.ajax({
            url: '<?php echo Router::url(array('controller'=>'Orders','action'=>'getFinalDetail'));?>',
            type: 'POST',
            data: {id : tempId,gpVal: gpVal,custId: custId,runData: runData},
            dataType: "html",
            async: false,
           	success: function(respsText) {
				//alert(respsText);
				if(respsText != 0){
					final_price = parseFloat(respsText); 
				} 
            }
	    });			
	}	
	
	
	function getCustValues(custId){
		//alert(custId);
		$.ajax({
            url: '<?php echo Router::url(array('controller'=>'Orders','action'=>'getCustomerLocation'));?>',
            type: 'POST',
            data: {id : custId},
            dataType: "html",
            async: false,
           	success: function(respsText) {
				if(respsText != "blank"){
					$('#location').html(respsText);
				} else {
					alert("No Address Exist With This Customer");
				}
            }
	    });			
	}
	
	
	function getCustDetail(custId){
		for(var a in customer_dtls) {
			if(customer_dtls[a].id == custId) {
				$("#customer_name").val(customer_dtls[a].name);
				$("#gpVal").val(customer_dtls[a].group_priority);
			}
		}
		
		/*$.ajax({
            url: '<?php echo Router::url(array('controller'=>'Orders','action'=>'getCustomerDetail'));?>',
            type: 'POST',
            data: {id : custId},
            dataType: "html",
            async: false,
           	success: function(respsText) {
				//alert(respsText);
				if(respsText != "blank"){ 
	           		respsText = JSON.parse(respsText);				
					$("#customer_name").val(respsText.name);
					$("#gpVal").val(respsText.gpval);
					//final_price = final_price +1;
					//$('#valOrder').html(final_price);
				} else {
					alert("Check Address Detail. Either Address is rong or no Run have selected Address.");
				}				

            }
	    });*/
	}
	
	function getTempleteDetail(custId){
		//alert(custId);
		$.ajax({
            url: '<?php echo Router::url(array('controller'=>'Orders','action'=>'getTempleteDetail'));?>',
            type: 'POST',
            data: {id : custId},
            dataType: "html",
            async: false,
           	success: function(respsText) {
				//alert(respsText);
				if(respsText != "blank"){
					$('#templ').html(respsText);
				} 			

            }
	    });
	}	
	
	
	function getTempleteData(tempId){
		
		var runVal = document.getElementById("runVal").innerHTML;
		var gpVal = document.getElementById("gpVal").value;
		var custId = document.getElementById("customer_id").value;
		var runData = document.getElementById("run_name").value;
		
		//alert(runData); alert(gpVal); alert(custId);
		$.ajax({
            url: '<?php echo Router::url(array('controller'=>'Orders','action'=>'getTempleteData'));?>',
            type: 'POST',
            data: {id : tempId,gpVal: gpVal,custId: custId,runData: runData},
            dataType: "html",
            async: false,
           	success: function(respsText) {
				//alert(respsText);
				//console.log(respsText);
				//var respsText = JSON.parse(respsText);
				//$('#producSummery').html(respsText.view);
				$('#producSummery').html(respsText);				

            }
	    });
	}	
	
	function getNewDetail(val) {
		
		$.ajax({
            url: '<?php echo Router::url(array('controller'=>'Orders','action'=>'getNewDetail'));?>',
            type: 'POST',
            data: {id : val},
            dataType: "html",
            async: false,
           	success: function(respsText) {
				$('#producSummery').html(respsText);
            }
	    });		
		
		//var checkbox = document.getElementById("isnew"); if(checkbox.checked){ document.getElementById('producSummery').style.visibility = 'visible'; } else { document.getElementById('producSummery').style.visibility = 'hidden'; }
	}	
	
	
	
	function getRunDetail(addrId){
		//alert(addrId);
		$.ajax({
            url: '<?php echo Router::url(array('controller'=>'Orders','action'=>'getRunDetail'));?>',
            type: 'POST',
            data: {id : addrId},
            dataType: "html",
            async: false,
           	success: function(respsText) {
				if(respsText != "blank"){ 					
	           		respsText = JSON.parse(respsText); 
					//alert(respsText.name);					
					$("#address_name").val(respsText.name);
					$("#run_id").val(respsText.rid);
					$("#run_name").val(respsText.rname);				
					$('#runVal').html(respsText.rname);
					$('#runValf').html(respsText.rname);					
					//var tmp= document.getElementById('#runValf').value; alert(tmp);
				} else {
					alert("Check Address Detail. Either Address is rong or no Run have selected Address.");
				}
            }
	    });
	}	
 function addExpPhotos() {      
	   //alert(final_price);
	   var str = '<div class="form-group" id="del'+countBoxPhotos+'">'+
					'<div class="input col-md-6">'+
						'<label>Product</label>'+
						'<select data-placeholder="Choose Products" name="product_idn[]" required="required" '+ 
						'class="form-control chzn-select" onchange="change_price(this.value, '+countBoxPhotos+')">'+
						'<option value="">Choose Products</option>'+
						'<?php foreach($products as $pval){?>'+
							'<option value="<?=$pval->id?>"><?=$pval->description?></option>'+
						'<?php } ?>'+
						'</select>'+
					'</div><input type="hidden" id="product_price'+countBoxPhotos+'" name="product_price">'+
					'<input type="hidden" id="old_val'+countBoxPhotos+'" name="old_val'+countBoxPhotos+'" value= "0">'+
					'<div class="input col-md-5">'+
						'<label>Qty</label> <input class="form-control" type="text" required="required" name="product_qtyn[]" id="product_qtyn'+countBoxPhotos+'" onchange="setFinalVAl(this.value,'+countBoxPhotos+')">'+
					'</div>'+	
					'<div class="clearfix"></div>'+
					'<div id="prodDetail'+countBoxPhotos+'"> </div>'+
					'<a href="javascript:void(0)" onclick="delExpPhotos(this.value,'+countBoxPhotos+')" class="btn btn-default">Remove</a>'+			
				'</div>';	   
	    //alert(countBoxPhotos);
        $("#expPhoto").append(str);
        $(".chzn-select").chosen();
        countBoxPhotos += 1;
        //alert(countBoxPhotos);
    }
     
    function delExpPhotos(val,inpid) {	    
	    //alert($("#product_qtyn"+inpid).val()); alert($("#product_price"+inpid).val());  alert(inpid);	    
	    var qty = $("#product_qtyn"+inpid).val();		
	    var price = $("#product_price"+inpid).val();	    
	    var curPrice = parseFloat(qty) * parseFloat(price);
		final_price = parseFloat(final_price) - parseFloat(curPrice);
		$('#valOrder').html(final_price);
	    //alert(curPrice); alert(final_price);
        $("#del"+inpid).remove();
    }	
	
	
	
	
	function change_price(pid, divid) {
		//alert(pid);
		var $product_price = JSON.parse('<?php echo json_encode($price_product);?>');
		if(divid == 0) {
			divid = "";
		}
		for(var $a in $product_price ) {
			if($a == pid) {
				if($("#gpVal").val() == "1") {
					$("#product_price"+divid).val($product_price[$a]['p1']);
					var priceVal = 'p1';
				} else if($("#gpVal").val() == "2") {
					$("#product_price"+divid).val($product_price[$a]['p2']);
					var priceVal = 'p2';
				} else if($("#gpVal").val() == "3") {
					$("#product_price"+divid).val($product_price[$a]['p3']);
					var priceVal = 'p3';
				} else if($("#gpVal").val() == "4") {
					$("#product_price"+divid).val($product_price[$a]['p4']);
					var priceVal = 'p4';
				} else if($("#gpVal").val() == "5") {
					$("#product_price"+divid).val($product_price[$a]['p5']);
					var priceVal = 'p5';
				}
			}
		}
		console.log($product_price);
		
		$.ajax({
            url: '<?php echo Router::url(array('controller'=>'Orders','action'=>'getProductDetail'));?>',
            type: 'POST',
            data: {id : pid, priceVal : priceVal},
            dataType: "html",
            async: false,
           	success: function(respsText) {

				if(respsText != "blank"){
					
					if(divid == 0) {
						$("#prodDetail"+divid).html(respsText);
					} else {
						$("#prodDetail"+divid).html(respsText);
					}
				} else {
					alert("No Address Exist With This Customer");
				}
				
            }
	    });				
	}

	function setFinalVAl(val,inpid){
		
		//alert(val); alert(inpid);
		if(inpid == 0) {
			alert('qq');
			if($("#product_price").val() != ""){
				//alert($("#old_val").val());
				var curPrice = $("#product_price").val() * val;
				var oldPrice = $("#product_price").val() * $("#old_val").val();

				//alert(oldPrice);alert(curPrice);alert(final_price);
				
				
				
				final_price = parseFloat(final_price) + parseFloat(curPrice) - parseFloat(oldPrice) ;
				alert(final_price);
				$('#valOrder').html(final_price);
				$("#old_val").val(val);
			} else {
				alert("Please Choose Product First");
				$("#product_qtyn"+inpid).val('')
				
			}
		} else {
			
			if($("#product_price"+inpid).val() != ""){
				//alert($("#old_val"+inpid).val());
				var curPrice = $("#product_price"+inpid).val() * val;
				var oldPrice = $("#product_price"+inpid).val() * $("#old_val"+inpid).val();
				

				//alert(oldPrice);alert(curPrice); alert(final_price);
				
				final_price = parseFloat(final_price) + parseFloat(curPrice) - parseFloat(oldPrice) ;
				
				//alert(final_price);
				
				$('#valOrder').html(final_price);
				$("#old_val"+inpid).val(val);
			} else {
				alert("Please Choose Product First");
				$("#product_qtyn"+inpid).val('')
				
			}			
		}
	}	
	
	
</script>




<div id="content">
<div class="inner">
<div class="row">
    <div class="col-lg-12">
 		
    </div>
</div>
<hr />
<div class="row">
	  <?=$this->Form->create($order) ?>
    <div class="col-lg-6">
          <div class="box">
            <div id="collapseOne" class="accordion-body collapse in body">
                <div class="col-sm-12">
                    <div class="row">
				    
				   
				    <fieldset>
				        <legend><?= __('Add Order') ?></legend>
						
						<input type="hidden" name="customer_name" id="customer_name" value="" />
						<input type="hidden" name="address_name" id="address_name" value="" />
						<input type="hidden" name="run_id" id="run_id" value="" />
						<input type="hidden" name="run_name" id="run_name" value="" />
						<input type="hidden" name="gpVal" id="gpVal" value="" />

						<div class="form-group">
							<div class="input">
								<label>Order Date : <?=date("Y-m-d")?> </label>
							</div>
						</div>

						<div class="form-group">
							<div class="input">
								<label>Delivery Date : <?=date("Y-m-d", time() + 86400)?> </label>
							</div>
						</div>
						
						<div class="form-group">
						<?php //pr($customers->toArray());
							//echo json_encode($customers->toArray());
						?>
							<div class="input">
								<label>Customer</label>
								<select data-placeholder="Choose Customer" name="customer_id" id="customer_id" required="required" 
								class="form-control chzn-select" onchange="Javascript: getCustValues(this.value); getCustDetail(this.value); getTempleteDetail(this.value);">
								<option value="">Choose Customers</option>
								<?php foreach($customers->toArray() as $custKey=>$custval){?>
									<option value="<?=$custval->id?>"><?=$custval->name?></option>
								<?php } ?>
								</select>
							</div>
						</div>
				        
						<div class="form-group" id="location">
							<div class="input">
								<label>Locations</label>
								<select data-placeholder="Choose Location" name="address_id" id="address_id" required="required" 
								class="form-control chzn-select">
								<option value="">Choose customer to get location</option>
								</select>
							</div>
						</div>
						
						<div class="form-group" id="location">
							<div class="input">
								<label><div id="runVal" >  </div></label>
							</div>
						</div>
						
						<div id="templ">
						<div class="form-group" id="templ">
							<div class="input">
								<label>Order Templets</label>
								<select data-placeholder="Choose templets" name="templete_id" id="templete_id" required="required" 
								class="form-control chzn-select">
								<option value="">Choose customer to get templets</option>
								</select>
							</div>
						</div>						
						
						<!--<input type="checkbox" name="isnew" id="isnew" value="1" onchange="getMeBack(this.value)" > New -->
						</div>
						
						
				    </fieldset>
					<!--  -->
                    </div>
                </div>
            </div>
        </div>
        
        
          <div id="producSummery" >
       
        </div>
        
        
        
        
          <div class="box">
            <div id="collapseOne" class="accordion-body collapse in body">
                <div class="col-sm-12">
                    <div class="row"> <?= $this->Form->button(__('Order Now')) ?> </div>
                </div>
            </div>
        </div>         
        
        
        
        
        
    </div>
      <?= $this->Form->end() ?>
</div>
</div>
</div>


<!--
<div class="orders form large-9 medium-8 columns content">
    <?= $this->Form->create($order) ?>
    <fieldset>
        <legend><?= __('Add Order') ?></legend>
        <?php
            echo $this->Form->input('customer_id', ['options' => $customers, 'empty' => true]);
            echo $this->Form->input('customer_name');
            echo $this->Form->input('address_id', ['options' => $addresses, 'empty' => true]);
            echo $this->Form->input('address_name');
            echo $this->Form->input('run_id', ['options' => $runs, 'empty' => true]);
            echo $this->Form->input('run_name');
            echo $this->Form->input('order_date', ['empty' => true]);
            echo $this->Form->input('delivery_date', ['empty' => true]);
            echo $this->Form->input('comment');
            echo $this->Form->input('payment_status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
-->