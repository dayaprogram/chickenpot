<?php

namespace App\Model\Table;

use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Text;
use Cake\Event\Event;
use Cake\ORM\Table;
use ArrayObject;
use Cake\I18n\Time;

class UsersTable extends Table {

    public function initialize(array $config) {
        $this->table('users');
        //$this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior ( 'Timestamp' );
        //$this->request->data['dob']= Time::parseDate($this->request->data['dob'],'Y-M-d');



        /*
          $this->hasMany('Reviews', [
          'foreignKey' => 'service_provider_id',
          'dependent' => true,
          ]);


          $this->hasOne('Bankdetails', [
          'className' => 'Bankdetails',
          'foreignKey' => 'service_provider_id',
          'propertyName' => 'Bankdetails'
          ]);

          $this->hasOne('Packagedetails', [
          'className' => 'Packagedetails',
          'foreignKey' => 'id',
          'propertyName' => 'Packagedetails'
          ]);


          $this->belongsTo('Packagedetails', [
          'className' => 'Packagedetails',
          'foreignKey' => 'id',
          'propertyName' => 'Packagedetails'
          ]);

         */
           $this->belongsTo('Postcards', [
          'className' => 'Postcards',
          'foreignKey' => 'user_id',
          'propertyName' => 'Postcards'
          ]);  
    }

    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options) {
    }

    public function beforeSave(Event $event) {
        $event->dateField = date('Y-m-d', strtotime($event->dateField));
        $entity = $event->data['entity'];
        
        if ($entity->isNew()) {
            $hasher = new DefaultPasswordHasher();
        }
        return true;
    }

}
