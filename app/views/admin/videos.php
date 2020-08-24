<?php 
require APPROOT . '/views/includes/admin_header.php';
?>  

  <!-- MAIN -->
  <div class="page-wrapper">

    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="row">
        
        <div class="col-lg-12 mb-3">
          <h1 class="page-header pb-4">
            <small>Manage</small>
            Videos
          </h1>
          <div class="col-lg-6 col-md-12">
            <?php flash('video_updated');?>
            <?php flash('video_updtade_error');?>
            <?php flash('video_update_error');?>
            <?php flash('video_deleted');?>
          </div>

          <form action="<?php echo URLROOT;?>/admin/edit_video" method="post" enctype="multipart/form-data">
            <table id="video-table" class="table-light table-bordered table-responsive table-hover table-md text-dark" cellspacing="0" width="100%">
              <thead class="">
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Category</th>
                  <th>Tags</th>
                  <th>Video</th>
                  <th>Channel</th>
                  <th>Comments</th>
                  <th>Likes</th>
                  <th>Date</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['videos'] as $key => $video) : ?>
                <tr>
                  <td><?php echo $video['vid_id'];?></td>
                  <td>
                    <textarea class="edit-video d-none text-info w-100" data-index="<?php echo $video['vid_id']; ?>"><?php echo $video['vid_title'];?> </textarea>
                    <div class="video-table-content" data-index="<?php echo $video['vid_id']; ?>">
                      <?php echo $video['vid_title'];?>
                    </div>
                  </td>
                  <td>
                    <select class="edit-video custom-select-sm d-none text-info border-0" data-index="<?php echo $video['vid_id']; ?>">
                      <?php foreach($data['categories'] as $key => $cat) : ?>
                        <option value="<?php echo $cat['cat_id']; ?>"><?php echo $cat['cat_title']; ?></option>
                      <?php endforeach;?> 
                    </select>
                    <!-- <textarea class="edit-video d-none text-info w-100" data-index="<?php echo $video['vid_id']; ?>"><?php echo $video['cat_title'];?> </textarea> -->
                    <div class="video-table-content" data-index="<?php echo $video['vid_id']; ?>">
                      <?php echo $video['cat_title'];?>
                    </div> 
                  </td>
                  <td>
                    <textarea class="edit-video d-none text-info w-100" data-index="<?php echo $video['vid_id']; ?>"><?php echo $video['vid_tags'];?> </textarea>
                    <div class="video-table-content" data-index="<?php echo $video['vid_id']; ?>">
                      <?php echo $video['vid_tags'];?>
                    </div> 
                  </td>
                  <td>
                    <div class="edit-video custom-file d-none" data-index="<?php echo $video['vid_id']; ?>">
                      <input type="file" class="custom-file-input" id="inputGroupFile02">
                      <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon01"></label>
                    </div>
                    <div class="video-table-content" data-index="<?php echo $video['vid_id']; ?>">
                      <video muted src="<?php echo URLROOT; ?>/<?php echo $video['vid_url']; ?>"></video>
                    </div>
                  </td>
                  <td>
                    <?php echo $video['channel_name'];?></td>
                  <td>
                    <textarea class="edit-video d-none text-info w-100" data-index="<?php echo $video['vid_id']; ?>"><?php echo $video['vid_com_count'];?> </textarea>
                    <div class="video-table-content" data-index="<?php echo $video['vid_id']; ?>">
                      <?php echo $video['vid_com_count'];?>
                    </div>
                  </td>
                  <td>
                    <textarea class="edit-video d-none text-info w-100" data-index="<?php echo $video['vid_id']; ?>"><?php echo $video['vid_like_count'];?> </textarea>
                    <div class="video-table-content" data-index="<?php echo $video['vid_id']; ?>">
                      <?php echo $video['vid_like_count'];?>
                    </div>
                  </td>
                  <td><?php echo $video['vid_date'];?></td>
                  <td class="text-center">
                    <button type="button" onclick="openVideoEdit(this)" class="open-video-edit bg-transparent border-0 text-info" data-index="<?php echo $video['vid_id']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                    <button class="submit-edit bg-transparent border-0 text-success d-none" value="<?php echo $video['vid_id']; ?>" data-index="<?php echo $video['vid_id']; ?>"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                  </td>
                  <td class="text-center">
                    <a class="bg-transparent border-0 text-danger" href="<?php echo URLROOT;?>/admin/del_vid/<?php echo $video['vid_id']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
              <tfoot class="">
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Category</th>
                  <th>Tags</th>
                  <th>Video</th>
                  <th>Channel</th>
                  <th>Comments</th>
                  <th>Likes</th>
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

  <script src="<?php echo URLROOT; ?>/js/file_upload.js"></script>
  <script>
    $(document).ready( function () {
      $('#video-table').DataTable();
    });
  </script>

<?php
require APPROOT . '/views/includes/admin_footer.php';
?>