<div class="modal fade" id="other_groups" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Other groups</h4>
	    </div>
      	<div class="modal-body">
      		<?php if($other_groups->isEmpty()){echo "There isn't other groups...";}else{ ?>
	        <?php foreach ($other_groups as $other_group){?>

				<?php echo "<img class = 'img-circle' src='<?php echo asset($other_group->image)?>' height='60' width='60'/>&nbsp;<B><a href=\"/groups/index/{$other_group->id}\">{$other_group->name}</a></B><br><br>";?>

			<?php }} ?>
      	</div>
    </div>
  </div>
</div>