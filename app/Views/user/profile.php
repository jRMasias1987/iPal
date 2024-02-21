<section class="section">
     <?= session()->getFlashdata('error') ?>
     <?= validation_list_errors() ?>

     <h3 class="text-orange mb-3">Update Info</h3>

     <form action="/update" method="post" class="form mw-768">
          <?= csrf_field() ?>
          <label for="name" class="text-warning">Name</label>
          <input type="text" class="form-control mb-3" name="name" id="name" value="<?= set_value('name') ?>" placeholder="<?= esc(strtoupper($userdata['name'])) ?>" autocomplete="off" />
          <label for="bio" class="text-warning">Biography</label>
          <textarea name="bio" class="form-control mb-3" id="bio" value="<?= set_value('bio') ?>" placeholder="<?= esc($userdata['bio']) ?>"></textarea>
          <input type="submit" name="submit" class="btn btn-success btn-100-width mb-3" value="Update Profile">
          <input type="button" name="delete-account" class="btn btn-danger btn-100-width mb-3" value="Delete Account" onclick="deleteUserWarning()">
     </form>
</section>