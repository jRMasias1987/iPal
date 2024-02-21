<section class="section">
     <h1 class="text-danger mb-5"><span class="text-warning fs-3 fw-bold">i</span>Pal</h1>

     <?= session()->getFlashdata('error') ?>

     <form action="/create-user" method="post" class="form mw-768">
          <?= csrf_field() ?>
          <p class="text-danger mb-1"><?= validation_show_error('email') ?></p>
          <input type="email" class="form-control mb-3" id="email" name="email" value="<?= set_value('email') ?>" placeholder="Email address" aria-describedby="emailHelp" />
          
          <p class="text-danger mb-1"><?= validation_show_error('pass') ?></p>
          <input type="password" class="form-control mb-3" id="pass" name="pass" value="<?= set_value('pass') ?>" placeholder="Password" />
          
          <p class="text-danger mb-1"><?= validation_show_error('cpass') ?></p>
          <input type="password" class="form-control mb-3" id="cpass" name="cpass" value="<?= set_value('cpass') ?>" placeholder="Confirm Password" />
          
          <p class="text-danger mb-1"><?= validation_show_error('name') ?></p>
          <input type="text" class="form-control mb-3" id="name" name="name" value="<?= set_value('name') ?>" placeholder="Enter your name" />
          
          <p class="text-danger mb-1"><?= validation_show_error('bio') ?></p>
          <textarea class="form-control mb-3" id="bio" name="bio" value="<?= set_value('bio') ?>" placeholder="Enter some info about you" rows="10" cols="10"></textarea>
          <input type="submit" name="submit" class="btn btn-success btn-100-width mb-3" value="Sign Up">
     </form>
</section>