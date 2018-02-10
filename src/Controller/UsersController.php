<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Mailer\Email;
use Cake\Routing\Router;
use Cake\I18n\FrozenDate;
use Cake\Database\Type;

Type::build('date')->setLocaleFormat('yyyy-MM-dd');

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
/*
 * Users Controller
 * Frontend User Management
 */

class UsersController extends AppController {

    public $paginate = ['limit' => 10];

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['signup', 'signin', 'forgotpassword', 'setpassword', 'activeaccount', 'paynow', 'logout', 'index', 'dashboard', 'userOrder']);
        $this->loadComponent('Paginator');
    }

    public $uses = array('User', 'Admin');

    public function index() {
        $this->loadModel('Area_master');
        $select_location = $this->Area_master->find()->toArray();
        if ($this->request->is(['patch', 'post', 'put'])) {
            echo 'hello';
            die;
        }
        $this->set(compact('select_location'));
    }

    /*
     * Users Login Section
     */

    // User Logout
    public function signout() {
        $session->destroy();
        return $this->redirect($this->Auth->logout());
    }

    public function userOrder() {
        $uid = $this->Auth->user('id');
        //pr($uid);die;
        $this->loadModel('Postcards');
        $this->loadModel('Orders');
        $details = $this->Postcards->find()->where(['user_id' => $uid])->toArray();
        //pr($details);die;
        $order_details = $this->Orders->find()->where(['user_id' => $uid])->toArray();
        $this->set(compact('order_details', 'details'));
        $this->set('_serialize', ['order_details', 'details']);
        //pr($order_details);
    }

    //Doctors Logout
    public function logout() {
        $session = $this->request->session();
        //$session->delete('Auth.Doctor');
        $session->delete('Auth.User');
        return $this->redirect('/');
    }

    public function signup() {
        $this->loadModel('Users');
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
           // pr($this->request->data);die;
            $this->request->data['created'] = gmdate("Y-m-d h:i:s");
                $this->request->data['modified'] = gmdate("Y-m-d h:i:s");
            $phone = $this->request->data('phone');
           // pr($phone);die;
            
            $existsUser = $this->Users->find('all')->where(['phone' => $phone])->toArray();
            $flag = true;
            if (!empty($existsUser)) {
                $this->Flash->error(__('Mobile number is already registered!'));
                $flag = false;
            } 
            if($this->request->data('password')!==$this->request->data('cpassword')){
                $false=false;
                  $this->Flash->error(__('Password and Confirm Password does not Match'));
            }
                else {
                $user = $this->Users->patchEntity($user, $this->request->data);
                $this->Users->save($user);
                $this->Flash->success(__('Registered'));
                return $this->redirect(["controller" => "users", "action" => "signin"]);
            }
        }
    }

    public function signin() {
        if ($this->request->is('post')) {
            // pr($this->request->data);die;
            $user = $this->Auth->identify();
            //  pr($user);die;
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    // Reset password for users
    public function forgotpassword() {

//        if ($this->request->session()->check('Auth.User') == true) {
//            $this->redirect(['controller' => 'Users', 'action' => 'dashboard']);
//        }
//
//        if ($this->request->session()->check('Auth.Doctor') == true) {
//            $this->redirect(['controller' => 'Doctors', 'action' => 'dashboard']);
//        }
        //$this->viewBuilder()->layout('default');
        $responce = array();
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            // echo 'lllll'; die;
            // Checking if User is valid or not.
            $tableRegObj = TableRegistry::get('Users');
            $userExist = $tableRegObj->find()->where(['email' => $this->request->data['email']])->first();

            $etRegObj = TableRegistry::get('EmailTemplates');
            $emailTemp = $etRegObj->find()->where(['id' => 1])->first();

            $siteSettings = $this->site_setting();
            //pr($siteSettings); pr($emailTemp); pr($userExist); pr($this->request->data); exit;
            if (!empty($userExist)) {
                $length = 5;
                $str = "";
                $chkPost = "";
                $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
                $max = count($characters) - 1;
                for ($i = 0; $i < $length; $i++) {
                    $rand = mt_rand(0, $max);
                    $chkPost .= $characters[$rand];
                }
                //$chkPost = $this->generateRandomString(); //Generating new Password
                $user = $this->Users->find()->where(['id' => $userExist['id']])->first();
                $user = $this->Users->patchEntity($user, ['password' => $chkPost]);


                $user->password = $chkPost;
                $this->Users->save($user);



                $mail_To = $userExist['email'];
                $mail_CC = '';
                $mail_subject = $emailTemp['subject'];
                $name = $userExist['first_name'] . " " . $userExist['last_name'];
                $url = Router::url('/', true);
                $link = $url . 'users/setpassword/' . $chkPost;
                $mail_body = 'Login With this Password:' . '  ' . $chkPost;
                // $mail_body = str_replace(array('[NAME]', '[LINK]'), array($name, $link), $emailTemp['content']);
                //echo $mail_body; //exit;
                // Sending user the reset password link.
                $email = new Email('default');
                if ($email->emailFormat('html')
                                ->to($userExist['email'])
                                ->subject($mail_subject)
                                ->send($mail_body)) {
                    $responce = array('Ack' => '1', 'msg' => 'Please check your email for new password.');
                    //return $this->redirect(array('action' => 'forgotpassword'));
                } else {
                    $responce = array('Ack' => '0', 'msg' => 'Internal server error. Please try again later.');
                }
            } else {
                $responce = array('Ack' => '0', 'msg' => 'Email is not registered.');
            }
        }
        echo json_encode($responce);
        exit;
    }

    // Reset password from the generated mail.
    public function setpassword($ckval = null) {

//        if ($this->request->session()->check('Auth.User') == true) {
//            $this->redirect(['controller' => 'Users', 'action' => 'dashboard']);
//        }
//
//        if ($this->request->session()->check('Auth.Doctor') == true) {
//            $this->redirect(['controller' => 'Doctors', 'action' => 'dashboard']);
//        }
//

        if ($this->request->is(['post', 'put'])) {
            //echo "lll"; die;
            // Checking Password and Confirm Password
            $flag = true;
            if ($this->request->data['password'] != $this->request->data['cpassword']) {
                $this->Flash->error('Password not matched with Confirm password.');
                $flag = false;
            }

            //Saving new password
            if ($flag) {
                $user = $this->Users->find()->where(['id' => $this->request->data['id']])->first();
                $user = $this->Users->patchEntity($user, ['password' => $this->request->data['password']]);


                $user->password = $this->request->data['password'];
                $this->Users->save($user);
                $new = $user->password;

                $userdt = TableRegistry::get('Users');
                $query = $userdt->query();
                $query->update()->set(['cpass_req' => 0, 'cpass_value' => ''])->where(['id' => $this->request->data['id']])->execute();
                $this->Flash->success(__('Your password changed successfully.'));
                return $this->redirect(array('action' => 'signin'));
            } else {
                $this->Flash->error(__('Enter Password and Confirm Password Properly.'));
            }
        }

        $tableRegObj = TableRegistry::get('Users');
        $user = $tableRegObj->find()->where(['cpass_value' => $ckval, 'cpass_req' => 1])->first();

        if (empty($user)) {
            $this->Flash->error(__('Invalid Link. make forgot password request again.'));
            return $this->redirect(array('action' => 'forgotpassword'));
        } else {
            //pr($user); exit;
            //$userdt = TableRegistry::get('Users');
            //$query = $userdt->query();
            //$query->update()->set(['cpass_req' => 0, 'cpass_value' => ''])->where(['id' => $user->id])->execute();
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /*
      public function logout() {
      return $this->redirect($this->Auth->logout());
      } */

    // New user registration
//    public function signup($val = null) {
//        //echo 'lll'; die;
//
//        // if ($this->request->session()->check('Auth.User') == true) {
//        //     $this->redirect(['controller' => 'Users', 'action' => 'dashboard']);
//        // }
//
//        // if ($this->request->session()->check('Auth.Doctor') == true) {
//        //     $this->redirect(['controller' => 'Doctors', 'action' => 'dashboard']);
//        // }
//        
////         $logs=array(
////           'password' => $this->request->data['password'],
////           'email' => $this->request->data['email'],
////           'name' => $this->request->data['name'],
////            );
//        //print_r($logs);
//        $this->viewBuilder()->layout('default');
//
//        $user = $this->Users->newEntity();
//        if ($this->request->is('post')) {
//             //echo 'lll'; die;
//
//            //Checking if email is already exists.
//             $flag = true;
//            $tableRegObj = TableRegistry::get('Users');
//            $userExist = $tableRegObj
//                            ->find()
//                            ->where(['email' => $this->request->data['email']])->toArray();
//                           // pr($userExist);
//
//            // Users form validation
//            if($flag){
//            if($userExist) {
//                $flag = false;
//              // echo 'lll'; die;    
//           
//                       }
//                   }
//
//            if($flag){
//             $this->request->data['ptxt'] = base64_encode($this->request->data['password']);
//                $this->request->data['created'] = gmdate("Y-m-d h:i:s");
//                $this->request->data['modified'] = gmdate("Y-m-d h:i:s");
//                $themail = $this->request->data['email'];
//                $name = $this->request->data['name'];
//
//                $user = $this->Users->patchEntity($user, $this->request->data);
//                //print_r($this->request->data); die;
//               
//
//                   
//                }
//                }
//                
//                
//
//            }
    // Users account activation


    /*
      public function editprofile($id = null) {
      $this->viewBuilder()->layout('admin');
      $user = $this->Users->get($id);
      if ($this->request->is(['post', 'put'])) {
      //pr($this->request->data); exit;
      $flag = true;
      if ($this->request->data['first_name'] == "") {
      $this->Flash->error(__('First Name can not be null. Please, try again.'));
      $flag = false;
      }

      if ($this->request->data['last_name'] == "") {
      $this->Flash->error(__('Last Name can not be null. Please, try again.'));
      $flag = false;
      }

      if ($this->request->data['phone'] == "") {
      $this->Flash->error(__('Phone can not be null. Please, try again.'));
      $flag = false;
      }

      if ($this->request->data['epassword'] != "") {
      $this->request->data['password'] = $this->request->data['epassword'];
      }

      if ($flag) {
      $user = $this->Users->patchEntity($user, $this->request->data);
      $this->request->data['modified'] = gmdate("Y-m-d h:i:s A");
      if ($this->Users->save($user)) {
      $this->Flash->success(__('Patient has been edited successfully.'));
      return $this->redirect(['action' => 'listuser']);
      } else {
      $this->Flash->error(__('Patient could not be edit. Please, try again.'));
      return $this->redirect(['action' => 'listuser']);
      }
      } else {
      return $this->redirect(['action' => 'listuser']);
      }
      }
      $this->set(compact('user'));
      $this->set('_serialize', ['user']);
      }
     */

    // Patients Dashboard after login
    public function dashboard() {
        $title = "Dashboard";
        //$this->layout="inner_layout";
//        $this->loadModel('Orders');
        $this->loadModel('Users');
        $uid = $this->Auth->user('id');
        $query = $this->Users->find("all")->where(['id' => $uid])->toArray();

        // $query = $this->Users->find()->where(['id' => $user])->toArray();
        // print_r($query);die;
//        $this->loadModel('Orders');
//        $query = $this->Orders->find()->where(['Orders.user_id' => $uid, 'Orders.is_complete' => 1, 'isverified' => 0, 'is_reject' => 0])->order(['id' => 'DESC'])->all()->toArray();
//
//        $uniqueDt = array();
//        foreach ($query as $q) {
//            $uniqueDt[$q->transaction_id]['id'] = $q->id;
//        }
//
//        $dtArr = array();
//        foreach ($uniqueDt as $dt) {
//            $dtArr[$dt['id']] = $dt['id'];
//        }
//        if (empty($dtArr)) {
//            $dtArr[0] = 0;
//        }
//        $this->set('orders', $this->Paginator->paginate($this->Orders, [ 'limit' => 10, 'order' => [ 'id' => 'DESC'], 'conditions' => [ 'id IN' => $dtArr]]));
//
        $this->set(compact('title', 'query'));
    }

    // Patients approved orders
    public function approvedorder() {

        $this->loadModel('Orders');
        $this->loadModel('Users');
        $uid = $this->request->session()->read('Auth.User.id');
        $user = $this->Users->get($this->Auth->user('id'));
        $this->set(compact('user', 'trans'));
        $this->set('_serialize', ['user']);

        $this->loadModel('Orders');
        $query = $this->Orders->find()->where(['Orders.user_id' => $uid, 'Orders.is_complete' => 1, 'isverified' => 1, 'is_reject' => 0, 'is_delivered' => 0, 'is_reject' => 0])->all()->toArray();

        $uniqueDt = array();
        foreach ($query as $q) {
            $uniqueDt[$q->transaction_id]['id'] = $q->id;
        }
        $dtArr = array();
        foreach ($uniqueDt as $dt) {
            $dtArr[$dt['id']] = $dt['id'];
        }
        if (empty($dtArr)) {
            $dtArr[0] = 0;
        }
        $this->set('orders', $this->Paginator->paginate($this->Orders, ['limit' => 10, 'order' => ['id' => 'DESC'], 'conditions' => ['id IN' => $dtArr]]));
        $this->set(compact('dtArr'));
    }

    //Patients rejected orders
    public function rejectedorder() {

        $this->loadModel('Orders');
        $this->loadModel('Users');
        $uid = $this->request->session()->read('Auth.User.id');
        $user = $this->Users->get($this->Auth->user('id'));
        $this->set(compact('user', 'trans'));
        $this->set('_serialize', ['user']);

        $this->loadModel('Orders');
        $query = $this->Orders->find()->where(['Orders.user_id' => $uid, 'Orders.is_complete' => 1, 'isverified' => 0, 'is_reject' => 1])->all()->toArray();

        $uniqueDt = array();
        foreach ($query as $q) {
            $uniqueDt[$q->transaction_id]['id'] = $q->id;
        }
        $dtArr = array();
        foreach ($uniqueDt as $dt) {
            $dtArr[$dt['id']] = $dt['id'];
        }
        if (empty($dtArr)) {
            $dtArr[0] = 0;
        }
        $this->set('orders', $this->Paginator->paginate($this->Orders, ['limit' => 10, 'order' => ['id' => 'DESC'], 'conditions' => ['id IN' => $dtArr]]));
        $this->set(compact('orders'));
        $this->set(compact('dtArr'));
    }

    //Patients Delivered Orders
    public function deliveredorder() {

        $this->loadModel('Orders');
        $this->loadModel('Users');
        $uid = $this->request->session()->read('Auth.User.id');
        $user = $this->Users->get($this->Auth->user('id'));
        $this->set(compact('user', 'trans'));
        $this->set('_serialize', ['user']);

        $this->loadModel('Orders');
        $query = $this->Orders->find()->where(['Orders.user_id' => $uid, 'Orders.is_complete' => 1, 'isverified' => 1, 'is_delivered' => 1])->all()->toArray();

        $uniqueDt = array();
        foreach ($query as $q) {
            $uniqueDt[$q->transaction_id]['id'] = $q->id;
        }
        $dtArr = array();
        foreach ($uniqueDt as $dt) {
            $dtArr[$dt['id']] = $dt['id'];
        }
        if (empty($dtArr)) {
            $dtArr[0] = 0;
        }
        $this->set('orders', $this->Paginator->paginate($this->Orders, ['limit' => 10, 'order' => ['id' => 'DESC'], 'conditions' => ['id IN' => $dtArr]]));
        $this->set(compact('dtArr'));
    }

    // Users prescription Details Page with Delivery Details
    public function newprescriptiondetail($txn = null) {
        $this->loadModel('Users');
        $uid = $this->request->session()->read('Auth.User.id');
        $user = $this->Users->get($this->request->session()->read('Auth.User.id'));

        $this->loadModel('Treatments');
        $this->loadModel('Orders');
        $this->loadModel('Orderdetails');
        $this->loadModel('Medicines');
        $this->loadModel('Pils');
        $this->loadModel('Prescriptions');

        $orderExist = $this->Orders->find()->contain(['Orderdetails', 'Treatments', 'Orderdetails.Medicines'])->where(['Orders.transaction_id' => $txn])->all()->toArray();
        $presc = $this->Prescriptions->find()->where(['Prescriptions.txnid' => $txn])->all()->toArray();

        foreach ($orderExist as $oExist) {
            $dt = json_decode($oExist['question']);
        }

        if ($this->request->is('post')) {

            //pr($this->request->data); exit;
            $this->loadModel('Users');
            $this->loadModel('Orders');
            $user = $this->Users->get($this->request->session()->read('Auth.Doctor.id'));
            if ($txn != "") {
                $ord = $this->Orders->find()->where(['Orders.transaction_id' => $this->request->data['transid']])->all()->toArray();
                //echo $txn; pr($user);pr($ord); exit;
                foreach ($ord as $ordDet) {
                    $tableRegObj = TableRegistry::get('Orders');
                    $query = $tableRegObj->query();
                    $query->update()->set(['isverified' => 2, 'reasion' => $this->request->data['data'], 'verifiedby' => $user['id']])->where(['id' => $ordDet->id])->execute();
                }

                $this->Flash->success(__('Prescription Rejected successfully.'));
                return $this->redirect(['action' => 'newprescription']);
            } else {
                return $this->redirect(['action' => 'newprescription']);
            }
        }

        //pr($orderExist); exit;


        $this->set(compact('orderExist', 'user', 'presc'));
        $this->set('_serialize', ['user']);
    }

    //Users prescription details
    public function prescriptiondetail($txn = null) {
        $this->loadModel('Users');
        $uid = $this->request->session()->read('Auth.User.id');
        $user = $this->Users->get($this->request->session()->read('Auth.User.id'));

        $this->loadModel('Transactions');
        $this->loadModel('Treatments');
        $this->loadModel('Orders');
        $this->loadModel('Orderdetails');
        $this->loadModel('Medicines');
        $this->loadModel('Pils');
        $this->loadModel('Prescriptions');
        $this->loadModel('Reviews');

        $transaction = $this->Transactions->find()->where(['Transactions.transaction_id' => $txn])->first()->toArray();
        $orderExist = $this->Orders->find()->contain(['Orderdetails', 'Treatments', 'Orderdetails.Medicines'])->where(['Orders.transaction_id' => $txn])->all()->toArray();
        $presc = $this->Prescriptions->find()->where(['Prescriptions.txnid' => $txn])->all()->toArray();

        $medArr = array();
        foreach ($orderExist as $ordExist) {
            foreach ($ordExist['orderdetails'] as $ordDet) {
                $medArr[] = $ordDet->medicine->id;
            }
        }
        $medArr = array_unique($medArr);

        if (!empty($medArr)) {
            if (count($medArr) == 1) {
                $revMedicine = $medArr[0];
            } else {
                $revMedicineDt = "";
                foreach ($medArr as $k => $v) {
                    $revMedicineDt = $revMedicineDt . "," . $v;
                }
                $revMedicine = ltrim($revMedicineDt, ",");
            }
        } else {
            $revMedicine = "";
        }



        foreach ($orderExist as $oExist) {
            $dt = json_decode($oExist['question']);
        }

        if ($this->request->is('post')) {

            //pr($this->request->data);
            if ($this->request->data['ftype'] == 'msg') {
                $this->loadModel('Ordermsgs');
                $ordermsgsTable = TableRegistry::get('Ordermsgs');
                $ordermsg = $ordermsgsTable->newEntity();
                $ordermsg->ordid = $this->request->data['transid'];
                $ordermsg->fromid = $this->request->data['fromid'];
                $ordermsg->toid = $this->request->data['toid'];
                $ordermsg->msg = $this->request->data['msg'];
                $ordermsg->pid = $this->request->data['pid'];
                $ordermsg->type = $this->request->data['type'];
                $ordermsg->fromtype = $this->request->data['fromtype'];
                $ordermsg->totype = $this->request->data['totype'];
                $ordermsg->date = gmdate('Y-m-d H:i:s');
                if ($ordermsgsTable->save($ordermsg)) {
                    $id = $ordermsg->id;
                }
                $this->Flash->success(__('Message Sent To Customer Care Successfully.'));
            }

            if ($this->request->data['ftype'] == 'review') {
                //pr($this->request->data); exit;
                if (!empty($this->request->data['rate'])) {
                    $orde = $this->Orders->find()->where(['Orders.transaction_id' => $txn])->all()->toArray();

                    $reviewsTable = TableRegistry::get('Reviews');
                    $review = $reviewsTable->newEntity();
                    $review->rate = $this->request->data['rate'];
                    $review->trans_id = $this->request->data['trans_id'];
                    $review->user_id = $this->request->data['fromid'];
                    $review->txn_id = $this->request->data['txnid'];
                    $review->medicines = $this->request->data['medicines'];
                    $review->review = $this->request->data['review'];
                    $review->date = gmdate('Y-m-d H:i:s');
                    $review->is_active = 1;
                    if ($reviewsTable->save($review)) {
                        $id = $review->id;
                    }
                    $ordTable = TableRegistry::get('Orders');
                    $query = $ordTable->query();
                    $query->update()->set(['is_review' => 1])->where(['transaction_id' => $txn])->execute();

                    $transTable = TableRegistry::get('Transactions');
                    $query1 = $transTable->query();
                    $query1->update()->set(['is_review' => 1])->where(['transaction_id' => $txn])->execute();

                    $this->Flash->success(__('Review Saved Successfully.'));
                } else {
                    $this->Flash->error(__('Please enter your rating.'));
                }
            }
        }

        //$this->request->session()->read('Auth.User.id');

        $reviews = $this->Reviews->find()->where(['Reviews.txn_id' => $txn])->first();
        if (!empty($reviews)) {
            $review = $reviews->toArray();
        } else {
            $review = array();
        }
        //pr($review);
        //pr($orderExist); exit;


        $this->set(compact('orderExist', 'user', 'presc', 'transaction', 'review', 'revMedicine'));
        $this->set('_serialize', ['user']);
    }

    // Users Messages section
    public function mymessage() {
        $this->loadModel('Ordermsgs');
        $this->loadModel('Users');
        $this->loadModel('Orders');
        $uid = $this->request->session()->read('Auth.User.id');
        $user = $this->Users->get($this->request->session()->read('Auth.User.id'));
        $query1 = $this->Ordermsgs->find()->contain(['Users'])->where(['fromid' => $user->id, 'type' => 'p'])->orWhere(['toid' => $user->id, 'type' => 'p'])->all()->toArray();
        //pr($query1); exit;
        if (!empty($query1)) {
            $msgList = array();
            foreach ($query1 as $q) {
                $msgList[$q->ordid] = $q;
            }
        } else {
            $msgList = array();
        }

        $user = $this->Users->get($this->request->session()->read('Auth.User.id'));

        $this->set(compact('msgList', 'user'));
        $this->set('_serialize', ['msgList', 'user']);
    }

    // Users Message details page
    public function msgdetail($txn = null) {
        $this->loadModel('Users');
        $user = $this->Users->get($this->request->session()->read('Auth.User.id'));
        //pr($user); exit;
        $this->loadModel('Ordermsgs');
        $this->loadModel('Orders');
        $uid = $this->request->session()->read('Auth.User.id');
        $msg = $this->Ordermsgs->find()->contain(['Users'])->where(['fromid' => $user->id, 'type' => 'p', 'ordid' => $txn])->orWhere(['toid' => $user->id, 'type' => 'p', 'ordid' => $txn])->order(['date' => 'DESC'])->all()->toArray();

        //pr($msg); exit;

        $this->loadModel('Orders');
        $orderExist = $this->Orders->find()->where(['Orders.transaction_id' => $txn])->all()->toArray();

        if ($this->request->is('post')) {
            if ($this->request->data['ftype'] == 'msg') {
                $this->loadModel('Ordermsgs');
                $ordermsgsTable = TableRegistry::get('Ordermsgs');
                $ordermsg = $ordermsgsTable->newEntity();
                $ordermsg->ordid = $this->request->data['transid'];
                $ordermsg->fromid = $this->request->data['fromid'];
                $ordermsg->toid = $this->request->data['toid'];
                $ordermsg->msg = $this->request->data['msg'];
                $ordermsg->pid = $this->request->data['pid'];
                $ordermsg->type = $this->request->data['type'];
                $ordermsg->fromtype = $this->request->data['fromtype'];
                $ordermsg->totype = $this->request->data['totype'];
                $ordermsg->date = gmdate('Y-m-d H:i:s');
                if ($ordermsgsTable->save($ordermsg)) {
                    $id = $ordermsg->id;
                }
                $this->Flash->success(__('Message Sent To Customer Care Successfully.'));
                $this->redirect(['controller' => 'Users', 'action' => 'msgdetail', $txn]);
            }
        }

        $this->set(compact('user', 'msg', 'orderExist'));
        $this->set('_serialize', ['user']);
    }

    // Users edit profile
    public function editprofile() {
        //$this->viewBuilder()->layout('default');

        /*
          echo $this->Auth->user('id');
          pj($this->request->session()->check('Auth.User'));
          pj($this->request->session()->read('Auth.User'));
          pr($this->request->session()->check('Auth.User'));
          pr($this->request->session()->read('Auth.User'));
          exit;
         */

        $user = $this->Users->get($this->Auth->user('id'));


        //echo $user->dob->format('d F Y'); pr($user); exit;

        if ($this->request->is(['post', 'put'])) {
            //echo "hello"; die;
            //pr($this->request->data);
            $flag = true;

            if ($flag) {

                $this->request->data['created'] = gmdate("Y-m-d h:i:s");
                $this->request->data['modified'] = gmdate("Y-m-d h:i:s");


                //$this->request->data['dob'] = date('Y-m-d', strtotime($this->request->data['dob']));
                if ($this->request->data['password'] == "") {
                    $this->request->data['password'] = base64_decode($user->ptxt);
                    $this->request->data['ptxt'] = $user->ptxt;
                } else {
                    $this->request->data['ptxt'] = base64_encode($this->request->data['password']);
                }

                $user = $this->Users->patchEntity($user, $this->request->data);
                if ($this->Users->save($user)) {

                    //pr($user); exit;
                    $this->Flash->success(__('Patient has been edited successfully.'));
                    return $this->redirect(['action' => 'editprofile']);
                } else {

                    $this->Flash->error(__('Patient could not be edit. Please, try again.'));
                    //return $this->redirect(['action' => 'editprofile']);
                }
            } else {
                $this->Flash->error(__('Patient could not be edit. Please, try again.'));
            }
        }

        //echo $user->dob;
        //pr($user); exit;
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    // Order checkout page.
    public function cartcheckout($id = null) {

        $this->viewBuilder()->layout('');
        //echo "ok"; exit;

        $this->loadModel('Orders');
        $this->loadModel('Orderdetails');

        $site = $this->site_setting();

        //pr($site);

        $curIp = $_SERVER['REMOTE_ADDR'];
        $orderExist = $this->Orders->find()->where(['Orders.client_ip' => $curIp, 'Orders.is_login' => 0, 'Orders.is_complete' => 0])->all()->toArray();
        $user = $this->Users->get($this->Auth->user('id'));
        foreach ($orderExist as $ordupdt) {
            $order = TableRegistry::get('Orders');
            $query = $order->query();
            $query->update()->set(['is_login' => 1, 'user_id' => $user->id, 'name' => $user->first_name . " " . $user->last_name, 'email' => $user->email, 'contact' => $user->phone, 'prescription_fee' => $site['prescfee'], 'billing_address' => $user->address])->where(['id' => 22])->execute();
        }

        $this->redirect(['controller' => 'Users', 'action' => 'checkout']);


        $this->autoRender = false;
    }

    // Checkout Payment Page
    public function checkout($delCh = null) {
        $this->viewBuilder()->layout('default');

        $this->loadModel('Treatments');
        $this->loadModel('Orders');
        $this->loadModel('Orderdetails');
        $this->loadModel('Medicines');
        $this->loadModel('Pils');

        $is_login = '';
        if ($this->request->session()->check('Auth.User')) {
            $is_login = 1;
            $uid = $this->request->session()->read('Auth.User.id');
            //$orderExist = $this->Orders->find()->contain(['Treatments','Orderdetails','Orderdetails.Medicines'])->where(['Orders.user_id' => $uid,'Orders.is_complete' => 0])->all();
            $orderExist = $this->Orders->find()->contain(['Orderdetails'])->where(['Orders.user_id' => $uid, 'Orders.is_complete' => 0])->all();
            //$orderExist = $this->Orders->find()->where(['Orders.user_id' => $uid,'Orders.is_complete' => 0])->all();
            $cartData = $orderExist->toArray();
        } else {
            $cartData = array();
        }



        if (empty($cartData)) {
            $this->Flash->error('Your Cart is empty.'); //Checking cart is empty or not
            return $this->redirect('/');
        } else {
            $cData = array();
            if ($delCh == 1) {
                $deliveryCharge = 2.92;
            } else if ($delCh == 2) {
                $deliveryCharge = 5.93;
            } else if ($delCh == 3) {
                $deliveryCharge = 32.45;
            } else {
                $deliveryCharge = 0;
            }
            $cartAmount = 0;
            $prescriptionFee = 0;
            foreach ($cartData as $crt) {
                $prescriptionFee = $crt->prescription_fee;
                $cData[] = $crt->id;
                foreach ($crt->orderdetails as $cDataArr) {
                    $cartAmount = $cartAmount + $cDataArr->pil_price;
                }
            }
        }

        if ($this->request->is('post')) {

            //  4242424242424242
            //  12 / 2017
            //  111

            $amount = $deliveryCharge + $prescriptionFee + $cartAmount;
            $currencyCode = 'GBP';
            $paymentAction = 'Sale';
            $methodToCall = 'doDirectPayment';
            $nvpRecurring = '';
            $creditCardType = $this->request->data['card'];
            $creditCardNumber = $this->request->data['card_number'];
            $expDateMonth = $this->request->data['expiry_month'];
            $expDateYear = $this->request->data['expiry_year'];
            $cvv2Number = $this->request->data['cvv'];
            $firstName = $this->request->data['firstname'];
            $lastName = $this->request->data['lastname'];
            $city = $this->request->data['ship_city'];
            $state = "Westbengal";
            $zip = $this->request->data['ship_postcode'];

            $request_params = array(
                'METHOD' => 'DoDirectPayment',
                'USER' => 'nits.arpita_api1.gmail.com',
                'PWD' => '1383658129',
                'SIGNATURE' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31AKsVq2ka8e2MK-zCBP3Um9xHlsFO',
                'VERSION' => '85.0',
                //'PAYMENTACTION'     => 'Authorization',
                'PAYMENTACTION' => 'Sale',
                'IPADDRESS' => $_SERVER['REMOTE_ADDR'],
                'CREDITCARDTYPE' => $creditCardType,
                'ACCT' => $creditCardNumber,
                'EXPDATE' => $expDateMonth . $expDateYear,
                'CVV2' => $cvv2Number,
                'FIRSTNAME' => $firstName,
                'LASTNAME' => $lastName,
                'AMT' => $amount,
                'CURRENCYCODE' => 'GBP',
                'DESC' => 'Testing Payments Pro'
            );

            $nvp_string = '';
            foreach ($request_params as $var => $val) {
                $nvp_string .= '&' . $var . '=' . urlencode($val);
            }
            // Submit card details with amount to paypal for payment
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_VERBOSE, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_TIMEOUT, 3000);
            curl_setopt($curl, CURLOPT_URL, 'https://api-3t.sandbox.paypal.com/nvp');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $nvp_string);

            $result = curl_exec($curl);
            curl_close($curl);
            //var_dump($result);
            //$resArray = $this->NVPToArray($result);

            parse_str($result, $resArray);


            if (!empty($resArray)) {
                if ($resArray["ACK"] == 'SUCCESS' || $resArray["ACK"] == 'Success') {

                    $ack = strtoupper($resArray["ACK"]);
                    $txn_id = $resArray["TRANSACTIONID"];
                    $chkPost = $this->generateRandomString();
                    $curIp = $_SERVER['REMOTE_ADDR'];

                    $transactionTable = TableRegistry::get('Transactions');
                    $transaction = $transactionTable->newEntity();
                    $transaction->client_ip = $curIp;
                    $transaction->user_id = $cartData[0]->user_id;
                    $transaction->prescription_fee = $cartData[0]->prescription_fee;
                    $transaction->amt = $amount;
                    $transaction->shipping_address = $this->request->data['ship_address'];
                    $transaction->shipping_city = $this->request->data['ship_city'];
                    $transaction->shipping_code = $this->request->data['ship_postcode'];
                    $transaction->shipping_country = $this->request->data['ship_country'];
                    $transaction->date = gmdate("Y-m-d h:i:s");
                    $transaction->transaction_id = $txn_id;

                    if ($transactionTable->save($transaction)) {
                        $transactionid = $transaction->id;
                    }

                    foreach ($cData as $k => $v) {
                        $tableRegObj = TableRegistry::get('Orders');
                        $query = $tableRegObj->query();
                        $query->update()->set(['transactionid' => $transactionid, 'transaction_id' => $txn_id, 'is_complete' => 1, 'is_cart' => 0, 'amt' => $amount, 'shipping_address' => $this->request->data['ship_address'], 'shipping_city' => $this->request->data['ship_city'], 'shipping_code' => $this->request->data['ship_postcode'], 'shipping_country' => $this->request->data['ship_country']])->where(['id' => $v])->execute();
                    }

                    // Sending Payment Success Mail with order details
                    $tableRegObj1 = TableRegistry::get('Users');
                    $user = $tableRegObj1->find()->where(['id' => $this->Auth->User('id')])->first()->toArray();
                    $this->loadModel('EmailTemplates');
                    $etRegObje = TableRegistry::get('EmailTemplates');
                    $emailTemp = $etRegObje->find()->where(['id' => 3])->first()->toArray();
                    $fullname = $user['first_name'] . " " . $user['last_name'];
                    $mail_To = $user['email'];
                    //$mail_CC = '';
                    $mail_subject = $emailTemp['subject'];
                    $url = Router::url('/', true);
                    $link = $url . 'users/signin';
                    $mail_body = str_replace(array('[NAME]', '[TRID]', '[LINK]'), array($fullname, $txn_id, $link), $emailTemp['content']);
                    $email = new Email('default');
                    $email->emailFormat('html')->from(['noreply@medicinesbymailbox.co.uk' => 'Medicines By Mailbox'])
                            ->to($mail_To)
                            ->subject($mail_subject)
                            ->send($mail_body);

                    $this->Flash->success(__('Your Order completed successfully.'));
                    $this->redirect(['controller' => 'Users', 'action' => 'dashboard', $txn_id]);
                } else {
                    //pr($cData); pr($this->request->data); pr($resArray); exit;
                    $this->Flash->success(__('Your Order not proccessed. Try again.'));
                    //$this->redirect(['controller' => 'Treatments', 'action' => 'cart']);
                }
            } else {
                $this->Flash->success(__('Your Card Detail Not Valid. Try again.'));
            }
        }


        $user = $this->Users->get($this->request->session()->read('Auth.User.id'))->toArray();


        $this->set(compact('orderExist', 'cartData', 'is_login', 'user'));
        $this->set('_serialize', ['cartData']);
    }

    public function changepass() {
        $user = $this->Users->get($this->Auth->user('id'));


        if ($this->request->is(['post', 'put'])) {

            // $new_pass = $this->request->data['password'];
            $confirm_pass = $this->request->data['confirm_password'];
            $user = $this->Users->patchEntity($user, $this->request->data);
            $this->Users->save($user);
            $this->Flash->success(__('Password has been Changed successfully.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function exportUsers() {


        //$events = $this->User->find('all',array('conditions' => array('User.is_paid' => 1)));
        $this->loadModel('Landlords');
        $this->loadModel('Properties');
        $events = $this->Landlords->find()->all();

        //print_r($events);
        //$this->layout = false;
        $output = '';
        $output .= 'Id,Property,Company, Email,FirstName,LastName,Phone,Address, BankDetails';
        $output .= "\n";

        if (!empty($events)) {
            //print_r($events);die;
            foreach ($events as $event) {
                $id = $event->id;
                $property_id = $event->property_id;
                //echo$id; die;
                $company_name = $event->company_name;
                $address = $event['address'];
                //print_r($address);die;
                $bank_details = $event['bank_details'];
                $email = $event['email'];
                $first_name = $event['first_name'];
                $last_name = $event['last_name'];
                $phone = $event['phone'];
                $add_date = $event['add_date'];
                $props = $this->Properties->find("all")->where(["is_active" => 1, 'id' => $property_id])->toArray();
                foreach ($props as $prop) {
                    $properties = $prop->title;
                }

                $output .= '"' . $id . '","' . $properties . '","' . $company_name . '","' . $email . '","' . $first_name . '","' . $last_name . '","' . $phone . '","' . $address . '","' . $bank_details . '"';
                $output .= "\n";
            }
        }


        $filename = "myFile" . time() . ".csv";
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename);
        echo $output;
        exit;
    }

////add certficate
    public function certificates() {
        $this->loadModel('Certificate');
        $result = $this->Certificate->find('all', array(
            'order' => 'Certificate.id DESC',
                )
        );
        // $title = 'Certificate';
        // echo "hello"; die;
// $result = $this->Certificate->find()->all();
        //echo "<pre>"; print_r($result); die; 
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }

    public function addcretificate() {

        //add certificate to be modify from sidemanegment
        $this->loadModel("Properties");
        $this->loadModel('certificate');
        $uid = $this->Auth->user('id');
        //echo "<pre>"; print_r($uid);die;
        $addcertificate = $this->certificate->newEntity();
        if ($this->request->is('post')) {
            // echo "test"; die;
            // Modify from Here surbhi

            $tableRegObj = TableRegistry::get('certificate');
            $certificateExiist = $tableRegObj->find()->where(['title' => $this->request->data['title']])->toArray();
            $flag = true;
            //pr($mediciineExiist);
            //pr($this->request->data); exit;
            // Medicine Form validation
            if ($this->request->data['title'] == "") {
                $this->Flash->error(__('Title can not be null. Please, try again.'));
            }
        }
        $this->request->data["user_id"] = $uid;

        // if($flag){
        //           $arr_ext = array('jpg', 'jpeg', 'gif', 'png');
        //           if (!empty($this->request->data['image']['name'])) {
        //               $file = $this->request->data['image']; //put the data into a var for easy use
        //               $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
        //               $fileName = time() . "." . $ext;
        //               if (in_array($ext, $arr_ext)) {
        //                   move_uploaded_file($file['tmp_name'], WWW_ROOT . 'certificate_img' . DS . $fileName);
        //                   $file = $fileName;
        //               } else {
        //                   $flag = false;
        //                   $this->Flash->error(__('Upload image only jpg,jpeg,png files.'));
        //               }
        //           } else {
        //               $flag = false;
        //               $this->Flash->error(__('Upload Certificate.'));
        //           }
        //       }

        if ($flag) {
            //$this->request->data['image'] = $file;
            //print_r ($this->request->data);die;
            $certificate_img = $this->Users->patchEntity($addcertificate, $this->request->data);
            if ($this->certificate->save($addcertificate)) {
                $this->Flash->success(__('certificate has been saved.'));
                return $this->redirect(['action' => 'certificates']);
            } else {
                $this->Flash->error(__('certificate could not be saved. Please, try again.'));
            }
        }
        $props = $this->Properties->find("all")->where(["is_active" => 1, 'user_id' => $uid])->toArray();
        foreach ($props as $prop) {
            $properties[$prop->id] = $prop->address;
        }

        $this->set(compact('addcertificate', 'properties'));
        $this->set('_serialize', ['addcertificate', 'properties']);
    }

    public function delete($id) {
        $this->loadModel('Certificate');
        $result = $this->Certificate->get($id);
        // print_r($result);die;
        if ($this->Certificate->delete($result)) {
            $this->Flash->success(__('Certificate has been deleted.'));
        } else {
            $this->Flash->error(__('Certificate not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'certificates']);
    }

    public function edit($id) {

        // $this->viewBuilder()->layout('admin');
        $this->loadModel("Properties");
        $this->loadModel('Certificate');
        $uid = $this->Auth->user('id');
        $result = $this->Certificate->get(base64_decode($id));
        //print_r($result);die;
        $result->issue_date = date("Y-m-d", strtotime($result->issue_date));
        $result->expire_date = date("Y-m-d", strtotime($result->expire_date));

        $id = base64_decode($id);
        $this->request->data["user_id"] = $uid;
        $props = $this->Properties->find("all")->where(["is_active" => 1, 'user_id' => $uid])->toArray();
        foreach ($props as $prop) {
            $properties[$prop->id] = $prop->title;
        }

        // print_r($id);die;
        // $flag=false;
        if ($this->request->is(['patch', 'post', 'put'])) {



            // pr($this->request->data); exit;
            // $this->loadModel('SideBar');
            $tableRegObj = TableRegistry::get('Certificate');
            $slugExist = $tableRegObj
                            ->find()
                            ->where(['title' => $this->request->data['title'], 'id !=' => $id])->toArray();
            // print_r($slugExist);
            // $this->request->data; die;
            //pr($getAllResults); exit;
            //pr($this->request->data); exit;
            // $issue_date = date("Y-m-d", strtotime($this->request->data));
            //print_r($issue_date); die;

            $flag = true;

            if ($this->request->data['title'] == "") {
                $this->Flash->error(__('Title can not be null. Please, try again.'));
                $flag = false;
            }
            $this->request->data['issue_date'] = date("Y-m-d", strtotime($this->request->data['issue_date']));
            $this->request->data['expire_date'] = date("Y-m-d", strtotime($this->request->data['expire_date']));
        }



        // if($flag){
        // $arr_ext = array('jpg', 'jpeg', 'gif', 'png');
        // if (!empty($this->request->data['image'])) {
        //     $file = $this->request->data['image']; //put the data into a var for easy use
        //     $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
        //     if($result->image != "") { $fileName = $result->image; } else { $fileName = time() . "." . $ext; }
        //     if (in_array($ext, $arr_ext)) {
        //         move_uploaded_file($file['tmp_name'], WWW_ROOT . 'certificate_img' . DS . $fileName);
        //         $this->request->data['image'] = $fileName;
        //     }
        // } else {
        //     $this->request->data['image'] = $result->image;
        // }


        if ($flag) {

            // print_r($this->request->data); die;
            $certificate = $this->Certificate->patchEntity($result, $this->request->data);
            //print_r($certificate); die;
            if ($this->Certificate->save($certificate)) {
                $this->Flash->success(__('Certificate detail has been updated.'));
                // return $this->redirect(['action' => 'certificate']);
            } else {
                $this->Flash->error(__('certificate detail could not be update. Please, try again.'));
            }
        }
        //  }


        $this->set(compact('result', 'properties'));
        $this->set('_serialize', ['result', 'properties']);
    }

    // Adding Prescription for Users
    public function addprescription($txn = null) {
        //echo $txn; exit;
        $this->loadModel('Orders');
        $this->loadModel('Prescriptions');


        $prescription = $this->Prescriptions->newEntity();


        if ($this->request->is('post')) {

            //pr($this->request->data); exit;

            $flag = true;

            if ($flag) {
                $this->request->data['txnid'] = $txn;
                $this->request->data['file'] = $filedt;

                $prescription = $this->Prescriptions->patchEntity($prescription, $this->request->data);

                if ($this->Prescriptions->save($prescription)) {
                    $this->Flash->success(__('Prescription has been saved.'));
                    return $this->redirect(['action' => 'dashboard']);
                } else {
                    $this->Flash->error(__('Prescription could not be saved. Please, try again.'));
                }
            }
        }

        $this->set(compact('prescription'));
        $this->set('_serialize', ['prescription']);
    }

    // Cancel oreder and Refund
    public function refundextra($txn_id = null) {


        $request_params = array(
            'METHOD' => 'RefundTransaction',
            'TRANSACTIONID' => $txn_id,
            'REFUNDTYPE' => 'Full',
            'USER' => 'nits.debsoumen2_api1.gmail.com',
            'PWD' => 'LJMGQ33VJGFUZGXQ',
            'SIGNATURE' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31AjUTZMwQl04R5EwZTojhK76GG1wR',
            'VERSION' => '85.0',
            'CURRENCYCODE' => 'GBP',
        );

        $nvp_string = '';
        foreach ($request_params as $var => $val) {
            $nvp_string .= '&' . $var . '=' . urlencode($val);
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_VERBOSE, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_URL, 'https://api-3t.sandbox.paypal.com/nvp');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $nvp_string);

        $result = curl_exec($curl);
        curl_close($curl);
        //var_dump($result);
        //$resArray = $this->NVPToArray($result);

        parse_str($result, $resArray);


        //$resArray = $this->PPHttpPost($methodToCall, $nvpstr, 'on', $API_UserName, $API_Password, $API_Signature);
        //end PennyAuctionSoft add
        //$nvpstr = "&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber&EXPDATE=" . $padDateMonth . $expDateYear . "&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=$address1&CITY=$city&STATE=$state" . "&ZIP=$zip&COUNTRYCODE=TH&CURRENCYCODE=$currencyCode";
        //echo phpinfo();
        //pr($request_params);
        //pr($this->request->data); pr($resArray); exit;
        echo "<pre>";
        print_r($resArray);
        exit;
    }

    // Oreder canceletion by doctor.
    public function cancelnow($txnId = null) {
        $this->viewBuilder()->layout('');

        $this->loadModel('Treatments');
        $this->loadModel('Orders');
        $this->loadModel('Orderdetails');
        $this->loadModel('Medicines');
        $this->loadModel('Pils');
        $this->loadModel('Transactions');

        $is_login = '';
        if ($this->request->session()->check('Auth.User')) {
            $is_login = 1;
            $uid = $this->request->session()->read('Auth.User.id');
            $orderExist = $this->Orders->find()->where(['Orders.user_id' => $uid, 'Orders.transaction_id' => $txnId])->all()->toArray();
        }

        if ($txnId != "") {

            $transaction = $this->Transactions->find()->contain(['Orders', 'Users'])->where(['Transactions.transaction_id' => $txnId])->first()->toArray();

            $request_params = array(
                'METHOD' => 'RefundTransaction',
                'TRANSACTIONID' => $txnId,
                'REFUNDTYPE' => 'Full',
                'USER' => 'nits.debsoumen2_api1.gmail.com',
                'PWD' => 'LJMGQ33VJGFUZGXQ',
                'SIGNATURE' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31AjUTZMwQl04R5EwZTojhK76GG1wR',
                'VERSION' => '85.0',
                'CURRENCYCODE' => 'GBP',
            );

            $nvp_string = '';
            foreach ($request_params as $var => $val) {
                $nvp_string .= '&' . $var . '=' . urlencode($val);
            }

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_VERBOSE, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_TIMEOUT, 3000);
            curl_setopt($curl, CURLOPT_URL, 'https://api-3t.sandbox.paypal.com/nvp');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $nvp_string);

            $result = curl_exec($curl);
            curl_close($curl);
            parse_str($result, $resArray);
            if ($resArray['ACK'] == 'Success') {
                $retTransactionId = $resArray['REFUNDTRANSACTIONID'];
                $refAmt = $resArray['NETREFUNDAMT'];
                $record_id = $transaction['id'];
                $trans['is_reject'] = 1;
                $trans['reject_by'] = "Patient";
                $trans['reject_by_id'] = $this->request->session()->read('Auth.User.id');
                $trans['is_refunded'] = 1;
                $trans['refund_amt'] = $refAmt;
                $trans['refund_transaction_id'] = $retTransactionId;
                //$trans['reasion'] = $this->request->data['data'];

                $transactionTable = TableRegistry::get('Transactions');
                $query1 = $transactionTable->query();
                $query1->update()->set($trans)->where(['id' => $record_id])->execute();

                foreach ($transaction['Orders'] as $cancelOrder) {
                    $record_ids = $cancelOrder['id'];
                    $order['is_reject'] = 1;
                    $order['reject_by'] = "Patient";
                    $order['reject_by_id'] = $this->request->session()->read('Auth.User.id');
                    $order['is_refunded'] = 1;
                    $order['refund_amt'] = $refAmt;
                    $order['refund_transaction_id'] = $retTransactionId;
                    //$order['reasion'] = $this->request->data['data'];
                    $ordersTable = TableRegistry::get('Orders');
                    $query = $ordersTable->query();
                    $query->update()->set($order)->where(['id' => $record_ids])->execute();
                }
                $this->Flash->success(__('You have cancel order Successfully.'));
                $this->redirect(['controller' => 'Users', 'action' => 'prescriptiondetail', $txnId]);
            } else {
                $this->Flash->success(__('Your cancel order Not done Try again.'));
                $this->redirect(['controller' => 'Users', 'action' => 'prescriptiondetail', $txnId]);
            }
        } else {
            $this->Flash->success(__('Your cancel order Not done Try again.'));
            $this->redirect(['controller' => 'Users', 'action' => 'prescriptiondetail', $txnId]);
        }
    }

}
