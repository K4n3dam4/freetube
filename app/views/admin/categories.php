<?php 
require APPROOT . '/views/includes/admin_header.php';
?>

  <!-- MAIN -->
  <div class="page-wrapper">

    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="row">
        
        <div class="col-lg-12 mb-3">
          <h1 class="page-header">
            <small>Manage</small>
            Categories
          </h1>
        </div>

        <div class="col-md-6">
          <!-- ADD CATEGORY -->
          <?php flash('new_cat_success')?>
          <?php flash('new_cat_error')?>
          <form action="<?php echo URLROOT;?>/admin/add_cat" method="post">
            <div class="form-group">
              <label for="add-category">New category</label>
              <input type="text" name="new" class="form-control <?php if(!empty($data['new_cat_error']) ? 'is-invalid' : '');?>" id="add-category">
              <span class="invalid-feedback"><?php echo $data['new_cat_error'];?></span>
              <button type="submit" class="btn-success btn mt-2 w-25">Add</button>
            </div>
          </form>
        </div>

        <!-- CATEGORY TABLE -->
        <div class="col-md-6">
          <?php flash('edit_cat_success')?>
          <?php flash('edit_cat_error')?>
          <?php flash('edit_empty_error')?>
          <form id="cat-form" action="<?php echo URLROOT; ?>/admin/del_cat" method="post">
            <table id="video-table" class="table-striped table-bordered table-hover text-dark text-center" cellspacing="0" width="100%">
              <thead class="">
                <tr>
                  <th>#</th>
                  <th>Category</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['categories'] as $key => $cat) : ?>
                <tr>
                  <td><?php echo $cat['cat_id'];?></td>
                  <td class="d-flex align-items-center justify-content-center">
                    <textarea class="edit-cat-title d-none text-center text-info" data-index="<?php echo $cat['cat_id']; ?>" ><?php echo $cat['cat_title'];?></textarea>
                    <div class="cat-title" data-index="<?php echo $cat['cat_id']; ?>">
                      <?php echo $cat['cat_title'];?>
                    </div>
                  </td>
                  <td class="text-center">
                    <button id="open-cat-edit" type="button" onclick="openCatEdit(this)" class="open-cat-edit bg-transparent border-0 text-info" data-index="<?php echo $cat['cat_id']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                    <button class="submit-edit bg-transparent border-0 text-success d-none" value="<?php echo $cat['cat_id']; ?>" data-index="<?php echo $cat['cat_id']; ?>"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                  </td>
                  <td class="text-center">
                    <!-- <input class="del-cat-input" type="hidden" name="del-cat"> -->
                    <button type="submit" class="del-cat-btn bg-transparent border-0 text-danger" name="del-cat" value="<?php echo $cat['cat_id']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </form>
        </div>


      </div>
      <!-- /.row -->
    </div>

  </div>

<?php
require APPROOT . '/views/includes/admin_footer.php';
?>