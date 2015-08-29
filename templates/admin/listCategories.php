<?php include "templates/include/header.php" ?>
<?php include "templates/include/admin.php" ?>
 
      <h1>Article Categories</h1>
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
             <th>Category Name</th>
             <th>Description</th>
              <th>Actions</th>
           </thead>
           <tbody>
    <?php foreach ( $results['categories'] as $category  ) { ?>
          <tr>
    
        <td><?php echo $category->name?></td>
        <td><?php echo $category->description?></td>
         
        <td>
        <a class="btn btn-primary btn-xs" href="admin.php?action=editCategory&amp;categoryId=<?php echo $category->id?>"><span class="glyphicon glyphicon-pencil"></span></a>
        <a class="btn btn-danger btn-xs" href="admin.php?action=deleteCategory&amp;categoryId=<?php echo $category->id?>"><span class="glyphicon glyphicon-trash"></span></a>
      
    
        </tr>
    
  </tbody>
    <?php } ?>
     <p style="text-align: right">
        <span class="glyphicon glyphicon-list"></span>
                      <?php echo $results['totalRows']?><?php echo ( $results['totalRows'] != 1 ) ? ' categories' : ' category' ?> in total.
                 </p>

</table>

<div align="right">
 <a class="btn btn-default" href="admin.php?action=newCategory"><span class="glyphicon glyphicon-plus"></span> New Category </a>
</div>

 <?php
// paging buttons will be here
         include_once 'pagingCategory.php'; 

?>
<?php include "templates/include/footer.php" ?>