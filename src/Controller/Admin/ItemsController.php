<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\View\Helper;
/**
 * Website Settings Controller
 *
 * @property \App\Model\Table\SiteSettingsTable $Customers
 */
class ItemsController extends AppController {
    

    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    
    public function index() {
        $this->viewBuilder()->layout('admin');
       $this->loadModel('Item');  
        $food_item = $this->paginate($this->Item,['limit' => 10]);
       $this->set(compact('food_item'));

    }
    
    public function delete($id=null){
          $this->loadModel('Item');
        $result = $this->Item->get($id);
       // print_r($result);die;
        if ($this->Item->delete($result)) {
            $this->Flash->success(__('Item has been deleted.'));
        } else {
            $this->Flash->error(__('Item not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
        
    
    
    public function edit($id = null) {
    $this->loadModel('Item');
        $this->viewBuilder()->layout('admin');
        $category = $this->Item->get($id, [ 'contain' => [] ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            
            //pr($this->request->data); exit;
            
             $tableRegObj = TableRegistry::get('Item');
             $slugExist = $tableRegObj
                            ->find()
                            ->where(['foodname' => $this->request->data['foodname'],'id !='=> $id])->toArray();
            
            
            
            //pr($getAllResults); exit;
            //pr($this->request->data); exit;
            
            $flag = true;
            
            if($this->request->data['foodname'] == ""){
                $this->Flash->error(__('Title can not be null. Please, try again.')); $flag = false;
            }            
            
            if($flag){
                if( $slugExist ){
                    $this->Flash->error(__('Title already Exist. Please, change some text to make it unique.')); $flag = false;
                }      
            }
            if($flag){
                 $file = $this->request->data['image'];
                               //put the data into a var for easy use
                     $ext = substr(strtolower(strrchr($file, '.')), 1); //get the extension
                     $fileName = time() . "." . $ext;//get the extension

                     if($fileName != "") 
                         $fileNames = time() . "." . $ext; 
                        $imgname = array($fileNames);

                    if (in_array($ext, $imgname)) {
                         move_uploaded_file($file['tmp_name'], WWW_ROOT . 'food_image' . DS . $fileName);
                        $this->request->data['image'] = $fileName;
                     }
                 } else {
                     $this->request->data['image'] = $result->image;
                 }
                 
            
             if($flag){
                
                $category = $this->Item->patchEntity($category, $this->request->data);
                if ($this->Item->save($category)) {
                    $this->Flash->success(__('Itwm detail has been updated.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('Itwm detail could not be update. Please, try again.'));
                }
            }
        }


        $this->set(compact('category'));
        $this->set('_serialize', ['category']);
    }
    public function add(){
         $this->loadModel('Item');
       $this->viewBuilder()->layout('admin');
        $items = $this->Item->newEntity();
        if ($this->request->is('post')) {

            $flag = true;
            //echo $this->generateRandomString(); exit;
            $tableRegObj = TableRegistry::get('Item');
            $userExist = $tableRegObj->find()->where(['foodname' => $this->request->data['foodname']])->toArray();
            // Validating Patient Form
            if($this->request->data['foodname'] == ""){
                $this->Flash->error(__('Title can not be null. Please, try again.')); $flag = false;
            }
            
            if($flag){
                if($this->request->data['description'] == ""){
                    $this->Flash->error(__('Description can not be null. Please, try again.')); $flag = false;
                }            
            }
            if($flag){
                 $arr_ext = array('jpg', 'jpeg', 'gif', 'png');
                 if (!empty($this->request->data['image']['name'])) {
                     $file = $this->request->data['image']; //put the data into a var for easy use
                     $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                     $fileName = time() . "." . $ext;
                     if (in_array($ext, $arr_ext)) {
                         move_uploaded_file($file['tmp_name'], WWW_ROOT . 'food_image' . DS . $fileName);
                         $file = $fileName;
                     } else {
                         $flag = false;
                         $this->Flash->error(__('Upload image only jpg,jpeg,png files.'));
                     }
                 } else {
                     $flag = false;
                     $this->Flash->error(__('Upload Image.'));
                 }
             }
             if($flag){
                if($userExist){
                    $flag = false;
                    $this->Flash->error(__('Title Already Registered, try with another.'));
                }  
            }
          if($flag){
              $this->request->data['image'] = $file;
                $items = $this->Item->patchEntity($items, $this->request->data);
                if ($this->Item->save($items)) {
                    $this->Flash->success(__('Item has been updated.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('Item could not be update. Please, try again.'));
                }
            }            
 
                }
            
         $this->set(compact('items'));
        
    }
}
