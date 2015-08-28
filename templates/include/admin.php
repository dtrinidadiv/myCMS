  <p style="text-align: right">You are logged in as <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>. 
  	<a class="btn-xs btn-danger xs" href="admin.php?action=logout"?>Log out</a></p>
        <h1 class="page-header"><i style="color: #051938" class="glyphicon glyphicon-tower"></i> Admin Dashboard</h2>
        <hr>
<div align ="right">
    <a class ="btn btn-default" href="admin.php?action=listArticles"><span class="glyphicon glyphicon-pencil"></span>Edit Articles</a> 
    <a class = "btn btn-default" href="admin.php?action=listCategories"><span class="glyphicon glyphicon-list"></span>Edit Categories</a> 
 </div>