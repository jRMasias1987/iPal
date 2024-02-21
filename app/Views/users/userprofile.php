<section class="other-posts mb-5">
     <h2 class="my-5 text-center"><?= esc(strtoupper($userdata['name'])) ?></h2>
     <div class="mw-bio">
          <p class="align-self-start fs-4 text-info"><?= esc($userdata['bio']) ?></p>
     </div>
     <p class="subtext my-5 disappear">Scroll down to see posts by <?= esc($userdata['name']) ?></p>
</section>

<section class="other-posts">
          <?php if (!empty($userblogs)) : ?>
               <?php foreach ($userblogs as $blog) : ?>
                    <div class="container mb-5 pt-4 py-4 pb-0 bg-warning text-dark rounded my-card pos-rel mw-bio">
                         <a href="post/<?= esc($blog['id']) ?>" class="post-anchor text-dark">
                              <div class="card-overflow mb-2">
                                   <h4><?= esc($blog['entry']) ?></h4>
                              </div>
                              <div class="card-footer pb-0">
                                   <p class="subtext">entry created on: <?= esc($blog['entry_created_at']) ?></p>
                              </div>
                         </a>
                    </div>
               <?php endforeach; ?>
          <?php else : ?>
               <h3>No Entries</h3>
          <?php endif ?>
</section>