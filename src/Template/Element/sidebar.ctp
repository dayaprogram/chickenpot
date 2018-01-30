<?php 
$controller=$this->request->params["controller"];
$action=$this->request->params["action"];
?>
<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                </span>
                    <div class="dropdown profile-element"> <span>
                            <a href="http://192.168.1.118/bikash/Proptino"><img alt="image" src="<?php echo $this->request->webroot; ?>images/logo.png" style=" width:97px; height: 83px; "/></a></br>
                            <!-- <img alt="image" class="img-circle" src="<?php  echo $this->Url->build('/');?>user_img/<?php echo !empty($user_details->pimg)?$user_details->pimg:'nouser.png' ?>" 
                                 style=" width:60px; height: auto; " /> -->
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"><strong class="font-bold" ><?php echo !empty($user_details->first_name)?$user_details->first_name:""?>&nbsp;<?php echo !empty($user_details->last_name)?$user_details->last_name:""?></strong>
                             </span> <!--    --> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "editprofile"]); ?>">Profile</a></li>
                            <li><a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "changepass"]); ?>">Change Password</a></li>
                            <li><a href="<?php  echo $this->Url->build('/');?>Users/logout">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
              
                
              
               <li class="<?php echo ($controller=="Users" and $action=="dashboard")?"active":""?>">
                    <a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "dashboard"]); ?>"><i class="fa fa-edit"></i> <span class="nav-label">Dashboard</span><span class="fa arrow"></span></a>
                    
                </li>
                <li class="<?php echo $controller=="Properties"?"active":""?>">
                    <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Properties</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php echo ($controller=="Properties" and $action=='add')?"active":'' ?>"><a href="<?php echo $this->Url->build(["controller" => "Properties", "action" => "add"]); ?>">Add a Property</a></li>
                        <li class="<?php echo ($controller=="Properties" and $action=='index')?"active":'' ?>"><a href="<?php echo $this->Url->build(["controller" => "Properties", "action" => "index"]); ?>">All Properties</a></li>
                        
                    </ul>
                </li>
                <li class="<?php echo ($controller=="Users" and ($action=='addcretificate' or $action=='certificates'))?"active":""?>">
                    <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Certificates</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php echo ($controller=="Users" and $action=='addcretificate')?"active":'' ?>"><a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "addcretificate"]); ?>">Add a Certificate</a></li>
                      </ul>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php echo ($controller=="Users" and $action=='certificates')?"active":'' ?>"><a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "certificates"]); ?>">All Certificates</a></li>
                      </ul>
                </li>
                <li class="<?php echo $controller=="Landlords"?"active":""?>">
                    <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Landlords</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php echo ($controller=="Landlords" and $action=="addLandlord")?"active":""; ?>"><a href="<?php echo $this->Url->build(["controller" => "Landlords", "action" => "addLandlord"]); ?>">Add a Landlord</a></li>
                        <li class="<?php echo ($controller=="Landlords" and $action=="index")?"active":""; ?>"><a href="<?php echo $this->Url->build(["controller" => "Landlords", "action" => "index"]); ?>">All  Landlords</a></li>                            
                    </ul>    
                </li>

                <li class="<?php echo $controller=="Tenants"?"active":""?>">
                    <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Tenants</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php echo ($controller=="Tenants" and $action=="index")?"active":""; ?>"><a href="<?php echo $this->Url->build(["controller" => "Tenants", "action" => "add"]); ?>">Add a Tenant</a></li>
                        <li class="<?php echo ($controller=="Tenants" and $action=="index")?"active":""; ?>"><a href="<?php echo $this->Url->build(["controller" => "Tenants", "action" => "index"]); ?>">All  Tenants</a></li>                            
                    </ul>    
                </li>
 <li class="<?php echo $controller=="Guarantors"?"active":""?>">
                    <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Guarantors</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php echo ($controller=="Guarantors" and $action=="addGuarantor")?"active":""; ?>"><a href="<?php echo $this->Url->build(["controller" => "Guarantors", "action" => "addGuarantor"]); ?>">Add a Guarantor</a></li>
                        <li class="<?php echo ($controller=="Guarantors" and $action=="index")?"active":""; ?>"><a href="<?php echo $this->Url->build(["controller" => "Guarantors", "action" => "index"]); ?>">All  Guarantors</a></li>                            
                    </ul> 
                </li>
                <li class="<?php echo $controller=="Idmanegment"?"active":""?>">
                    <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Tanent Id</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php echo ($controller=="Idmanegment" and $action=="add")?"active":""; ?>"><a href="<?php echo $this->Url->build(["controller" => "Idmanegment", "action" => "add"]); ?>">Add Tanent Id</a></li>
                        <li class="<?php echo ($controller=="Idmanegment" and $action=="index")?"active":""; ?>"><a href="<?php echo $this->Url->build(["controller" => "Idmanegment", "action" => "index"]); ?>">All  Tanent Ids</a></li>
                         
                  </ul></li>
                  <li class="<?php echo $controller=="Expense"?"active":""?>">
                    <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Expenses</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php echo ($controller=="Expense" and $action=="add")?"active":""; ?>"><a href="<?php echo $this->Url->build(["controller" => "Expense", "action" => "add"]); ?>">Add an Expense</a></li>
                        <li class="<?php echo ($controller=="Expense" and $action=="index")?"active":""; ?>"><a href="<?php echo $this->Url->build(["controller" => "Expense", "action" => "index"]); ?>">All  Expenses</a></ul></li>

                        <li class="<?php echo $controller=="Applicant"?"active":""?>">
                    <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Applicants</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php echo ($controller=="Applicant" and $action=="add")?"active":""; ?>"><a href="<?php echo $this->Url->build(["controller" => "Applicant", "action" => "add"]); ?>">Add an Applicant</a></li>
                        <li class="<?php echo ($controller=="Applicant" and $action=="index")?"active":""; ?>"><a href="<?php echo $this->Url->build(["controller" => "Applicant", "action" => "index"]); ?>">All  Applicants</a></ul></li>

                        <li class="<?php echo $controller=="Journal"?"active":""?>">
                    <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Journals</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php echo ($controller=="Journal" and $action=="add")?"active":""; ?>"><a href="<?php echo $this->Url->build(["controller" => "Journal", "action" => "add"]); ?>">Add a Journal</a></li>
                        <li class="<?php echo ($controller=="Journal" and $action=="index")?"active":""; ?>"><a href="<?php echo $this->Url->build(["controller" => "Journal", "action" => "index"]); ?>">All  Journals</a></ul></li>

                        <li class="<?php echo $controller=="Propertykey"?"active":""?>">
                    <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">keysLog</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php echo ($controller=="Propertykey" and $action=="add")?"active":""; ?>"><a href="<?php echo $this->Url->build(["controller" => "Propertykey", "action" => "add"]); ?>">Add a Key</a></li>
                        <li class="<?php echo ($controller=="Propertykey" and $action=="index")?"active":""; ?>"><a href="<?php echo $this->Url->build(["controller" => "Propertykey", "action" => "index"]); ?>">All keylog</a></ul></li>

                         <!--li class="<?php echo $controller=="View"?"active":""?>">
                    <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">View</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php echo ($controller=="View" and $action=="add")?"active":""; ?>"><a href="<?php echo $this->Url->build(["controller" => "View", "action" => "add"]); ?>">Add a View</a></li>
                        <li class="<?php echo ($controller=="View" and $action=="index")?"active":""; ?>"><a href="<?php echo $this->Url->build(["controller" => "View", "action" => "index"]); ?>">All View</a></ul></li-->
 </div>
    </nav>
    <style>

</style>