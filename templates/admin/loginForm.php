<?php include "templates/include/header.php" ?>
 <div class="wrapper" >

      <form class = "form-signin" action="admin.php?action=login" method="post" style="width: 50%;">
      <center><h3  class="form-signin-heading page-header"><i style="color: #0099CC" class="glyphicon glyphicon-cog"></i>  Admin Panel</h3></center>
      <hr>
        <input type="hidden" name="login" value="true" />

<?php if ( isset( $results['errorMessage'] ) ) { ?>

          <div class="alert alert-danger">
                      <i class="glyphicon glyphicon-remove-sign"></i> &nbsp;<?php echo $results['errorMessage'] ?>
                 </div>

<?php } ?>

       
            <input class="form-control" type="text" name="username" id="username" placeholder="username" required autofocus maxlength="20" />
        
        
            <input class="form-control"  type="password" name="password" id="password" placeholder="password" required maxlength="20" />
     <hr>


        <div class="buttons">
          <input class="btn btn-lg btn-primary btn-block" type="submit" name="login" value="Login" />
        </div> 

      </form>
</div>
