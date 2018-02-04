<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ChickenPot</title>

    <?php echo $this->Html->css('/inner_styles/css/bootstrap.min.css') ?>
    <?php echo $this->Html->css('/inner_styles/font-awesome/css/font-awesome.css') ?>
    <?php echo $this->Html->css('/inner_styles/css/plugins/toastr/toastr.min.css') ?>
    <?php echo $this->Html->css('/inner_styles/css/animate.css') ?>
    <?php echo $this->Html->css('/inner_styles/css/style.css') ?>
    <?php echo $this->Html->script('/inner_styles/js/jquery-3.1.1.min');?>
    <?php echo $this->Html->script('/inner_styles/js/bootstrap.min');?>
    <?php echo $this->Html->script('/inner_styles/js/plugins/metisMenu/jquery.metisMenu');?>
    <?php echo $this->Html->script('/inner_styles/js/plugins/slimscroll/jquery.slimscroll.min');?>
    <?php echo $this->Html->script('/inner_styles/js/inspinia');?>
    <?php echo $this->Html->script('/inner_styles/js/plugins/pace/pace.min');?>

    <!-- Toastr style -->
</head>
<body>

    <div id="wrapper">

        <?php echo $this->element("sidebar"); ?>

        <div id="page-wrapper" class="gray-bg">
        <?php echo $this->element("header"); ?>
          
         <?php echo $this->Flash->render() ?>
         <?php echo $this->Flash->render('success') ?>
         <?php echo $this->Flash->render('error') ?>
         <?php echo $this->fetch('content'); ?>    
       
        <div class="footer">
            <div class="pull-right">
                
            </div>
            <div>
                <strong>Copyright</strong> Proptino &copy; <?php echo date("Y");?>
            </div>
        </div>

        </div>
        </div>

</body>

</html>
<script>
$(document).ready(function(){
  setTimeout(function(){ $(".message").fadeOut() }, 3000);
})    
</script>    