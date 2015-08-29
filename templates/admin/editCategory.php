<?php include "templates/include/header.php" ?>
<?php include "templates/include/admin.php" ?>
 
      <h1><?php echo $results['pageTitle']?></h1>
 
      <form action="admin.php?action=<?php echo $results['formAction']?>" method="post">
        <input type="hidden" name="categoryId" value="<?php echo $results['category']->id ?>"/>
 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>

          <div class="form-group">
             <div class="row">
                <div class="col-xs-6 selectContainer">
                <label class="control-label">Category Name</label>
                <input style="width = 70%" class="form-control" type="text" name="name" id="name" placeholder="Name of the category" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['category']->name )?>" />
              </div>
             </div>
            </div>

            <div class="form-group">
             <div class="row">
                <div class="col-xs-6 selectContainer">
                <label class="control-label">Description</label>
                <input class="form-control" type="text" name="description" id="description" placeholder="Descripton of the category" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['category']->description )?>" />
              </div>
             </div>
            </div>
 
         <div class="col-xs-6 selectContainer" align = "right" class="buttons" >
          <input class="btn btn-primary" type="submit" name="saveChanges" value="Save Changes" />
          <input class="btn btn-danger" type="submit" formnovalidate name="cancel" value="Cancel" />
        </div>
 
      </form>
 
 
 
<?php include "templates/include/footer.php" ?>