<div class="modal fade" id="users_group" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
	    <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Users</h4>
	      </div>
	      <div class="modal-body">
	        <?php foreach ($group->users as $user) {
	          echo "<img class = 'img-circle' src='".$user->image."' height='60' width='60'/>&nbsp;<B><a href=\"/users/{$user->id}\">{$user->name} {$user->surname}</a></B><br><br>";
	        } ?>
	      </div>
    </div>
  </div>
</div>