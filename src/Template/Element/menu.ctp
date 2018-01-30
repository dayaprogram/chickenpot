<div class="mega-menu-part">
    <nav class="navbar  navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                
            </div>
            <div class="collapse navbar-collapse js-navbar-collapse">
                <ul class="nav navbar-nav nav-partt">                   
                    <!-- <li><a href="javascript:void(0)">Men</a></li> -->                   
                    <li class="dropdown mega-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="trigger_class">Treatments<b class="caret"></b></a>
                        <ul class="dropdown-menu mega-dropdown-menu row">
                        	<a class="cros"><i class="fa fa-close" aria-hidden="true"  ></i></a>
                            <li class="col-sm-12">
                                <h3>
                                    Treatments
                                </h3>
                            </li>
                            <div class="new row">                            
                                <?php foreach ($appTreatmentList as $menuTreatList) { ?>
                                <div class="item">
                                    <div class="well">
                                        <li class="">
                                            <ul>
                                                <li class="dropdown-header"><a href="<?php echo $this->Url->build(["controller" => "Treatments", "action" => "treatmentdetail", $menuTreatList['slug']]); ?>"> <?php echo $menuTreatList['name'] ?> </a>  </li>
                                                <?php foreach ($menuTreatList['Medicines'] as $menuMedList) { ?>
                                                    <li><a href="<?php echo $this->Url->build(["controller" => "Treatments", "action" => "medicinedetail", $menuMedList['slug']]); ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <?php echo $menuMedList['title'] ?> </a></li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    </div>
                                </div>
                            <?php } ?>
                            </div>
                            <div class="health-list">
                                <ul>
                                    <li><?php echo $this->Html->link('Mens health', ['controller' => 'Categories', 'action' => 'detail', $appCategoryList[0]['slug']]); ?></li>
                                    <li><?php echo $this->Html->link('Womens health', ['controller' => 'Categories', 'action' => 'detail', $appCategoryList[1]['slug']]); ?></li>
                                    <li><?php echo $this->Html->link('Sexual health', ['controller' => 'Categories', 'action' => 'detail', $appCategoryList[2]['slug']]); ?></li>
                                    <li><?php echo $this->Html->link('Travel health', ['controller' => 'Categories', 'action' => 'detail', $appCategoryList[3]['slug']]); ?></li>
                                    <li><?php echo $this->Html->link('General health', ['controller' => 'Categories', 'action' => 'detail', $appCategoryList[4]['slug']]); ?></li>
                                    <li><?php echo $this->Html->link('Skin health', ['controller' => 'Categories', 'action' => 'detail', $appCategoryList[5]['slug']]); ?></li>
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                            <div class="blueback">
                                <p class="closer"><a href="javascript:void(0)">Close <i class="fa fa-chevron-up" aria-hidden="true"></i></a>
                                </p>
                            </div>
                        </ul>
                    </li>
                    <li> <?php echo $this->Html->link('Men', ['controller' => 'Categories', 'action' => 'detail', $appCategoryList[0]['slug']]); ?> </li>
                    <li><?php echo $this->Html->link('Women', ['controller' => 'Categories', 'action' => 'detail', $appCategoryList[1]['slug']]); ?></li>
                    <li><?php echo $this->Html->link('Sexual', ['controller' => 'Categories', 'action' => 'detail', $appCategoryList[2]['slug']]); ?></li>
                    <li><?php echo $this->Html->link('Travel', ['controller' => 'Categories', 'action' => 'detail', $appCategoryList[3]['slug']]); ?></li>
                    <li><?php echo $this->Html->link('About us', ['controller' => 'Contents', 'action' => 'index', "about-us"]); ?></li>
                    <li><a href="<?php echo $this->Url->build(["controller" => "Contents", "action" => "reviews"]); ?>">Reviews</a></li>
                    <li><?php echo $this->Html->link('Delivery', ['controller' => 'Contents', 'action' => 'index', "delivery"]); ?></li>
                    <!--<li class="account">
                        <a href=""><i class="fa fa-user"></i> Account</a>
                        <div class="account-holder">
                            <ul>
                                <?php if ($this->request->session()->check('Auth.User')) { ?>
                                    <li><a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "dashboard"]); ?>">My Account</a></li>                              
                                    <li><a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "signout"]); ?>">Sign Out</a></li>
                                <?php } else if ($this->request->session()->check('Auth.Doctor')) { ?>
                                    <li><a href="<?php echo $this->Url->build(["controller" => "Doctors", "action" => "dashboard"]); ?>">My Account</a></li>                              
                                    <li><a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "logout"]); ?>">Sign Out</a></li>
                                <?php } else { ?>
                                    <li><a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "signin"]); ?>">Login</a></li>
                                    <li><a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "signup"]); ?>">Register</a></li>
                                <?php } ?>

                            </ul>
                        </div> 
                    </li>-->

                    <li class="accounts">
                        <a href="">More</a>
                        <div class="accounts-holder">
                            <ul>
                                <li><a href="<?php echo $this->Url->build(["controller" => "Contacts"]); ?>">Contact Us</a></li>
                                <li><a href="<?php echo $this->Url->build(["controller" => "Treatments", "action" => "allprices"]); ?>">All Prices</a></li>
                                <li><a href="<?php echo $this->Url->build(["controller" => "Newses", "action" => "index"]); ?>">News</a></li>
                                <li><?php echo $this->Html->link('Refunds', ['controller' => 'Contents', 'action' => 'index', "return-and-refunds"]); ?></li>
                                <li><?php echo $this->Html->link('How it works', ['controller' => 'Contents', 'action' => 'index', "how-it-works"]); ?></li>
                                <li><?php echo $this->Html->link('Regulated', ['controller' => 'Contents', 'action' => 'index', "regulated"]); ?></li>
                                <li><?php echo $this->Html->link('FAQs', ['controller' => 'Faqs', 'action' => 'index']); ?></li>                                
                                
                            </ul>
                        </div>
                    </li>
                </ul>
            </div><!-- /.nav-collapse -->
    </nav>
</div> 
 <style>
  .new.row {
 -moz-column-width: 18em;
 -webkit-column-width: 18em;
 -moz-column-gap: 1em;
 -webkit-column-gap:1em; 
  width:97%;
  padding:0;
  margin:0 auto;float:none;
}

.item {
 display: inline-block;
 padding:  .25rem;
 width:  100%; 
}

.well {
 position:relative;
 display: block;
 background: none;
 border: 0;
 box-shadow: none;
 margin-bottom:0;padding:5px;
}
.well ul{list-style:none;padding:0}
.well ul li a{color:rgb(5, 133, 195)  !important}
.well ul li a:hover {background:none !important;color:#ddd !important}
 </style>
 <script>
        $("#trigon").click(function(){
            //$('trigger_class').trigger();
            alert();
        })
 </script>