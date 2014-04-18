<?php

defined('_JEXEC') or die;
?>

<ol class="breadcrumb <?php echo $moduleclass_sfx; ?>">
<?php if ($params->get('showHere', 1))
	// {
	// 	echo '<li class="showHere">' .JText::_('MOD_BREADCRUMBS_HERE').'</li>';
	// }
?>
<?php for ($i = 0; $i < $count; $i ++) :

	if ($i == 1 && !empty($list[$i]->link) && !empty($list[$i-1]->link) && $list[$i]->link == $list[$i-1]->link) {
		continue;
	}

	if ($i < $count -1) {
		if (!empty($list[$i]->link)) {
			echo '<li  itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
			echo '<a href="'.$list[$i]->link.'" class="pathway"  itemprop="url"><span itemprop="title">'.$list[$i]->name.'</span></a>';
			echo '</li>';
		} else {
			echo '<li>';
			echo $list[$i]->name;
			echo '</li>';
		}
		if($i < $count -2){
			// echo ' '.$separator.' ';
		}
	}  elseif ($params->get('showLast', 1)) { // when $i == $count -1 and 'showLast' is true
		if($i > 0){
			// echo ' '.$separator.' ';
		}
		 echo '<li class="active"  itemprop="child" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">';
		echo $list[$i]->name;
		  echo '</span></li>';
	}
endfor; 
?>
</ol>
