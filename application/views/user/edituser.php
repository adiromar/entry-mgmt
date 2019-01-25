<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-eye"></i> <?= $title ?></h1>
      <!-- <p>Set your Form name and Fields:</p> -->
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="fa fa-home fa-lg"></i></a></li>
      <li class="breadcrumb-item"><a href="#"><?= $title ?></a></li>
    </ul>
  </div>
<?php 
foreach ($get_user as $key) {
 // print_r($key);die();


?>
 <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body" style="padding: 10px 75px;">
         <form action="edituser" method="post">
  <div class="form-group row">
    <input type="hidden" name="user_id" value="<?= $key['user_id'] ?>">
    <label for="inputEmail3" class="col-sm-2 col-form-label">First Name :</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="firstname" id="inputEmail3" value="<?= $key['firstname'] ?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Last Name :</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="lastname" id="inputEmail3" value="<?= $key['lastname'] ?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Username :</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="username" value="<?= $key['user_name'] ?>" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Password :</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" placeholder="New Password" name="password" required>
    </div>
  </div>

  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Email :</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="emailpattern" name="email" value="<?= $key['email'] ?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Location :</label>
    <div class="col-md-4">
      <select class="form-control" name="location">
        <option><?= $key['location']; ?></option>
        <?php
          foreach ($location as $loc) {
            echo '<option>'.$loc['location'].'</option>';
          }
        ?>
      </select>
    </div>
  </div>

  <fieldset class="form-group">
    <div class="row">
      <legend class="col-form-label col-sm-2 pt-0">User Type :</legend>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="user_type" id="gridRadios2" value="User" <?php if($key['user_type'] == 'User'){
            echo ' checked ';}?>>
          <label class="form-check-label" for="gridRadios2">User</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="user_type" id="gridRadios1" value="Branch" <?php if($key['user_type'] == 'Branch'){
            echo ' checked '; } ?>>
          <label class="form-check-label" for="gridRadios1">
            Branch
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="user_type" id="gridRadios1" value="Admin" <?php if($key['user_type'] == 'Admin'){
            echo ' checked ';}?>>
          <label class="form-check-label" for="gridRadios1">
            Admin
          </label>
        </div>
        
      </div>
    </div>
  </fieldset>
  <div class="form-group row">
    <div class="col-sm-2">Status :</div>
    <div class="col-sm-10">
      <div class="form-check">
        <select class="form-control" name="status" value="<?= $key['status'] ?>">
          <option><?= $key['status'] ?></option>
          <option>Pending</option>
          <option>DeActive</option>
          <option>Active</option>
        </select>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" name="user_edit" class="btn btn-primary">Update</button>
    </div>
  </div>
</form>
        </div>
      </div>
    </div>


  </div>
  <?php } ?>
</main>