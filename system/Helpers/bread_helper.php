<?php
if(!function_exists("addBreadLink"))
{
 
function addBreadLink($link="", $label="")
{
return '<li><a href="'.site_url($link).'">'.$label.'</a></li>';
}
 
}
?>