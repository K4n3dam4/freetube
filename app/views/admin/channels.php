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

        <div class="col-lg-6 col-md-12">
          <?php flash('channel_updated');?>
          <?php flash('channel_updtade_error');?>
          <?php flash('img_update_error');?>
          <?php flash('channel_deleted');?>
        </div>

        <form action="<?php echo URLROOT;?>/admin/edit_channel" method="post" enctype="multipart/form-data">
          <table id="channel-table" class="table-md table-light table-bordered table-responsive table-hover text-dark" cellspacing="0" width="100%">
            <thead class="">
              <tr>
                <th>#</th>
                <th>Admin</th>
                <th>Channel</th>
                <th>Profile Picture</th>
                <th>Owner</th>
                <th>Email</th>
                <th>Registration Date</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($data['channels'] as $key => $channel) : ?>
              <tr>
                <td><?php echo $channel['channel_id'];?></td>
                <td>
                  <select class="edit-channel custom-select-sm d-none text-info" data-index="<?php echo $channel['channel_id']; ?>">
                    <option value="false">User</option>
                    <option value="true">Admin</option>
                  </select>
                  <div class="channel-table-content" data-index="<?php echo $channel['channel_id']; ?>">
                    <?php echo $channel['channel_is_admin'];?>
                  </div>
                </td>
                <td>
                  <textarea class="edit-channel d-none text-info w-100" data-index="<?php echo $channel['channel_id']; ?>"><?php echo $channel['channel_name'];?> </textarea>
                  <div class="channel-table-content" data-index="<?php echo $channel['channel_id']; ?>">
                    <?php echo $channel['channel_name'];?>
                  </div>
                </td>
                <td>
                  <div class="edit-channel custom-file d-none" data-index="<?php echo $channel['channel_id']; ?>">
                    <input type="file" class="custom-file-input" id="inputGroupFile02">
                    <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon01"></label>
                  </div>
                  <div class="channel-table-content justify-content-center" data-index="<?php echo $channel['channel_id']; ?>">
                    <div class="d-flex justify-content-center">
                      <img src="<?php echo URLROOT;?>/<?php echo $channel['channel_img'];?>" alt="" srcset="">
                    </div>  
                  </div>
                </td>
                <td>
                  <textarea class="edit-channel d-none text-info w-100" data-index="<?php echo $channel['channel_id']; ?>"><?php echo $channel['channel_owner'];?> </textarea>
                  <div class="channel-table-content" data-index="<?php echo $channel['channel_id']; ?>">
                    <?php echo $channel['channel_owner'];?>
                  </div>
                </td>
                <td>
                  <textarea class="edit-channel d-none text-info w-100" data-index="<?php echo $channel['channel_id']; ?>"><?php echo $channel['channel_email'];?> </textarea>
                  <div class="channel-table-content" data-index="<?php echo $channel['channel_id']; ?>">
                    <?php echo $channel['channel_email'];?>
                  </div>
                </td>
                <td>
                  <?php echo $channel['channel_reg_date'];?>
                </td>
                <td class="text-center">
                  <button type="button" onclick="openChannelEdit(this)" class="open-channel-edit bg-transparent border-0 text-info" data-index="<?php echo $channel['channel_id']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                  <button class="submit-edit bg-transparent border-0 text-success d-none" value="<?php echo $channel['channel_id']; ?>" data-index="<?php echo $channel['channel_id']; ?>"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                </td>
                <td class="text-center">
                  <a class="bg-transparent border-0 text-danger" href="<?php echo URLROOT;?>/admin/del_channel/<?php echo $channel['channel_id']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot class="">
              <tr>
                <th>#</th>
                <th>Admin</th>
                <th>Channel</th>
                <th>Profile Picture</th>
                <th>Owner</th>
                <th>Email</th>
                <th>Registration Date</th>
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
    $('#channel-table').DataTable();
  });
</script>

<?php
require APPROOT . '/views/includes/admin_footer.php';
?>