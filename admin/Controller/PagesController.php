<?php

/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

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
        $this->Auth->allow('home');
    }

    public function index() {
        $this->paginate = array(
            'fields' => array(
                'Page.title', 'Page.created','is_program_detail', 'Page.id', 'Page.only_meta', 'Page.modified', 'Page.has_sub_points', 'Page.sub_points_heading', 'Page.modified_by', 'Menu.name'
            ),
            'joins' => array(
                array(
                    'table' => 'menus',
                    'alias' => 'Menu',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Menu.page_id = Page.id'
                    )
                )
            ),
            'group' => "page_id",
            'limit' => 50,
        );
        //pr($this->paginate());
        $this->set('users_list', $this->paginate());
        $this->set('tab_open', 'cms');
        $this->set('title_for_layout', 'Pages List');
    }

    public function slug_by_title($title) {
        $slug = strtolower($title);
        $slug = str_replace(" ", "_", $slug);
        return $slug;
    }

    public function manage_points($page_id) {
        $this->set('tab_open', 'cms');

        $this->set('page_id', $page_id);
        $users_data = $this->Page->find('first', array(
            'conditions' => array(
                'Page.id' => $page_id
            ),
            'fields' => array(
                'Page.id', 'Page.sub_points_heading', 'Page.has_sub_points'
            )
        ));

        $page_list = $this->Page->find('all', array(
            'conditions' => array(
                'Page.parent_id' => $page_id
            ),
            'fields' => array(
                'Page.id', 'Page.title'
            )
        ));
        $this->set('page_list', $page_list);
        $this->set('title_for_layout', $users_data['Page']['sub_points_heading']);





        if ($this->request->is('post') || $this->request->is('put')) {

            $this->loadModel('PageTab');
            $this->loadModel('PageTabHeading');
            $this->PageTabHeading->deleteAll(array("PageTabHeading.parent_page_id" => $page_id));
            $this->PageTab->deleteAll(array("PageTab.parent_page_id" => $page_id));
            //insert new headings//
            $headings = $this->request->data['heading'];
            if (!empty($headings)) {
                $insHd = array();
                $i = 0;
                foreach ($headings as $pg_id => $hd) {
                    //if ($hd) {
                        $insHd['PageTabHeading'][$i]['page_id'] = $pg_id;
                        $insHd['PageTabHeading'][$i]['heading'] = $hd;
                        $insHd['PageTabHeading'][$i]['parent_page_id'] = $page_id;
                        $i++;
                   // }
                }
                if (!empty($insHd)) {
                    $this->PageTabHeading->saveAll($insHd['PageTabHeading']);
                }
            }
            //insert new headings//
            $text_point = $this->request->data['text_point'];
            if (!empty($text_point)) {
                $insHd = array();
                $i = 0;
                foreach ($text_point as $pg_id => $dtls) {
                    if (!empty($dtls)) {
                        foreach ($dtls as $j => $pt) {
                            if ($pt) {
                                $insHd['PageTab'][$i]['page_id'] = $pg_id;
                                $insHd['PageTab'][$i]['text_point'] = $pt;
                                $insHd['PageTab'][$i]['created_on'] = date("Y-m-d H:i:s");
                                $insHd['PageTab'][$i]['parent_page_id'] = $page_id;
                                $i++;
                            }
                        }
                    }
                }
                if (!empty($insHd)) {
                    $this->PageTab->saveAll($insHd['PageTab']);
                }
            }
            $this->Session->setFlash('Data updated successfully', 'success');
            $this->redirect(array('plugin' => false, 'controller' => 'pages', 'action' => 'manage_points', $page_id));
        } else {
            $this->loadModel('PageTabHeading');
            $page_hd = $this->PageTabHeading->find('all', array(
                'conditions' => array(
                    'PageTabHeading.parent_page_id' => $page_id
                ),
            ));
            $shodatas = array();
            if (!empty($page_hd)) {
                foreach ($page_hd as $pdata) {
                    $shodatas['heading'][$pdata['PageTabHeading']['page_id']] = $pdata['PageTabHeading']['heading'];
                }
            }
            $this->data = $shodatas;
            //pr($page_hd);
            $this->loadModel('PageTab');
            $page_pts = $this->PageTab->find('all', array(
                'conditions' => array(
                    'PageTab.parent_page_id' => $page_id
                ),
            ));

            $pts = array();
            if (!empty($page_pts)) {
                foreach ($page_pts as $pdata) {
                    $pts[$pdata['PageTab']['page_id']][] = $pdata['PageTab']['text_point'];
                }
            }
            $this->set('pts', $pts);
        }
    }

    public function edit() {
        $user_id = $this->params->query['id'];
        $this->set('tab_open', 'cms');
        if (!$user_id || $user_id == NULL) {
            $this->Session->setFlash('Invalid request to edit page', 'error');
            $this->redirect(array('plugin' => false, 'controller' => 'pages', 'action' => 'index'));
        } else {
            // check that user exists or not
            $check_user_exists = $this->Page->Find('count', array(
                'conditions' => array(
                    'Page.id' => $user_id
                ),
                'recursive' => -1
            ));
            if ($check_user_exists == 0) {
                $this->Session->setFlash('Page does not exists', 'error');
                $this->redirect(array('plugin' => false, 'controller' => 'pages', 'action' => 'index'));
            }
        }

        $users_data = $this->Page->find('first', array(
            'conditions' => array(
                'Page.id' => $user_id
            ),
            'joins' => array(
                array(
                    'table' => 'menus',
                    'alias' => 'Menu',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Menu.page_id = Page.id'
                    )
                )
            ),
            'fields' => array(
                'Page.id', 'Page.title', 'Page.content', 'Page.only_meta', 'Page.meta_title', 'Page.meta_title','Page.sample_test_url',
                'Page.meta_keywords', 'Page.meta_description', 'Menu.name', 'Menu.slug', 'Page.image', 'Page.sub_points_heading', 'Page.has_sub_points','video_list_title'
            )
        ));

        if ($this->request->is('post') || $this->request->is('put')) {
            $is_success = 1;
            $upload_image_folder = BANNER_IMAGE_PATH;
            $filename = $this->data{$this->modelClass}['image']['name'];
            if (isset($this->request->data{$this->modelClass}['image']) && $this->request->data{$this->modelClass}['image']['name'] != "") {
                $allowed_extensions = array('jpg', 'JPG', 'jpeg', 'png', 'gif');
                $uploaded_image = $this->request->data{$this->modelClass}['image']['name'];
                $imgExtension = pathinfo($uploaded_image, PATHINFO_EXTENSION);
                if (!in_array($imgExtension, $allowed_extensions)) {
                    $this->data = $this->request->data;
                    $is_success = 0;
                    $this->Session->setFlash(__('Image extension should be of ' . implode(",", $allowed_extensions) . ' only'), 'error');
                }
                $uploadimageArray = $this->request->data{$this->modelClass}['image'];
                unset($this->request->data{$this->modelClass}['image']);
            } else {
                unset($this->request->data{$this->modelClass}['image']);
            }

            $this->request->data['Page']['modified'] = date("Y-m-d h:i:s");

            $this->request->data['Page']['modified_by'] = "Admin";
            $this->request->data['Page']['id'] = $user_id;
            if ($is_success == 1) {
                if ($this->Page->save($this->request->data)) {
                    if (isset($uploadimageArray) && $uploadimageArray['name'] != "") {

                        $file_name = basename($uploadimageArray['name']);
                        $imgExtension = pathinfo($file_name, PATHINFO_EXTENSION);
                        $image_name = explode("." . $imgExtension, $file_name);
                        $prefix = time() . rand(0, 99) . "~@~";
                        $file_name = base64_encode($prefix . $image_name[0]) . "." . $imgExtension;

                        if (move_uploaded_file($uploadimageArray['tmp_name'], $upload_image_folder . DS . $file_name)) {
                            $this->{$this->modelClass}->updateAll(array('Page.image' => "'" . $file_name . "'"), array('Page.id' => $user_id));
                            $image = $users_data['Page']['image'];
                            if ($image) {
                                if (file_exists(BANNER_IMAGE_PATH . $image)) {
                                    @unlink(BANNER_IMAGE_PATH . $image);
                                }
                            }
                        }
                    }

                    $this->Session->setFlash('Page updated successfully', 'success');
                    $this->redirect(array('plugin' => false, 'controller' => 'pages', 'action' => 'edit','?' => array('id' => $user_id)));
                } else {
                    $this->Session->setFlash('Page couldn\'t be updated, try again later', 'error');
                    // $this->redirect(array('controller' => 'users', 'action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Banner couldn\'t be updated, try again later', 'error');
            }
        } else {
            //pr($users_data);
            $this->data = $users_data;
            $this->set('users_data', $users_data);
        }
        $this->set('title_for_layout', 'Edit Page');
    }

}
