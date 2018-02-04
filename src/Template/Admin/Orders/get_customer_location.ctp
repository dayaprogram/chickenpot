
<script> $(".chzn-select").chosen(); </script>

<div class="input">
	<label>Locations</label>
	<select data-placeholder="Choose Location" name="address_id" id="address_id" required="required" 
	class="form-control chzn-select" onchange="Javascript: getRunDetail(this.value);">
	<option value="">Choose Locations</option>
	<?php foreach($address as $addrKey => $addrval){?>
		<option value="<?=$addrKey?>"><?=$addrval?></option>
	<?php } ?>
	</select>
</div>
