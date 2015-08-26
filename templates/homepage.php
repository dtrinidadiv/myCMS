<?php include "templates/include/header.php" ?>

    
            <!-- Blog Entries Column -->
            <div class="col-md-8">
            	<h1 class="page-header">
                   Programmers
                    <small> DEN</small>
                </h1>
            	<?php foreach ( $results['articles'] as $article ) { ?>
 					 <h2>
                    	<a href=".?action=viewArticle&amp;articleId=<?php echo $article->id?>"><?php echo htmlspecialchars( $article->title )?></a>
               		 </h2>
               		 <p><span class="glyphicon glyphicon-time"></span><?php echo date('j F Y', $article->publicationDate)?></p>
           			 <p class="summary"><?php echo htmlspecialchars( $article->summary )?></p>
                	 <a class="btn btn-primary" href=".?action=viewArticle&amp;articleId=<?php echo $article->id?>"><span class="glyphicon glyphicon-chevron-right"></span> Read More </a>
                     <hr>
 				<?php } ?>
        

            </div>

          <a class="btn btn-default" href="./?action=archive"><span class="glyphicon glyphicon-folder-close"></span> Article Archive </a>
         


     
   

<?php include "templates/include/footer.php" ?>