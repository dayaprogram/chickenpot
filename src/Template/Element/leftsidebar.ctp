<div class="side-menu-area">
    <h4>Online prescriptions</h4>
    <div class="side-menu-list">
        <ul>
            <li style="border-bottom:none;"> 
                <p>Our doctors will review your order information and issue the prescription online direct to our pharmacy.</p>
            </li>
            <li style="border-bottom:none;"> 
                <video width="" controls>
                    <source src="<?php echo $this->Url->build('/video/'.$SiteSettings['video']);?>" type="video/mp4">
                    Your browser does not support HTML5 video.
                  </video>
            </li>            
        </ul>
    </div>
</div>

<div class="side-menu-area">
    <h4>Site Newses</h4>
    <div class="side-menu-list">
        <ul style="padding-bottom:15px;">
            <li style="border-bottom:none;"> 
                <marquee direction="up"  scrollamount="1">
                <?php foreach($appNews as $news){ ?>
               <a href="<?php echo $this->Url->build(["controller" => "Newses", "action" => "detail", $news->slug ]); ?>">
                   <!-- <img src="<?php echo $this->Url->build('/news_img/'.$news->img);?>" width="100%" height="50px"><br> -->
               <h5><?php echo $news->title; ?> </h5>
               </a>
                <?php } ?>
                    </marquee>
            </li>
            <li style="border-bottom:none;">
                <a href="<?php echo $this->Url->build(["controller" => "Newses", "action" => "index"]);?>" 
                   class="button btn btn-info" target="_blank">All newses<span class="icon-new-window ml_10"></span>
                </a>
            </li>            
        </ul>
    </div>
</div>

<!--<div class="side-menu-area">
    <h4>Submit Review : </h4>
    <div class="side-menu-list">
        <ul style="padding-bottom:15px;"> 
            <li style=" border-bottom:none;">
                <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
  </div>
                 <a class="gallery_item button btn btn-info" href="https://www.doctorfox.co.uk/assets/images/logo-trusted-shops.svg">GP magazine.</a>
            </li>            
        </ul>
    </div>
</div>-->

<div class="side-menu-area">
    <h4>Site Reviews</h4>
    <div class="side-menu-list">
        <ul style="padding-bottom:15px;">
            <li style="border-bottom:none;">
                <marquee direction="up"  scrollamount="1">
                    <?php foreach($appReviewsDt as $k => $rev){ ?>
                    
                        <div class="top-reviews">
                            <div class="review-text">
                                <span id="<?php echo $k;?>" style="color:#ff6624; font-size: 15px;"></span><br>
                                <h5><b> Review From : </b> <?php echo $rev->user->first_name." ".$rev->user->last_name ?> </h5>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <script>
                            $(document).ready(function(){
                            $("#<?php echo $k; ?>").raty({score:'<?php echo $rev->rate ?>',readOnly:true, halfShow : true});   
                        }); 
                        </script>
                    <?php } ?>                
                </marquee>
            </li>
            <!--
            <li>
                <span id="leftRateDt" style="color:#ff6624; font-size: 18px;"></span><br>
                Rated <?php echo $totReview ?>/5 in <?php echo $revCount; ?> reviews.
            </li> 
            <script>
                $(document).ready(function(){
                $("#leftRateDt").raty({score:'<?php echo $totReview ?>',readOnly:true, halfShow : true});   
            }); 
            </script>
            -->
            <li style=" border-bottom:none;">
                <a href="<?php echo $this->Url->build(["controller" => "Contents", "action" => "reviews"]); ?>" 
                   class="button btn btn-info" target="_blank">All reviews<span class="icon-new-window ml_10"></span>
                </a>
            </li>             
        </ul>
    </div>
</div>




<div class="side-menu-area">
    <h4>Your guarantee</h4>
    <div class="side-menu-list">
        <ul style="padding-bottom:15px;">
            <li style=" border-bottom:none;">
            <div class="logo">
                <img src="<?php echo $this->Url->build('/'); ?>img/logo-trusted-shops.svg" alt="Trusted Shops logo" width="89">
                </div>
            </li> 
            <li  style=" border-bottom:none;">
                <p>Buying drugs via the internet is risky, but not for people using this GP web clinic.</p>
                 <a class="gallery_item button btn btn-info" href="javascript:void(0);">GP magazine.</a>
            </li>            
        </ul>
    </div>
</div>

<div class="side-menu-area">
    <h4>Fully UK regulated</h4>
    <div class="side-menu-list">
        <ul style="padding-bottom:15px;">
            <li style="border-bottom:none;">
            <div class="logo"> 
                <img src="<?php echo $this->Url->build('/'); ?>img/1124326.png" alt="Video: How it works">
                </div>
            </li>  
            <li><p><i class="fa fa-check-circle-o" aria-hidden="true"></i> Registered with the Care Quality Commission</p></li>            
            <li><p><i class="fa fa-check-circle-o" aria-hidden="true"></i> Managed by <abbr title="General Practitioner">GP</abbr>s</p></li>
            <li  style="border-bottom:none;"><p><i class="fa fa-check-circle-o" aria-hidden="true"></i> <abbr title="United Kingdom">UK</abbr> Pharmacy</p></li>
        </ul>
    </div>
</div>

<div class="side-menu-area">
    <h4>Delivery to UK & EU</h4>
    <div class="side-menu-list">
        <ul>
            <li style="border-bottom:none;"> 
                <p>Our doctors will review your order information and issue the prescription online direct to our pharmacy.</p>
            </li>
            <li style="border-bottom:none; padding-bottom:15px;"> 
                <div class="pic"><img src="<?php echo $this->Url->build('/'); ?>img/aside-video.jpg" alt="Video: How it works"></div>
            </li>            
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
