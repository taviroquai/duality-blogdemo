<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ;
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

    
    
    <div class="row">
        <div class="col col-sm-12 col-md-12 col-lg-6">
            <?php 
$_fh0_data = (isset($this->scope["posts"]) ? $this->scope["posts"] : null);
if ($this->isTraversable($_fh0_data) == true)
{
	foreach ($_fh0_data as $this->scope['item'])
	{
/* -- foreach start output */
?>

            <h2><a href="<?php echo $this->scope["url"];
echo $this->scope["item"]["id"];?>"><?php echo $this->scope["item"]["title"];?></a></h2>
            <div class="well pull-right">
                <span class="label label-info"><?php echo $this->scope["item"]["author"];?></span>
                <span class="label label-info"><?php echo $this->scope["item"]["updated_at"];?></span>
            </div>
            <div class="clearfix"></div>
            <div>
                <?php echo $this->scope["item"]["body"];?>

            </div>
            <?php 
/* -- foreach end output */
	}
}?>

        </div>
    </div>
    
    
</div>

</body></html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>