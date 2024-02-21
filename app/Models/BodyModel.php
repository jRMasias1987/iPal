<?php

namespace App\Models;

use CodeIgniter\Model;

class BodyModel extends Model
{
     public function verifyUser($email, $pass)
     {
          $builder = $this->db->table('users');
          $builder->select('email, name, pass, bio, id');
          $builder->where('email', $email);
          $result = $builder->get();

          if ($result->getNumRows() == 1) {
               $user = $result->getRowArray();
               if (password_verify($pass, $user['pass'])) {
                    return $user;
               } else {
                    return false;
               }
          } else {
               return false;
          }
     }

     public function getUserStatus($id)
     {
          $builder = $this->db->table('status');
          $builder->select('isAdmin');
          $builder->where('user_id', $id);
          $result = $builder->get();

          if ($result->getNumRows() == 1) {
               return $result->getRowArray();
          } else {
               return false;
          }
     }

     public function getUserInfo($id)
     {
          $builder = $this->db->table('users');
          $builder->select('name, bio');
          $builder->where('id', $id);
          $result = $builder->get();

          if ($result->getNumRows() == 1) {
               return $result->getRowArray();
          } else {
               return false;
          }
     }

     public function getOtherUsers($email)
     {
          $builder = $this->db->table('users');
          $builder->select('name, email, bio, id');
          $builder->where('email', $email);
          $result = $builder->get();

          if ($result->getNumRows() == 1) {
               return $result->getRowArray();
          } else {
               return false;
          }
     }

     public function getAllUsers()
     {
          $builder = $this->db->table('users');
          $builder->select('id');
          $result = $builder->get();

          if ($result->getNumRows() >= 1) {
               return $result->getResultArray();
          } else {
               return false;
          }
     }

     public function getAllBlogs()
     {
          $builder = $this->db->table('blogs');
          $builder->select('id');
          $result = $builder->get();

          if ($result->getNumRows() >= 1) {
               return $result->getResultArray();
          } else {
               return false;
          }
     }

     public function getAllComments()
     {
          $builder = $this->db->table('comments');
          $builder->select('id');
          $result = $builder->get();

          if ($result->getNumRows() >= 1) {
               return $result->getResultArray();
          } else {
               return false;
          }
     }

     public function getOtherUsersByBlogID($id)
     {
          $builder = $this->db->table('users');
          $builder->select('name');
          $builder->join('blogs', 'users.id = blogs.user_id');
          $builder->where('blogs.id', $id);
          $result = $builder->get();

          if ($result->getNumRows() == 1) {
               return $result->getRowArray();
          } else {
               return false;
          }
     }

     public function updateInfo($data, $id)
     {
          $builder = $this->db->table('users');
          $builder->where('id', $id);
          $builder->update($data);
     }

     public function getUserBlogs($id)
     {
          $builder = $this->db->table('blogs');
          $builder->select('entry, entry_created_at, id');
          $builder->where('blogs.user_id', $id);
          $builder->orderBy('entry_created_at', 'DESC');
          $result = $builder->get();

          if ($result->getNumRows() >= 1) {
               return $result->getResultArray();
          } else {
               return false;
          }
     }

     public function getUserBlog($id)
     {
          $builder = $this->db->table('blogs');
          $builder->select('entry, entry_created_at, id');
          $builder->where('blogs.id', $id);
          $result = $builder->get();

          if ($result->getNumRows() == 1) {
               return $result->getRowArray();
          } else {
               return false;
          }
     }

     public function getComments($id)
     {
          $builder = $this->db->table('comments');
          $builder->select('comment, comment_created_at, users.name');
          $builder->join('users', 'comments.user_id = users.id');
          $builder->join('blogs', 'comments.post_id = blogs.id');
          $builder->where('post_id', $id);
          $builder->orderBy('comment_created_at', 'ASC');
          $result = $builder->get();

          if ($result->getNumRows() >= 1) {
               return $result->getResultArray();
          } else {
               return false;
          }
     }

     public function createUser($data)
     {
          $builder = $this->db->table('users');
          $builder->insert($data);
     }

     public function generateDefaultStatus($id)
     {
          $builder = $this->db->table('status');
          $builder->insert([
               'user_id' => $id,
               'isAdmin' => 0
          ]);
     }

     public function createComment($data)
     {
          $save = [
               'user_id' => $data['user_id'],
               'post_id' => $data['post_id'],
               'comment' => $data['comment']
          ];

          $builder = $this->db->table('comments');
          $builder->insert($save);
     }

     public function savePost($id, $entry)
     {
          $data = [
               'user_id' => $id,
               'entry' => $entry,
          ];
          $builder = $this->db->table('blogs');
          $builder->insert($data);
     }

     public function deleteblog($id)
     {
          $builder = $this->db->table('comments');
          $builder->delete(['post_id' => $id]);

          $builder = $this->db->table('blogs');
          $builder->delete(['id' => $id]);
     }

     public function deleteUser($id)
     {
          $builder = $this->db->table('comments');
          $builder->delete(['user_id' => $id]);

          $builder = $this->db->table('blogs');
          $builder->delete(['user_id' => $id]);

          $builder = $this->db->table('status');
          $builder->delete(['user_id' => $id]);

          $builder = $this->db->table('users');
          $builder->delete(['id' => $id]);
     }
}
