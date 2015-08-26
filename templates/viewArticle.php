<?php include "templates/include/header.php" ?>

      <h1 style="width: 75%;"><?php echo htmlspecialchars( $results['article']->title )?></h1>
      <p><span class="glyphicon glyphicon-time"></span>Published on <?php echo date('j F Y', $results['article']->publicationDate)?></p>
      <hr>
      <div style="width: 75%;"><?php echo $results['article']->content?></div>
      
      <p><a class="btn btn-default" href="./"><span class="glyphicon glyphicon-home"></span> Return to Homepage</a></p>

<?php include "templates/include/footer.php" ?>

