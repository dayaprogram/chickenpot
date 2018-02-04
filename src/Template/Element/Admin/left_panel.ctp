<!-- MENU SECTION -->
<?php ?>
<div id="left" >
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
    <ul id="menu" class="collapse" style=" width:100%; margin-top:30px;">
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
        
        <!----------------- Site Settings Start ------------------------>
        <?php if(!empty($admin_permissions) && in_array(1, $admin_permissions))
        { ?>
        <li class="panel <?php if ($this->request->params['controller'] == 'SiteSettings') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#sitesettings"> Site Settings </a>
            <ul class="<?php echo $this->request->params['controller'] == 'SiteSettings' ? 'in' : 'collapse' ?>" id="sitesettings">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "SiteSettings", "action" => "logo"]); ?>"><i class="icon-angle-right"></i> Logo Management </a></li>					
<!--                <li class=""><a href="<?php echo $this->Url->build(["controller" => "SiteSettings", "action" => "video"]); ?>"><i class="icon-angle-right"></i> Homepage Video </a></li>-->
<!--                <li class=""><a href="<?php echo $this->Url->build(["controller" => "SiteSettings", "action" => "homecontent"]); ?>"><i class="icon-angle-right"></i> Homepage Management </a></li>-->
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "SiteSettings", "action" => "sitedetail"]); ?>"><i class="icon-angle-right"></i> Site Settings </a></li>
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "SiteSettings", "action" => "siteseo"]); ?>"><i class="icon-angle-right"></i> SEO Settings </a></li>
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "SiteSettings", "action" => "sitesociials"]); ?>"><i class="icon-angle-right"></i> Social Settings </a></li>
<!--                <li class=""><a href="<?php echo $this->Url->build(["controller" => "SiteSettings", "action" => "sitesociials"]); ?>"><i class="icon-angle-right"></i> Social Settings </a></li>-->
<!--                <li class=""><a href="<?php echo $this->Url->build(["controller" => "SiteSettings", "action" => "sitedeliverycharges"]); ?>"><i class="icon-angle-right"></i> Delivery Charges </a></li>-->
<!--                <li class=""><a href="<?php echo $this->Url->build(["controller" => "SiteSettings", "action" => "footermanagement"]); ?>"><i class="icon-angle-right"></i> Footer Management </a></li>-->
                <!-- <li class=""><a href="<?php echo $this->Url->build(["controller" => "SiteSettings", "action" => "sitemap"]); ?>"><i class="icon-angle-right"></i> Site Map </a></li> -->
            </ul>
        </li> 
        <?php
        } ?>
        <!----------------- Site Settings End ------------------------>
        
        <!----------------- Admins Management Start ------------------------>
        <?php if(!empty($admin_permissions) && in_array(2, $admin_permissions))
        { ?>
        <li class="panel <?php if ($this->request->params['controller'] == 'Admins') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#order" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#msgadm"> Admins </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Admins' ? 'in' : 'collapse' ?>" id="msgadm">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Admins", "action" => "index"]); ?>">
                        <i class="icon-angle-right"></i> Admin List </a></li>
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Admins", "action" => "add"]); ?>">
                        <i class="icon-angle-right"></i> Add Admin </a></li>        
            </ul>
        </li>  
        <?php
        } ?>
        <!----------------- Admins Management End ------------------------>
        
        <!----------------- Doctors Management Start ------------------------>
        <?php if(!empty($admin_permissions) && in_array(3, $admin_permissions))
        { ?>
        <li class="panel <?php if (($this->request->params['controller'] == 'Users' && $this->request->params['action'] == 'listdoctor') || ($this->request->params['controller'] == 'Users' && $this->request->params['action'] == 'adddoctor') || ($this->request->params['controller'] == 'Users' && $this->request->params['action'] == 'editdoctor') || ($this->request->params['controller'] == 'Users' && $this->request->params['action'] == 'doctorview') || ($this->request->params['controller'] == 'Users' && $this->request->params['action'] == 'doctorview')) { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#doctors"> Users </a>
            <ul class="<?php if (($this->request->params['controller'] == 'Users' && $this->request->params['action'] == 'listdoctor') || ($this->request->params['controller'] == 'Users' && $this->request->params['action'] == 'adddoctor') || ($this->request->params['controller'] == 'Users' && $this->request->params['action'] == 'editdoctor') || ($this->request->params['controller'] == 'Users' && $this->request->params['action'] == 'doctorview') || ($this->request->params['controller'] == 'Users' && $this->request->params['action'] == 'doctorview')) { ?> in <?php } else { ?> collapse <?php } ?>" id="doctors">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "listdoctor"]); ?>"><i class="icon-angle-right"></i> Users List </a></li>					
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "adddoctor"]); ?>"><i class="icon-angle-right"></i> Add Users </a></li>
            </ul>
        </li>
        <?php
        } ?>
        
        
         <!----------------- Orders Management Start ------------------------>
        <?php //if(!empty($admin_permissions) && in_array(6, $admin_permissions))
        //{ ?>
