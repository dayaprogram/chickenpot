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

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['index', 'customerdetails', 'menu', 'shop',
            'orderlist', 'home2', 'ourstory', 'blog', 'contactus', 'details',
            'addorder', 'viewcart', 'addtokrt', 'deletecart', 'cartview',
            'updateQcart', 'signup', 'tracklocation', 'updatePotPackFlag',
            'getValidCouponDtl', 'validateUserToredeemCoupon']);
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

    public function contactus() {
        
    }

    public function tracklocation() {
        $this->loadModel('Area_master');
        $select_location = $this->Area_master->find()->toArray();
        $date = date('Y-m-d'); //today date
        if ($this->request->is('post')) {
            //pr($this->request->data());die;
        }
        $this->set(compact('select_location', 'weekOfdays', 'times'));
    }

    public function customerdetails() {
        $this->loadModel('Users');
        $this->loadModel('Area_master');
        $this->loadModel('Shipping_add');
        $select_location = $this->Area_master->find()->toArray();
        $uid = $this->Auth->user('id');
        $userdetails = $this->Users->find('all')->where(['id' => $uid])->first();
        $shipping = $this->Shipping_add->newEntity();
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
            if ($this->request->data('address') == "") {
                $this->Flash->error(__('Please Enter Your Address'));
                $flag = false;
            }
            if ($flag) {
                $uniqid = uniqid();
                $rand_start = rand(1, 5);
                $rand_8_char = substr($uniqid, $rand_start, 8);
                $this->request->data['shipping_code'] = $rand_8_char;
                $this->request->data['user_id'] = $uid;
                $this->request->data['address1'] = $this->request->data['address'];
                $this->request->data['area_code'] = $this->request->data['location'];
                $shipping = $this->Shipping_add->patchEntity($shipping, $this->request->data);
                $shp_id = $this->Shipping_add->save($shipping);
                // pr($shp_id); die;
                $this->Flash->success(__('Shipping Details is Saved'));
                return $this->redirect(["controller" => "resturent", "action" => "shipping", $shp_id->shipping_id]);
            }
        }
        $this->set(compact('userdetails', 'select_location'));
    }

    public function shop($catagary = 'ALL') {
        //var_dump($catagary);
        session_start();
        $this->loadModel('Item');
        $this->loadModel('item_variant');
        if ($catagary == 'ALL') {
            $getitem = $this->Item->find('all')->toArray();
        } else {
            $getitem = $this->Item->find('all')->where(['food_category' => $catagary])->toArray();
        }
        $itemveriant = $this->item_variant->find('all')->toArray();
        $this->set(compact('itemveriant'));
        $this->set(compact('getitem'));


//        $a = array('a' => 1, 'b' => 2, 'c' => false, 'd' => 0);
//        $b = array_filter($a, function($v) {
//            return $v !== 0;
//        });
//        var_dump($b);
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

    public function shipping($id) {
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
            $query->update()->set(['first_name' => $this->request->data['first_name'],
                'last_name' => $this->request->data['last_name'], 'email' => $this->request->data['email'],
                'address1' => $this->request->data['address'],
                'area_code' => $this->request->data['location']])->where(['shipping_id' => $id])->execute();
            if ($query) {
                $this->checkout();
            }
        }
        $userdetails = $this->Users->find('all')->where(['id' => $uid])->first();
        $this->set(compact('details', 'select_location'));
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
                if ($value['id'] == $this->request->data("id")) {
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
                $view .= '<div class="cart-food" id="' . $data["id"] . '"><div class="detail"><a href="javascript:;" class="btn btn-danger pull-right" onclick="return deleteItem(' . $data["id"] . ');"><i class="icon-icons163"></i></a><img src="' . $data["image"] . '" alt=""><div class="text">';
                $subtotal = $subtotal + ($data['foodprice'] * $data['quantity']);
                $view .= '<a href="javascript:;">' . $data["foodname"] . '</a><p><span class="priceMoney hidden">' . $data["foodprice"] . '</span>
                        ' . $data["foodprice"] . ' x <input type="number" style="width:40px;" value="' . $data["quantity"] . '" id="changeValuePrice"> = <span id="calculatePrice">' . ($data["foodprice"] * $data["quantity"]) . '</span></p></div></div></div>';
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
                if ($value['id'] == $this->request->data("id")) {
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
                if ($value['id'] == $this->request->data("id")) {
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

        pr($redmfreqType);
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

}
