<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ;
// checking for modification in file:data/admin.html
if (!("1425359482" == filemtime('data/admin.html'))) { ob_end_clean(); return false; };
// checking for modification in file:data/template.html
if (!("1425359482" == filemtime('data/template.html'))) { ob_end_clean(); return false; };?><!DOCTYPE html>
<html><head>

<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<title><?php echo $this->scope["title"];?></title>
<meta name="description" content="<?php echo $this->scope["description"];?>">
<meta name="keywords" content="<?php echo $this->scope["keywords"];?>">
<meta name="author" content="<?php echo $this->scope["author"];?>">

<!-- add the bootstrap css framework -->
<link href="<?php echo $this->scope["url"];?>theme/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!--  add font awesome -->
<link href="<?php echo $this->scope["url"];?>theme/font-awesome/css/font-awesome.css" rel="stylesheet">
<!-- blog stylesheet -->
<link href="<?php echo $this->scope["url"];?>theme/blog.css" rel="stylesheet">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<script src="<?php echo $this->scope["url"];?>/theme/bootstrap/js/jquery-1.11.1.min.js"></script>

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
                <div class="form-group <?php if ((isset($this->scope["errors"]["body"]) ? $this->scope["errors"]["body"]:null)) {
?>has-error<?php 
}?>">
                    <label>Body</label>
                    <input name="body" type="hidden" value="<?php echo $this->scope["formPost"]["bodyHtmlEntities"];?>" />
                    <?php if ((isset($this->scope["errors"]["body"]) ? $this->scope["errors"]["body"]:null)) {
?>

                    <span class="help-block"><?php echo $this->scope["errors"]["body"];?></span>
                    <?php 
}?>

                    
                    <div class="btn-toolbar well" data-role="editor-toolbar" data-target="#editor">
                        <div class="btn-group">
                          <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                            <li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>
                            <li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
                            <li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>
                            </ul>
                        </div>
                        <div class="btn-group">
                          <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                          <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                          <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                          <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                        </div>
                        <div class="btn-group">
                          <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                          <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                          <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-indent"></i></a>
                          <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-dedent"></i></a>
                        </div>
                        <div class="btn-group">
                          <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                          <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                          <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                          <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                        </div>
                        <div class="btn-group">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink" 
                               id="dropdownMenu1"
                               aria-expanded="true"
                               ><i class="fa fa-link"></i></a>
                                <div class="dropdown-menu input-append" role="menu" aria-labelledby="dropdownMenu1">
                                    <input class="span2" placeholder="URL" type="text" data-edit="createLink"/>
                                    <button class="btn" type="button">Add</button>
                                </div>
                          <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-unlink"></i></a>

                        </div>

                        <div class="btn-group">
                          <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="fa fa-image"></i></a>
                          <input type="file" data-target="#pictureBtn" data-edit="insertImage" 
                                 style="opacity: 0; position: absolute; top: 0px; left: 0px; width: 41px; height: 30px;"
                                 />
                        </div>
                        <div class="btn-group">
                          <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                          <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                        </div>
                      </div>

                      <div id="editor" style="overflow:scroll; max-height:300px"><?php echo $this->scope["formPost"]["body"];?></div>
                </div>
                
                <div class="form-group">
                    <button class="btn btn-primary">Save</button>
                    <a class="btn btn-danger" href="javascript: history.back()">Back</a>
                </div>
            </form>   
        </div>
    </div>
    <script type="text/javascript">
        $.getScript("<?php echo $this->scope["url"];?>/theme/bootstrap/js/bootstrap.min.js", function() {
            $.getScript("<?php echo $this->scope["url"];?>/theme/wysiwyg/jquery.hotkeys.js", function() {
                $.getScript("<?php echo $this->scope["url"];?>/theme/wysiwyg/bootstrap-wysiwyg.js", function () {
                    $('[data-edit="createLink"]').on('click', function(e) {
                        e.stopPropagation();
                    });
                    $('#editor').wysiwyg();
                    $('form').submit(function() {
                        $('[name="body"]').val($('#editor').cleanHtml());
                        return true;
                    });
                });
            });
        });
        
    </script>
    <?php 
}?>

    
    <?php if ((isset($this->scope["comments"]) ? $this->scope["comments"] : null)) {
?>

    <div class="row">
        <div class="col col-sm-12 col-md-12 col-lg-6">
            <h2>Manage Comments</h2>
            <table class="table" id="posts">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Created</td>
                        <td>Published</td>
                        <td>Options</td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
$_fh0_data = (isset($this->scope["comments"]) ? $this->scope["comments"] : null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['item'])
	{
/* -- foreach start output */
?>

                    <tr>
                        <td><?php echo $this->scope["item"]["id"];?></td>
                        <td><?php echo $this->scope["item"]["created_at"];?></td>
                        <td>
                            <?php if ((isset($this->scope["item"]["published"]) ? $this->scope["item"]["published"]:null)) {
?>

                            <span class="glyphicon glyphicon-check"></span>
                            <?php 
}
else {
?>

                            <span class="glyphicon glyphicon-unchecked"></span>
                            <?php 
}?>

                        </td>
                        <td>
                            <a href="<?php echo $this->scope["commentEditUrl"];?>/<?php echo $this->scope["item"]["id"];?>"><span class="glyphicon glyphicon-pencil"></span></a>
                            <a href="<?php echo $this->scope["commentDelUrl"];?>/<?php echo $this->scope["item"]["id"];?>"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                    </tr>
                    <?php 
/* -- foreach end output */
	}
}?>

                </tbody>
            </table>
        </div>
    </div>
    <?php 
}?>

    
    
</div>

</body></html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>