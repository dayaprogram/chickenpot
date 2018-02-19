<?php 
$txnid = '111';
$status = '1';
$amount = '500';
$customerorderdetails = $this->requestAction('/resturent/transactindtls/'.$txnid.'_'.$status.'_'.$amount);
//            ));
//$this->requestAction(
//    array('controller' => 'resturent', 'action' => 'transactindtls'),
//        array('pass' => array('dog','cat'))
//            );
   
   ?>