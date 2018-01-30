<div id="content">
    <div class="inner">
        <div class="row">
            <div class="col-lg-12">
                <h1 > Edit Item</h1>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <header>
                        <div class="icons"><i class="icon-th-large"></i></div>
                        <h5>Edit Product</h5>
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
                               
				  <?php echo $this->Form->create($category,['class' => 'form-horizontal', 'id' => 'user-validate']);?>

                               

                                <div class="form-group">
                                    <label class="control-label col-lg-4">Title</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="foodname" name="foodname" class="form-control" value="<?php echo $category['foodname'] ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Description</label>
                                    <div class="col-lg-8">
                                        
                                        <input type="textarea" id="description" name="description" class="form-control" value="<?php echo $category['description'] ?>"/>
                                    </div>
                                </div>
                              <div class="form-group">
                                    <label class="control-label col-lg-4">Price</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="price" name="price"  class="form-control" value="<?php echo $category['price'] ?>"/>
                                    </div>
                                </div>
                                  <div class="form-group">
                                  <label class="control-label col-lg-4">User Image </label>
                                  <div class="col-lg-8">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;">
                                            <?php $filePath = WWW_ROOT . 'food_image' .DS. $category->image; ?>
                                            <?php if ($category->image != "" && file_exists($filePath)) { ?>
                                                <img src="<?php echo $this->Url->build('/food_image/'.$category->image); ?>" width="150px" height="150px" />
                                            <?php } ?>
                                        </div>
                                      <div> <span class="btn btn-file btn-success"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                        <input type="file" id="image" name="image" />
                                        </span> <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a> </div>
                                    </div>
                                  </div>
                                </div>         
                                  <label class="control-label col-lg-4"></label>
                                <div class="col-lg-8" style="text-align:left;"> 
                                    <input type="submit" name="submit" value="Edit Product" class="btn btn-primary" />
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


<!--
<div id="content">
    <div class="inner">
        <div class="row">
            <div class="col-lg-12">

            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                  <div class="box">
                    <div id="collapseOne" class="accordion-body collapse in body">
                        <div class="col-sm-6">
                            <div class="row">
                                <?php //echo $this->Form->create($doctor) ?>
                                <?php echo $this->Form->create($doctor,['class' => 'form-horizontal', 'id' => 'admin-validate']);?>
                                <fieldset>
                                    <legend><?php echo __('Add Doctor') ?></legend>
                                    <?php
                                        echo '<div class="form-group">'.$this->Form->input('first_name', array('class'=>'form-control')).'</div>';
                                        echo '<div class="form-group">'.$this->Form->input('last_name', array('class'=>'form-control')).'</div>';
                                        echo '<div class="form-group">'.$this->Form->input('phone', array('class'=>'form-control')).'</div>';
                                        echo '<div class="form-group">'.$this->Form->input('username', array('class'=>'form-control','readonly')).'</div>';
                                        echo '<div class="form-group">'.$this->Form->input('password', array('class'=>'form-control','value'=>'')).'</div>';
                                        echo '<div class="form-group">'.$this->Form->input('email', array('class'=>'form-control','readonly')).'</div>';
                                    ?>
                                </fieldset>

                                <fieldset>
                                    <button type="submit" class="btn btn-primary" style="margin-top: 15px">Edit Doctor</button>
                                </fieldset>


                                <?php //echo $this->Form->button(__('Edit Doctor')) ?>
                                <?php echo $this->Form->end() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
-->