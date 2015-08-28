<?php include "templates/include/header.php" ?>


            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <h1 class="page-header logo">
                   Programmers
                    <small> DEN</small>
                </h1>

           <?php foreach ( $results['articles'] as $article ) { ?>
          <div class="thumbnail">
            <img src="http://placehold.it/740x320/eee/0099CC">
              <div class="caption">
              <h2>
                <a href=".?action=viewArticle&amp;articleId=<?php echo $article->id?>"><?php echo htmlspecialchars( $article->title )?></a>
                   </h2>
                   <p><span class="glyphicon glyphicon-time"></span><?php echo date('j F Y', $article->publicationDate)?> 
                   <?php if ( $article->categoryId ) { ?>
            <span class="category">in <a href=".?action=archive&amp;categoryId=<?php echo $article->categoryId?>"><?php echo htmlspecialchars( $results['categories'][$article->categoryId]->name )?></a></span>
            <?php } ?></p>
                    <p class="summary"><?php echo htmlspecialchars( $article->summary )?></p>
                    <div align="right">
                   <a class="btn btn-info btn-s" href=".?action=viewArticle&amp;articleId=<?php echo $article->id?>"><span class="glyphicon glyphicon-chevron-right"></span> Read More </a>
                    </div> 
            </div>
          </div>      


 				<?php } ?>
        

            </div>

          <a class="btn btn-default" href="./?action=archive"><span class="glyphicon glyphicon-folder-close"></span> Article Archive </a>
         


     
   

<?php include "templates/include/footer.php" ?>