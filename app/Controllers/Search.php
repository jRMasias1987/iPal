<?php

namespace App\Controllers;

use App\Models\BodyModel;

class Search extends BaseController
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
               $data['title'] = 'Find Pals';
               $data['userdata'] = $this->model->getUserInfo($user_id);
               
               if ($this->session->get('admin')) {
                    return view('templates/header', $data) . view('templates/adminbar') . view('users/searchusers') . view('templates/footer');
               } else {
                    return view('templates/header', $data) . view('templates/navbar') . view('users/searchusers') . view('templates/footer');
               }
          } else {
               return redirect()->redirect('/');
          }
     }

     /*
          This will collect from post the searched email address and
          compare it with the DB and return the user name, and posts
     */
     public function searchUsers()
     {
          helper('form');

          $data = [];
          $post = [];
          if ($this->session->has('logged_user')) {
               $data['title'] = 'Find Pals';

               $post = $this->request->getPost(['email']);

               if (!$this->validateData($post, [
                    'email' => 'required|valid_email',
               ])) {
                    // invalid data
                    return $this->index();
               }

               $data['userdata'] = $this->model->getOtherUsers($post['email']);
               
               if ($data['userdata']){
                    $user_id = $data['userdata']['id'];
                    $data['userblogs'] = $this->model->getUserBlogs($user_id);
                    if ($this->session->get('admin')){
                         return view('templates/header', $data) . view('templates/adminbar') . view('users/userprofile') . view('templates/footer');
                    } else {
                         return view('templates/header', $data) . view('templates/navbar') . view('users/userprofile') . view('templates/footer');
                    }
               } else {
                    $this->session->setTempdata('error', 'Email address not found', 3);
                    return $this->index();
               }

          } else {
               return redirect()->redirect('/');
          }
     }
}
