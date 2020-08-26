<?php foreach($data['comments'] as $comment) : ?>
  <div class="channel-comment mt-4 d-flex">
    <div>
      <img class="" src="<?php echo URLROOT . '/' . $comment['channel_img']; ?>" alt="">
    </div>
    <div class="mx-3 channel-comment-body">

      <div class="comment-channel-name d-flex">
        <b class="text-primary mr-3"><a class="text-primary" href="<?php echo URLROOT . '/videos/index/' . $comment['com_channel_id']; ?>"><?php echo $comment['channel_name']; ?></a></b>
        <?php if(isLoggedIn() && $_SESSION['channel_id'] == $comment['com_channel_id']) : ?>
          <form action="<?php echo URLROOT;?>/view/del_com" method="post">
            <input type="hidden" name="com_vid_id" value="<?php echo $comment['com_vid_id']; ?>">
            <input type="hidden" name="com_id" value="<?php echo $comment['com_id']; ?>">
            <button class="bg-transparent text-info com-open-edit" data-index="<?php echo $comment['com_id']; ?>" type="button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
            <button class="bg-transparent text-danger com-delete" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
          </form>
        <?php endif; ?>
      </div>
        
      <?php if (isLoggedIn() && $_SESSION['channel_id'] == $comment['com_channel_id']) : ?>
        <div class="com-edit-form d-none" data-index="<?php echo $comment['com_id']; ?>">
          <form action="<?php echo URLROOT . '/view/edit_com/' . $comment['com_vid_id'];?>" method="post">
            <input type="hidden" name="com_id" value="<?php echo $comment['com_id'];?>">
            <textarea class="com-edit" name="com_edit"><?php echo $comment['com_content']; ?></textarea>
            <div class="comment-btns mt-2 d-flex justify-content-end">
              <button class="com-edit-cancel btn btn-danger mr-3" type="button" data-index="<?php echo $comment['com_id']; ?>">Cancel</button>
              <button class="com-edit-submit btn btn-info" type="submit">Edit</button>
            </div>
          </form>
        </div>
      <?php endif; ?>

      <p class="comments-cont mt-1" data-index="<?php echo $comment['com_id']; ?>">
      <?php echo $comment['com_content']; ?>
      </p>

    </div>
  </div>
<?php endforeach?>