

<?php
if (isset($_GET['okmsg'])) {
    ?>
    <div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h1>Success! </h1> <h6><?php echo base64_decode($_GET['okmsg']);?></h6>
</div>
<?php
}

else if (isset($_GET['errormsg'])) {
    ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong><h1>Error!</h1>  </strong><h5><?php echo base64_decode($_GET['errormsg']);?></h5>
</div>
<?php
}


?>