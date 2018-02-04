<?php ?>
<div id="content">
    <div class="inner">
        <div class="row">
            <div class="col-lg-12">
                <h1 > Add Order </h1>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <header>
                        <div class="icons"><i class="icon-th-large"></i></div>
                        <h5>Add User</h5>
                        <div class="toolbar">
                            <ul class="nav">
                                <li style="margin-right:15px">
                                    <div class="btn-group"> 
                                        <a href="<?php echo $this->Url->build(["controller" => "Users","action" => "listdoctor"]);?>"><button class="btn btn-xs btn-success close-box">
                                                <i class="icon-list"></i>List User</button></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </header>
                    <div id="collapseOne" class="accordion-body collapse in body"> 
                        <div class="col-sm-6">
                            <div class="row">
        <?php echo $this->Form->create($orders,['class' => 'form-horizontal', 'id' => 'user-validate', 'enctype' => 'multipart/form-data']);?>
                                <input type="hidden" name="utype" id="utype" value="2" />
                                <input type="hidden" name="is_active" id="is_active" value="1" />
                                <input type="hidden" name="is_mail_verified" id="is_mail_verified" value="1" />
                                
                                 <div class="form-group">
                                    <label class="control-label col-lg-4">User Name</label>
                                    <div class="col-lg-8">
                                        <?php echo $this->Form->input('username', array('class'=>'form-control','label' => false)); ?>
                                    </div>
                                </div>
                                
                                <!--
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Username</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="username" name="username" class="form-control" value=""/>
                                    </div>
                                </div>
                                -->
                                 <div class="form-group">
                                    <label class="control-label col-lg-4">Description</label>
                                    <div class="col-lg-8">
                                        <?php echo $this->Form->input('address', array('class'=>'form-control','label' => false,'type'=>'textarea')); ?>
                                    </div>
                                </div>
                                <!--
                                <div class="form-group">
                                    <label class="control-label col-lg-4">City</label>
                                    <div class="col-lg-8">
                                        <?php echo $this->Form->input('city', array('class'=>'form-control','label' => false)); ?>
                                    </div>
                                </div>                                
                                
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Country</label>
                                    <div class="col-lg-8">
                                        <?php echo $this->Form->input('country', array('class'=>'form-control','label' => false)); ?>
                                    </div>
                                </div>
                                -->
                                <div class="form-group"> 
                                  <label class="control-label col-lg-4">Front Image</label>
                                  <div class="col-lg-8">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-preview thumbnail" style="width: 90px; height: 90px;">
                                        </div>
                                      <div> <span class="btn btn-file btn-success"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                        <input type="file" id="back_image" name="back_image" />
                                        </span> <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a> </div>
                                    </div>
                                  </div>
                                </div>   
                                <div class="form-group"> 
                                  <label class="control-label col-lg-4">Back Image</label>
                                  <div class="col-lg-8">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-preview thumbnail" style="width: 90px; height: 90px;">
                                        </div>
                                      <div> <span class="btn btn-file btn-success"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                        <input type="file" id="image" name="image" />
                                        </span> <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a> </div>
                                    </div>
                                  </div>
                                </div>      

                                
                                <label class="control-label col-lg-4"></label>
                                <div class="col-lg-8" style="text-align:left;"> 
                                    <input type="submit" name="submit" value="Add User" class="btn btn-primary" />
                                </div>
                                <?php echo $this->Form->end();?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="<?php echo $this->request->webroot;?>js/bootstrap-datepicker.js"></script>
<script>
$(document).ready(function(){
    $('.subdate').datepicker({
    format:"yyyy-mm-dd",
    startDate:"today"
    });
});
</script>
<style>
    .datepicker{
        background:white !important;
    }    
</style>    