<?php ?>
<div id="content">
    <div class="inner">
        <div class="row">
            <div class="col-lg-12">
            </div>
        </div>
        <hr />
        <div class="table-responsive">
            <div class="runs view large-9 medium-8 columns content">
                <h3> Order Details</h3>
                <table class="vertical-table table table-striped table-bordered table-hover">
                    <?php
					//print_r($user_details);die;
                    if (!empty($details)) {
                         //print_r($user_details);die;
                        ?>
                        <tr>
                            <th><?php echo __('Username') ?></th>
                            <td><?php print_r($user_details['name'])?></td>
                        </tr>

                        <tr>
                            <th><?php echo __('address') ?></th>
                            <td><?php print_r($details['address']) ?></td>
                        </tr>

                        <tr>
                            <th><?php echo __('price') ?></th>
                            <td><?php echo $orders->total_price; ?></td>
                        </tr>                    

                        <tr>
                            <th><?php echo __('message') ?></th>
                            <td><?php echo $details['message'] ?></td>
                        </tr>                    
                        <!--
                        <tr>
                            <th><?php echo __('City') ?></th>
                            <td><?php echo $users->city ?></td>
                        </tr> 
                        
                        <tr>
                            <th><?php echo __('Country') ?></th>
                            <td><?php echo $users->country ?></td>
                        </tr>                    
                        -->
                        <tr>
                            <th><?php echo __('Front Image') ?></th>
                            <td> <img src="<?php echo $this->Url->build('/img/' . $orders->front_image); ?>" width="240px" height="140px" /> </td>
                        </tr> 
                        <tr>
                            <th><?php echo __('Back Image') ?></th>
                            <td> <img src="<?php echo $this->Url->build('/img/' . $orders->back_image); ?>" width="240px" height="140px" /> </td>
                        </tr>  
                    <?php } ?>                  



                    <!--
                    <tr>
                        <th><?php echo __('Modified On') ?></th>
                        <td><?php echo $users->modified ?></td>
                    </tr>
                    -->
                </table>

                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table cellpadding="0" cellspacing="0" class="table  table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th><?php echo $this->Paginator->sort('Sl No') ?></th>
                                    <th><?php echo $this->Paginator->sort('username') ?></th>
                                    <th><?php echo $this->Paginator->sort('address') ?></th>
                                    <th><?php echo $this->Paginator->sort('message') ?></th>
                                    <th><?php echo $this->Paginator->sort('download') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($order_details)) {
                                    $ik = 1;
                                    //
                                    //pr($order_details);die;
                                    foreach ($order_details as $ord) {
                                        //pr($ord);die;
                                        // pr($ord->postcards->name);die;
                                        foreach ($ord->postcards as $post) {
                                            // print_r($post['id']);die;
                                            ?>
                                            <tr>
                                                <td><?php echo $ik ?></td>
                                                <td><?php echo $post['name'] ?></td>
                                                <td><?php echo $post['address'] ?></td>
                                                 <td><?php echo $post['message'] ?></td>
                                                <td><a href="<?php echo $this->Url->build(["action" => "downloads", ($post['id'])]); ?>"> <button class="btn btn-primary btn-xs"><i class="icon-download-alt"></i> Download</button>  </a></td>  
                                            </tr>
                                            <?php
                                            $ik++;
                                        }
                                    }
                                }
                                ?>
                            <tbody>
                        </table>
                    </div></div>

            </div>
        </div>
    </div>
</div>