<?php
	foreach($ciudades as $id=>$ciudad):
		echo '<option value="'.$ciudad['id'].'">'.$ciudad['name'].'</option>';
	endforeach;
?>