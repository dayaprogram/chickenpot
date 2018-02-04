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

Type::build('date')->setLocaleFormat('yy/mm/dd');

/**
 * Addresses Controller
 *
 * @property \App\Model\Table\AddressesTable $Addresses
 */
class aboutController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     * 
     */
    
     public function initialize() {
        parent::initialize();
        //$this->Auth->allow(['index', 'view','edit','chstatus','add','delete']); 
    }
    public function index(){
    	

    }
    


        
       
    
}

    