<section class="landing">
     <h1 class="text-danger mb-5"><span class="text-warning fs-3 fw-bold">i</span>Pal</h1>

     <?= session()->getFlashdata('error') ?>
     <?= validation_list_errors() ?>
     <?php if (session()->getTempdata('error')) : ?>
          <p class="text-danger"><?= session()->getTempdata('error'); ?></p>
     <?php endif; ?>

     <form action="/login" method="post" class="form mw-768">
          <?= csrf_field() ?>
          <input type="email" class="form-control mb-3" id="email" name="email" value="<?= set_value('email') ?>" placeholder="Email address" aria-describedby="emailHelp" />
          <input type="password" class="form-control mb-3" id="pass" name="pass" value="<?= set_value('pass') ?>" placeholder="Password" />
          <input type="submit" name="submit" class="btn btn-success btn-100-width mb-3" value="Login">
          <a href="signup" class="hyperlink text-info fs-6 text-center">Create an account</a>
     </form>
</section>