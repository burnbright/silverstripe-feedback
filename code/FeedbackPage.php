<?php
class FeedbackPage extends Controller{
	
	
	function window(){
		Requirements::css('feedback/css/feedbackpopup.css');
		Requirements::themedCSS('forms');
		return array();
	}
		
	function Link(){
		return Director::baseURL().'FeedbackPage';
	}
	
	function Form(){
		
		$categorydd = array(
			'Compliment' => '<span>Compliment</strong> - what you like and love',			
			'Suggestion' => '<span>Suggestions</span> - for new pages and features',			
			'Bug' => '<span>Bugs</span> - such as technical issues',
			'Site Content' => '<span>Site Content</span> - changes, additions and page ordering',
			'Other' => '<span>Other</span> - thoughts about the site'
		);
		
		$fields = new FieldSet(
			new LiteralField('SignInMsg','<p>*Please sign in if you are a site member.</p>'),
			new TextField('Name'),
			new EmailField('Email','E-Mail'),
			new OptionsetField('OverallRating','Overall Rating (1 = terrible, 5 = excellent)',array(1=>"1",2=>"2",3=>"3",4=>"4",5=>"5"),""),
			new DropdownField('Category','Category',$categorydd),
			new TextareaField('Message')
		);
		
		if($member = Controller::CurrentMember()){
			$fields->removeByName('Name');
			$fields->removeByName('Email');
			$fields->removeByName('SignInMsg');
			$fields->insertBefore(new LiteralField('Blurb',"<p>Feedback from ".$member->getName()."</p>"),'OverallRating');
		}
		//Debug::show(Director::urlParams());
		if($id = Director::urlParam('ID')){
			$fields->push(new HiddenField('PageID',"PageID",$id));
		}
		if(isset($_GET['currenturl'])){
			$fields->push(new HiddenField('CurrentURL','Current',$_GET['currenturl']));			
		}
		
		$actions = new Fieldset(
			new FormAction('submit','Send')
		);
		
		$form = new Form($this,'Form',$fields,$actions);
		return $form;
	}
	
	
	function submit($data,$form){
		
		$feedback = new Feedback();
		if($member = Controller::CurrentMember()){
			$feedback->SubmitterID = $member->ID;
		}
		$form->saveInto($feedback);
		if(isset($data['CurrentURL'])){
			$feedback->URL = urldecode($data['CurrentURL']);
		}
		if(isset($data['PageID']) && is_numeric($data['PageID'])){
			$feedback->PageID = (int)$data['PageID'];
		}
		$feedback->write();
		$this->window();
		return "<p>Thank you. Your feedback has been recorded.</p>";
	}
	
}
?>
