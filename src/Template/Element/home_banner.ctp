<div class="home-banner" style="width:100%; position: relative; background: url('<?php echo $this->Url->build('/', true); ?>images/banner.png') no-repeat top center; background-size: cover; min-height: 525px">
    <?php echo $this->element('menu');?>
    <div class="banner-content">
        <h1><?php echo $SiteSettings['bannerheading'] ?></h1>
        <span class="thin"><?php echo $SiteSettings['bannerheading2'] ?>.</span>
        <ul>
            <li><span><i class="fa fa-check-circle"></i></span> <?php echo $SiteSettings['bannner_subtxt1'] ?></li>
            <li><span><i class="fa fa-check-circle"></i></span> <?php echo $SiteSettings['bannner_subtxt2'] ?></li>
            <li><span><i class="fa fa-check-circle"></i></span> <?php echo $SiteSettings['bannner_subtxt3'] ?></li>
        </ul>
        
        <?php if ($this->request->session()->check('Auth.User')) { ?>
            <a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "dashboard"]); ?>"><button type="button" class="button">My Dashboard</button></a>                              
        <?php } else if ($this->request->session()->check('Auth.Doctor')) { ?>
            <a href="<?php echo $this->Url->build(["controller" => "Doctors", "action" => "dashboard"]); ?>"><button type="button" class="button">My Dashboard</button></a>                              
        <?php } else { ?>
            
            <a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "signup"]); ?>">
                <button type="button" class="button">Open Your Account</button>
            </a>
        <?php } ?>        
        
            <button type="button" id="bapsi" class="button2 " >Choose Your Treatment</button>
        
        
        
    </div>
</div>

<script>
	$('#bapsi').on('click', function() {
		$('ul.dropdown-menu').css('display','block');
		
	});
</script>

<script>
	$('.cros').on('click', function() {
		$('ul.dropdown-menu').css('display','none');
	});
</script>