<?php

namespace App\Controllers;

use App\Models\BodyModel;

class User extends BaseController
{
     protected $model;
     public $session;

     /**
      * Class constructor.
      */
     public function __construct()
     {
          $this->model = new BodyModel();
          $this->session = session();
     }

     public function index()
     {
          helper('form');

          if ($this->session->has('logged_user')) {

               $user_id = $this->session->get('logged_user');

               $data = [];
               $data['title'] = 'Profile';
               $data['userdata'] = $this->model->getUserInfo($user_id);
               $data['userposts'] = $this->model->getUserBlogs($user_id);

               if ($this->session->get('admin')) {
                    return view('templates/header', $data) . view('templates/adminbar') . view('user/profile') . view('templates/footer');
               } else {
                    return view('templates/header', $data) . view('templates/navbar') . view('user/profile') . view('templates/footer');
               }
          } else {
               return redirect()->redirect('/');
          }
     }

     public function userblogs()
     {
          helper('form');

          if ($this->session->has('logged_user')) {
               $data = [];
               $data['title'] = 'Home';

               $user_id = $this->session->get('logged_user');

               $data['userdata'] = $this->model->getUserInfo($user_id);
               $data['userblogs'] = $this->model->getUserBlogs($user_id);

               if ($this->session->get('admin')) {
                    return view('templates/header', $data) . view('templates/adminbar') . view('user/blogs') . view('templates/footer');
               } else {
                    return view('templates/header', $data) . view('templates/navbar') . view('user/blogs') . view('templates/footer');
               }
          } else {
               return redirect()->redirect('/');
          }
     }

     public function create()
     {
          helper('form');
          $data = [];

          if ($this->session->has('logged_user')) {

               $data = $this->request->getPost(['entry']);

               if (!$this->validateData($data, [
                    'entry' => 'max_length[500]|required',
               ])) {
                    // invalid data
                    return $this->userblogs();
               }

               $user_id = $this->session->get('logged_user');
               $this->model->savePost($user_id, $data['entry']);
               return redirect()->redirect('userhome');
          } else {
               return redirect()->redirect('/');
          }
     }

     public function updateInfo()
     {
          helper('form');

          if ($this->session->has('logged_user')) {
               $data = [];
               $updatedata = $this->request->getPost(['name', 'bio']);
               $user_id = $this->session->get('logged_user');
               $userOG = $this->model->getUserInfo($user_id);

               if (strlen($updatedata['name']) <= 0) {
                    $updatedata['name'] = $userOG['name'];
               }

               if (strlen($updatedata['bio']) <= 0) {
                    $updatedata['bio'] = $userOG['bio'];
               }

               if (!$this->validateData($updatedata, [
                    'name' => 'max_length[100]',
                    'bio' => 'max_length[500]'
               ])) {
                    return $this->index();
               }

               $data = [
                    'name' => $updatedata['name'],
                    'bio' => $updatedata['bio']
               ];

               $this->model->updateInfo($updatedata, $user_id);

               return redirect()->redirect('userhome');
          } else {
               return $this->index();
          }
     }

     public function delete()
     {
          helper('form');
          $id = [];
          $id = $this->request->getPost(['blog_id']);

          if ($this->session->has('logged_user')) {
               $this->model->deleteblog($id);
               return redirect()->redirect('userhome');
          } else {
               return redirect()->redirect('/');
          }
     }

     public function deleteUser()
     {
          helper('form');

          if ($this->session->has('logged_user')) {
               $user_id = $this->session->get('logged_user');

               $this->model->deleteUser($user_id);
               $this->session->remove('logged_user');
               return redirect()->redirect('/');
          } else {
               return redirect()->redirect('/');
          }          
     }
}
