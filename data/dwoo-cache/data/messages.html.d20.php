<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ;
if ((isset($this->scope["info"]) ? $this->scope["info"] : null)) {
?>

    <div class="alert alert-info" role="alert"><?php echo $this->scope["info"];?></div>
<?php 
}?>

<?php if ((isset($this->scope["error"]) ? $this->scope["error"] : null)) {
?>

    <div class="alert alert-danger" role="alert"><?php echo $this->scope["error"];?></div>
<?php 
}
 /* end template body */
return $this->buffer . ob_get_clean();
?>