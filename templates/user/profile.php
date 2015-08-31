<?php include "templates/include/header.php" ?>


            <div class="col-md-8">

            <h1 class="page-header logo">
            <img class="profile-img" src="http://www.gravatar.com/avatar/">

                 <?php echo $_SESSION['user-username'] . "'s";?>

                    <small>profile</small>
            </h1>
            <div align="right">
            <p> <span class="glyphicon glyphicon-envelope"></span> <?php echo  $_SESSION['user-email'];?> </p>
</div>      </div>
<?php include "templates/include/footer.php" ?>