<?php if ($this->request->params['controller'] == "Treatments" && $this->request->params['action'] == "treatmentdetail") { ?>
    <div class="side-menu-area side-menu-part right-side-menu-area">
        <h4> <?php echo $treatment['name'] ?> </h4>
        <div class="side-menu-list">
            <ul>               
                <!--<li class="active"><a href="<?php echo $this->Url->build(["controller" => "Treatments", "action" => "treatmentdetail", $treatment['slug']]); ?>">
                         <span class="span"><i class="fa fa-caret-right" aria-hidden="true"></i> <?php echo $treatment['name'] ?> </a></li> -->
                <?php if (!empty($treatment['Medicines'])) {
                    foreach ($treatment['Medicines'] as $sideBarMedicineMenu) {
                        ?>
                        <li><a href="<?php echo $this->Url->build(["controller" => "Treatments", "action" => "medicinedetail", $sideBarMedicineMenu['slug']]); ?>">
                                <span class="span"><i class="fa fa-caret-right" aria-hidden="true"></i> <?php echo $sideBarMedicineMenu['title'] ?> </a></li>        
                    <?php }
                }
                ?>
            </ul>            
        </div>
    </div>
<?php } else if ($this->request->params['controller'] == "Treatments" && $this->request->params['action'] == "medicinedetail") { ?>
    <div class="side-menu-area side-menu-part">
        <h4> <?php echo $treatmentdata['name'] ?></h4>
        <div class="side-menu-list">
            <ul>               
                <!--<li class="active"><a href="<?php echo $this->Url->build(["controller" => "Treatments", "action" => "treatmentdetail", $treatmentdata['slug']]); ?>">
                         <span class="span"><i class="fa fa-caret-right" aria-hidden="true"></i> <?php echo $treatmentdata['name'] ?> </a></li> -->

    <?php if (!empty($treatmentdata['Medicines'])) {
        foreach ($treatmentdata['Medicines'] as $sideBarMedicineMenu) {
            ?>
                        <li><a href="<?php echo $this->Url->build(["controller" => "Treatments", "action" => "medicinedetail", $sideBarMedicineMenu['slug']]); ?>">
                                <span class="span"><i class="fa fa-caret-right" aria-hidden="true"></i> <?php echo $sideBarMedicineMenu['title'] ?> </a></li>        
        <?php }
    }
    ?>
            </ul>            
        </div>
    </div>
<?php } else if ($this->request->params['controller'] == "Treatments" && $this->request->params['action'] == "treatmentprice") { ?>
    <div class="side-menu-area">
        <h4> Selected</h4>
        <div class="side-menu-list">
            <ul>
                <li class="active"><a href="<?php echo $this->Url->build(["controller" => "Treatments", "action" => "treatmentdetail", $treatment['slug']]); ?>">
                        <span class="span"><i class="fa fa-caret-right" aria-hidden="true"></i> <?php echo $treatment['name'] ?> </a></li>
                <?php if (!empty($treatment['Medicines'])) {
                    foreach ($treatment['Medicines'] as $sideBarMedicineMenu) {
                ?>
                    <li>
                        <a href="<?php echo $this->Url->build(["controller" => "Treatments", "action" => "medicinedetail", $sideBarMedicineMenu['slug']]); ?>">
                            <span class="span"><i class="fa fa-caret-right" aria-hidden="true"></i> <?php echo $sideBarMedicineMenu['title'] ?> 
                        </a>
                    </li>        
                <?php } } ?>
            </ul>            
        </div>
    </div>
<?php } ?>

<div class="side-menu-area">
    <h4>Treatments</h4>
    <div class="side-menu-list">
        <ul>
            <?php foreach ($appTreatmentList as $menuTreatList) { ?>
                <li> <a href="<?php echo $this->Url->build(["controller" => "Treatments", "action" => "treatmentdetail", $menuTreatList['slug']]); ?>">
                        <span class="span"><i class="fa fa-caret-right" aria-hidden="true"></i></span> <?php echo $menuTreatList['name'] ?> 
                    </a>
                </li>
            <?php } ?>   
        </ul>
    </div>
</div>



<!--
<div class="side-menu-area">
    <h4>Treatments & prices</h4>
    div class="side-menu-list">
        <ul>
            <li> <a href="#"><span class="span"><i class="fa fa-caret-right" aria-hidden="true"></i></span> Anti-malaria tablets</a></li>
            <li> <a href="#"><span class="span"><i class="fa fa-caret-right" aria-hidden="true"></i></span> Anti-malaria tablets</a></li>
            <li> <a href="#"><span class="span"><i class="fa fa-caret-right" aria-hidden="true"></i></span> Anti-malaria tablets</a></li>
            <li> <a href="#"><span class="span"><i class="fa fa-caret-right" aria-hidden="true"></i></span> Anti-malaria tablets</a></li>
            <li> <a href="#"><span class="span"><i class="fa fa-caret-right" aria-hidden="true"></i></span> Anti-malaria tablets</a></li>
            <li> <a href="#"><span class="span"><i class="fa fa-caret-right" aria-hidden="true"></i></span> Anti-malaria tablets</a></li>
            <li> <a href="#"><span class="span"><i class="fa fa-caret-right" aria-hidden="true"></i></span> Anti-malaria tablets</a></li>
            <li> <a href="#"><span class="span"><i class="fa fa-caret-right" aria-hidden="true"></i></span> Anti-malaria tablets</a></li>
        </ul>
    </div>
</div>
-->
