<?php 
foreach ($raw->actions as $action):
	echo '<a class="'.(isset($action['class'])?$action['class']:'').'" title="'.(isset($action['title'])?$action['title']:'').'" href="'.URL::to(sprintf($action['url'],$item->$primary_key)).'" data-rel="'.(isset($action['data-rel'])?$action['data-rel']:'').'" data-redirect="'.(isset($action['data-redirect'])?asset($action['data-redirect']):'').'"><span class="'.(isset($action['span'])?$action['span']:'').'"></span>'.(isset($action['title'])?$action['title']:'').'</a>';
endforeach;