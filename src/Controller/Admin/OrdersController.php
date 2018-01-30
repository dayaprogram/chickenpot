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
class OrdersController extends AppController {

    
    
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
        $this->loadModel("Orders");	
        $this->paginate = [
            'contain' => ['Users'],
            'order' => [
            'Orders.id' => 'desc'
        ]
        ];
        $query = $this->Orders->find()->contain(['Users']);
        $orders =$this->paginate($query);
        $this->set(compact('orders'));
        $this->set('_serialize', ['orders']);
        

    }
    public function orderdelete($id = null) {
        //$this->request->allowMethod(['post', 'delete']);
        $orders = $this->Orders->get($id);
        if ($this->Orders->delete($orders)) {
            $this->Flash->success(__('Order has been deleted.'));
        } else {
            $this->Flash->error(__('Order could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }    
    
     
    
    
    /**
     * View Order Details
     *
     * @param string|null $id Order id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    function view($id=null)
    {
       // echo 'hello'; die;
        $this->viewBuilder()->layout('admin');
         $this->loadModel('Postcards');
		 $this->loadModel('Users');
        $orders = $this->Orders->get($id);
        $this->paginate = [
            'contain' => ['Postcards'],
            'order' => [
            'Orders.id' => 'desc'
        ]
        ];
        //pr($orders);die;
        $query = $this->Orders->find()->contain(['Postcards']);
        $order_details =$this->paginate($query);
        //first
        $details = $this->Postcards->find()->where(['order_id'=>$orders['id']])->first()->toArray(); 
		$user_details = $this->Users->find()->where(['id'=>$orders['user_id']])->first()->toArray();
		//pr($user_details); die;
        

        //$results = $customer->toArray(); 
        //pr($query); exit;

        $this->set(compact('orders','details','order_details','user_details'));
        $this->set('_serialize', ['orders','details','order_details','user_details']);       
                
                
        
    }


public function add_order(){
     $this->loadModel("Orders");
     $this->viewBuilder()->layout('admin');
        $orders = $this->Orders->newEntity();
        if ($this->request->is('post')) {

            $flag = true;
            //echo $this->generateRandomString(); exit;
            
            // Validating Patient Form
            if($this->request->data['username'] == ""){
                $this->Flash->error(__('User Name can not be null. Please, try again.')); $flag = false;
            }
            
                   
             $arr_ext = array('jpg', 'jpeg', 'gif', 'png');
            if (!empty($this->request->data['back_image'])) {
                $file = $this->request->data['back_image']; //put the data into a var for easy use
                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                $fileName = time() . "." . $ext;
                if (in_array($ext, $arr_ext)) {
                    
                    if ($orders->back_image != "" && $orders->back_image != $fileName ) {
                        $filePathDel = WWW_ROOT . 'user_img' . DS . $user->back_image;
                        if (file_exists($filePathDel)) {
                            unlink($filePathDel);
                        }
                    }                     
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . 'user_img' . DS . $fileName);
                    $file = $fileName;
                    $this->request->data['back_image'] = $fileName;
                } else {
                    $flag = false;
                    $this->Flash->error(__('Upload image only jpg,jpeg,png files.'));
                }
            } else {
                $this->request->data['back_image'] = $user->pimg;
            }             
             $orders = $this->Orders->patchEntity($orders, $this->request->data);
               if ($this->Orders->save($orders)) {
                    $this->Flash->success(__('Order has been edited successfully.'));
                    //return $this->redirect(['action' => 'listuser']);
                }
                    
                    //pr($this->request->data); pr($user); exit;
                    $this->redirect(['action' => 'listuser']);
            }
        $this->set(compact('orders'));
        $this->set('_serialize', ['orders']);
    }


    /*
     *  Approve order as Admin
     */
    public function approvenow($txn = null) {
        
        $this->viewBuilder()->layout('');
        $this->loadModel('Users');
        $this->loadModel('Orders');
        $this->loadModel('Transactions');
        $this->loadModel('Admins');
        
        $user = $this->Admins->get($this->request->session()->read('Auth.Admin.id'));
        
        if ($txn != "") {
            
            $transaction = $this->Transactions->find()->contain(['Orders','Users'])->where(['Transactions.transaction_id' => $txn])->first()->toArray();
            //$ord = $this->Orders->find()->where(['Orders.transaction_id' => $txn])->all()->toArray();
            
            $record_id = $transaction['id'];
            $transactionTable = TableRegistry::get('Transactions');
            $query1 = $transactionTable->query();
            $query1->update()->set(['isverified' => 1, 'verifiedby' => $user['id'], 'verifiedbytype' => 'Admin'])->where(['id' => $record_id])->execute(); 

            foreach($transaction['Orders'] as $cancelOrder){ 
                $record_ids = $cancelOrder['id'];
                $ordersTable = TableRegistry::get('Orders');
                $query = $ordersTable->query();
                $query->update()->set(['isverified' => 1, 'verifiedby' => $user['id'], 'verifiedbytype' => 'Admin'])->where(['id' => $record_ids])->execute();                   
            }            
             
             $this->Flash->success(__('Prescription Approved successfully.'));
             return $this->redirect(['action' => 'approvedorders']);
             
        } else {
            return $this->redirect(['action' => 'view', $txn]);
        }
            
        $this->autoRender = false;
    } 
    
    /*
     *  order Statistics
     */
    
    /*
     *  Order Chart Statistics
     */
    
    
    /*
     *  Order Chart search by Day Month And Year with time Duration
     */
    
            
            
            
            
            
         
        public function allorders()
        {
	$this->viewBuilder()->layout('admin');
	$this->loadModel('Orders');
	$this->loadModel('Users');
	$users = $this->Orders->find('all', ['fields' => ['Users.id', 'Users.first_name', 'Users.last_name']])->where(['Orders.user_id != ' => 0])->contain(['Users'])->order(['Users.first_name' => 'ASC'])->group(['Orders.user_id'])->toArray();
	$query = $this->Orders->find()->where(['is_complete' => 1, 'is_active' => 1, 'transaction_id !=' => ''])->order(['id' => 'DESC'])->all()->toArray();
	$uniqueDt = array();
	foreach($query as $q)
		{
		$uniqueDt[$q->transaction_id]['id'] = $q->id;
		}

	$dtArr = array();
	foreach($uniqueDt as $dt)
		{
		$dtArr[$dt['id']] = $dt['id'];
		}

	if (empty($dtArr))
		{
		$dtArr[0] = 0;
		}

	$conditions['id IN'] = $dtArr;
	if (!empty($_REQUEST))
		{
		if (!empty($_REQUEST['user_id']))
			{
			$conditions['user_id'] = $_REQUEST['user_id'];
			}

		if (!empty($_REQUEST['transaction_id']))
			{
			$conditions['transaction_id LIKE '] = '%' . $_REQUEST['transaction_id'] . '%';
			}

		if (!empty($_REQUEST['start_date']))
			{
			$conditions['date(date) >='] = date('Y-m-d', strtotime($_REQUEST['start_date']));
			}

		if (!empty($_REQUEST['end_date']))
			{
			$conditions['date(date) <='] = date('Y-m-d', strtotime($_REQUEST['end_date']));
			}

		if (!empty($_REQUEST['export']))
			{
			$export_data = $this->Orders->find('all', ['conditions' => [$conditions], 'contain' => ['Orderdetails'], 'order' => ['id' => 'DESC']])->toArray();
			$output = '';
			$output.= "#,";
			$output.= "Patient,";
			$output.= "Transaction Id,";
			$output.= "Pills,";
			$output.= "Amount,";
			$output.= "Order Date,";
			$output.= "Shipping Address,";
			$output.= "Status,";
			$output.= "\n";
			$ik = 1;
			foreach($export_data as $order)
				{
				$output.= '"' . $ik . '",';
				$output.= '"' . $order->name . '",';
				$output.= '"' . $order->transaction_id . '",';
				$output.= '"' . count($order->orderdetails) . '",';
				$output.= '"' . $order->amt . '",';
				$output.= '"' . $this->requestAction('admin/users/change_datetimeformat/' . strtotime($order->date)) . '",';
				$output.= '"' . $order->shipping_address . ',' . $order->shipping_city . ',' . $order->shipping_country . ',' . $order->shipping_code . '",';
				if ($order->is_reject == 0 && $order->isverified == 1)
					{
					$output.= "Approved";
					}
				  else
				if ($order->is_reject == 1 && $order->isverified == 0)
					{
					$output.= "Rejected";
					}
				  else
				if ($order->is_reject == 0 && $order->isverified == 0)
					{
					$output.= "Pending";
					}

				$output.= "\n";
				$ik++;
				}

			$filename = "order_" . time() . ".csv";
			header('Content-type: application/csv');
			header('Content-Disposition: attachment; filename=' . $filename);
			echo $output;
			exit;
			}
		}

	$this->set('orders', $this->Paginator->paginate($this->Orders, ['limit' => 30, 'order' => ['id' => 'DESC'], 'conditions' => [$conditions], 'contain' => ['Orderdetails']]));
	$this->set(compact('dtArr', 'users'));
	}
        
        public function salesreport()
        {
        header('Content-type: text/plain');
	$this->viewBuilder()->layout('admin');
	$this->loadModel('Orders');
	$this->loadModel('Users');
        $this->loadModel('Pils');
        $this->loadModel('Medicines');
        $this->loadModel('Orderdetails');
        $conditions['Orders.is_active']=1;
        $conditions['Orders.is_reject']=0;
        $conditions['Orders.isverified']=1;
        $conditions['Orders.is_complete']=1;
        $conditions['Orders.transaction_id !=']="";
        
        if(!empty($_REQUEST['title']))
        {
          $conditions['Pils.title LIKE']='%'.$_REQUEST['title'].'%';

        }
        
        if(!empty($_REQUEST['start_date']))
        {
            $conditions['DATE(Orders.date) >= ']= date('Y-m-d',strtotime($_REQUEST['start_date']));
        }
        
        if(!empty($_REQUEST['end_date']))
        {
            $conditions['DATE(Orders.date) <= ']= date('Y-m-d',strtotime($_REQUEST['end_date']));
        }
        
        $pills= $this->Paginator->paginate($this->Orderdetails, ['limit' => 30, 'order' => ['id' => 'DESC'], 'conditions' => [$conditions], 'contain' => ['Pils','Orders','Medicines'],"group"=>"pil_id"]);
        $output="";
        if (!empty($_REQUEST['export']))
        {
            $output.="#,";
            $output.="Pill,";
            $output.="Medicine,";
            $output.="Qty,";
            $output.="Amount,";
            $output.="\n";
            $ik = 1;
            $export_data = $this->Orderdetails->find('all', ['conditions' => [$conditions], 'contain' => ['Pils','Orders','Medicines'], 'order' => ['Orderdetails.id' => 'DESC'],'group'=>'pil_id'])->toArray();
            
            foreach($export_data as $result)
            {
                $priceqty=$this->business($result->pil_id);
                $price=explode("-",$priceqty);
                $output.='"' . str_replace('"', '""',$ik ) . '", ';
                $output.='"' . str_replace('"', '""', $result->pil_name) . '", ';
                $output.='"' . str_replace('"', '""', $result->medicine->title) . '", ';
                $output.='"' . str_replace('"', '""', $price[0]) . '", ';
                $output.='"' . str_replace('"', '""', number_format((float)$price[1],2,'.',',')) . '", ';
                $output .="\n";
                $ik++;

            }
            
            $filename = "sales".time().".csv";
            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename='.$filename);
            echo $output;
            exit;

            
          
        }
        $this->set(compact('dtArr', 'pills'));
        
	}
        
        public function business($pill_id)
        {
	$this->loadModel('Orders');
	$this->loadModel('Users');
        $this->loadModel('Pils');
        $this->loadModel('Medicines');
        $this->loadModel('Orderdetails');
        $query=$this->Orderdetails->find();
        $conditions['Orders.is_active']=1;
        $conditions['Orders.is_reject']=0;
        $conditions['Orders.isverified']=1;
        $conditions['Orders.is_complete']=1;
        $conditions['Orders.transaction_id !=']="";
        $conditions['Orderdetails.pil_id']=$pill_id;
        $net_qty=0;
        $sum=0;
        $export_data = $this->Orderdetails->find('all', ['conditions' => [$conditions], 'contain' => ['Orders']])->toArray();
        foreach($export_data as  $data)
        {
             $net_qty=$net_qty+1;
             $sum=$sum+$data->pil_price;
             
        }
        
       
        $this->response->body($net_qty.'-'.$sum);
        return $this->response;
        
        
	}
        
        /*
         *  Profit Graph with search
         */
        public function profit_analytic() 
        {
            $this->loadModel('Orders');
            $this->loadModel('Orderdetails');
            $conditions['Orders.is_active']=1;
            $conditions['Orders.is_complete']=1;
            $conditions['Orders.transaction_id !=']="";
            $conditions['Orders.is_reject']=0;
            $conditions['Orders.isverified']=1;
             $sum=0;
             $transactions=$this->Orders->find('all', ['conditions' => [$conditions], 'contain' => ['Orderdetails'=>['Pils']]])->toArray(); ;
             foreach ($transactions as $tr)
             {
                 
                 
                 foreach ($tr->orderdetails as $order_details)
                 {
                 $profit=$order_details->pil_price-$order_details->pil->buy_price;
                 $sum=$sum+$profit;
                 }
                 
             }
             $this->set(compact('sum'));
             $this->set('_serialize', ['sum']);
        }
        
       public function profit_graph() 
        {      
        $ip= isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? 
        $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']; 
        $data = json_decode(file_get_contents('http://ip-api.com/json/' . $ip)); 
        $result=array();
        if($data->status == 'success')
        {
             $timezone = $data->timezone;
        }
        else 
        {
            $timezone="Asia/Kolkata";
        }
        $flag=0;
        date_default_timezone_set($timezone);
        $GMT = new \DateTimeZone('UTC');
        $type=$this->request->data['type'];
        $start1=explode("/",$this->request->data['start_date']);
        $this->request->data['start_date']=$start1[2].'-'.$start1[1].'-'.$start1[0];
        $end1=explode("/",$this->request->data['end_date']);
        $this->request->data['end_date']=$end1[2].'-'.$end1[1].'-'.$end1[0];
        $start_date=date('Y-m-d 00:00:00',strtotime($this->request->data['start_date']));
        $end_date=date("Y-m-d 23:59:59",strtotime($this->request->data['end_date']));
        $start=new \DateTime($start_date);
        $start->setTimezone($GMT);
        $start_time=$start->format('Y-m-d H:i:s');
        $end=new \DateTime($end_date);
        $end->setTimezone($GMT);
        $end_time=$end->format('Y-m-d H:i:s');
        $initital_end=date('Y-m-d H:i:s', strtotime("+1 Days", strtotime($start_time)));
        $order_history=array();
        if($type=='daily')
        {
            
            $listings = $this->Orders->find()->select(['id','name','email','amt','date'])->where(
                        ['is_active'=>1,'is_reject'=>0,'isverified'=>1,"is_complete"=>1,"transaction_id !="=>'',"date >="=>$start_time,"date <="=>$end_time]
                        )->contain(['Orderdetails'=>['Pils']])->order(['date'=>'desc'])->all()->toArray();
            
                       
                foreach ($listings as $list)
                {
                  $order_date=date('Y-m-d h:i',strtotime($list->date));
                  $gmtTimezone = new \DateTimeZone('GMT'); 
                  $myDateTime = new \DateTime($order_date, $gmtTimezone);
                  $offset = date("P");
                  $qty=count($list->orderdetails);
                  $place_order_date=date('d/m/Y h:i a', $myDateTime->format('U') + $offset);
                  $net_profit=0;
                  $net_sellingprice=0;
                  $net_costing=0;
                  foreach ($list->orderdetails as $dtl)
                 {
                    $profit=$dtl->pil_price-$dtl->pil->buy_price;
                    $net_profit=$net_profit+$profit;
                    $net_sellingprice=$net_sellingprice+$dtl->pil_price;
                    $net_costing=$net_costing+$dtl->pil->buy_price;
                    
                 }
                  $order_history[]=array('id'=>$list->id,'net_profit'=>  number_format((float)$net_profit,2,'.',','),'net_sellingprice'=>  number_format((float)$net_sellingprice,2,'.',','),'net_costing'=>  number_format((float)$net_costing,2,'.',','),'name'=>$list->name,'email'=>$list->email,'amt'=> number_format((float)$list->amt,2,'.',','),'date'=>$place_order_date,"qty"=>$qty);  
                }
                while($start_time<$end_time)
                {

                    $conditions['is_active']=1;
                    $conditions['is_complete']=1;
                    $conditions['transaction_id !=']="";
                    $conditions['is_reject']=0;
                    $conditions['isverified']=1;
                    $conditions['date >=']=$start_time;
                    $conditions['date <=']=$initital_end;
                    $transactions=$this->Orders->find('all', ['conditions' => [$conditions], 'contain' => ['Orderdetails'=>['Pils']]])->toArray(); ;
                    $sum=0;
                    foreach ($transactions as $tr)
                    {
                        foreach ($tr->orderdetails as $order_details)
                        {
                           
                        $profit=$order_details->pil_price-$order_details->pil->buy_price ;
                        $sum=$sum+$profit;
                        $flag=1;
                        }
                        
                        
                    }
                   
                    $userTimezone = new \DateTimeZone($timezone);
                    $gmtTimezone = new \DateTimeZone('GMT'); 
                    $myDateTime = new \DateTime($start_time, $gmtTimezone);
                    $offset = $userTimezone->getOffset($myDateTime);
                    $x[]=date('d/m/Y', $myDateTime->format('U') + $offset);
                    $y[]=!empty($sum)?number_format((float)$sum,2,'.',','):0;

                    $start_time=date('Y-m-d H:i:s', strtotime("+1 Days", strtotime($start_time)));;
                    $initital_end=date('Y-m-d H:i:s', strtotime("+1 Days", strtotime($start_time)));  

                }
                $result=array('x'=>$x,'y'=>$y,'flag'=>$flag,'order_history'=>$order_history);
            
        }
        
        if($type=='monthly')
        {
            $i=0;
            $month=array("01"=>'Jan',"02"=>'Feb',"03"=>'March',"04"=>'April',"05"=>'May',"06"=>'June',"07"=>'July',
            "08"=>'Aug',"09"=>'Sep',"10"=>'Oct',"11"=>'Nov',"12"=>'Dec'    
            );
            
            $listings = $this->Orders->find()->select(['id','name','email','amt','date'])->where(
                        ['is_active'=>1,'is_reject'=>0,'isverified'=>1,"is_complete"=>1,"transaction_id !="=>'',"date >="=>$start_time,"date <="=>$end_time]
                        )->contain(['Orderdetails'=>['Pils']])->order(['date'=>'desc'])->all()->toArray();
            
                       
                foreach ($listings as $list)
                {
                  $order_date=date('Y-m-d h:i',strtotime($list->date));
                  $gmtTimezone = new \DateTimeZone('GMT'); 
                  $myDateTime = new \DateTime($order_date, $gmtTimezone);
                  $offset = date("P");
                  $qty=count($list->orderdetails);
                  $place_order_date=date('d/m/Y h:i a', $myDateTime->format('U') + $offset);
                  $net_profit=0;
                  $net_sellingprice=0;
                  $net_costing=0;
                  foreach ($list->orderdetails as $dtl)
                 {
                    $profit=$dtl->pil_price-$dtl->pil->buy_price;
                    $net_profit=$net_profit+$profit;
                    $net_sellingprice=$net_sellingprice+$dtl->pil_price;
                    $net_costing=$net_costing+$dtl->pil->buy_price;
                    
                 }
                  $order_history[]=array('id'=>$list->id,'net_profit'=>  number_format((float)$net_profit,2,'.',','),'net_sellingprice'=>  number_format((float)$net_sellingprice,2,'.',','),'net_costing'=>  number_format((float)$net_costing,2,'.',','),'name'=>$list->name,'email'=>$list->email,'amt'=> number_format((float)$list->amt,2,'.',','),'date'=>$place_order_date,"qty"=>$qty);  
                }
            
            
            $datetime1 = new \DateTime($start_time);
            $datetime2 = new \DateTime($end_time);
            $difference = $datetime1->diff($datetime2);
            $no_of_days=$difference->days;
            while($i<=$no_of_days)
            {
                $sum=0;
                $conditions['is_active']=1;
                $conditions['is_complete']=1;
                $conditions['transaction_id !=']="";
                $conditions['is_reject']=0;
                $conditions['isverified']=1;
                $conditions['date >=']=$start_time;
                $conditions['date <=']=$initital_end;
                $transactions=$this->Orders->find('all', ['conditions' => [$conditions], 'contain' => ['Orderdetails'=>['Pils']]])->toArray(); ;
                foreach ($transactions as $tr)
                {


                    foreach ($tr->orderdetails as $order_details)
                    {
                    $profit=$order_details->pil_price-$order_details->pil->buy_price ;
                    $sum=$sum+$profit;
                    $flag=1;
                    }
                }
                
                $userTimezone = new \DateTimeZone($timezone);
                $gmtTimezone = new \DateTimeZone('GMT'); 
                $myDateTime = new \DateTime($start_time, $gmtTimezone);
                $offset = $userTimezone->getOffset($myDateTime);
                $d=date('d-m-Y', $myDateTime->format('U') + $offset);
                $monthname=$month[date('m',strtotime($d))].'-'.date('y',strtotime($d));
                $monthly[$monthname][]=!empty($sum)? $sum:0;
               
                $start_time=date('Y-m-d H:i:s', strtotime("+1 days", strtotime($start_time)));;
                $initital_end=date('Y-m-d H:i:s', strtotime("+1 days", strtotime($start_time)));  
                $i++;
            
                
            }
            
            foreach($monthly as $month=> $rec)
            {
                $x[]=$month;
                $y[]= array_sum($rec);
            }
            
            
            
            
            
            
           $result=array('x'=>$x,'y'=>$y,'flag'=>$flag,'order_history'=>$order_history);
            
        }
        
         if($type=='yearly')
        {
            $i=0;
            $datetime1 = new \DateTime($start_time);
            $datetime2 = new \DateTime($end_time);
            $difference = $datetime1->diff($datetime2);
            $no_of_days=$difference->days;
           $listings = $this->Orders->find()->select(['id','name','email','amt','date'])->where(
                        ['is_active'=>1,'is_reject'=>0,'isverified'=>1,"is_complete"=>1,"transaction_id !="=>'',"date >="=>$start_time,"date <="=>$end_time]
                        )->contain(['Orderdetails'=>['Pils']])->order(['date'=>'desc'])->all()->toArray();
            
                       
                foreach ($listings as $list)
                {
                  $order_date=date('Y-m-d h:i',strtotime($list->date));
                  $gmtTimezone = new \DateTimeZone('GMT'); 
                  $myDateTime = new \DateTime($order_date, $gmtTimezone);
                  $offset = date("P");
                  $qty=count($list->orderdetails);
                  $place_order_date=date('d/m/Y h:i a', $myDateTime->format('U') + $offset);
                  $net_profit=0;
                  $net_sellingprice=0;
                  $net_costing=0;
                  foreach ($list->orderdetails as $dtl)
                 {
                    $profit=$dtl->pil_price-$dtl->pil->buy_price;
                    $net_profit=$net_profit+$profit;
                    $net_sellingprice=$net_sellingprice+$dtl->pil_price;
                    $net_costing=$net_costing+$dtl->pil->buy_price;
                    
                 }
                  $order_history[]=array('id'=>$list->id,'net_profit'=>  number_format((float)$net_profit,2,'.',','),'net_sellingprice'=>  number_format((float)$net_sellingprice,2,'.',','),'net_costing'=>  number_format((float)$net_costing,2,'.',','),'name'=>$list->name,'email'=>$list->email,'amt'=> number_format((float)$list->amt,2,'.',','),'date'=>$place_order_date,"qty"=>$qty);  
                }
            while($i<=$no_of_days)
            {
                
                $sum=0;
                $conditions['is_active']=1;
                $conditions['is_complete']=1;
                $conditions['transaction_id !=']="";
                $conditions['is_reject']=0;
                $conditions['isverified']=1;
                $conditions['date >=']=$start_time;
                $conditions['date <=']=$initital_end;
                $transactions=$this->Orders->find('all', ['conditions' => [$conditions], 'contain' => ['Orderdetails'=>['Pils']]])->toArray(); ;
                foreach ($transactions as $tr)
                {


                    foreach ($tr->orderdetails as $order_details)
                    {
                    $profit=$order_details->pil_price-$order_details->pil->buy_price ;
                    $sum=$sum+$profit;
                    $flag=1;
                    }
                }
                
                $userTimezone = new \DateTimeZone($timezone);
                $gmtTimezone = new \DateTimeZone('GMT'); 
                $myDateTime = new \DateTime($start_time, $gmtTimezone);
                $offset = $userTimezone->getOffset($myDateTime);
                $d=date('d-m-Y', $myDateTime->format('U') + $offset);
                $monthname='Since-'.date('Y',strtotime($d));
                $monthly[$monthname][]=!empty($sum)?$sum:0;
                
                $start_time=date('Y-m-d H:i:s', strtotime("+1 days", strtotime($start_time)));;
                $initital_end=date('Y-m-d H:i:s', strtotime("+1 days", strtotime($start_time)));  
                $i++;
            
                
            }
            
            foreach($monthly as $month=> $rec)
            {
                $x[]=$month;
                $y[]= array_sum($rec);
            }
            
            
           $result=array('x'=>$x,'y'=>$y,'flag'=>$flag,'order_history'=>$order_history);
            
        }
       echo json_encode($result);exit;
    }
    
        public function pendingorders() {
        $this->viewBuilder()->layout('admin');
        $this->loadModel('Orders');
        $conditions['is_reject']=0;
        $conditions['isverified']=1;
        $conditions['is_delivered']=0;
        $conditions['is_complete']=1;
        $conditions['is_active']=1;
        $conditions['transaction_id !=']="";
        if(!empty($_REQUEST['start_date']) && !empty($_REQUEST['end_date']))
        {
          $starts= explode("/", $_REQUEST['start_date']);
          $ends= explode("/", $_REQUEST['end_date']);
          $start_date=$starts[2].'-'.$starts[1].'-'.$starts[0];
          $end_date=$ends[2].'-'.$ends[1].'-'.$ends[0];
        $conditions['date >=']=$start_date;
        $conditions['date <=']=$end_date;
        }
        $query = $this->Orders->find()->where($conditions)->order(['id' => 'DESC'])->all()->toArray(); 
        $uniqueDt = array();
        foreach($query as $q){
            $uniqueDt[$q->transaction_id]['id'] = $q->id;
        }
        $dtArr = array();
        foreach($uniqueDt as $dt){
            $dtArr[$dt['id']] = $dt['id'];
        }
        if(empty($dtArr)){ $dtArr[0] = 0; }            
            
            
        $this->set('orders', $this->Paginator->paginate($this->Orders, [ 'limit' => 10, 'order' => [ 'id' => 'DESC' ], 'conditions' => [ 'id IN' => $dtArr ]]));
        $output="";
        if (!empty($_REQUEST['export']))
        {
            $output.="#,";
            $output.="Order From,";
            $output.="Transaction Id,";
            $output.="Order Date,";
            $output.="\n";
            $ik = 1;
            $export_data = $this->Orders->find('all', ['conditions' => [ 'id IN' => $dtArr ],'order' => ['Orders.id' => 'DESC']])->toArray();
            
            foreach($export_data as $result)
            {
                
                $output.='"' . str_replace('"', '""',$ik ) . '", ';
                $output.='"' . str_replace('"', '""', $result->name) . '", ';
                $output.='"' . str_replace('"', '""', $result->transaction_id) . '", ';
                $output.='"' . str_replace('"', '""', date('d F Y', strtotime($result->date))) . '", ';
                $output .="\n";
                $ik++;

            }
            
            $filename = "pendingDelivery".time().".csv";
            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename='.$filename);
            echo $output;
            exit;

            
          
        }
        
        
        
        
        $this->set(compact('dtArr'));

    }
    
    function details($id)
    {
     $order = $this->Orders->find()->where(['id'=>$id])->contain(['Orderdetails' => ['Pils','Medicines']])->first()->toArray(); 
     $this->set(compact('order'));
        
    }
    
    function detailpil($pill)
    {
        $this->loadModel('Orderdetails');
        $conditions['Orders.is_active']=1;
        $conditions['Orders.is_reject']=0;
        $conditions['Orders.isverified']=1;
        $conditions['Orders.is_complete']=1;
        $conditions['Orders.transaction_id !=']="";
        $conditions['Orderdetails.pil_id']=$pill;
        $orderDetails = $this->Orderdetails->find('all', ['conditions' => [$conditions], 'contain' => ['Orders'],'order'=>['Orders.date'=>'desc']])->toArray();
        $this->set(compact('orderDetails'));
        
        
    }
    
    function UpdatePils()
    {
       $this->loadModel('Pils');
       $pils = $this->Pils->find('all')->toArray();
       foreach($pils as $pil)
       {
           $rec['buy_price']=$pil->cost-5;
           $ordersTable = TableRegistry::get('Pils');
           $query = $ordersTable->query();
           
           $query->update()->set($rec)->where(['id' => $pil->id])->execute(); 
       }

    exit;            

        
    }
    public function barcode($text = null, $size = null, $size_tekst = null,$name = null){
     	//$text = (isset($_GET["text"])?$_GET["text"]:"0");
		//$size = (isset($_GET["size"])?$_GET["size"]:"20");
		//$size_tekst = (isset($_GET["size_tekst"])?$_GET["size_tekst"]:"0");
		$orientation = "horizontal";//(isset($_GET["orientation"])?$_GET["orientation"]:"horizontal");
		$code_type = "code128";//(isset($_GET["codetype"])?$_GET["codetype"]:"code128");
		$code_string = "";//(isset($_GET["codestring"])?$_GET["codestring"]:"");
//echo $text;echo 'hi';exit;
		// Translate the $text into barcode the correct $code_type
		if ( strtolower($code_type) == "code128" ) {
			$chksum = 104;
			// Must not change order of array elements as the checksum depends on the array's key to validate final code
			$code_array = array(" "=>"212222","!"=>"222122","\""=>"222221","#"=>"121223","$"=>"121322","%"=>"131222","&"=>"122213","'"=>"122312","("=>"132212",")"=>"221213","*"=>"221312","+"=>"231212",","=>"112232","-"=>"122132","."=>"122231","/"=>"113222","0"=>"123122","1"=>"123221","2"=>"223211","3"=>"221132","4"=>"221231","5"=>"213212","6"=>"223112","7"=>"312131","8"=>"311222","9"=>"321122",":"=>"321221",";"=>"312212","<"=>"322112","="=>"322211",">"=>"212123","?"=>"212321","@"=>"232121","A"=>"111323","B"=>"131123","C"=>"131321","D"=>"112313","E"=>"132113","F"=>"132311","G"=>"211313","H"=>"231113","I"=>"231311","J"=>"112133","K"=>"112331","L"=>"132131","M"=>"113123","N"=>"113321","O"=>"133121","P"=>"313121","Q"=>"211331","R"=>"231131","S"=>"213113","T"=>"213311","U"=>"213131","V"=>"311123","W"=>"311321","X"=>"331121","Y"=>"312113","Z"=>"312311","["=>"332111","\\"=>"314111","]"=>"221411","^"=>"431111","_"=>"111224","\`"=>"111422","a"=>"121124","b"=>"121421","c"=>"141122","d"=>"141221","e"=>"112214","f"=>"112412","g"=>"122114","h"=>"122411","i"=>"142112","j"=>"142211","k"=>"241211","l"=>"221114","m"=>"413111","n"=>"241112","o"=>"134111","p"=>"111242","q"=>"121142","r"=>"121241","s"=>"114212","t"=>"124112","u"=>"124211","v"=>"411212","w"=>"421112","x"=>"421211","y"=>"212141","z"=>"214121","{"=>"412121","|"=>"111143","}"=>"111341","~"=>"131141","DEL"=>"114113","FNC 3"=>"114311","FNC 2"=>"411113","SHIFT"=>"411311","CODE C"=>"113141","FNC 4"=>"114131","CODE A"=>"311141","FNC 1"=>"411131","Start A"=>"211412","Start B"=>"211214","Start C"=>"211232","Stop"=>"2331112");
			$code_keys = array_keys($code_array);
			$code_values = array_flip($code_keys);
			for ( $X = 1; $X <= strlen($text); $X++ ) {
				$activeKey = substr( $text, ($X-1), 1);
				$code_string .= $code_array[$activeKey];
				$chksum=($chksum + ($code_values[$activeKey] * $X));
			}
			$code_string .= $code_array[$code_keys[($chksum - (intval($chksum / 103) * 103))]];

			$code_string = "211214" . $code_string . "2331112";
		} elseif ( strtolower($code_type) == "code39" ) {
			$code_array = array("0"=>"111221211","1"=>"211211112","2"=>"112211112","3"=>"212211111","4"=>"111221112","5"=>"211221111","6"=>"112221111","7"=>"111211212","8"=>"211211211","9"=>"112211211","A"=>"211112112","B"=>"112112112","C"=>"212112111","D"=>"111122112","E"=>"211122111","F"=>"112122111","G"=>"111112212","H"=>"211112211","I"=>"112112211","J"=>"111122211","K"=>"211111122","L"=>"112111122","M"=>"212111121","N"=>"111121122","O"=>"211121121","P"=>"112121121","Q"=>"111111222","R"=>"211111221","S"=>"112111221","T"=>"111121221","U"=>"221111112","V"=>"122111112","W"=>"222111111","X"=>"121121112","Y"=>"221121111","Z"=>"122121111","-"=>"121111212","."=>"221111211"," "=>"122111211","$"=>"121212111","/"=>"121211121","+"=>"121112121","%"=>"111212121","*"=>"121121211");

			// Convert to uppercase
			$upper_text = strtoupper($text);

			for ( $X = 1; $X<=strlen($upper_text); $X++ ) {
				$code_string .= $code_array[substr( $upper_text, ($X-1), 1)] . "1";
			}

			$code_string = "1211212111" . $code_string . "121121211";
		} elseif ( strtolower($code_type) == "code25" ) {
			$code_array1 = array("1","2","3","4","5","6","7","8","9","0");
			$code_array2 = array("3-1-1-1-3","1-3-1-1-3","3-3-1-1-1","1-1-3-1-3","3-1-3-1-1","1-3-3-1-1","1-1-1-3-3","3-1-1-3-1","1-3-1-3-1","1-1-3-3-1");

			for ( $X = 1; $X <= strlen($text); $X++ ) {
				for ( $Y = 0; $Y < count($code_array1); $Y++ ) {
					if ( substr($text, ($X-1), 1) == $code_array1[$Y] )
						$temp[$X] = $code_array2[$Y];
				}
			}

			for ( $X=1; $X<=strlen($text); $X+=2 ) {
				if ( isset($temp[$X]) && isset($temp[($X + 1)]) ) {
					$temp1 = explode( "-", $temp[$X] );
					$temp2 = explode( "-", $temp[($X + 1)] );
					for ( $Y = 0; $Y < count($temp1); $Y++ )
						$code_string .= $temp1[$Y] . $temp2[$Y];
				}
			}

			$code_string = "1111" . $code_string . "311";
		} elseif ( strtolower($code_type) == "codabar" ) {
			$code_array1 = array("1","2","3","4","5","6","7","8","9","0","-","$",":","/",".","+","A","B","C","D");
			$code_array2 = array("1111221","1112112","2211111","1121121","2111121","1211112","1211211","1221111","2112111","1111122","1112211","1122111","2111212","2121112","2121211","1121212","1122121","1212112","1112122","1112221");

			// Convert to uppercase
			$upper_text = strtoupper($text);

			for ( $X = 1; $X<=strlen($upper_text); $X++ ) {
				for ( $Y = 0; $Y<count($code_array1); $Y++ ) {
					if ( substr($upper_text, ($X-1), 1) == $code_array1[$Y] )
						$code_string .= $code_array2[$Y] . "1";
				}
			}
			$code_string = "11221211" . $code_string . "1122121";
		}
		// Pad the edges of the barcode
		$code_length = 20;
		for ( $i=1; $i <= strlen($code_string); $i++ )
			$code_length = $code_length + (integer)(substr($code_string,($i-1),1));

		if ( strtolower($orientation) == "horizontal" ) {
			$img_width = $code_length;
			$img_height = $size+$size_tekst+$size_tekst*0.4;
		} else {
			$img_width = $size;
			$img_height = $code_length;
		}
		$image = imagecreate($img_width, $img_height+$size_tekst*0.4);
		$black = imagecolorallocate ($image, 0, 0, 0);
		$white = imagecolorallocate ($image, 255, 255, 255);

		imagefill( $image, 0, 0, $white );
		$bbox = imagettfbbox($size_tekst,0,WWW_ROOT.'arial.ttf',$text);
		$tekst_prawy= $bbox[2];
		$tekst_lewy = $bbox[0];
		$szerokosc_tekstu=$tekst_prawy-$tekst_lewy;
		$offset_x=$img_width/2.0-$szerokosc_tekstu/2.0;
		$location = 10;
		for ( $position = 1 ; $position <= strlen($code_string); $position++ ) {
			$cur_size = $location + ( substr($code_string, ($position-1), 1) );
			if ( strtolower($orientation) == "horizontal" )
				imagefilledrectangle( $image, $location, 0, $cur_size, $img_height-$size_tekst, ($position % 2 == 0 ? $white : $black) );
			else
				imagefilledrectangle( $image, 0, $location, $img_width, $cur_size, ($position % 2 == 0 ? $white : $black) );
			$location = $cur_size;
		}
		imagettftext($image, $size_tekst, 0, $offset_x, $size+$size_tekst+$size_tekst*0.6, $black, WWW_ROOT.'arial.ttf', $text);
		//header ('Content-type: image/png');
		$path = WWW_ROOT.'img/'.$name.'.png';
		imagepng($image,$path);
		imagedestroy($image);
return $path;
     }

    public function downloads($id){
        //pr($id);die;
//echo ROOT."/webroot/barcode/autoload.php";
		$this->loadModel('Postcards');
$postcode = $this->Postcards->find()->where(['id' =>$id])->first();
	//pr($postcode['order_id']); die;
		$input = $postcode['id'];
        $pcode = str_pad($input, 4, "0", STR_PAD_LEFT);
		//echo $pcode; die;
$this->loadModel('Orders');
$ordercode = $this->Orders->find()->where(['id' => $postcode['order_id']])->first();
		$ocode = $ordercode['id'];
		$input = $ocode;
        $ocode = str_pad($input, 4, "0", STR_PAD_LEFT);
	//	pr($ocode);die;
$this->loadModel('Users');
$usercode = $this->Users->find()->where(['id' => $ordercode['user_id']])->first();
		$ucode = $usercode['id'];
		$code = $ucode;
		//pr($code);die;
         $codes = str_pad($code, 4, "0", STR_PAD_LEFT);
		//echo $codes; die;
		$barcode = $codes.$ocode.$pcode;
		//echo $barcode;die;
		//echo 'lll';die;

$s = $this->barcode($barcode,'100','17',$barcode);
//var_dump($s); exit;
      $this->viewBuilder()->layout('admin');
         $this->loadModel('Postcards');
         $this->loadModel('Orders');
        $orders = $this->Orders->get($ocode);
       // pr($orders);die;
        
        
         require_once(WWW_ROOT."vendor/autoload.php");
	
		// require (WWW_ROOT."card_bardcode/BarcodeGeneratorHTML.php");
		
		//echo 'lll'; die;
		
	$bcode = array();


		
         $dompdf = new DOMPDF();
        
            //  $this->loadModel('Properties');
            // $events = $this->Propertykey->find()->where(['user_id' => $uid])->toArray();
           //
         
                    $events=$this->Orders->find("all")->where(["id"=>$ocode])->toArray();
		          // $events=$this->Orders->find("all")->where(["id"=>$ocode])->toArray();

                  $post_name = $postcode['name'];
		           $post_address = $postcode['address'];
		           $address = substr($post_address, 0, 30);
		           $address1 = substr($post_address,30);
		          $address2 = substr($post_address,60);
		




$html ='
<html>
<head>
<style>
#top-table{
    top:0px;
     float:right;
}
th{
    font-size:12;
}
td{
    
    font-size:10;
}
.title {
    border-bottom: 1px solid #ddd;
    padding-botton:50px;
    padding-top:2px;
    padding-left:5px;
    height: 50px;
    font-family: arial;
}
#logo-table{
    
}
.bottom-table{
        float:right;
        position: absolute;
        bottom:0px;
        border-top: 1px solid;
        width:100%;
}
.table-label{
    font-size:10;
    font-weight:bold;
}
</style>

</head>
 <body>';
                    if(!empty($events))
                                 {
                                    
                                  $i = 1; foreach ($events as $dt)
                                  { 
                                   // print_r($postcode['name']); die;
                                    $html.='
                                    <style>@import url("https://fonts.googleapis.com/css?family=Lato:300,400,700|Roboto");</style>
                                    <div style="margin-bottom: 100px; margin-left:70px; margin-top:20px;"><img src="'.WWW_ROOT.'img' . DS. $dt['front_image'].'" style="height:400px; width:580px;"/></div>
                                     <div style="position:relative; margin-left:70px;"><img src="'.WWW_ROOT.'img' . DS. 'backpost.png'.'" style="height:400px; width:580px;  position:absolute; top:0; left:0;"/>
									 
									 <div class="postCardPart" style="position: absolute; top: 0; left: 0;  width: 100%;">
              				<div class="leftPostCard" style="width: 40%;position: absolute;top: 20px;padding: 10px; height:10px;">
		  						<div class="leftPostCardImg" style="width: 100%; padding: 0 20px; ">
		  							<p style="font-family: sans-serif; font-size: 12px;font-style: normal;font-variant: normal;font-weight: 200;line-height: 15px; color:#393939; text-align:justify;">'.$postcode['message'].'</p>
								</div>
								
              				</div>
							<img src="'.$s.'" alt="barcode" style="height:40px; width:90px; margin-left:33px; margin-bottom:30px; margin-top:320px;">
              				<div class="rightPostCard" style="width: 50%;position: absolute;right: 2px; top: 130px;">
              					<div class="rightPostCardImg" style="width: 100%;  padding: 1px 1px;">
              						<h2 style="font-size: 17px; color: #000; font-family:sans-serif;">'.$post_name.'</h2>
              						<p style=" margin-bottom: 0px; font-family: sans-serif;font-size: 12px;font-style: normal;font-variant: normal;font-weight: 200;line-height: 20px;color:#393939; text-align:justify;">'.$address.'</p>
              						<p style=" margin-bottom: 22px; font-family: sans-serif;font-style: normal;font-variant: normal;font-weight: 200;line-height: 20px; font-size: 12px; color:#393939; text-align:justify;">'.$address1.'</p>
              						<p style=" margin-bottom: 0px; font-family: sans-serif;font-size: 12px;font-style: normal;font-variant: normal;font-weight: 200;line-height: 5px; color:#393939;  text-align:justify;">'.$address2.'</p>
              					</div>
              				</div>
              			</div></div>
                                    ';
                                }
                            }
                            

    $html .=      ' 
      
   </body>
 
</html>';


//echo $html; die;                   


$dompdf->loadHtml($html);

$dompdf->render();

$dompdf->stream("Postcards.pdf", array("Attachment" => false));
exit(0);

    

    }
    
        
        
        
   
    
    
}
