<?php include "templates/include/header.php" ?>


            <div class="col-md-8">
            <h1 class="page-header logo">
                 <?php echo $_SESSION['user-username'] . "'s";?>

                    <small>profile</small>
            </h1>
            <p> <span class="glyphicon glyphicon-envelope"></span> <?php echo  $_SESSION['user-email'];?> </p>
</div>  
<?php include "templates/include/footer.php" ?>