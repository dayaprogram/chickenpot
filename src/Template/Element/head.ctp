<!-- MENU SECTION -->
<div id="left" style="height: 100%" >
    <div class="media user-media well-small"> <a class="user-link" href="javascript:void(0);"> 

        </a> <br />
        <div class="media-body">
            <h5 class="media-heading"> <?php echo $SiteSettings['site_title'];?> Admin </h5>
            <ul class="list-unstyled user-info">
                <li> <!-- <a class="btn btn-success btn-xs btn-circle" style="width: 10px;height: 12px;"></a> Online --> </li>
            </ul>
        </div>
        <br />
    </div>
    <ul id="menu" class="collapse">
        <li class="panel <?php if ($this->request->params['action'] == 'home') { ?> active <?php } else { ?><?php } ?>"> <a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "home"]); ?>" >  Dashboard </a> </li>

        <?php /* ?>
        <li class="panel <?php if ($this->request->params['action'] == 'settings' or $this->request->params['action'] == 'listuserbank' or $this->request->params['action'] == 'adduserbank') { ?> active <?php } else { ?><?php } ?>"> <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav"> 
                Settings</a>
            <ul  <?php if ($this->request->params['action'] == 'settings' or $this->request->params['action'] == 'listuserbank' or $this->request->params['action'] == 'adduserbank') { ?>class="in" <?php } else { ?>class="collapse"<?php } ?> id="component-nav">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "settings"]); ?>"><i class="icon-angle-right"></i> Admin Details </a></li>
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "listuserbank"]); ?>"><i class="icon-angle-right"></i> Data Entry User List </a></li>					
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "adduserbank"]); ?>"><i class="icon-angle-right"></i> Add Data Entry User </a></li>
            </ul>
        </li>
        <?php */ ?>
        
        <li class="panel <?php if ($this->request->params['controller'] == 'SiteSettings') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#sitesettings"> Site Settings </a>
            <ul class="<?php echo $this->request->params['controller'] == 'SiteSettings' ? 'in' : 'collapse' ?>" id="sitesettings">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "SiteSettings", "action" => "logo"]); ?>"><i class="icon-angle-right"></i> Logo Management </a></li>					
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "SiteSettings", "action" => "sitedetail"]); ?>"><i class="icon-angle-right"></i> Site Settings </a></li>
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "SiteSettings", "action" => "siteseo"]); ?>"><i class="icon-angle-right"></i> SEO Settings </a></li>
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "SiteSettings", "action" => "sitesociials"]); ?>"><i class="icon-angle-right"></i> Social Settings </a></li>
                <!-- <li class=""><a href="<?php echo $this->Url->build(["controller" => "SiteSettings", "action" => "sitemap"]); ?>"><i class="icon-angle-right"></i> Site Map </a></li> -->
            </ul>
        </li>        
        
        
        
        <li class="panel <?php if ($this->request->params['controller'] == 'Doctors') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#doctors"> Doctors </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Doctors' ? 'in' : 'collapse' ?>" id="doctors">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Doctors", "action" => "index"]); ?>"><i class="icon-angle-right"></i> Doctors List </a></li>					
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Doctors", "action" => "add"]); ?>"><i class="icon-angle-right"></i> Add Doctors </a></li>
            </ul>
        </li>        


        <li class="panel <?php if ($this->request->params['controller'] == 'Users') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#users"> Patients </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Users' ? 'in' : 'collapse' ?>" id="users">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "listuser"]); ?>"><i class="icon-angle-right"></i> Patient List </a></li>					
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "add"]); ?>"><i class="icon-angle-right"></i> Add Patient </a></li>
            </ul>
        </li> 




        <li class="panel <?php if ($this->request->params['controller'] == 'Contents') { ?> active <?php } else { ?> '' <?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#contents"> Contents </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Contents' ? 'in' : 'collapse' ?>" id="contents">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Contents", "action" => "index"]); ?>"><i class="icon-angle-right"></i> Contents List </a></li>					
            </ul>
        </li>        

        <li class="panel <?php if ($this->request->params['controller'] == 'Contacts') { ?> active <?php } else { ?> '' <?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#contact"> Contacts </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Contacts' ? 'in' : 'collapse' ?>" id="contact">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Contacts", "action" => "index"]); ?>"><i class="icon-angle-right"></i> Contacts List </a></li>					
            </ul>
        </li>

        <li class="panel <?php if ($this->request->params['controller'] == 'Faqs') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#faq"> FAQ </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Faqs' ? 'in' : 'collapse' ?>" id="faq">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Faqs", "action" => "index"]); ?>">
                        <i class="icon-angle-right"></i> FAQ List </a></li>					
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Faqs", "action" => "add"]); ?>">
                        <i class="icon-angle-right"></i> Add FAQ </a></li>
            </ul>
        </li>        

        
        <li class="panel <?php if ($this->request->params['controller'] == 'Newses') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#newses"> News and Announcements </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Newses' ? 'in' : 'collapse' ?>" id="newses">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Newses", "action" => "index"]); ?>">
                        <i class="icon-angle-right"></i> News List </a></li>					
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Newses", "action" => "add"]); ?>">
                        <i class="icon-angle-right"></i> Add News </a></li>
            </ul>
        </li>       
        
        <li class="panel <?php if ($this->request->params['controller'] == 'Newsletters') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#newsleters"> Newsletters </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Newsletters' ? 'in' : 'collapse' ?>" id="newsleters">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Newsletters", "action" => "index"]); ?>">
                        <i class="icon-angle-right"></i> Newsletter List </a></li>					
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Newsletters", "action" => "add"]); ?>">
                        <i class="icon-angle-right"></i> Add Newsletter </a></li>
            </ul>
        </li>  
        
        <li class="panel <?php if ($this->request->params['controller'] == 'Treatments') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#treatment"> Treatments </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Treatments' ? 'in' : 'collapse' ?>" id="treatment">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Treatments", "action" => "index"]); ?>">
                        <i class="icon-angle-right"></i> Treatment List </a></li>					
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Treatments", "action" => "add"]); ?>">
                        <i class="icon-angle-right"></i> Add Treatment </a></li>
            </ul>
        </li>        
        
        <?php //pr($appTreatment); exit; ?>
        <?php if($appTreatment){ ?>
        
        <li class="panel <?php if ($this->request->params['controller'] == 'SubTreatments') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#streatment"> Sub Treatments </a>
            <ul class="<?php echo $this->request->params['controller'] == 'SubTreatments' ? 'in' : 'collapse' ?>" id="streatment">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "SubTreatments", "action" => "index"]); ?>">
                        <i class="icon-angle-right"></i> Sub Treatments List </a></li>					
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "SubTreatments", "action" => "add"]); ?>">
                        <i class="icon-angle-right"></i> Add Sub Treatment </a></li>
            </ul>
        </li>
        
        <?php } ?>
        
        
        <li class="panel <?php if ($this->request->params['controller'] == 'Sliders') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#hslide"> Home Sliders </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Sliders' ? 'in' : 'collapse' ?>" id="hslide">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Sliders", "action" => "index"]); ?>">
                        <i class="icon-angle-right"></i> Slider List </a></li>					
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Sliders", "action" => "add"]); ?>">
                        <i class="icon-angle-right"></i> Add Slider </a></li>
            </ul>
        </li>        

        <li class="panel <?php if ($this->request->params['controller'] == 'Questions') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#question"> Questions </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Questions' ? 'in' : 'collapse' ?>" id="question">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Questions", "action" => "index"]); ?>">
                        <i class="icon-angle-right"></i> Question List </a></li>					
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Questions", "action" => "add"]); ?>">
                        <i class="icon-angle-right"></i> Add Question </a></li>
            </ul>
        </li>        
        
        <li class="panel <?php if ($this->request->params['controller'] == 'Medicines') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#medicine"> Medicines </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Medicines' ? 'in' : 'collapse' ?>" id="medicine">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Medicines", "action" => "index"]); ?>">
                        <i class="icon-angle-right"></i> Medicine List </a></li>					
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Medicines", "action" => "add"]); ?>">
                        <i class="icon-angle-right"></i> Add Medicine </a></li>
            </ul>
        </li>        
        
        
        <?php /* ?>
        <li class="panel <?php if ($this->request->params['controller'] == 'Runs') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#form-nav"> Run </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Runs' ? 'in' : 'collapse' ?>" id="form-nav">

                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Runs", "action" => "index"]); ?>"><i class="icon-angle-right"></i> Run List </a></li>					
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Runs", "action" => "add"]); ?>"><i class="icon-angle-right"></i> Add Run </a></li>
            </ul>
        </li>		  

        <li class="panel <?php if ($this->request->params['controller'] == 'Customers') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#customers"> Customers </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Customers' ? 'in' : 'collapse' ?>" id="customers">

                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Customers", "action" => "index"]); ?>"><i class="icon-angle-right"></i> Customers List </a></li>					
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Customers", "action" => "add"]); ?>"><i class="icon-angle-right"></i> Add Customers </a></li>
            </ul>
        </li>

        <li class="panel <?php if ($this->request->params['controller'] == 'Suppliers') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#suppliers"> Suppliers </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Suppliers' ? 'in' : 'collapse' ?>" id="suppliers">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Suppliers", "action" => "index"]); ?>"><i class="icon-angle-right"></i> Suppliers List </a></li>					
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Suppliers", "action" => "add"]); ?>"><i class="icon-angle-right"></i> Add Suppliers </a></li>
            </ul>
        </li>		  

        <li class="panel <?php if ($this->request->params['controller'] == 'Products') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#prod"> Products </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Products' ? 'in' : 'collapse' ?>" id="prod">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Products", "action" => "index"]); ?>"><i class="icon-angle-right"></i> Products List </a></li>					
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Products", "action" => "add"]); ?>"><i class="icon-angle-right"></i> Add Products </a></li>
            </ul>
        </li>

        <li class="panel <?php if ($this->request->params['controller'] == 'Orders') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#ord"> Orders </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Orders' ? 'in' : 'collapse' ?>" id="ord">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Orders", "action" => "index"]); ?>"><i class="icon-angle-right"></i> Orders List </a></li>					
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Orders", "action" => "add"]); ?>"><i class="icon-angle-right"></i> Add Orders </a></li>
            </ul>
        </li>

        <li class="panel <?php if ($this->request->params['controller'] == 'Templates') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#ordtemp"> Order Templets </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Templates' ? 'in' : 'collapse' ?>" id="ordtemp">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Templates", "action" => "index"]); ?>"><i class="icon-angle-right"></i> Order Templets List </a></li>					
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Templates", "action" => "add"]); ?>"><i class="icon-angle-right"></i> Add Order Templets </a></li>
            </ul>
        </li>

        <li class="panel <?php if ($this->request->params['controller'] == 'Reports') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#report"> Reports </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Reports' ? 'in' : 'collapse' ?>" id="report">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Reports", "action" => "index"]); ?>"><i class="icon-angle-right"></i> Run Reports </a></li>
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Reports", "action" => "packing"]); ?>"><i class="icon-angle-right"></i> Packing Reports </a></li>									
            </ul>
        </li>




        <li class="panel <?php if ($this->request->params['action'] == 'generaluser' or $this->request->params['action'] == 'generaluseredit') { ?> active <?php } else { ?><?php } ?>"> <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#pagesr-nav"> 
                Users </a>
            <ul <?php if ($this->request->params['action'] == 'generaluser' or $this->request->params['action'] == 'generaluseredit') { ?>class="in" <?php } else { ?>class="collapse"<?php } ?> id="pagesr-nav">
                <li><?php echo $this->Html->link(__('> User List'), ['controller' => 'users', 'action' => 'generaluser']) ?></li>

            </ul>
        </li>	
        <?php */ ?>
    </ul>
</div>
<!--END MENU SECTION --> 