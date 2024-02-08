<a type="button" class="btn btn-primary" href="?action=add">Add Admin</a>
<br>
<br>

<table>

<table class="table table-striped table-gray">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Address</th>
      <th scope="col">Gender</th>
      <th scope="col">Privligies</th>
      <th scope="col">Control</th>
      
    </tr>
  </thead>
  <tbody>
    <?php
     include "functions/connect.php";
     $select= "SELECT * FROM admins";
     $query= $conn->query($select);
     foreach($query as $admin){
    ?>
       
    <tr>
      <th scope="row"><?= $admin['id']?></th>
      <th ><?= $admin['username']?></th>
      <th ><?= $admin['email']?></th>
      <th ><?= $admin['address']?></th>
      <th >
        <?php if($admin['gender']==0){echo "Male";}else{echo "Female";}?>
      </th>
      <th ><?php
             $privligies= $admin['privligies'];
             $selectPriv= "SELECT title FROM privligies WHERE id='$privligies'";
             $queryPriv= $conn->query($selectPriv);
             if($queryPriv){
              $result= $queryPriv->fetch_assoc();
              $title= $result['title'];
              echo "$title";
             }else{
              echo $conn->error;
             }
             
             
             ?>
      </th>
      <th>
      <a type="button" class="btn btn-primary" href="?action=edit&id=<?= $admin['id']?>">Edit</a>
     <!-- Button trigger modal -->
<button type="button" class="btn btn-danger delete-btn" data-name= "<?= $admin['username']?>"  data-id ="<?= $admin['id']?>" data-toggle="modal" data-target="#e<?= $admin['id']?>">
  Delete
</button>

<!-- Modal -->
<div class="modal fade" id="e<?= $admin['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete <span class="text-danger span-delete" style="font-weight:bold;"><?= $admin['username']?></spane>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        <a type="button" class="btn btn-danger" href="functions/admins/delete.php?id=<?= $admin['id']?>">Confirm</a>
      </div>
    </div>
  </div>
</div>
      </th>
    </tr>
    <?php } ?>
  
  </tbody>
</table>

