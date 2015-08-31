<?php include "templates/include/header.php" ?>
 <div class="wrapper" >
<center><br><br>
<div class="tabbable" >
  <ul class="nav nav-tabs" >
    <li class="active"><a href="#pane1" data-toggle="tab">Sign Up</a></li>
    <li><a href="#pane2" data-toggle="tab">Login</a></li>
  </ul>

  <div class="tab-content">
    <div id="pane1" class="tab-pane active">
     
                            <form class = "form-signin" action="?action=user-signup" method="post" >
                            <center><h3  class="form-signin-heading page-header">Sign Up</h3></center>
                            <hr>
                              <input type="hidden" name="user-signup" value="true" />

                      <?php if ( isset( $results['errorMessage'] ) ) { ?>

                                <div class="alert alert-danger">
                                            <i class="glyphicon glyphicon-remove-sign"></i> &nbsp;<?php echo $results['errorMessage'] ?>
                                       </div>

                      <?php } ?>

                        <?php if ( isset( $results['statusMessage'] ) ) { ?>

                                <div class="alert alert-info">
                                            <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo $results['statusMessage'] ?>
                                       </div>

                      <?php } ?>
                            <div style="padding-bottom:5px">

                                   <input class="form-control" type="email" name="email" id="email" placeholder="email" required autofocus maxlength="20" />
                             </div> 
                             <div style="padding-bottom:5px">
                                  <input class="form-control" type="text" name="uname" id="uname" placeholder="username" required autofocus maxlength="20" />
                               </div> 

                              <div style="padding-bottom:5px">
                                  <input class="form-control"  type="password" name="password" id="password" placeholder="password" required maxlength="20" />
                            </div> 
                           <hr>


                              <div class="buttons">
                                <input class="btn btn-lg btn-danger btn-block" type="submit" name="user-signup" value="Sign Up" />
                              </div> 

                            </form>
    </div>

    <div id="pane2" class="tab-pane">
   
      <form class = "form-signin" action="?action=user-login" method="post" ">
      <center><h3 class="form-signin-heading page-header">Login</h3></center>
      <hr>
        <input type="hidden" name="user-login" value="true" />

<?php if ( isset( $results['errorMessage'] ) ) { ?>

          <div class="alert alert-danger">
                      <i class="glyphicon glyphicon-remove-sign"></i> &nbsp;<?php echo $results['errorMessage'] ?>
                 </div>

<?php } ?>

       
            <input class="form-control" type="text" name="username" id="username" placeholder="username" required autofocus maxlength="20" />
        
        
            <input class="form-control"  type="password" name="password" id="password" placeholder="password" required maxlength="20" />
     <hr>


        <div class="buttons">
          <input class="btn btn-lg btn-primary btn-block" type="submit" name="user-login" value="Login" />
        </div> 

      </form>
    </div>
  </div><!-- /.tab-content -->
</div><!-- /.tabbable -->

</div>
<?php include "templates/include/footer.php" ?>