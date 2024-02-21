<section class="posts">

     <?= session()->getFlashdata('error') ?>
     <?= validation_list_errors() ?>

     <h3>Welcome,</h3>
     <h3 class="text-orange mb-5"><?= esc(strtoupper($userdata['name'])) ?></h3>

     <div class="container mb-5 py-2 bg-info text-dark rounded box-shadow mw-bio">
          <form action="/create-post" method="post" class="form">
               <?= csrf_field() ?>
               <textarea name="entry" id="entry" class="mb-2" value="<?= set_value('entry') ?>" placeholder="Start a blog here (max 1000 characters)"></textarea>
               <div class="d-flex justify-content-evenly align-items-center">
                    <input type="submit" name="submit" class="btn btn-success fw-bold text-white btn-shadow" value="Post" />
                    <input type="button" name="clear" id="clear" class="btn btn-success fw-bold text-white btn-shadow" value="Clear" onclick="clearPost()" />
               </div>
          </form>
     </div>

          <?php if (!empty($userblogs)) : ?>
               <?php foreach ($userblogs as $blog) : ?>
                    <form action="/delete-post" method="post" class="form mw-bio">
                         <?= csrf_field() ?>
                         <div class="container mb-5 pt-4 py-4 pb-0 bg-warning text-dark rounded my-card pos-rel">
                              <a href="post/<?= esc($blog['id']) ?>" class="post-anchor text-dark">
                                   <input type="hidden" name="blog_id" value="<?= $blog['id'] ?>" />
                                   <input class="delete-blog" name="delete-blog" type="submit" value="x" />
                                   <div class="card-overflow mb-2">
                                        <h4><?= esc($blog['entry']) ?></h4>
                                   </div>
                                   <div class="card-footer pb-0">
                                        <p class="subtext">entry created on: <?= esc($blog['entry_created_at']) ?></p>
                                   </div>
                              </a>
                         </div>
                    </form>
               <?php endforeach ?>
          <?php else : ?>
               <h3>No Entries</h3>
          <?php endif ?>
</section>