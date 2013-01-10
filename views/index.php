<?=get_messages_from_session()?>
<h1>Welcome to Lanaya framework!</h1>
<br/>
List below of all the controllers and their methods.
<br/>
<?php
	echo '<p>';
	foreach($menu as $val):
		echo '<li class="controllers"><a href=' . create_url($val) . '>' . $val . '</a></li>';
	endforeach; 
	echo '</p>';
?>
<br/>