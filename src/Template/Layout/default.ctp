<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = 'Post Card';
?>


<!DOCTYPE HTML>
<html lang="en">
    <head>
	<!-- Google Tag Manager -->
	 </head>
    <body>
        
        

        <?php #if ($this->request->params['controller'] == "Pages" && $this->request->params['action'] == "home") { ?>
        
             <?php echo $this->element('home_header'); ?>
                   
        <?php /*} 
        else { ?>
            <?php #echo $this->element('header'); ?>
        <?php } */ ?>
        <?php echo $this->Flash->render() ?>
        <?php echo $this->Flash->render('success') ?>
        <?php echo $this->Flash->render('error') ?>

        <?php echo $this->fetch('content'); ?>   
        <?php echo $this->element('footer'); ?>

    </body>
    <style>
       .message.error{
        text-align: center;
        background: red;
        width:100%;
        height: 63px;
        padding-top: 19px;
        color: white;
        font-weight:bold;
        font-size: 22px;
       } 

    </style>



    
</html>

<?php //echo $this->element('sql_dump');  ?>
