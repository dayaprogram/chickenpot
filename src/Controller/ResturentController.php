<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenDate;
use Cake\Database\Type;
use Cake\Routing\Router;
use Cake\Mailer\Email;
use Cake\Network\Session\DatabaseSession;
use Cake\View\Helper\HtmlHelper; 

Type::build('date')->setLocaleFormat('yy/mm/dd');

/**
 * Addresses Controller
 *
 * @property \App\Model\Table\AddressesTable $Addresses
 */
class resturentController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     * 
     */
    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['index','customerdetails', 'menu', 'shop', 'orderlist', 'home2', 'ourstory', 'blog', 'contactus', 'details', 'addorder', 'viewcart', 'addtokrt', 'deletecart','cartview','updateQcart','signup']);
    }

    public function index() {
     //   php_info();
        
    }

    public function menu() {
        //echo "menu";die;
    }

    public function home2() {
        
    }

    public function ourstory() {
        
    }

    public function blog() {
        
    }

    public function contactus() {
        
    }
    
    public function customerdetails(){
        $this->loadModel('Users');
         $this->loadModel('Area_master');
         $this->loadModel('Shipping_add');
        $select_location = $this->Area_master->find()->toArray();
          $uid = $this->Auth->user('id');
        $userdetails = $this->Users->find('all')->where(['id' => $uid])->first();
        $shipping =  $this->Shipping_add->newEntity();
          if ($this->request->is('post')) 
       {
              $flag = true;
           if($this->request->data('first_name') == ""){
                $this->Flash->error(__('Please Enter Your  First Name')); $flag = false;
           } 
           if($this->request->data('last_name') == ""){
                $this->Flash->error(__('Please Enter Your Last Name')); $flag = false;
           } 
            if($this->request->data('email') == ""){
                $this->Flash->error(__('Please Enter Your Email')); $flag = false;
           }
            if($this->request->data('contact_no') == ""){
                $this->Flash->error(__('Please Enter Your Mobile Number')); $flag = false;
           }
            if($this->request->data('address') == ""){
                $this->Flash->error(__('Please Enter Your Address')); $flag = false;
           }
           if($flag){
               $uniqid = uniqid();
             $rand_start = rand(1,5);
           $rand_8_char = substr($uniqid,$rand_start,8);
           $this->request->data['shipping_code'] = $rand_8_char;
           $this->request->data['user_id']= $uid;
            $this->request->data['address1']= $this->request->data['address'];
            $this->request->data['area_code']= $this->request->data['location'];
               $shipping =  $this->Shipping_add->patchEntity($shipping, $this->request->data); 
                $shp_id = $this->Shipping_add->save($shipping);
               // pr($shp_id); die;
                $this->Flash->success(__('Shipping Details is Saved'));
                return $this->redirect(["controller" => "resturent", "action" => "shipping", $shp_id->shipping_id]);
              }
       }
        $this->set(compact('userdetails','select_location'));
    }

    public function shop() {
        session_start();
        $this->loadModel('Item');
        $getitem = $this->Item->find('all')->toArray();
        $this->set(compact('getitem'));
    }

    public function details($id = null) {
        $this->loadModel('Item');
        $getitem = $this->Item->find('all')->where(['id' => $id])->first();
        $this->set(compact('getitem'));
    }

