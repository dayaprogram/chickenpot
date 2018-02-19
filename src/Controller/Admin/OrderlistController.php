<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Dompdf\Adapter\CPDF;
use Dompdf\Dompdf;
use Dompdf\Exception;
use Picqer\Barcode ;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 */
class OrderlistController extends AppController {

    
    
    public function initialize() {
        parent::initialize();
        //$conn = ConnectionManager::get('default');
        //$this->loadComponent('Paginator');

    }  
    public $components = ['Paginator'];
    public $paginate = ['limit' => 15];
    
    public function beforeFilter(Event $event) {
        if (!$this->request->session()->check('Auth.Admin')) {
            return $this->redirect(['controller' => 'Users', 'action' => 'index']);
        }
    }

    /*
     *  Pending Order Listing
     */
    public function index() {
        $this->viewBuilder()->layout('admin');
         $this->loadModel('Orderlist');
    $orders = $this->paginate($this->Orderlist);
    $this->set(compact('orders'));
        $this->set('_serialize', ['orders']);
       
   }
   
   public function edit($id){
       $this->loadModel('Orderlist');
       $this->loadModel('Shipping_add');
        $this->viewBuilder()->layout('admin');
     $order = $this->Orderlist->find('all')->where(['id' => $id])->first();
     $shipping_id = $order['shipping_add_code'];
     $customer_details = $this->Shipping_add->find('all')->where(['shipping_code' => $shipping_id])->first();
     if ($this->request->is('post')) {
         $status = $this->request->data('order_status');
          $flag = true;
           $updatestatus = TableRegistry::get('Orderlist');
                    $query = $updatestatus->query();
                    $query->update()->set(['order_status' => $status])->where(['id' => $id])->execute();
                    if($flag){
                         $this->Flash->success(__('The status has been updated.'));
                          return $this->redirect(['action' => 'index']);
                    }else{
                         $this->Flash->error(__('The Status could not be saved. Please, try again.'));
                    }
            // pr($userExist);
     }
     $this->set(compact('order','customer_details','status'));
    
   }
   
   
   
     
    
    
  


    
        
        
        
   
    
    
}
