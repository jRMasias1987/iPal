<?php

namespace App\Controllers;

use App\Models\BodyModel;

class Landing extends BaseController
{
     public $session;
     /**
      * Class constructor.
      */
     public function __construct()
     {
          $this->session = session();
     }

     public function index(): string
     {
          helper('form');
          $data = [];
          $data['title'] = "Login";

          return  view('templates/header', $data) . view('users/index') . view('templates/footer');
     }

     public function login()
     {
          helper('form');
          $data = [];
          $data['title'] = 'Home';
          $model = model(BodyModel::class);

          $user = $this->request->getPost(['email', 'pass']);

          if (!$this->validateData($user, [
               'email' => 'required|valid_email',
               'pass' => 'required|max_length[16]|min_length[8]',
          ])) {
               // invalid data
               return $this->index();
          }

          $data['userdata'] = $model->verifyUser($user['email'], $user['pass']);

          if ($data['userdata']) {
               $this->session->set('logged_user', $data['userdata']['id']);
               $data['userstatus'] = $model->getUserStatus($data['userdata']['id']);

               if ($data['userstatus']['isAdmin'] == 1) {
                    $this->session->set('admin', true);
                    return $this->adminPanel();
               } else {
                    return redirect()->redirect('userhome');
               }
          } else {
               $this->session->setTempdata('error', 'Invalid email and/or password', 3);
               return $this->index();
          }
     }

     public function adminPanel()
     {
          $data = [];
          $data['title'] = 'Admin Panel';

          $model = model(BodyModel::class);
          $user_id = $this->session->get('logged_user');

          if ($this->session->has('logged_user') && $this->session->get('admin')) {
               $data['userdata'] = $model->getUserInfo($user_id);
               $data['alluserdata'] = $model->getAllUsers();
               $data['userblogs'] = $model->getAllBlogs();
               $data['comments'] = $model->getAllComments();

               return view('templates/header', $data) . view('templates/adminbar') . view('admin/panel') . view('templates/footer');
          } else {
               return redirect()->redirect('/');
          }
     }

     public function new()
     {
          helper('form');
          $data = [];
          $data['title'] = "Sign Up";

          return view('templates/header', $data) . view('users/create') . view('templates/footer');
     }

     public function create()
     {
          helper('form');

          $save = [];
          $data = $this->request->getPost(['email', 'pass', 'cpass', 'name', 'bio']);

          if (!$this->validateData($data, [
               'email' => ['rules' => 'required|valid_email|is_unique[users.email]', 'errors' => ['is_unique' => 'Email already in use']],
               'name' => 'required|max_length[100]',
               'pass' => 'required|max_length[16]|min_length[8]',
               'cpass' => 'required|max_length[16]|matches[pass]',
               'bio' => 'required|max_length[300]'
          ])) {
               // invalid data
               return $this->new();
          }

          // save data to db
          $pass = password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT);

          $save = [
               'email' => $this->request->getVar('email'),
               'pass' => $pass,
               'name' => $this->request->getVar('name'),
               'bio' => $this->request->getVar('bio'),
          ];
          $email = $this->request->getVar('email');
          $inPass = $this->request->getVar('pass');

          $model = model(BodyModel::class);
          $model->createUser($save);
          $userdata = $model->verifyUser($email, $inPass);

          $model->generateDefaultStatus($userdata['id']);
          // print_r($userdata);
          // echo('yes');
          return redirect()->redirect('/');
     }

     public function logout()
     {
          $this->session->remove('logged_user');
          $this->session->destroy();
          return redirect()->redirect('/');
     }
}