//              public function signup() {
//        $this->loadModel('Users');
//        $responce = array();
//        $logs = array(
//            'password' => $this->request->data['password'],
//            'email' => $this->request->data['email'],
//            'name' => $this->request->data['name'],
//        );
//        //print_r($logs);
//        $this->viewBuilder()->layout('default');
//
//        $user = $this->Users->newEntity();
//        if ($this->request->is('post')) {
//            //echo $'lll'; die;
//            //Checking if email is already exists.
//            $flag = true;
//            $tableRegObj = TableRegistry::get('Users');
//            $userExist = $tableRegObj
//                            ->find()
//                            ->where(['email' => $this->request->data['email']])->toArray();
//            // pr($userExist);
//            // Users form validation
//            if ($flag) {
//                if ($userExist) {
//                    $flag = false;
//                    // echo 'lll'; die;    
//                    $responce = array('Ack' => '0', 'msg' => 'Email is already Registered');
//                }
//            }
//
//            if ($flag) {
//                $this->request->data['ptxt'] = base64_encode($this->request->data['password']);
//                $this->request->data['created'] = gmdate("Y-m-d h:i:s");
//                $this->request->data['modified'] = gmdate("Y-m-d h:i:s");
//                $themail = $this->request->data['email'];
//                $name = $this->request->data['name'];
//
//                $user = $this->Users->patchEntity($user, $this->request->data);
//                //print_r($this->request->data); die;
//                if ($rs = $this->Users->save($user)) {
//
//                    $unique_id = $this->generateRandomString();
//                    $unique_id = $unique_id . $rs->id;
//
//                    $subquestion = TableRegistry::get('Users');
//                    $query = $subquestion->query();
//                    $query->update()->set(['unique_id' => $unique_id])->where(['id' => $rs->id])->execute();
//                }
//            }
//            echo json_encode($responce);
//            die;
//        }
//    }
    public function signup(){
        $this->loadModel('Users');
        $user = $this->Users->newEntity();
        if($this->request->is('post')){
            $phone = $this->request->data('contact_no');
            $existsUser = $this->Users->find('all')->where(['phone' => $phone])->toArray();
            $flag = true;
            if(!empty($existsUser)){
                $this->Flash->error(__('Mobile number is already registered!'));
                $flag = false;
            }else{
                $user= $this->Users->patchEntity($user,$this->request->data);
                $this->Users->save($user);
                $this->Flash->success(__('Registered'));
                return $this->redirect(["controller" => "users", "action" => "signin"]);
               
              }
            
        }       
				
    }
   	
    
    public function shipping($id){
        $this->loadModel('Shipping_add');
        $this->loadModel('Users');
        $this->loadModel('Area_master');
        $select_location = $this->Area_master->find()->toArray();
        $details = $this->Shipping_add->find('all')->where(['shipping_id' => $id])->first();
      //  pr($details); die;
          $uid = $this->Auth->user('id');
           if ($this->request->is(['patch', 'post', 'put'])) {
           $tableRegObj = TableRegistry::get('Shipping_add');
                    $query = $tableRegObj->query();
                    $query->update()->set(['first_name' => $this->request->data['first_name'], 'last_name' => $this->request->data['last_name'],'email' => $this->request->data['email'],'address1' => $this->request->data['address'],'area_code'=> $this->request->data['location']])->where(['shipping_id' => $id])->execute();
                    if($query){
                        $this->checkout();
                    }
           }
                    $userdetails = $this->Users->find('all')->where(['id' => $uid])->first();
        $this->set(compact('details','select_location'));
        
    
    }
        
    
//    public function signin($val = null) {
//        //echo 'lll'; die;
//        $responce = array();
//        $logs = array(
//            'password' => $this->request->data['password'],
//            'phone' => $this->request->data['phone'],
//        );
//        // print_r($logs);die;
//        if ($this->request->is('post')) {
//            // print_r($logs);die;
//            $user = $this->Auth->identify();
//            //print_r($user); die;
//            if (!empty($user)) {
//                $this->Auth->setUser($user);
//               // if ($user['utype'] == 1) {
//
//                    $SiteSettings = $this->site_setting();
//                    $is_login = 0;
//
//                    // echo 'll'; die;
//                    $responce = array('Ack' => '1', 'msg' => 'Successfully login');
//              //  }
//            } else {
//                $responce = array('Ack' => '0', 'msg' => 'Register your email.');
//            }
//            echo json_encode($responce);
//            exit;
//            //$this->set('response', $response);
//        }
//    }

    public function logout() {
        $session = $this->request->session();
        $session->delete('Auth.User');
        return $this->redirect('/');
    }

    public function orders() {
        echo 'lll';
        die;
    }

    public function orderlist() {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
        }

        $session = $this->request->session();
        if ($this->request->isPost()) {

            // get values here 
//            echo $this->request->data['id'];
            $var = $this->request->data['id'];

            if ($session->read('id') == '') {
                $session->write('id', $var); //Write
            } else {
//                echo "hihiihihih";
                $old_id = $session->read('id');
                $session->write('id', $old_id . '_' . $var); //Write
            }
        }

