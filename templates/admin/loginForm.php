<?php include "templates/include/header.php" ?>
 <div class="wrapper">
      <form class = "form-signin" action="admin.php?action=login" method="post" style="width: 50%;">
        <input type="hidden" name="login" value="true" />

<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>

       
            <input class="form-control" type="text" name="username" id="username" placeholder="Your admin username" required autofocus maxlength="20" />
        
        
            <input class="form-control"  type="password" name="password" id="password" placeholder="Your admin password" required maxlength="20" />
     <hr>


        <div class="buttons">
          <input class="btn btn-lg btn-primary btn-block" type="submit" name="login" value="Login" />
        </div> 

      </form>
</div>
<?php include "templates/include/footer.php" ?>
