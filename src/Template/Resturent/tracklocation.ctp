	<!--Start Sub Banner-->
   <div class="sub-banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="detail">
						<h1>order now</h1>
						<span>Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.</span>
						<ul>
							<li><a href="index.html">Home</a></li>
							<li><a class="select">Order Now</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="banner-img"></div>
   </div>
   <div class="wave"></div>
   
   <!--End Sub Banner-->

				

   
   
   <!--Start Content-->
	<div class="content">
		
		<!--Start Cash Billing-->
			
			
			<div class="cash-payment">
				<div class="container">
					
					
					
					
					<!--Start Content-->
<div class="content">
    <!--Start Services-->
    <div class="services">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="main-title">
                        <span>Our Location</span>
                    </div>
                </div>
            </div>
 <div class="col-sm-2"></div>
 <form name="trackloc"  method="post">
            <div class="col-sm-6">
                <div class="input-group">
           <input type="radio" name="trackloc" value="rloc" id="plocation" checked>
    <span class="input-group-addon" style="font-size:15px">Jalandhar</span>
      <select class="form-control" id="sel1" onchange="selectloc();" style="font-size:15px" name="findlocation">
                        <option value="">Choose A location</option>
                        <?php
                        foreach ($select_location as $location) {
                          
                            ?>
                            <option value="<?php echo $location['area_code'] ?>" id="location">
                                <?php echo $location['area_name'] ?>
                            </option>
                        <?php } ?>
                    </select>
              
                </div>
               <input type="radio" name="trackloc" value="ploc" id="pickshop">
          <div class="input-group">
                   <button type="button" class="btn btn-success" id="disablepick" style="display:none;">Pick From Shop</button>
                   <button type="button" class="btn btn-danger" id="ablepick" >Pick From Shop</button>
                </div>
                <div class="input-group">
                    <span class="input-group-addon" id="datespn"   style="font-size:15px">Date</span>
                      <input type="text" class="form-control" name="selectdate" id="datepicker">
                </div>
                 <div class="input-group">
                    <span class="input-group-addon"  id="datespn" style="font-size:15px">Time</span>
                   <input type="text" class="form-control" name="selecttime" id="time">
                </div>
            </div>
            <div class="col-sm-2"><button type="submit" class="btn btn-success">Go</button></div>
            <div class="col-sm-2"></div>
            </form>
        </div>
    </div>
</div>
<!--End Services-->
</div>
<!--End Content-->
</div>
			</div>
		<!--End Cash Billing-->
   
   </div>
   <!--End Content-->
   
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
 <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
     <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script>
    $(document).ready(function(){
    $('#time').timepicker({
    timeFormat: 'h:mm p',
    interval: 30,
    minTime: '10',
    maxTime: '6:00pm',
    defaultTime: '11',
    startTime: '10:00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});
});
    </script>

<script>

$("#sel1").change(function () {
    var selectedValue = $(this).text();
   // alert(selectedValue);
    $("#txtBox").val($(this).find("option:selected").attr("value"))
});

</script>

<script>
$("#pickshop").click(function () {
   $("#disablepick").show();
  $("#ablepick").hide();
  $('select[name=IMEI]').prop('disabled',false);
  $('#shell').attr('disabled',true);
});


$("#plocation").click(function () {
   $("#ablepick").show();
  $("#disablepick").hide();
  
});


</script>




