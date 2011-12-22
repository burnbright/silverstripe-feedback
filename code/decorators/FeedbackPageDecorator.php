<?php
class FeedbackPageDecorator extends Extension{
	
	function onAfterInit(){
		Requirements::javascript(THIRDPARTY_DIR.'/jquery/jquery.js'); //interferes with other versions
		
		if(Feedback::canSee()){
			Requirements::css('feedback/css/sidefeedback.css');
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
	}
	
	function Feedback(){
		
		$data = new ArrayData(array(
			'FeedbackSideLink' => $this->FeedbackSideLink()
		));
		
		return $data->renderWith('FeedbackSideLink');
	}
	
	function FeedbackSideLink(){
		if(Feedback::canSee())
			return "FeedbackPage/window/".$this->owner->ID."?currenturl=".$this->FeedbackURL();
		return false;
	}
	
	function FeedbackURL(){
		$url = rawurlencode($_SERVER['REQUEST_URI']);
		return $url;
	}
	
}
?>