 public function addorder(){
         if ($this->request->is('ajax')) {
            $this->autoRender = false;
        }
          $this->Session= $this->request->session();
         
         ////$orderdetail = $this->Orderdetails->newEntity();
         // pr($session);die;
		 
         if ($this->request->isPost()) {
			 
        $products= array(
            'foodname' => $this->request->data('foodname'),
            'foodprice' => $this->request->data('foodprice'),
            'quantity' => $this->request->data('quantity'),
            'id'=> $this->request->data('id')
        );
        //$_SESSION['ordersss'][] = $products;
        
         
		 if($this->Session->read('orders')){
			 //$test = 1;
			 foreach($this->Session->read('orders') as $val){
				 
				 if($val['id']==$this->request->data['id']){
					// $test = 0;
					  $val['quantity']=$val['quantity'] + $this->request->data['quantity'];
				 }
			 }
			 
			 $oldorder=$this->Session->read('orders');
			 array_push($oldorder,$products);
				//$this->Session->destroy('orders');
		      $this->Session->write('orders',$oldorder);
		 }else{
			 
			$this->Session->write('orders',$products); 
		 }
		
		 
     }
    $data[] = $products;
     $this->Session->write('orders', $data);
     
   $orderdetails = $this->Session->read('orders',$data);
  
    echo json_encode($orderdetails);
   