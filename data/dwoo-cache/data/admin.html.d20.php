<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ;
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

    
        
    <?php if ((isset($this->scope["posts"]) ? $this->scope["posts"] : null)) {
?>

    <div class="row">
        <div class="col col-sm-12 col-md-12 col-lg-6">
            <h2>Manage Posts</h2>
            <table class="table" id="posts">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Title</td>
                        <td>Published</td>
                        <td>Options</td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
$_fh0_data = (isset($this->scope["posts"]) ? $this->scope["posts"] : null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['item'])
	{
/* -- foreach start output */
?>

                    <tr>
                        <td><?php echo $this->scope["item"]["id"];?></td>
                        <td><?php echo $this->scope["item"]["title"];?></td>
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
                            <a href="<?php echo $this->scope["editUrl"];?>/<?php echo $this->scope["item"]["id"];?>"><span class="glyphicon glyphicon-pencil"></span></a>
                            <a href="<?php echo $this->scope["delUrl"];?>/<?php echo $this->scope["item"]["id"];?>"><span class="glyphicon glyphicon-trash"></span></a>
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