//        pr($session->read('id'));
//      pr($this->request->post['id']); 
//        echo 'll's;
        die;
    }
    public function checkout(){
        $this->loadModel('orderlist');
        $this->loadModel('Users');
        
    $this->Session = $this->request->session();
   $setsession = $this->Session->read('cart_item');
    $uid = $this->Auth->user('id');
      $userdetails = $this->Users->find('all')->where(['id' => $uid])->first();
  //  pr($setsession);die;
   foreach($setsession as $orders){
       for($i=0; $i<=count($orders["id"]); $i++){
            $cart =  $this->orderlist->newEntity(); 
           $val = array(
                        'foodname' => $orders["foodname"][$i],
                        'quantity' => $orders["quantity"][$i],
                        'item_id' => $orders["id"][$i],
                        'user_id'=> $userdetails["id"],
                        'address'=> $userdetails["address"],
                        'phone'=> $userdetails["phone"],
                    ); 
           //var_dump($val);
           $cart = $this->orderlist->patchEntity($cart, $val);
           if(!empty($cart->item_id)){
               $orderkrt= $this->orderlist->save($cart);
           
      } }die;
   }die;
    
     }

    public function addorder() {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
        }
        $this->Session = $this->request->session();

        ////$orderdetail = $this->Orderdetails->newEntity();
        // pr($session);die;

        if ($this->request->isPost()) {
            $products = array(
                'foodname' => $this->request->data('foodname'),
                'foodprice' => $this->request->data('foodprice'),
                'quantity' => $this->request->data('quantity'),
                'id' => $this->request->data('id')
            );
            //$_SESSION['ordersss'][] = $products;


            if ($this->Session->read('orders')) {
                $oldorder = $this->Session->read('orders');

                echo 'before:';
                pr($oldorder);
                array_push($oldorder, $products);
                echo 'after:';
                pr($oldorder);
                //$this->Session->destroy('orders');
                $this->Session->write('orders', $oldorder);
            } else {

                $this->Session->write('orders', $products);
            }
        }
        $data[] = $products;
        $this->Session->write('orders', $data);

        $orderdetails = $this->Session->read('orders', $data);

        echo json_encode($orderdetails);
    }

    public function viewcart() {
        $sessin = $this->set('session', $this->Session);
    }

    public function addtokrt() {
        if (!empty($this->request->data("quantity"))) {
            //$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
            // $this->Session= $this->request->session('cart_item');
            $this->Session = $this->request->session();
            $itemArray[$this->request->data('id')] =
                    array(
                        'foodname' => $this->request->data('foodname'),
                        'foodprice' => $this->request->data('foodprice'),
                        'quantity' => $this->request->data('quantity'),
                        'image' => $this->request->data('img'),
                        'id' => $this->request->data('id')
            );
//            $this->Session->delete('cart_item');
//            pr($this->Session->read('cart_item'));
//            pr();

            if (!empty($this->Session->read('cart_item'))) {
//                pr(array_merge($this->Session->read('cart_item'),$itemArray));
////                pr($_SESSION);
                if (in_array($this->request->data('id'), array_column($this->Session->read('cart_item'), 'id'))) {
                  $krt = $this->cartview();
//            pr(array_values($this->Session->read('cart_item')));
//            die;
//                if (in_array($this->request->data('id'), current(array_column($this->Session->read('cart_item'),'id')))) {
//            pr(array_column($this->Session->read('cart_item'),'id'));
//                    foreach ($this->request->session()->read('cart_item') as $k => $v) {
//                        if ($itemArray == $k) {
//                            if (empty($this->request->session('cart_item')[$k]["quantity"])) {
//                                $this->request->session('cart_item')[$k]["quantity"] = 0;
//                            }
//                            $this->request->session('cart_item')[$k]["quantity"] += $_POST["quantity"];
//                        }
//                    }
                    $krt = $this->cartview();
                    echo '{"code":"0","msg":"You have already added in your cart!","cartvalue":'.$krt.'}';
                } else {
                    $arr = array_merge($this->Session->read('cart_item'), $itemArray);
                    $this->Session->write('cart_item', $arr);
                    $krt = $this->cartview();
//                    $view=$this->cartview();
                    echo '{"code":"1","msg":"Cart is added to your account!","cartvalue":'.$krt.'}';
                    //$this->request->session('cart_item') = array_merge($this->request->session('cart_item'),$itemArray);
                }
            } else {
                if ($this->Session->write('cart_item', $itemArray)) {
                    $krt = $this->cartview();
                    echo '{"code":"1","msg":"You have already added in your cart!","cartvalue":'.$krt.'}';
                } else {
                    $krt = $this->cartview();
                    echo '{"code":"0","msg":"You have already added in your cart!","cartvalue":'.$krt.'}';
                }
//                $this->request->session('cart_item') = $itemArray;
            }
        }
        die;
    }

    public function deletecart() {
        session_start();
        if (!empty($this->request->data("id"))) {
//            pr($this->request->session()->read('cart_item')); die;
            $sessionArr = $_SESSION['cart_item'];
            foreach ($sessionArr as $key => $value) {
//                print_r($sessionArr); die;
                if ($value['id'] == $this->request->data("id")) {
                    $this->request->session()->delete('cart_item.' . $key);
                    echo '1';
                }
            }
        } else {
            echo '0';
        }
        die;
    }

  public function cartview() {
       $html = new HtmlHelper(new \Cake\View\View());
       $subtotal = "0.00";
       $view = "";
        if (!empty($this->request->session()->read('cart_item'))) {
            foreach ($this->request->session()->read('cart_item') as $data) {   
               $view.='<div class="cart-food" id="' . $data["id"] . '"><div class="detail"><a href="javascript:;" class="btn btn-danger pull-right" onclick="return deleteItem(' . $data["id"] . ');"><i class="icon-icons163"></i></a><img src="' . $data["image"] . '" alt=""><div class="text">';
               $subtotal = $subtotal + ($data['foodprice'] * $data['quantity']);
               $view.='<a href="javascript:;">' . $data["foodname"] . '</a><p><span class="priceMoney hidden">' . $data["foodprice"] . '</span>
                        ' . $data["foodprice"] . ' x <input type="number" style="width:40px;" value="' . $data["quantity"] . '" id="changeValuePrice"> = <span id="calculatePrice">' . ($data["foodprice"] * $data["quantity"]) . '</span></p></div></div></div>';
           }
       } else {
           $view.='<h7>No Card added to your account.</h7>';       
       }
       $view.='<div class="sub-total"><span>SUBTOTAL: <strong>$' . $subtotal . '</strong></span><div class="buttons">
           '.$html->link('VIEW CART',['controller' => 'resturent', 'action' => 'viewcart'],['class'=>'view-cart']). '<a href="javascript:;" class="check-out">Check Out</a></div></div>';
   
       return json_encode($view);
   }
   
   public function updateQcart(){
       if (!empty($this->request->data("id"))) {
            $sessionArr = $this->request->session()->read('cart_item');
//            $key=0;
//            pr($this->request->session()->read('cart_item.'.$key.'.quantity')); die;
            foreach ($sessionArr as $key => $value) {
                if ($value['id'] == $this->request->data("id")) {
                    $this->request->session()->write('cart_item.'.$key.'.quantity', $this->request->data("value"));
                    $krt = $this->cartview();
                    echo '{"code":"1","msg":"Item Quantity is updated successfully!","cartvalue":'.$krt.'}';
                }
            }
        } else {
            echo '0';
        }
        die;
   }

}