<!--        <li class="panel <?php if ($this->request->params['controller'] == 'Orders' && $this->request->params['action']!='allorders' && $this->request->params['action']!='orderanalytic' && $this->request->params['action']!='statistics' && $this->request->params['action']!='salesreport' && $this->request->params['action']!='profit_analytic' && $this->request->params['action']!='pendingorders'
                && $this->request->params['action']!='detailpil' && $this->request->params['action']!='details'
                ) { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#order" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#orders"> Orders </a>
            <ul class="<?php echo ($this->request->params['controller'] == 'Orders' && $this->request->params['action']!='allorders' && $this->request->params['action']!='orderanalytic' && $this->request->params['action']!='statistics' && $this->request->params['action']!='salesreport' && $this->request->params['action']!='profit_analytic' && $this->request->params['action']!='pendingorders' && $this->request->params['action']!='detailpil'  && $this->request->params['action']!='details')  ? 'in' : 'collapse' ?>" id="orders">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Orders", "action" => "index"]); ?>">
                        <i class="icon-angle-right"></i> New Orders </a></li>					
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Orders", "action" => "approvedorders"]); ?>">
                        <i class="icon-angle-right"></i> Approved Orders </a></li>
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Orders", "action" => "rejectedorders"]); ?>">
                        <i class="icon-angle-right"></i> Rejected Orders </a></li> 
                    
            </ul>
        </li> -->
        <?php
        //} ?>
        <!----------------- Orders Management End ------------------------>
        
        <!----------------- Shipping Management Start ------------------------>
        <?php //if(!empty($admin_permissions) && in_array(16, $admin_permissions))
        //{ ?>
<!--        <li class="panel <?php if ($this->request->params['controller'] == 'Shippings' && $this->request->params['action']!='allorders' && $this->request->params['action']!='orderanalytic' && $this->request->params['action']!='statistics' && $this->request->params['action']!='salesreport' && $this->request->params['action']!='profit_analytic' && $this->request->params['action']!='pendingorders'
                && $this->request->params['action']!='detailpil' && $this->request->params['action']!='details'
                ) { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#shippings" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#shippings"> Shipping </a>
            <ul class="<?php echo ($this->request->params['controller'] == 'Shippings' && $this->request->params['action']!='allorders' && $this->request->params['action']!='orderanalytic' && $this->request->params['action']!='statistics' && $this->request->params['action']!='salesreport' && $this->request->params['action']!='profit_analytic' && $this->request->params['action']!='pendingorders' && $this->request->params['action']!='detailpil'  && $this->request->params['action']!='details')  ? 'in' : 'collapse' ?>" id="shippings">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Shippings", "action" => "index"]); ?>">
                        <i class="icon-angle-right"></i> Pending </a></li>					
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Shippings", "action" => "approvedorders"]); ?>">
                        <i class="icon-angle-right"></i> Shipped </a></li>
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Shippings", "action" => "delivered"]); ?>">
                        <i class="icon-angle-right"></i> Delivered </a></li> 
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Shippings", "action" => "rejectedorders"]); ?>">
                        <i class="icon-angle-right"></i> Refunded </a></li> 
                    
            </ul>
        </li> -->
        <?php
        //} ?>
        <!----------------- Shipping Management End ------------------------>
        
        <!----------------- Shopping Management Start -------------------------------->
        <?php //if(!empty($admin_permissions) && in_array(7, $admin_permissions))
        //{ ?>
<!--        <li class="panel <?php if ($this->request->params['controller'] == 'Orders' && $this->request->params['action']=='allorders' || $this->request->params['action']=='orderanalytic' ||  $this->request->params['action']=='statistics' || $this->request->params['action']=='salesreport' ||  $this->request->params['action']=='profit_analytic' || $this->request->params['action']=='pendingorders' || $this->request->params['action']=='detailpil' || $this->request->params['action']=='details') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#order" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#shopping"> Shopping </a>
            <ul class="<?php echo ($this->request->params['controller'] == 'Orders' && $this->request->params['action']=='allorders' || $this->request->params['action']=='orderanalytic' ||  $this->request->params['action']=='statistics' || $this->request->params['action']=='salesreport' ||  $this->request->params['action']=='profit_analytic' || $this->request->params['action']=='pendingorders' || $this->request->params['action']=='detailpil' || $this->request->params['action']=='details') ? 'in' : 'collapse' ?>" id="shopping">                 
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Orders", "action" => "allorders"]); ?>">
                        <i class="icon-angle-right"></i> Cart </a></li>
                  <li class=""><a href="<?php echo $this->Url->build(["controller" => "Orders", "action" => "orderanalytic"]); ?>">
               <i class="icon-angle-right"></i> Orders Analytics </a></li>
               <li class=""><a href="<?php echo $this->Url->build(["controller" => "Orders", "action" => "statistics"]); ?>">
               <i class="icon-angle-right"></i> Sales Analytics </a></li>
               <li class=""><a href="<?php echo $this->Url->build(["controller" => "Orders", "action" => "profit_analytic"]); ?>">
               <i class="icon-angle-right"></i> Profit Analytics</a></li> 
               <li class=""><a href="<?php echo $this->Url->build(["controller" => "Orders", "action" => "salesreport"]); ?>">
               <i class="icon-angle-right"></i> Medicines Sales </a></li>  
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Orders", "action" => "pendingorders"]); ?>">
               <i class="icon-angle-right"></i> Pending Deliveries </a></li> 
              
            </ul>
        </li> -->
        <?php
        //} ?>
        <!----------------- Shopping Management End -------------------------------->
        
        <!----------------- Message Management Start -------------------------------->
        <?php //if(!empty($admin_permissions) && in_array(8, $admin_permissions))
        //{ ?>
<!--        <li class="panel <?php if ($this->request->params['controller'] == 'Messages') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#order" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#msgadm"> Inbox </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Messages' ? 'in' : 'collapse' ?>" id="msgadm">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Messages", "action" => "doctorinbox"]); ?>">
                        <i class="icon-angle-right"></i> Doctors Inbox </a></li>
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Messages", "action" => "patientinbox"]); ?>">
                        <i class="icon-angle-right"></i> Patients Inbox </a></li>        
            </ul>
        </li> -->
        <?php
        //} ?>
        <!----------------- Message Management End -------------------------------->
        
        <!----------------- Contents Management Start -------------------------------->
        <?php if(!empty($admin_permissions) && in_array(9, $admin_permissions))
        { ?>
        <li class="panel <?php if ($this->request->params['controller'] == 'Contents') { ?> active <?php } else { ?> '' <?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#contents"> Contents </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Contents' ? 'in' : 'collapse' ?>" id="contents">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Contents", "action" => "index"]); ?>"><i class="icon-angle-right"></i> Contents List </a></li>					
            </ul>
        </li>   
        <?php
        } ?>
        <!----------------- Contents Management End -------------------------------->
        
        
         <!----------------- Message Management End -------------------------------->
        
        <!----------------- Email Templates Management  Start -------------------------------->
        <?php if(!empty($admin_permissions) && in_array(17, $admin_permissions))
        { ?>
        <li class="panel <?php if ($this->request->params['controller'] == 'EmailTemplates') { ?> active <?php } else { ?> '' <?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#email_tpl"> Email Templates </a>
            <ul class="<?php echo $this->request->params['controller'] == 'EmailTemplates' ? 'in' : 'collapse' ?>" id="email_tpl">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "EmailTemplates", "action" => "index"]); ?>"><i class="icon-angle-right"></i> Email Templates List </a></li>					
            </ul>
        </li>   
        <?php
        } ?>
        <!----------------- Email Templates Management End -------------------------------->
         <!----------------- Item Management Start ------------------------>
       
        <?php if(!empty($admin_permissions) && in_array(17, $admin_permissions))
        { ?>
        <li class="panel <?php if ($this->request->params['controller'] == 'Items') { ?> active <?php } else { ?> '' <?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#itm"> Items </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Items' ? 'in' : 'collapse' ?>" id="itm">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Items", "action" => "index"]); ?>"><i class="icon-angle-right"></i> Item List </a></li>					
                 <li class=""><a href="<?php echo $this->Url->build(["controller" => "Items", "action" => "add"]); ?>"><i class="icon-angle-right"></i> Add Item </a></li>	
            </ul>
        </li>   
        <?php
        } ?>
        
        <!----------------- Items Management End ------------------------>
        
        
        
        <!----------------- Contacts Management Start -------------------------------->
        <?php //if(!empty($admin_permissions) && in_array(10, $admin_permissions))
        //{ ?>
