<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Templates Controller
 *
 * @property \App\Model\Table\TemplatesTable $Templates
 */
class TemplatesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
     
   public function beforeFilter(Event $event) {
       if (!$this->request->session()->check('Auth.Admin')) {
          return $this->redirect(
               ['controller' => 'Users', 'action' => 'index']
           );
       }
   }      
     
     
     // Email template List
     
    public function index(){
    	
		$this->viewBuilder()->layout('admin');
        $this->paginate = [
            'contain' => ['Customers']
        ];
        $templates = $this->paginate($this->Templates);

        $this->set(compact('templates'));
        $this->set('_serialize', ['templates']);
    }

    /**
     * View Template
     *
     * @param string|null $id Template id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null){
    	$this->viewBuilder()->layout('admin');
        $template = $this->Templates->get($id, [
            'contain' => ['Customers']
        ]);

		$det = json_decode($template->detail);
		
		
		$prod = array(); $i = 0; 
		$this->loadModel('Products');
		foreach($det as $dets){
			$prod[$i] = $this->Products->get($dets->id);
			$prod[$i]['qty'] = $dets->qty;
			$i ++;
		}
		
		
		//pr($det); pr($prod); pr($template->toarray()); exit;


		$this->set(compact('prod'));
        $this->set('template', $template);
        $this->set('_serialize', ['template']);
    }

    /**
     * Add Email Template
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
    	$this->viewBuilder()->layout('admin');
        $template = $this->Templates->newEntity();
        if ($this->request->is('post')) {
        	
			//pr($this->request->data); exit;
			
			
			$det = array();
			$detkey = 0;
			foreach($this->request->data['product_idn'] as $key=>$val){
				$det[$detkey]['id'] = $val;
				$det[$detkey]['qty'] = $this->request->data['product_qtyn'][$key];
				$detkey ++;
			}
			
			$detail = json_encode($det);
			
			//echo $detail; pr($det); pr($this->request->data); exit;
			
			$templet = $this->Templates->newEntity();
			
            $templet->customer_id	= $this->request->data['customer_id'];
			$templet->day	= $this->request->data['day'];
			$templet->detail	= $detail;

			//$templet->created = date("Y-m-d");
			//$templet->modified = date("Y-m-d");
	
            if ($this->Templates->save($templet)) {
			    $this->Flash->success(__('The template has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The template could not be saved. Please, try again.'));
            }
        }
        $customers = $this->Templates->Customers->find('list', ['limit' => 200]);
		
        $this->loadModel('Products');
        $products = $this->Products->find('all');
        //pr($products->toArray()); exit;
		
		$tempDays = array('Sunday' => 'Sunday', 'Monday' => 'Monday', 'Tuesday' => 'Tuesday', 'Wednesday' => 'Wednesday', 'Thursday' => 'Thursday', 'Friday' => 'Friday', 'Saturday' => 'Saturday');
		
        $this->set(compact('template', 'customers', 'addresses', 'runs','products','tempDays'));
        $this->set('_serialize', ['template']);		
		
		
		
		
		
		
    }

    /**
     * Edit template method
     *
     * @param string|null $id Template id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null){
    	$this->viewBuilder()->layout('admin');
        $template = $this->Templates->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
        	
			//pr($this->request->data); exit;
			
			$det = array();
			$detkey = 0;
			foreach($this->request->data['product_idn'] as $key=>$val){
				$det[$detkey]['id'] = $val;
				$det[$detkey]['qty'] = $this->request->data['product_qtyn'][$key];
				$detkey ++;
			}
			
			$detail = json_encode($det);
			
			//echo $detail; pr($det); pr($this->request->data); exit;
			
            $this->request->data['customer_id']	= $this->request->data['customer_id'];
			$this->request->data['day']	= $this->request->data['day'];
			$this->request->data['detail']	= $detail;		
			
            $template = $this->Templates->patchEntity($template, $this->request->data);
            if ($this->Templates->save($template)) {
                $this->Flash->success(__('The template has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The template could not be saved. Please, try again.'));
            }
        }




		$det = json_decode($template->detail);
		
		
		$prod = array(); $i = 0; $this->loadModel('Products');
		foreach($det as $dets){
			$prod[$i] = $this->Products->get($dets->id); $prod[$i]['qty'] = $dets->qty; $i ++;
		}


		//pr($prod); pr($template->toarray()); exit;
		
        $this->loadModel('Products');
        $products = $this->Products->find('all');		

		$tempDays = array('Sunday' => 'Sunday', 'Monday' => 'Monday', 'Tuesday' => 'Tuesday', 'Wednesday' => 'Wednesday', 'Thursday' => 'Thursday', 'Friday' => 'Friday', 'Saturday' => 'Saturday');
        $customers = $this->Templates->Customers->find('list', ['limit' => 200]);
        $this->set(compact('template', 'customers', 'tempDays', 'products', 'prod'));
        $this->set('_serialize', ['template']);
    }

    /**
     * Delete Template method
     *
     * @param string|null $id Template id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
    	
        $this->request->allowMethod(['post', 'delete']);
        $template = $this->Templates->get($id);
        if ($this->Templates->delete($template)) {
            $this->Flash->success(__('The template has been deleted.'));
        } else {
            $this->Flash->error(__('The template could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
