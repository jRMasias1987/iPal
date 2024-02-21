<section class="section">
     <h2 class="text-white mb-5">F<span class="text-warning">i</span>nd <span class="text-orange">Pal</span>s</h2>

     <?= session()->getFlashdata('error') ?>
     <?= validation_list_errors() ?>
     <p class="text-danger"><?= session()->getTempdata('error'); ?></p>

     <form action="/search" method="post" class="form mw-768">
          <?= csrf_field() ?>
          <input type="email" class="form-control mb-3" id="email" name="email" value="<?= set_value('email') ?>" placeholder="Email address" aria-describedby="emailHelp" />
          <input type="submit" name="submit" class="btn btn-success btn-100-width mb-3" value="Search">
     </form>
</section>