<!--        <li class="panel <?php if ($this->request->params['controller'] == 'Contacts') { ?> active <?php } else { ?> '' <?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#contact"> Contacts </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Contacts' ? 'in' : 'collapse' ?>" id="contact">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Contacts", "action" => "index"]); ?>"><i class="icon-angle-right"></i> Contacts List </a></li>					
            </ul>
        </li>-->
        <?php
        //} ?>
        <!----------------- Contacts Management End -------------------------------->
        
        <!----------------- Reviews Management Start -------------------------------->
        <?php //if(!empty($admin_permissions) && in_array(11, $admin_permissions))
        //{ ?>
<!--        <li class="panel <?php if ($this->request->params['controller'] == 'Reviews') { ?> active <?php } else { ?> '' <?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#review"> Reviews </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Reviews' ? 'in' : 'collapse' ?>" id="review">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Reviews", "action" => "index"]); ?>"><i class="icon-angle-right"></i> Reviews List </a></li>					
            </ul>
        </li>-->
        <?php
        //} ?>
        <!----------------- Reviews Management End -------------------------------->
        
        <!----------------- Faq Management Start -------------------------------->
        <?php //if(!empty($admin_permissions) && in_array(12, $admin_permissions))
        //{ ?>
<!--        <li class="panel <?php if ($this->request->params['controller'] == 'Faqs') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#faq"> FAQ </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Faqs' ? 'in' : 'collapse' ?>" id="faq">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Faqs", "action" => "index"]); ?>">
                        <i class="icon-angle-right"></i> FAQ List </a></li>					
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Faqs", "action" => "add"]); ?>">
                        <i class="icon-angle-right"></i> Add FAQ </a></li>   
            </ul>
        </li>    -->
        <?php
        //} ?>
        <!----------------- Faq Management End -------------------------------->
        
        <!----------------- News Management Start -------------------------------->
        <?php //if(!empty($admin_permissions) && in_array(13, $admin_permissions))
        //{ ?>
