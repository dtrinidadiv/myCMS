<?php include "templates/include/header.php" ?>
<div class = "container">
	<div class = "container">
      <h1 class="page-header" style="width: 75%;"><?php echo htmlspecialchars( $results['article']->title )?></h1>
      <p><span class="glyphicon glyphicon-time"></span>Published on <?php echo date('j F Y', $results['article']->publicationDate)?>
	      <?php if ( $results['category'] ) { ?>
			        in <a href="./?action=archive&amp;categoryId=<?php echo $results['category']->id?>"><?php echo htmlspecialchars( $results['category']->name ) ?></a>
		  <?php } ?>
		</p>
      <hr>
      <div style="width: 75%;"><?php echo $results['article']->content?></div><br><hr>      
      <p><a class="btn btn-default" href="./"><span class="glyphicon glyphicon-home"></span> Return to Homepage</a></p>
      </div>
</div>
<?php include "templates/include/footer.php" ?>

