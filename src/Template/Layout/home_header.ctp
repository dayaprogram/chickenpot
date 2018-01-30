<?php
if ($this->request->params['controller'] == "Pages" && $this->request->params['action'] == "home") { ?>
<section class="homepage-top img-responsive" style="background: url('<?php echo $this->request->webroot; ?>images/home-top-bg.jpg') no-repeat top center;">
<header class="navbar-fixed-top">
<?php }
else
{ ?>


<!-- js -->
<!--<script src="<?php echo $this->request->webroot; ?>js/classie.js"></script>
<script>
    function init() {
        window.addEventListener('scroll', function(e){
            var distanceY = window.pageYOffset || document.documentElement.scrollTop,
                shrinkOn = 300,
                header = document.querySelector("header");
            if (distanceY > shrinkOn) {
                classie.add(header,"smaller");
            } else {
                if (classie.has(header,"smaller")) {
                    classie.remove(header,"smaller");
                }
            }
        });
    }
    window.onload = init();
</script>-->