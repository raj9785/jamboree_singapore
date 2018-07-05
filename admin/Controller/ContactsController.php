<?php

/**
 * Static content controller.
 *
 * This file will render views from views/introductions/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/introductions-controller.html
 */
class ContactsController extends AppController {

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array();

    /**
     * Displays a view
     *
     * @param mixed What page to display
     * @return void
     * @throws NotFoundException When the view file could not be found
     * 	or MissingViewException in debug mode.
     */
    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function edit($user_id) {

        $this->set('tab_open', 'cms');


        $users_data = $this->Contact->find('first', array(
            'conditions' => array(
                'Contact.id' => $user_id
            ),
        ));

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Contact']['updated_on'] = date("Y-m-d h:i:s");
            $this->request->data['Contact']['id'] = $user_id;
            if ($this->Contact->save($this->request->data)) {
                $this->Session->setFlash('Contact updated successfully', 'success');
                $this->redirect(array('plugin' => false, 'controller' => 'contacts', 'action' => 'edit', $user_id));
            } else {
                $this->Session->setFlash('Contact couldn\'t be updated, try again later', 'error');
                $this->redirect(array('controller' => 'contacts', 'action' => 'edit', $user_id));
            }
        } else {
            $this->data = $users_data;
            $this->set('users_data', $users_data);
        }
        $this->set('title_for_layout', 'Update Contact');
    }

}
