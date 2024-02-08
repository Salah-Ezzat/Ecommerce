<?php
    include "includes/header.php";
    include "includes/sidebar.php";
    include "includes/topbar.php"
 ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Admins</h1>
</div>

<?php
if (isset($_GET['action'])){
if ( $_GET['action']=='add'){
    include "designs/admins/add_form.php";
}elseif($_GET['action']=='edit'){
    include "designs/admins/edit_form.php";
}
}else{
 include "designs/admins/view_form.php";
};
 ?>


              









                    

<?php
include "includes/footbar.php";
?>
<script src=""></script>
<script>
 $(delete-btn).click(function(){
    $.post((.modal fade), {data['id'], data['name']}, function(){
        $('.span-delete').text('data['name']'),

    })
 })


</script>