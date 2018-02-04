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
					
					
					<!--Start Bread Crumb-->
					
					
					
					
					<!--Start Bread Crumb-->
					
					<div class="row">
						<div class="col-md-12">
							<div class="cash-delivery">
								<div class="cash-delivery-detail">
									<h5>Customer information</h5>
                                                                        <div class="form">
                                                                           
									 <?php echo $this->Form->create('',['enctype'=>"multipart/form-data",'class' => 'form-horizontal', 'id' => 'user-validate']);?>
                                                                          
                                                                            <input  type="text" name="lmane" value="<?php echo $userdetails['first_name']?>">
										 <input class="right"  type="text" placeholder="email" name="email" value="<?php echo $userdetails['email']?>">
                                                                                  <input class="right"  type="text" name="phone" value="<?php echo $userdetails['phone']?>">
                                                                                   <input type="text" name="address" placeholder="Address" value="<?php echo $userdetails['address']?>">
                                                                                   <input  type="text" name="city" value="<?php echo $userdetails['city']?>">
										</div>
                                                                            <input type="submit" class="next-step" value="Continue to shipping method">
										
                                                                         </form>
									</div>
									
									<div class="already-account">
										<span>Already have an account with us? <a href="#.">Login</a></span>
									</div>
									
								</div>
							</div>
						</div>
					</div>
					
					
					
				</div>
			</div>
		<!--End Cash Billing-->
   
   </div>
   <!--End Content-->
	
	