<!--        <li class="panel <?php if ($this->request->params['controller'] == 'Newses') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#newses"> News and Announcements </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Newses' ? 'in' : 'collapse' ?>" id="newses">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Newses", "action" => "index"]); ?>">
                        <i class="icon-angle-right"></i> News List </a></li>					
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Newses", "action" => "add"]); ?>">
                        <i class="icon-angle-right"></i> Add News </a></li>
            </ul>
        </li>-->
        <?php
        //} ?>
        <!----------------- News Management End -------------------------------->
        
        <?php /*if(!empty($admin_permissions) && in_array(19, $admin_permissions))
        { ?>
        <li class="panel <?php if ($this->request->params['controller'] == 'Properties') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#property"> Property </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Properties' ? 'in' : 'collapse' ?>" id="property">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Properties", "action" => "index"]); ?>">
                        <i class="icon-angle-right"></i> Property List </a></li>					
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Properties", "action" => "add"]); ?>">
                        <i class="icon-angle-right"></i> Add Property </a></li>
            </ul>
        </li>   
        <?php 
        } */ ?>
       
        
         
         <!----------------- Treatments Management Start -------------------------------->
        <?php //if(!empty($admin_permissions) && in_array(15, $admin_permissions))
        //{ ?>
<!--        <li class="panel <?php if ($this->request->params['controller'] == 'Treatments' && $this->request->params['action'] != 'export') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#treatment"> Treatments </a>
            <ul class="<?php echo ($this->request->params['controller'] == 'Treatments'  && $this->request->params['action'] != 'export') ? 'in' : 'collapse' ?>" id="treatment">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Treatments", "action" => "index"]); ?>">
                        <i class="icon-angle-right"></i> Treatment List </a></li>					
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Treatments", "action" => "add"]); ?>">
                        <i class="icon-angle-right"></i> Add Treatment </a></li>
            </ul>
        </li>   -->
        <?php
        //} ?>
        <!----------------- Treatments Management End -------------------------------->
        
        <!----------------- Slider Management Start -------------------------------->
        <?php /* if(!empty($admin_permissions) && in_array(16, $admin_permissions))
        { ?>
        <li class="panel <?php if ($this->request->params['controller'] == 'Sliders') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#hslide"> Home Sliders </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Sliders' ? 'in' : 'collapse' ?>" id="hslide">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Sliders", "action" => "index"]); ?>">
                        <i class="icon-angle-right"></i> Slider List </a></li>					
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Sliders", "action" => "add"]); ?>">
                        <i class="icon-angle-right"></i> Add Slider </a></li>
            </ul>
        </li>   
        <?php
        }*/ ?>
        <!----------------- Slider Management End -------------------------------->
        
        <!----------------- Questions Management Start -------------------------------->
        <?php //if(!empty($admin_permissions) && in_array(17, $admin_permissions))
        //{ ?>
