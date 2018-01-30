<div id="content">
    <div class="inner">
        <div class="row">
            <div class="col-lg-12">
                <h1 > Add Crown Fabrication </h1>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <header>
                        <div class="icons"><i class="icon-th-large"></i></div>
                        <h5>Add Crown Fabrication</h5>
                        <div class="toolbar">
                            <ul class="nav">
                                <li style="margin-right:15px">
                                    <div class="btn-group"> 

                                    </div>
                                </li>

                            </ul>
                        </div>
                    </header>
                    <div id="collapseOne" class="accordion-body collapse in body">
                        <div class="col-sm-6">

                            <div class="row">
				  <?php echo $this->Form->create($crown,['class' => 'form-horizontal', 'id' => 'user-validate']);?>

                                <input type="hidden" name="active" id="active" value="1" />

                                <div class="form-group">
                                    <label class="control-label col-lg-4">Patient First Name</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="first_name" name="first_name" class="form-control" value="" required=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Patient Last Name</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="last_name" name="last_name" class="form-control" value="" required=""/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Doctor</label>
                                    <div class="col-lg-8">
                                        <select name="doctor_id" required="" class="form-control">
                                            <option value="">Choose Doctor</option>
                                            <?php
                                            foreach ($doctors as $doct)
                                            {
                                            ?>
                                            <option value="<?php echo $doct->id;  ?>"><?php echo $doct->first_name.' '.$doct->last_name ?></option>
                                            <?php }?>
                                        </select> 
                                    </div>
                                </div>
                                                      

                                <div class="form-group">
                                    <label class="control-label col-lg-4">Color</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="color" name="color" class="form-control" value="" required=""/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-4">Description</label>
                                    <div class="col-lg-8">
                                        <textarea class="form-control" name="description" id="description"></textarea>   
                                        
                                    </div>
                                </div>
                                <label class="control-label col-lg-4"></label>
                                <div class="col-lg-8" style="text-align:left;"> 
                                    <input type="submit" name="submit" value="Add Doctor" class="btn btn-primary" />
                                </div>
                                </form>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




