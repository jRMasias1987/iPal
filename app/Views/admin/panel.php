<section class="section">

     <h1 class="mb-5">Welcome, <?= esc($userdata['name']) ?></h1>

     <div class="width-100 mw-bio">
          <table class="table table-dark table-striped-columns table-hover">
               <thead>
                    <tr>
                         <th>Total Users</th>
                         <th>Total Posts</th>
                         <th>Total Comments</th>
                    </tr>
               </thead>
               <tbody>
                    <tr>
                         <td class="text-center"><?= esc(count($alluserdata)) ?></td>
                         <td class="text-center"><?= esc(count($userblogs)) ?></td>
                         <td class="text-center"><?= esc(count($comments)) ?></td>
                    </tr>
               </tbody>
          </table>
     </div>
</section>