<!--        <li class="panel <?php if ($this->request->params['controller'] == 'Questions') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#question"> Questions </a>
            <ul class="<?php echo $this->request->params['controller'] == 'Questions' ? 'in' : 'collapse' ?>" id="question">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Questions", "action" => "index"]); ?>">
                        <i class="icon-angle-right"></i> Question List </a></li>					
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Questions", "action" => "add"]); ?>">
                        <i class="icon-angle-right"></i> Add Question </a></li>
            </ul>
        </li>  -->
        <?php
        //} ?>
        <!----------------- Questions Management End -------------------------------->

         <!----------------- Order Management Start ------------------------>
        <?php if(!empty($admin_permissions) && in_array(17, $admin_permissions))
        { ?>
       <li class="panel <?php if ($this->request->params['controller'] == 'orderslist') { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#orders"> Order </a>
            <ul class="<?php echo $this->request->params['controller'] == 'orderslist' ? 'in' : 'collapse' ?>" id="orders">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "orderslist", "action" => "index"]); ?>">
                        <i class="icon-angle-right"></i>Order List </a></li>                    
             </ul>
        </li> 
        <?php
        } ?>
        <!----------------- Order Management End ------------------------>
       
        

        
        <!----------------- Medicines Management Start -------------------------------->
        <?php //if(!empty($admin_permissions) && in_array(18, $admin_permissions))
        //{ ?>
<!--        <li class="panel <?php if (($this->request->params['controller'] == 'Medicines') || ($this->request->params['controller'] == 'Treatments' && $this->request->params['action'] == 'export')) { ?> active <?php } else { ?><?php } ?>"> 
            <a href="javascript:void(0)" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#medicine"> Medicines </a>
            <ul class="<?php echo ($this->request->params['controller'] == 'Medicines' || ($this->request->params['controller'] == 'Treatments' && $this->request->params['action'] == 'export'))? 'in' : 'collapse' ?>" id="medicine">
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Medicines", "action" => "index"]); ?>">
                        <i class="icon-angle-right"></i> Medicine List </a></li>					
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Medicines", "action" => "add"]); ?>">
                        <i class="icon-angle-right"></i> Add Medicine </a></li>
                <li class=""><a href="<?php echo $this->Url->build(["controller" => "Treatments", "action" => "export"]); ?>">
                        <i class="icon-angle-right"></i> Medicines Management </a></li>
            </ul>
        </li>   -->
        <?php
        //} ?>
        <!----------------- Medicines Management End -------------------------------->
        
        
    </ul>
</div>
<!--END MENU SECTION --> 