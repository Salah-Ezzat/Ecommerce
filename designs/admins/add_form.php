<?php
function Fill($input){
  if(isset($_SESSION[$input]) ){
    $Fill = $_SESSION[$input];
  }else{
    $Fill='';}; echo "$Fill";};

?>



<form method= "post" action='functions/admins/insert.php?'>
  <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" name="username" value="<?php Fill('username1');?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-danger"> <?php Fill('username'); ?></small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" value="<?php Fill('password1');?>" class="form-control" id="exampleInputPassword1">
    <small id="emailHelp" class="form-text text-danger"> <?php Fill('password'); ?></small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" value="<?php Fill('email1')?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-danger"> <?php Fill('email'); ?></small>
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Address</label>
    <input type="text" name="address" value="<?php Fill('address1')?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-danger"><?php Fill('address'); ?></small>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="0" checked>
  <label class="form-check-label" for="exampleRadios1">
    Male
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="gender" id="exampleRadios2" value="1">
  <label class="form-check-label" for="exampleRadios2">
    Female
  </label>
</div>

  <div class="form-group">
    <label for="exampleFormControlSelect1">Privligies</label>
    <select class="form-control" name="privligies"  id="exampleFormControlSelect1">
    <?php
     include_once "functions/connect.php";
     $select= "SELECT * FROM privligies";
     $query= $conn->query($select);
     if($query){
      foreach($query as $result){
        $value= $result['id'];
        $title= $result['title'];
        echo "<option value='$value'>$title</option>";
      }
     }else{
      echo $conn->error;
     }
    ?>
    </select>
   
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php session_unset();?>