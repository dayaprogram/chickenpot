
<script> $(".chzn-select").chosen(); </script>

<div class="input">
	<label>Order Templets</label>
	<select data-placeholder="Choose Templete" name="templets_id" id="templets_id"  
	class="form-control chzn-select" onchange="Javascript: getTempleteData(this.value); getFinalDetail(this.value);">	
	     <option value="">Choose Templets</option>
	<?php foreach($templ as $templkey => $templval){?>
		<option value="<?=$templkey?>"><?=$templval?></option>
	<?php } ?>
	</select>
	
	<input type="checkbox" name="isnew" id="isnew" value="1" onchange="getNewDetail(this.value)" > New
</div>
