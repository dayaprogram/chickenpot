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
class ResturentController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['index', 'customerdetails', 'menu', 'shop',
            'orderlist', 'home2', 'ourstory', 'blog', 'contactus', 'details',
            'addorder', 'viewcart', 'addtokrt', 'deletecart', 'cartview',
            'updateQcart', 'signup', 'tracklocation', 'updatePotPackFlag',
            'getValidCouponDtl', 'validateUserToredeemCoupon',
            'paymentsuccessbilldtl', 'paymetprocessdtl', 'login',
            'transactiondetails', 'transactindtls', 'applyDiscount']);
    }

    public function index() {
        
    }

    public function menu() {
        
    }

    public function home2() {
        
    }

    public function ourstory() {
        
    }

    public function blog() {
        
    }

    public function paymentsuccessbilldtl() {
        
    }

    public function paymetprocessdtl() {
        $this->Session = $this->request->session();
        $orderCompleteDeatail = array();
        if (empty($this->Session->read('orderCompleteDeatail'))) {
            $this->Session->write('orderCompleteDeatail', $orderCompleteDeatail);
        } else {
            return;
        }


        $cartItem = $this->Session->read('cart_item');
        //   pr($cartItem); die;
        $shippindAddDtl = $this->Session->read('shippindAddDtl');

        //$phone = $shippindAddDtl; die;
        $conn = ConnectionManager::get('default');
        $orderid = $conn->execute('select ifnull(max(order_id)+1,1) as order_id from payment_detail')->fetchAll('assoc')[0]['order_id'];
        $billno = $conn->execute('select ifnull(max(bill_no)+1,1) as bill_no from payment_detail')->fetchAll('assoc')[0]['bill_no'];
        $shipId = $conn->execute('select ifnull(max(shipping_code)+1,1) as shipping_code from shipping_add')->fetchAll('assoc')[0]['shipping_code'];
        $recno = $conn->execute('select ifnull(max(rec_no)+1,1) as rec_no from payment_detail')->fetchAll('assoc')[0]['rec_no'];

        // pr($couponDtlRowList[0]['order_id']); die;

        $this->loadModel('payment_detail');
        $this->loadModel('shipping_add');
        $this->loadModel('Orderlist');
        $id = $this->request->data('password_id');
        if (!empty($shippindAddDtl)) {
            $shippingdetails = $this->shipping_add->newEntity();
            $shippingvalues = array(
                'user_id' => $shippindAddDtl['user_id'],
                'first_name' => $shippindAddDtl['first_name'],
                'last_name' => $shippindAddDtl['last_name'],
                'address1' => $shippindAddDtl['address1'],
                'address2' => $shippindAddDtl['address2'],
                'landmark' => $shippindAddDtl['landmark'],
                'area_code' => $shippindAddDtl['area_code'],
                'contact_no' => $shippindAddDtl['contact_no'],
                'email' => $shippindAddDtl['email'],
                'shipping_code' => $shipId,
            );
            $shippingdetails = $this->shipping_add->patchEntity($shippingdetails, $shippingvalues);
            $this->shipping_add->save($shippingdetails);
        }

        if (!empty($cartItem)) {
            foreach ($cartItem as $key => $selpack) {
                // pr($selpack);
                $cartdetails = $this->Orderlist->newEntity();
                $foodDetails = array(
                    'user_id' => $shippindAddDtl['user_id'],
                    'item_id' => $selpack['id'],
                    'foodname' => $selpack['foodname'],
                    'quantity' => $selpack['quantity'],
                    'size_variant' => $selpack['foodsize'],
                    'pot_pack_flg' => $selpack['potpackflg'],
                    'phone_no' => $shippindAddDtl['contact_no'],
                    'description' => 'should be testy',
                    'is_active' => '1',
                    'COMMENT' => '',
                    'order_status' => 'G',
                    'delivery_date' => $shippindAddDtl['selectdate'],
                    'delivery_time' => $shippindAddDtl['selecttime'],
                    'delivery_method' => 'g',
                    'shipping_add_code' => $shipId,
                    'entry_date' => date('Y-m-d'),
                    'order_id' => $orderid,
                );
                $cartdetails = $this->Orderlist->patchEntity($cartdetails, $foodDetails);
                $this->Orderlist->save($cartdetails);
            }
        }

        $subtotal = 0.00;
        $foodbillAmt = 0.00;
        $finalbillamt = 0.00;
        if (!empty($cartItem)) {
            foreach ($cartItem as $data) {
                if ($data['potpackflg'] == 'A') {
                    $subtotal = $subtotal + ($data['foodprice'] * $data['quantity']) +
                            ($data['packCharge'] * $data['quantity']);
                } else {
                    $subtotal = $subtotal + ($data['foodprice'] * $data['quantity']);
                }
                $foodbillAmt = $foodbillAmt + ($data['foodprice'] * $data['quantity']);
            }
            $finalbillamt = $subtotal;
        }
        $dicountAmt = 0.00;
        $discountper = 0.00;
        if (!empty($this->Auth->user('id'))) {
            $discountper = $this->Session->read('discountper');
            $dicountAmt = ($foodbillAmt * $discountper) / 100;
            $subtotal = $subtotal - $dicountAmt;
        } else {
            $dicountAmt = 0.00;
        }




        $tax = 0.00;
        $finalbillamt = $finalbillamt + $tax;
        $discount = $dicountAmt;
        $finalpaid = $finalbillamt - $discount;
        $payment = $this->payment_detail->newEntity();
        $paymentDetais = array(
            'bill_no' => $billno,
            //'payment_id' => '1',
            'order_id' => $orderid,
            'customer_id' => $shippindAddDtl['user_id'],
            'total_bill_amt' => $foodbillAmt,
            'tax_amt' => $tax,
            'final_bill_amt' => $finalbillamt,
            'final_paid_amt' => $finalpaid,
            'bill_status' => 'G',
            'applied_coupon' => '',
            'discount_amt' => $discount,
            'rec_no' => $recno,
            'entry_date' => date('Y-m-d h:i:s'),
        );
        $payment = $this->payment_detail->patchEntity($payment, $paymentDetais);
        $this->payment_detail->save($payment);
        $orderCompleteDeatail = array(
            'bill_no' => $billno,
            'rec_no' => $recno,
            'order_id' => $orderid,
        );
        $this->Session->write('orderCompleteDeatail', $orderCompleteDeatail);
        $this->set(compact('subtotal'));
    }

    public function paymentfailuredtl() {
        
    }

    public function contactus() {
        
    }

    public function tracklocation() {

        $this->loadModel('Area_master');
        $select_location = $this->Area_master->find()->toArray();
        $date = date('Y-m-d'); //today date
        $this->Session = $this->request->session();
        if ($this->request->is('post')) {
            $tracklocation = array(
                'location' => $this->request->data['findlocation'],
                'date' => $this->request->data['selectdate'],
                'time' => $this->request->data['selecttime'],
                'chooselocation' => $this->request->data['trackloc'],
            );
            $this->Session->write('location', $tracklocation);

            if ($this->Session->read('location')) {
                return $this->redirect(["controller" => "resturent", "action" => "shop"]);
            }
        }
        $loc = $this->Session->read('location');
        $this->set(compact('select_location', 'times', 'loc'));
    }

    public function customerdetails() {
        $this->Session = $this->request->session();
        $loc = $this->Session->read('location');
        // pr($loc); die;
        $this->loadModel('Users');
        $this->loadModel('Area_master');
        $this->loadModel('Shipping_add');
        $select_location = $this->Area_master->find()->toArray();
        if (empty($this->Auth->user('id'))) {
            return $this->redirect(["controller" => "users", "action" => "signin"]);
        }
        $userdetails = array(
            'id' => $this->Auth->user('id'),
            'firstname' => $this->Auth->user('first_name'),
            'lastname' => $this->Auth->user('last_name'),
            'phone' => $this->Auth->user('phone'),
            'email' => $this->Auth->user('email'),
        );
        if ($this->request->is('post')) {
            $flag = true;
            if ($this->request->data('first_name') == "") {
                $this->Flash->error(__('Please Enter Your  First Name'));
                $flag = false;
            }
            if ($this->request->data('last_name') == "") {
                $this->Flash->error(__('Please Enter Your Last Name'));
                $flag = false;
            }
            if ($this->request->data('email') == "") {
                $this->Flash->error(__('Please Enter Your Email'));
                $flag = false;
            }
            if ($this->request->data('contact_no') == "") {
                $this->Flash->error(__('Please Enter Your Mobile Number'));
                $flag = false;
            }
            if ($this->request->data('address1') == "") {
                $this->Flash->error(__('Please Enter Your Address'));
                $flag = false;
            }
            if ($flag) {
//                $uniqid = uniqid();
//                $rand_start = rand(1, 5);
//                $rand_8_char = substr($uniqid, $rand_start, 8);
//                $this->request->data['shipping_code'] = $rand_8_char;
                $this->request->data['user_id'] = $this->Auth->user('id');

                $shippindAddDtl = array();
                if (!empty($this->request->data)) {
                    //print_r($_POST);
                    foreach ($this->request->data as $key => $value) {
                        $shippindAddDtl[$key] = $value;
                    }
                }


                if (empty($this->Session->read('shippindAddDtl'))) {
                    $this->Session->write('shippindAddDtl', $shippindAddDtl);
                } else {
                    $this->Session->delete('shippindAddDtl');
                    $this->Session->write('shippindAddDtl', $shippindAddDtl);
                }
                //$shipping = $this->Shipping_add->newEntity();
                //$this->Shipping_add->patchEntity($shipping, $this->request->data);
                //$this->Shipping_add->save($shipping);
                // pr($shp_id); die;
                $this->Flash->success(__('Shipping Details is Saved'));
                return $this->redirect(["controller" => "resturent", "action" => "shipping"]);
            }
        }
        $this->set(compact('userdetails', 'select_location', 'loc'));
    }

    public function shop($catagary = 'ALL') {
        session_start();
        $this->loadModel('Item');
        $this->loadModel('item_variant');
        $this->loadModel('ref_rec_type');
        if ($catagary == 'ALL') {
            $getitem = $this->Item->find('all')->where(['active_flag' => 'A'])->toArray();
        } else {
            $getitem = $this->Item->find('all')->where(['food_category' => $catagary, 'active_flag' => 'A'])->toArray();
        }
        $itemveriant = $this->item_variant->find('all')->toArray();
        $foodcatagoryList = $this->ref_rec_type->find()->select(['ref_code', 'ref_desc'])
                        ->where(['ref_rec_no' => '002'])->order(['order_by' => 'asc'])->toArray();
        $this->set(compact('itemveriant'));
        $this->set(compact('getitem'));
        $this->set(compact('foodcatagoryList'));
    }

    public function details($id = null) {
        $this->loadModel('Item');
        $getitem = $this->Item->find('all')->where(['id' => $id])->first();
        $this->set(compact('getitem'));
    }

    public function signup() {
        $this->loadModel('Users');
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $phone = $this->request->data('contact_no');
            $existsUser = $this->Users->find('all')->where(['phone' => $phone])->toArray();
            $flag = true;
            if (!empty($existsUser)) {
                $this->Flash->error(__('Mobile number is already registered!'));
                $flag = false;
                return $this->redirect(["controller" => "resturent", "action" => "signup"]);
            } else {
                $user = $this->Users->patchEntity($user, $this->request->data);
                $this->Users->save($user);
                $this->Flash->success(__('Registered'));
                return $this->redirect(["controller" => "users", "action" => "signin"]);
            }
        }
    }

    public function shipping() {
        $this->Session = $this->request->session();
        $shippindAddDtl = $this->Session->read('shippindAddDtl');
        $this->loadModel('Area_master');
        $areaDetail = array();
        if (!empty($shippindAddDtl)) {
            $areaDetail = $this->Area_master->find()->select(['area_code', 'area_name', 'city', 'state', 'country', 'pincode'])
                            ->where(['area_code' => $shippindAddDtl['area_code']])->first()->toArray();
        }
        //pr($areaDetail);die;
        $this->set(compact('areaDetail'));
    }

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
            $var = $this->request->data['id'];

            if ($session->read('id') == '') {
                $session->write('id', $var); //Write
            } else {
                $old_id = $session->read('id');
                $session->write('id', $old_id . '_' . $var); //Write
            }
        }
        die;
    }

    public function checkout() {
        $this->loadModel('orderlist');
        $this->loadModel('Users');

        $this->Session = $this->request->session();
        $setsession = $this->Session->read('cart_item');
        $uid = $this->Auth->user('id');
        $userdetails = $this->Users->find('all')->where(['id' => $uid])->first();
        //  pr($setsession);die;
        foreach ($setsession as $orders) {
            for ($i = 0; $i <= count($orders["id"]); $i++) {
                $cart = $this->orderlist->newEntity();
                $val = array(
                    'foodname' => $orders["foodname"][$i],
                    'quantity' => $orders["quantity"][$i],
                    'item_id' => $orders["id"][$i],
                    'user_id' => $userdetails["id"],
                    'address' => $userdetails["address"],
                    'phone' => $userdetails["phone"],
                );
                //var_dump($val);
                $cart = $this->orderlist->patchEntity($cart, $val);
                if (!empty($cart->item_id)) {
                    $orderkrt = $this->orderlist->save($cart);
                }
            }die;
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
                // pr($oldorder);
                array_push($oldorder, $products);
                echo 'after:';
                //
                //  pr($oldorder);
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
        $this->render();
    }

    public function addtokrt() {
        if (!empty($this->request->data("quantity"))) {
            $this->Session = $this->request->session();
            $itemArray[$this->request->data('id')] = array(
                'foodname' => $this->request->data('foodname'),
                'foodprice' => $this->request->data('foodprice'),
                'quantity' => $this->request->data('quantity'),
                'image' => $this->request->data('img'),
                'id' => $this->request->data('id'),
                'packCharge' => $this->request->data('packCharge'),
                'potpackflg' => $this->request->data('potpackflg'),
                'foodsize' => $this->request->data('foodsize')
            );
//            $this->request->session()->delete('cart_item');die;
            if (!empty($this->Session->read('cart_item'))) {

//                pr(array_merge($this->Session->read('cart_item'),$itemArray));die;
////                pr($_SESSION);
//                if (in_array($this->request->data('id'), array_column($this->Session->read('cart_item'), 'id'))&&
//                        in_array($this->request->data('foodsize'), array_column($this->Session->read('cart_item'), 'foodsize'))) {
                $curritem['foodsize'] = $this->request->data('foodsize');
                $curritem['id'] = $this->request->data('id');
                $currcartItem = array_filter($this->Session->read('cart_item'), function($v)use(&$curritem) {
                    return (($v['id'] === $curritem['id']) && ($v['foodsize'] === $curritem['foodsize']));
                });
                if (!empty($currcartItem)) {

//                    $krt = $this->cartview();
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
//                    pr($krt); die;
                    if (!empty($krt)) {
                        echo '{"code":"0","msg":"You have already added in your cart!","cartvalue":' . $krt . '}';
                    }
                } else {
                    $arr = array_merge($this->Session->read('cart_item'), $itemArray);
//                    pr($this->Session->read('cart_item'));die;
                    $this->Session->write('cart_item', $arr);
                    $krt = $this->cartview();
                    echo '{"code":"1","msg":"Food is added to your account!","cartvalue":' . $krt . '}';
                }
            } else {
                $this->Session->write('cart_item', $itemArray);
                $krt = $this->cartview();
                echo '{"code":"1","msg":"Food is added to your account!","cartvalue":' . $krt . '}';
            }
        }
        die;
    }

    public function deletecart() {
        session_start();
        if (!empty($this->request->data("id"))) {
            $krt = $this->cartview();
//            pr($this->request->session()->read('cart_item')); die;
            $sessionArr = $_SESSION['cart_item'];
            foreach ($sessionArr as $key => $value) {
//                print_r($sessionArr); die;
                if (($value['id'] == $this->request->data("id")) && ($value['foodsize'] == $this->request->data("foodsize"))) {
                    $this->request->session()->delete('cart_item.' . $key);
                    echo '1';
                }
            }
            $krt = $this->cartview();
        } else {
            $krt = $this->cartview();
            echo '0';
        }
        die;
    }

    public function cartview() {
        $html = new HtmlHelper(new \Cake\View\View());
        $subtotal = 0;
        $view = "";
        if (!empty($this->request->session()->read('cart_item'))) {
            foreach ($this->request->session()->read('cart_item') as $data) {
                $view .= '<div class="cart-food" id="' . $data["id"] . '"><div class="detail">'
                        . '<!--<a href="javascript:;" class="btn btn-danger pull-right" onclick="return deleteItem(' . $data["id"] . ');"><i class="icon-icons163"></i></a>-->'
                        . '<img src="' . $data["image"] . '" alt=""><div class="text">';
                $subtotal = $subtotal + ($data['foodprice'] * $data['quantity']);
                $view .= '<a href="javascript:;">' . $data["foodname"] . '</a><p><span class="priceMoney hidden">' . $data["foodprice"] .
                        '</span>' . $data['foodsize'] . '  &rightarrowtail;&nbsp;' . $data["foodprice"] . ' x <input type="number" style="width:40px;" value="' . $data["quantity"] . '" id="changeValuePrice"> = <span id="calculatePrice">' . ($data["foodprice"] * $data["quantity"]) . '</span></p></div></div></div>';
            }
        } else {
            $view .= '<h7>No Card added to your account.</h7>';
        }
//        echo $view; die;+
        $view .= '<div class="sub-total"><span>SUBTOTAL:<i class="icon-inr"></i><strong>' . $subtotal . '</strong></span><div class="buttons">
           ' . $html->link('MORE FOOD', ['controller' => 'resturent', 'action' => 'shop'], ['class' => 'view-cart']) . $html->link('CHECK OUT', ['controller' => 'resturent', 'action' => 'viewcart'], ['class' => 'check-out']);

        return json_encode($view);
    }

    public function updateQcart() {
        if ((!empty($this->request->data("id"))) && ($this->request->data("value") > 0)) {
            $sessionArr = $this->request->session()->read('cart_item');
//            $key=0;
//            pr($this->request->session()->read('cart_item.'.$key.'.quantity')); die;
            foreach ($sessionArr as $key => $value) {
                if (($value['id'] == $this->request->data("id")) && ($value['foodsize'] == $this->request->data("foodsize"))) {
                    $this->request->session()->write('cart_item.' . $key . '.quantity', $this->request->data("value"));
                    $krt = $this->cartview();
                    echo '{"code":"1","msg":"Item Quantity is updated successfully!","cartvalue":' . $krt . '}';
                }
            }
        } else {
            echo '0';
        }
        die;
    }

    public function updatePotPackFlag() {
        if ((!empty($this->request->data("id")))) {
            $sessionArr = $this->request->session()->read('cart_item');
            foreach ($sessionArr as $key => $value) {
                if (($value['id'] == $this->request->data("id")) && ($value['foodsize'] == $this->request->data("foodsize"))) {
                    $this->request->session()->write('cart_item.' . $key . '.potpackflg', $this->request->data("value"));
                    echo '{"code":"1","msg":"Pot Packing is updated successfully!"}';
                }
            }
        } else {
            echo '0';
        }
        die;
    }

    public function getValidCouponDtl() {
        $conn = ConnectionManager::get('default');
        if ((!empty($this->request->data("couponcode")))) {
            $couponcode = $this->request->data("couponcode");
            $billamt = $this->request->data("billamount");
            $today = date("Y-m-d");
            $validuserflg = $this->validateUserToredeemCoupon($couponcode);
            // var_dump($validuserflg);
            if ($validuserflg !== 'valid') {
                return $validuserflg;
            }

            $couponDtlRowList = $conn->execute('select coupon_code,discount_type,amt_or_per,max_amt '
                            . 'from coupon_master where coupon_code=? AND '
                            . '(? BETWEEN valid_from AND valid_to);', [$couponcode, $today])->fetchAll('assoc');

            $couponDtl = [];
            $discountAmt = 0;
            if (!empty($couponDtlRowList)) {
                foreach ($couponDtlRowList as $couponDtlRow) {
                    // Do something with the row.
                    $couponDtl = $couponDtlRow;
                    break;
                }
                if ($couponDtl['discount_type'] == 'P') {
                    $discountAmt = ($billamt * $couponDtl['amt_or_per']) / 100;
                    if ($discountAmt > $couponDtl['max_amt']) {
                        $discountAmt = $couponDtl['max_amt'];
                    }
                }
                if ($couponDtl['discount_type'] == 'A') {
                    $discountAmt = $couponDtl['amt_or_per'];
                }
            }
            echo $discountAmt;
        }
        die;
    }

    public function validateUserToredeemCoupon($couponcode) {
        $conn = ConnectionManager::get('default');
        $this->loadModel('coupon_master');
        $redmfreqType = $this->coupon_master->find()->select(['redm_freq'])->where(['coupon_code' => $couponcode])->first();


        $result = 'invalid';
        if (!empty($redmfreqType)) {
            if ($redmfreqType['redm_freq'] == 'ALL') {
                $result = 'valid';
            }

            if ($redmfreqType['redm_freq'] == 'FIRST') {
                $uid = $this->Auth->user('id');

                $couponUsedTimes = $conn->execute('select count(applied_coupon) from payment_detail'
                                . ' where applied_coupon=? and customer_id=?;', [$couponcode, $uid])->fetchAll('assoc');
                //  pr($couponUsedTimes);
                if ($couponUsedTimes == 0) {
                    $result = 'valid';
                }
            }
        }
        return $result;
    }

    public function login() {
        // echo 'lll'; die;
        $responce = array();
        $logs = array(
            'phone' => $this->request->data['phone'],
            'pass' => $this->request->data['password'],
        );
        // print_r($logs);die;
        if ($this->request->is('post')) {
            // print_r($logs);die;
            $user = $this->Auth->identify();
            //ss print_r($user); die;
            if (!empty($user)) {
                $this->Auth->setUser($user);

                $responce = array('Ack' => '1', 'msg' => 'Successfully login');
            }
        } else {
            $responce = array('Ack' => '0', 'msg' => 'Register your Mobile No.');
        }
        echo json_encode($responce);
        exit;
        //$this->set('response', $response);
    }

    public function transactiondetails() {

        //$resultJ = json_encode(array('result' => $trnctnid, 'errors' => 'ggggg'));
        //   $this->response->type('json');
        //  $this->response->body($resultJ);
    }

    public function transactindtls($data) {
        $txndetails = (explode("|", $data));
        //pr($txndetails); die;
        $this->loadModel('Txn_master');
        $orderCompleteDeatail = $this->request->session()->read('orderCompleteDeatail');
        $conn = ConnectionManager::get('default');
        $txnNo = $conn->execute('select count(bill_no) as bill_no from txn_master where bill_no=?', [$orderCompleteDeatail['bill_no']])->fetchAll('assoc')[0]['bill_no'];
        $usertranscation = $this->Txn_master->newEntity();
        $resultJ = json_encode('error');
        if ($txnNo <= 0) {
            if ((!empty($txndetails)) && (!empty($orderCompleteDeatail))) {

                $usertranscation = $this->Txn_master->patchEntity($usertranscation, [
                    'txn_ref_id' => $txndetails[0],
                    'cr_amt' => $txndetails[1],
                    'dr_amt' => 0.00,
                    'rec_no' => $orderCompleteDeatail['rec_no'],
                    'txn_mode' => 'payumony',
                    'enter_date' => date('Y-m-d h:i:s'),
                    // 'txn_id' => $txnNo,
                    'bill_no' => $orderCompleteDeatail['bill_no'],
                    'description' => '',
                    'eenter_by' => 'online'
                ]);
                $savedDetails = $this->Txn_master->save($usertranscation);
                $userid = $this->Auth->user('id');
                $conn->begin();
                $conn->execute('UPDATE orderlist SET order_status = ? WHERE user_id = ? and order_id=?', ['P', $userid, $orderCompleteDeatail['order_id']]);
                $conn->execute('UPDATE payment_detail SET bill_status = ? WHERE customer_id = ? and order_id=?', ['P', $userid, $orderCompleteDeatail['order_id']]);
                $conn->commit();
                if ($savedDetails) {
                    $this->Session = $this->request->session();
                    $this->Session->delete('orderCompleteDeatail');
                    $this->Session->delete('cart_item');
                    $orderCompleteDeatail = array();
                    if (empty($this->Session->read('orderCompleteDeatail'))) {
                        $this->Session->write('orderCompleteDeatail', $orderCompleteDeatail);
                    }
                    $resultJ = json_encode('success');
                }
            } else {
                $resultJ = json_encode('error');
            }
        }


        $this->response->type('json');
        $this->response->body($resultJ);
        return $this->response;
//       $resultJ = json_encode(array('result' => $trnctnid, 'errors' => 'ggggg'));
//
//        $this->response->type('json');
//         $this->response->body($resultJ);
//         return $this->response;sonpurs
    }

    public function applyDiscount() {

        $this->loadModel('orderlist');
        $noofPrviousOrder = $this->orderlist->find()->where(['user_id' => $this->Auth->user('id')])->count();
        if ($noofPrviousOrder == 0) {
            $discountPer = 20.00;
        } else {
            $discountPer = 0.00;
        }

        if (empty($this->request->session()->read('discountper'))) {
            $this->request->session()->write('discountper', $discountPer);
        } else {
            $this->request->session()->delete('discountper');
            $this->request->session()->write('discountper', $discountPer);
        }

        $resultJ = json_encode($discountPer);

        $this->response->type('json');
        $this->response->body($resultJ);
        return $this->response;
    }

}
