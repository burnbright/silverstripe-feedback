<?php
class FeedbackPageDecorator extends DataObjectDecorator{
	
	//extend page to show feedback link
	static function initialize() {
		/* Record Crawlers */
				
		/* Launch Analytics */
		self::addFeedback();
	}
	
	static function addFeedback(){

		Requirements::css('feedback/css/sidefeedback.css');
		Requirements::javascript('jsparty/jquery/jquery.js');
		Requirements::javascript('feedback/javascript/jquery.popupWindow.js');
		
$script = <<<JS
		 (function($){
		 $(document).ready(function() {
			$('#FeedbackSideLink a.feedbacklink').popupWindow({
					height:500,
					width:350,
					centerBrowser:1,
					windowName: "Give Feedback"
					//windowURL: "FeedbackPage/window?current="+window.location
			});
  		});
		})(jQuery);
JS;
		
		Requirements::customScript($script,'feedbackpopup');
	}
	
	function FeedbackSideLink(){
		return "FeedbackPage/window/".$this->owner->ID."?currenturl=".$this->FeedbackURL();
	}
	
	function FeedbackURL(){
		$url = rawurlencode($_SERVER['REQUEST_URI']);
		return $url;
	}
	
}
?>