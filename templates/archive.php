<?php include "templates/include/header.php" ?>


<!-- Blog Entries Column -->
            <div class="col-md-8">
              <h1 class="page-header">
                 Article
                    <small> | Archive</small>
                </h1>
                 <p style="text-align: right">
                  <span class="glyphicon glyphicon-list"></span>
                      <?php echo $results['totalRows']?> article<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.
                 </p>

                 <h1><?php echo htmlspecialchars( $results['pageHeading'] ) ?></h1>
<?php if ( $results['category'] ) { ?>
      <h3 class="categoryDescription"><?php echo htmlspecialchars( $results['category']->description ) ?></h3>
<?php } ?>

                <?php foreach ( $results['articles'] as $article ) { ?>
                   <h2>
                        <a href=".?action=viewArticle&amp;articleId=<?php echo $article->id?>"><?php echo htmlspecialchars( $article->title )?></a>
                  </h2>
                     <p><span class="glyphicon glyphicon-time"></span><?php echo date('j F Y', $article->publicationDate)?></p>
                   <p class="summary"><?php echo htmlspecialchars( $article->summary )?></p>
                  <hr>

                <?php } ?>
          
              <br>
                

            </div>
          

 
      
 
      <p> <a class="btn btn-default" href="./"> <span class="glyphicon glyphicon-home"></span> Return to Homepage</a></p>
 
<?php include "templates/include/footer.php" ?>