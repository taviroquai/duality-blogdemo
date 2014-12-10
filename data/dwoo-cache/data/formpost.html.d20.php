<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ;
// checking for modification in file:data/admin.html
if (!("1418181697" == filemtime('data/admin.html'))) { ob_end_clean(); return false; };
// checking for modification in file:data/template.html
if (!("1418181615" == filemtime('data/template.html'))) { ob_end_clean(); return false; };?><!DOCTYPE html>
<html><head>

<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<title><?php echo $this->scope["title"];?></title>
<meta name="description" content="<?php echo $this->scope["description"];?>">
<meta name="keywords" content="<?php echo $this->scope["keywords"];?>">
<meta name="author" content="<?php echo $this->scope["author"];?>">

<!-- add the bootstrap css framework -->
<link rel="stylesheet" href="<?php echo $this->scope["url"];?>theme/bootstrap/css/bootstrap.min.css" />

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head><body>

<div id="container" class="container">
	<div class="page-header">
        <h1><?php echo $this->scope["heading"];?></h1>
	</div>
    
    <?php echo $this->classCall('include', array('nav.html', null, null, null, '_root', null));?>

    
    <?php echo $this->classCall('include', array('messages.html', null, null, null, '_root', null));?>

    
        
    <?php if ((isset($this->scope["formPost"]) ? $this->scope["formPost"] : null)) {
?>

    <div class="row">
        <div class="col col-sm-12 col-md-12 col-lg-6">
            <h2><?php if ((isset($this->scope["formPost"]["id"]) ? $this->scope["formPost"]["id"]:null)) {
?>Edit<?php 
}
else {
?>Create<?php 
}?> Post</h2>
            <form method="post" action="<?php echo $this->scope["saveUrl"];?>" id="postform">
                
                <input name="id" value="<?php echo $this->scope["formPost"]["id"];?>" type="hidden" />
                
                <div class="form-group <?php if ((isset($this->scope["errors"]["title"]) ? $this->scope["errors"]["title"]:null)) {
?>has-error<?php 
}?>">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" 
                           value="<?php echo $this->scope["formPost"]["title"];?>"
                           placeholder="Insert post title" />
                    <?php if ((isset($this->scope["errors"]["title"]) ? $this->scope["errors"]["title"]:null)) {
?>

                    <span class="help-block"><?php echo $this->scope["errors"]["title"];?></span>
                    <?php 
}?>

                </div>
                <div class="form-group">
                    <label>Author</label>
                    <input type="text" class="form-control" name="author" 
                           value="<?php echo $this->scope["formPost"]["author"];?>"
                           placeholder="Insert post author" />
                </div>
                <div class="form-group <?php if ((isset($this->scope["errors"]["resume"]) ? $this->scope["errors"]["resume"]:null)) {
?>has-error<?php 
}?>">
                    <label>Resume</label>
                    <input type="text" class="form-control" name="resume" 
                           value="<?php echo $this->scope["formPost"]["resume"];?>"
                           placeholder="Insert post resume" />
                    <?php if ((isset($this->scope["errors"]["resume"]) ? $this->scope["errors"]["resume"]:null)) {
?>

                    <span class="help-block"><?php echo $this->scope["errors"]["resume"];?></span>
                    <?php 
}?>

                </div>
                <div class="form-group <?php if ((isset($this->scope["errors"]["keywords"]) ? $this->scope["errors"]["keywords"]:null)) {
?>has-error<?php 
}?>">
                    <label>Keywords</label>
                    <input type="text" class="form-control" name="keywords" 
                           value="<?php echo $this->scope["formPost"]["keywords"];?>"
                           placeholder="Insert post keywords" />
                    <?php if ((isset($this->scope["errors"]["keywords"]) ? $this->scope["errors"]["keywords"]:null)) {
?>

                    <span class="help-block"><?php echo $this->scope["errors"]["keywords"];?></span>
                    <?php 
}?>

                </div>
                <div class="form-group <?php if ((isset($this->scope["errors"]["body"]) ? $this->scope["errors"]["body"]:null)) {
?>has-error<?php 
}?>">
                    <label>Body</label>
                    <textarea class="form-control" rows="5" name="body" 
                        placeholder="Insert post body"><?php echo $this->scope["formPost"]["body"];?></textarea>
                    <?php if ((isset($this->scope["errors"]["body"]) ? $this->scope["errors"]["body"]:null)) {
?>

                    <span class="help-block"><?php echo $this->scope["errors"]["body"];?></span>
                    <?php 
}?>

                </div>
                <div class="form-group">
                    <label>Published</label>
                    <label class="radio-inline">
                        <input type="radio" name="published" value="0" <?php if (! (isset($this->scope["formPost"]["published"]) ? $this->scope["formPost"]["published"]:null)) {
?>checked<?php 
}?>> No
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="published" value="1" <?php if ((isset($this->scope["formPost"]["published"]) ? $this->scope["formPost"]["published"]:null)) {
?>checked<?php 
}?>> Yes
                    </label>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Save</button>
                    <a class="btn btn-danger" href="javascript: history.back()">Back</a>
                </div>
            </form>   
        </div>
    </div>
    <?php 
}?>

    
    
</div>

</body></html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>