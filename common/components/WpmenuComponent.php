<?php
namespace common\components;

use Yii;
use yii\base\Component;

class WpmenuComponent extends Component{
	public function init(){
		parent::init();
	}
	
	public function getwpmenu($slug=null){ //slug dari menu ex=>primary-menu
		if ($slug!=null) {
			$menu=Yii::$app->db2->createCommand("SELECT p2.ID, p2.post_content, p2.post_title, p2.post_name, p2.guid, p1.post_parent
	        FROM wp_grandistanaramaposts p1
	        INNER JOIN wp_grandistanaramaterm_relationships AS TR
	        ON TR.object_id = p1.ID
	        INNER JOIN wp_grandistanaramapostmeta AS pm
	        ON pm.post_id = p1.ID
	        INNER JOIN wp_grandistanaramaposts AS p2
	        ON p2.ID = pm.meta_value
	        WHERE p1.post_type = 'nav_menu_item'
	        AND TR.term_taxonomy_id = ( SELECT wp_grandistanaramaterm_taxonomy.term_taxonomy_id FROM wp_grandistanaramaterms LEFT JOIN wp_grandistanaramaterm_taxonomy ON wp_grandistanaramaterms.term_id=wp_grandistanaramaterm_taxonomy.term_id AND `taxonomy` = 'nav_menu' WHERE wp_grandistanaramaterms.slug = '".$slug."')
	        AND pm.meta_key = '_menu_item_object_id'
	        ORDER BY p1.menu_order ASC")->queryAll();

	        return $menu;
		} else {
			return false;
		}
	}
	
}
?>