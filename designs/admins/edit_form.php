<?php
include "functions/connect.php";
$id = $_GET['id'];
$select= "SELECT * FROM admins WHERE id= $id";
$query= $conn->query($select);
$admin= $query->fetch_assoc();
?>

<form method= "post" action='functions/admins/update.php?<?="id=$id"?>'>
  <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" name="username" value="<?= $admin['username']?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted"></small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" value="<?= $admin['password']?>" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" value="<?= $admin['email']?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Address</label>
    <input type="text" name="address" value="<?= $admin['address']?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted"></small>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="0" <?php if($admin['gender']==0){echo "checked";} ?>>
  <label class="form-check-label" for="exampleRadios1">
    Male
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="gender" id="exampleRadios2" value="1"<?php if($admin['gender']==1){echo "checked";} ?>>
  <label class="form-check-label" for="exampleRadios2">
    Female
  </label>
</div>

  <div class="form-group">
    <label for="exampleFormControlSelect1">Privligies</label>
    <select class="form-control" name="privligies"  id="exampleFormControlSelect1">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
