<?php 
require APPROOT . '/views/includes/admin_header.php';
?>  


<!-- MAIN -->
<div class="page-wrapper">

  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row channel-table-row">
      
      <div class="col-lg-12 mb-3">
        <h1 class="page-header pb-4">
          <small>Manage</small>
          Channels
        </h1>

        <div class="col-lg-6 col-md-12 pl-0">
          <?php flash('com-content-success');?>
          <?php flash('com-content-error0');?>
          <?php flash('com-content-error1');?>
          <?php flash('com-deleted');?>
        </div>

        <form action="<?php echo URLROOT;?>/admin/edit_comment" method="post" enctype="multipart/form-data">
          <table id="comment-table" class="table-md table-light table-bordered table-responsive table-hover text-dark" cellspacing="0" width="100%">
            <thead class="">
              <tr>
                <th>#</th>
                <th>Video</th>
                <th>Channel</th>
                <th>Comment</th>
                <th>Date</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($data['comments'] as $key => $comment) : ?>
              <tr>
                <td><?php echo $comment['com_id'];?></td>
                <td>
                  <?php echo $comment['vid_title']; ?>
                </td>
                <td>
                  <?php echo $comment['channel_name'];?>
                </td>
                <td>
                  <textarea class="edit-comment d-none text-info" data-index="<?php echo $comment['com_id']; ?>"><?php echo $comment['com_content'];?></textarea>
                  <div class="comment-table-content justify-content-center" data-index="<?php echo $comment['com_id']; ?>">
                    <?php echo $comment['com_content']; ?>
                  </div>
                </td>
                <td>
                  <?php echo $comment['com_date'];?>
                </td>
                <td class="text-center">
                  <button type="button" onclick="openCommentEdit(this)" class="open-comment-edit bg-transparent border-0 text-info" data-index="<?php echo $comment['com_id']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                  <button class="submit-edit bg-transparent border-0 text-success d-none" value="<?php echo $comment['com_id']; ?>" data-index="<?php echo $comment['com_id']; ?>"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                </td>
                <td class="text-center">
                  <a class="bg-transparent border-0 text-danger" href="<?php echo URLROOT;?>/admin/del_comment/<?php echo $comment['com_id']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot class="">
              <tr>
                <th>#</th>
                <th>Video</th>
                <th>Channel</th>
                <th>Comment</th>
                <th>Date</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </tfoot>
          </table>
        </form>

      </div>


    </div>
    <!-- /.row -->
  </div>

</div>


<script>
  $(document).ready( function () {
    $('#comment-table').DataTable();
  });
</script>

<?php
require APPROOT . '/views/includes/admin_footer.php';
?>