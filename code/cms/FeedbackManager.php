<?php
class FeedbackManager extends ModelAdmin{
	
	static $url_segment = 'feedback';
	static $menu_title = 'Feedback';
	
	static $managed_models = array(
		'Feedback'
	);
	
	function init(){
		parent::init();
		
		Requirements::css('feedback/css/adminfix.css');
	}
	
}
?>
