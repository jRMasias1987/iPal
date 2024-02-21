<section class="section">
     <h3 class="text-orange mb-5"><?= esc(strtoupper($userdata['name'])) ?></h3>

     <div class="container mb-5 pt-4 pb-0 bg-warning text-dark rounded post-card d-flex flex-column justify-content-between mw-bio">
          <div class="mb-5">
               <h4><?= esc($blog['entry']) ?></h4>
          </div>
          <div class="card-footer py-0">
               <p class="subtext">entry created on: <?= esc($blog['entry_created_at']) ?></p>
          </div>
     </div>

     <button class="btn btn-lg btn-outline-warning mb-5" type="button" onclick="openComment()">Leave a comment</button>

     <div class="comment-box" id="comment-box">
          <div class="container mb-5 py-2 bg-info text-dark rounded box-shadow mw-bio">
               <form action="/create-comment" method="post" class="form">
                    <?= csrf_field() ?>
                    <input type="hidden" name="post-id" value="<?= $blog['id'] ?>" />
                    <textarea name="comment" id="comment" class="mb-2" value="<?= set_value('comment') ?>" placeholder="Type your comment here (max 300 characters)"></textarea>
                    <div class="d-flex justify-content-evenly align-items-center">
                         <input type="submit" name="submit" class="btn btn-success fw-bold text-white btn-shadow" value="Comment" />
                         <input type="button" name="clear" id="clear" class="btn btn-success fw-bold text-white btn-shadow" value="Clear" onclick="clearPost()" />
                    </div>
               </form>
          </div>
     </div>

     <?php if (!empty($comments)) : ?>
          <div class="width-100 mw-bio">
               <table class="table table-dark table-striped-columns table-hover">
                    <thead>
                         <tr>
                              <th>Name</th>
                              <th>Comment</th>
                              <th class="comment-display">Created At</th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php foreach ($comments as $comment) : ?>
                              <tr>
                                   <td class="text-center"><?= esc($comment['name']) ?></td>
                                   <td><?= esc($comment['comment']) ?></td>
                                   <td class="comment-display"><?= esc($comment['comment_created_at']) ?></td>
                              </tr>
                         <?php endforeach; ?>
                    </tbody>
               </table>
          </div>
     <?php else : ?>
          <h3>No Comments</h3>
     <?php endif; ?>
</section>