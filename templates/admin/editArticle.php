<?php include "templates/include/header.php" ?>
<?php include "templates/include/admin.php" ?>
<?php include "templates/admin/include/header.php" ?>

      <h1><?php echo $results['pageTitle']?></h1>
      <hr>
      <form action="admin.php?action=<?php echo $results['formAction']?>" method="post">


        <input type="hidden" name="articleId" value="<?php echo $results['article']->id ?>"/>

        <?php if ( isset( $results['errorMessage'] ) ) { ?>
                <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
        <?php } ?>


      <div class="form-group">
        <div class="row">
            <div class="col-xs-6">
                <label class="control-label">Article title</label>
                <input class="form-control" type="text" name="title" id="title" placeholder="Name of the article" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['article']->title )?>" />
            </div>

            <div class="col-xs-3 selectContainer">
                 <label class="control-label">Publication Date</label>
                    <div class='input-group date'>
                      <input  class ="form-control" type="date" name="publicationDate" id="publicationDate" placeholder="YYYY-MM-DD" required maxlength="10" value="<?php echo $results['article']->publicationDate ? date( "Y-m-d", $results['article']->publicationDate ) : "" ?>" />
                <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                  </div>
                    
            </div>

        </div>
   </div>
            <div class="form-group">
             <div class="row">
                <div class="col-xs-9 selectContainer">
                <label class="control-label">Article Summary</label>
                
                <textarea class="form-control" name="summary" id="summary" placeholder="Brief description of the article" required maxlength="1000" style="height: 5em;"><?php echo htmlspecialchars( $results['article']->summary )?></textarea>
             </div>
             </div>
            </div>

          <div class="form-group">
             <div class="row">
                <div class="col-xs-9 selectContainer">
                <label class="control-label">Article Category</label>
                <select class="form-control" name="categoryId">
              <option value="0"<?php echo !$results['article']->categoryId ? " selected" : ""?>>(none)</option>
            <?php foreach ( $results['categories'] as $category ) { ?>
              <option value="<?php echo $category->id?>"<?php echo ( $category->id == $results['article']->categoryId ) ? " selected" : ""?>><?php echo htmlspecialchars( $category->name )?></option>
            <?php } ?>
            </select>

              </div>
             </div>
            </div>


        <div class="form-group">
             <div class="row">
                <div class="col-xs-9 selectContainer">
                <label class="control-label">Article Content</label>
                
                <textarea class ="form-control ckeditor" name="editor1" id="content" placeholder="The HTML content of the article" required maxlength="100000" style="height: 30em;"><?php echo htmlspecialchars( $results['article']->content )?></textarea>
             </div>
             </div>
            </div>

             
           
        <div class="col-xs-9 selectContainer" align = "right" class="buttons" >
          <input  class ="btn btn-primary" type="submit" name="saveChanges" value="Save Changes" />
          <input class ="btn btn-danger" type="submit" formnovalidate name="cancel" value="Cancel" />
        </div>

      </form>

<?php include "templates/include/footer.php" ?>

