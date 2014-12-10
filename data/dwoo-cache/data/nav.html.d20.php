<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>    <?php if ((isset($this->scope["mainNav"]) ? $this->scope["mainNav"] : null)) {
?>

    <div class="row">
        <div class="navbar">
            <ul class="nav nav-pills">
                <?php 
$_fh1_data = (isset($this->scope["mainNav"]["items"]) ? $this->scope["mainNav"]["items"]:null);
if ($this->isTraversable($_fh1_data) == true)
{
	foreach ($_fh1_data as $this->scope['item'])
	{
/* -- foreach start output */
?>

                <li <?php if ((isset($this->scope["item"]["url"]) ? $this->scope["item"]["url"]:null) == (isset($this->scope["mainNav"]["active"]) ? $this->scope["mainNav"]["active"]:null)) {
?>class="active"<?php 
}?>>
                    <a href="<?php echo $this->scope["item"]["url"];?>"><?php echo $this->scope["item"]["link"];?></a>
                </li>
                <?php 
/* -- foreach end output */
	}
}?>

            </ul>
        </div>
    </div>
    <?php 
}
 /* end template body */
return $this->buffer . ob_get_clean();
?>