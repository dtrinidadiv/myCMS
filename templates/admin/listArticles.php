<?php include "templates/include/header.php" ?>
<?php include "templates/include/admin.php" ?>

     
    
 <h1>All Articles</h1>
 <?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="alert alert-danger">
                      <i class="glyphicon glyphicon-remove-sign"></i> &nbsp;<?php echo $results['errorMessage'] ?>
                 </div>
<?php } ?>
<?php if ( isset( $results['statusMessage'] ) ) { ?>
        <div class="alert alert-info">
                      <i class="glyphicon glyphicon-thumbs-up"></i> &nbsp;<?php echo $results['statusMessage'] ?>
                 </div>
<?php } ?>
 <table id="mytable" class="table table-bordred table-striped">
                   
           <thead>
             <th>Publication Date</th>
             <th>Article</th>
             <th>Action</th>
           </thead>
           <tbody>
    <?php foreach ( $results['articles'] as $article ) { ?>
          <tr>
    
        <td><?php echo date('j M Y', $article->publicationDate)?></td>
        <td><?php echo $article->title?></td>
        <td>
        <a class="btn btn-primary btn-xs" href="admin.php?action=editArticle&amp;articleId=<?php echo $article->id?>"><span class="glyphicon glyphicon-pencil"></span></a>
        <a class="btn btn-danger btn-xs" href="admin.php?action=deleteArticle&amp;articleId=<?php echo $article->id?>"><span class="glyphicon glyphicon-trash"></span></a>
      
    
        </tr>
    
  </tbody>
    <?php } ?>
     <p style="text-align: right">
        <span class="glyphicon glyphicon-list"></span>
                      <?php echo $results['totalRows']?> article<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.
                 </p>

</table>

 <a class="btn btn-default" href="admin.php?action=newArticle"><span class="glyphicon glyphicon-plus"></span> New Article </a>


   



<?php include "templates/include/footer.php" ?>

