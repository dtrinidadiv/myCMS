<?php include "templates/include/header.php" ?>


<!-- Blog Entries Column -->
            <div class="col-md-8">
              <h1 class="page-header">
                 Article Archives
                    <small> |<?php echo htmlspecialchars( $results['pageHeading'] ) ?></small>
                </h1>
                 <p style="text-align: right">
                  <span class="glyphicon glyphicon-list"></span>
                      <?php echo $results['totalRows']?> article<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.
                 </p>

                 
<?php if ( $results['category'] ) { ?>
      <h3 class="categoryDescription"><?php echo htmlspecialchars( $results['category']->description ) ?></h3>
<?php } ?>

                
           <?php foreach ( $results['articles'] as $article ) { ?>
          <div class="thumbnail">
            <!--<img src="http://placehold.it/740x320/eee/0099CC">-->
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
        
          
              <br>
                

      <p> <a class="btn btn-default" href="./"> <span class="glyphicon glyphicon-home"></span> Return to Homepage</a></p>
 
            </div>
          

 
      
 
<?php include "templates/include/footer.php" ?>