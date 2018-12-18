<?php
namespace frontend\widgets;
use common\models\Category;
use Yii;
use yii\base\Widget;
use common\models\Menu;
class HomeMenuMain extends Widget

{

	public function run()
	{

		$menu = Menu::findOne(['id' => 1,'status'=>1]);

		$children = $menu->children(1)->all();

		$menus = array();
		$i=0;
		foreach($children as $child){
			
			if($child->status != 1)
				continue;
		
			$menus[$i]['link'] = $child->link;
			$menus[$i]['name'] = $child->name;
			$menus[$i]['icon'] = $child->icon;
			$children1 = $child->children(1)->all();
			if($children1){
				$j = 0; 
				foreach($children1 as $child1){
				
					if($child1->status != 1)
						continue;
				 
					$menus[$i]['child'][$j]['link'] = $child1->link;
					$menus[$i]['child'][$j]['name'] = $child1->name;
					$menus[$i]['child'][$j]['icon'] = $child1->icon;
					$j++;
				}
			}
			$i++;
		}
		return $this->render('homeMenuMain', [
			'menus' =>  $menus,
        ]);

		

	}

}