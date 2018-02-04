<!--PAGE CONTENT -->
<div id="content">
    <div class="inner">
        <div class="row">
            <div class="col-lg-12">
                <h1 > Product </h1>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <header>
                        <div class="icons"><i class="icon-th-large"></i></div>
                        <h5> Product</h5>
                        <div class="toolbar">
                            <ul class="nav">
                                <li style="margin-right:15px">
                                    <div class="btn-group" style=" margin-top: 8px">

                                    </div>
                                </li>
                            </ul>
                        </div>
                    </header>
                    <div id="collapseOne" class="accordion-body collapse in body">
                        <div class="col-sm-12">
                            <div class="row">                               
                                <div class="form-group"> 
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo $this->Paginator->sort('id') ?></th>
                                                        <th><?php echo $this->Paginator->sort('Name') ?></th>
                                                        <th><?php echo $this->Paginator->sort('description') ?></th>
                                                        <th><?php echo $this->Paginator->sort('price') ?></th>
                                                         <th><?php echo $this->Paginator->sort('image') ?></th>    
                                                        <th class="actions"><?php echo __('Action') ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($food_item)) { ?>
                                                        <?php $ik = 1;
                                                        foreach ($food_item as $product): ?>
                                                            <tr>
                                                                <td><?php echo $ik ?></td>
                                                                <td><?php echo $product->foodname; ?></td>
                                                                <td><?php echo substr($product->description,0,20); ?></td>
                                                                <td><?php echo $product->price; ?></td>
                                                             <td><div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;">
                                                                <?php $filePath = WWW_ROOT . 'food_image' .DS. $product->image; ?>
                                                               <img src="<?php echo $this->Url->build('/food_image/'.$product->image); ?>" width="250px" height="250px" />
                                                                 </div></td>
                                                                <td class="actions">
                                                                       <a href="<?php echo $this->Url->build(["action" => "delete", $product->id]); ?>" onclick="return confirm('Are you sure you want to delete this item?');"> <button class="btn btn-danger btn-xs"><i class="icon-remove icon-white"></i> Delete</button> </a>               
                                                                    <a href="<?php echo $this->Url->build(["action" => "edit", $product->id]); ?>"> <button class="btn-btn-info btn-xs"><i class="icon-pencil icon-white"></i> Edit</button> </a>
                                                                </td>
                                                            </tr>
                                                            <?php $ik++;
                                                        endforeach; ?>
                                                        <?php } else { ?>
                                                        <tr>
                                                            <td colspan="5"> No Data Exist </td>
                                                        </tr>                       
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                            <div class="paginator">
                                                <ul class="pagination">
                                                    <?php echo $this->Paginator->first(__('<< First', true), array('class' => 'number-first')); ?>
                                                    <?php echo $this->Paginator->numbers(array('class' => 'numbers', 'first' => false, 'last' => false)); ?>
                                                    <?php echo $this->Paginator->last(__('>> Last', true), array('class' => 'number-end')); ?>
                                                </ul>
                                                <p><?php //echo $this->Paginator->counter()  ?></p>
                                            </div>
                                        </div>  
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>
<!--END PAGE CONTENT -->

