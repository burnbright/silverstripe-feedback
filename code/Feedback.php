<?php

class Feedback extends DataObject{
	
	static $db = array(
		'Name' => 'Varchar',
		'Email' => 'Varchar',
		'OverallRating' => 'Int',
		'Message' => 'Text',
		'Category' => 'Enum("Bug,Site Content,Suggestion,Compliment,Other","Compliment")',
		'URL' => 'Varchar'
	);
	
	static $has_one = array(
		'Page' => 'SiteTree',
		'Submitter' => 'Member'
	);

   static $summary_fields = array('Message','OverallRating','Category','URL','MemberName','MemberEmail');
   //TODO: add created
   
   static $casting = array(
   	'MemberEmail' => 'Varchar',
   	'MemberName' => 'Varchar',

   );
   
   static $membergroup = 'all';
   
   static function set_member_group($group = 'all'){
   	self::$membergroup = $group;
   }
   
   static function canSee(){
   	if(!self::$membergroup)
   		return false;
   	if(self::$membergroup == 'all' && Member::currentUser()){
   		return true;
   	}elseif(Member::currentUser() && Member::currentUser()->inGroup(self::$membergroup)){
   		return true;
   	}
   	return false;
   }
   
   function getMemberEmail(){
   		if($this->Email){
   			return $this->Email; 
   		}
   		if($this->SubmitterID){
   			return $this->Submitter()->Email;
   		}
   		
   		return null;
   }
   
   function getMemberName(){
   		if($this->Name){
   			return $this->Name;
   		}
   		if($this->SubmitterID){
   			return $this->Submitter()->Name;
   		}
   		return null;
   }
   

}

?>
