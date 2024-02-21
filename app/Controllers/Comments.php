<?php

namespace App\Controllers;

use App\Models\BodyModel;

class Comments extends BaseController
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

     public function index($id = null)
     {
          helper('form');
          $data = [];
          $data['title'] = 'Comment';

          if ($this->session->has('logged_user')) {
               $data['blog'] = $this->model->getUserBlog($id);
               $data['userdata'] = $this->model->getOtherUsersByBlogID($id);
               $data['comments'] = $this->model->getComments($id);

               if ($this->session->get('admin')) {
                    return view('templates/header', $data) . view('templates/adminbar') . view('users/comments') . view('templates/footer');
               } else {
                    return view('templates/header', $data) . view('templates/navbar') . view('users/comments') . view('templates/footer');
               }
          } else {
               return redirect()->redirect('/');
          }
     }

     public function create()
     {
          helper('form');

          if ($this->session->has('logged_user')) {
               $data = [];
               $user_id = $this->session->get('logged_user'); // get logged user's ID
               $post = $this->request->getPost(['post-id', 'comment']);

               if (!$this->validateData($post, [
                    'comment' => 'max_length[300]|required',
               ])) {
                    return $this->index();
               }

               $data['user_id'] = $user_id;
               $data['post_id'] = $post['post-id'];
               $data['comment'] = $post['comment'];

               $this->model->createComment($data);

               return redirect()->redirect('post/' . $post['post-id']);
          } else {
               return redirect()->redirect('/');
          }
     }
}
