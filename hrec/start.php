<?php
//$GLOBALS['nojunk']='';
require_once 'base/verify_login.php';
require_once 'research_common.php';


////////User code below/////////////////////	

	$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

	$user_info=get_user_info($link,$_SESSION['login']);
	//my_print_r($user_info);
	echo'';
	echo '<form method=post><table class="table table-dark">
			<tr>
				<td>'.$user_info['id'].'</td>
				<td>'.$user_info['name'].'</td>
				<td>'.$user_info['type'].'</td>
				<td>'.$user_info['subtype'].'</td>
				<td>'.$user_info['Institute'].'</td>
				<td>'.$user_info['year_of_admission'].'</td>
				<td>'.$user_info['department'].'</td>
				<td>'.$user_info['email'].'</td>
				<td>'.$user_info['mobile'].'</td>
				<td><button class="btn btn-info" type=submit formtarget=_blank name=action value=help 
		formaction=http:\/\/'.$_SERVER['HTTP_HOST'].'/dokuwiki/doku.php?id=hrec_help:start">Help</button></td>
			</tr>
		</table></form>';

	//all three can save comments
	if($_POST['action']=='save_comment')
	{ 
		if(isset($_FILES['attachment']))
		{
			$blob=file_to_str($link,$_FILES['attachment']);
			$upload_fname=$_FILES['attachment']['name'];
		}
		else
		{
			$blob='';
			$upload_fname='';
		}
		save_comment($link,$_SESSION['login'],$_POST['proposal_id'],$_POST['comment'],$blob,$upload_fname);
	}	
		
	if($user_info['type']=='srcms')
	{	
		/////
		//1//
		/////
		echo '<h3 data-toggle="collapse" data-target="#srcms" class="bg-warning">Activity as SRCMS</h3>';
		echo '<div id="srcms" class="collapse">';
		if($_POST['action']=='assign_reviewer')
		{
			echo '<div class="jumbotron">';
				list_single_application($link,$_POST['proposal_id']);
			//echo '</div>';
			//echo '<div class="jumbotron">';
				list_srcm_reviewer($link,$_POST['proposal_id']);
			echo '</div>';
			$_SESSION['dsp']='srcms';
		}

		/////
		//2//
		/////
		if($_POST['action']=='save_reviewer')
		{
			save_srcm_reviewer($link,$_POST);
			//$applicant_id=get_applicant_id($link,$_POST['proposal_id']);
			
			//insert_reviewer($link,$_POST['proposal_id'],$applicant_id);
			
			echo '<div class="jumbotron">';
				list_single_application($link,$_POST['proposal_id']);
				list_srcm_reviewer($link,$_POST['proposal_id']);
			echo '</div>';
			$_SESSION['dsp']='srcms';
		}

		/////
		//5//
		/////		
		if($_POST['action']=='send_to_ecms')
		{
			set_application_status($link,$_POST['proposal_id'],'030.sent_to_ecms');
			$_SESSION['dsp']='srcms';
		}
				
		echo '<ul class="nav nav-pills">
			<li class="nav-item"><a class="nav-link active" data-toggle="pill" href="#applied">Applied</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="pill" href="#assigned">Reviewers Assigned (SRC)</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="pill" href="#reviewed">Reviewed (SRC)</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="pill" href="#sent_to_ecms">Sent to ECMS</a></li>
		</ul>
		
		<div class="tab-content">';
		
			echo '<div class="jumbotron tab-pane container active" id=applied>';
				list_application_status($link,'001.applied','assign_reviewer');
			echo '</div>';
			echo '<div class="jumbotron tab-pane container" id=assigned>';
				list_application_status($link,'010.srcm_assigned','assign_reviewer');
			echo '</div>';
			echo '<div class="jumbotron tab-pane container" id=reviewed>';
				list_application_status($link,'020.srcm_approved','send_to_ecms','(Send to ecms)');
			echo '</div>';
			echo '<div class="jumbotron tab-pane container" id=sent_to_ecms>';
				list_application_status($link,'030.sent_to_ecms');
			echo '</div>';			
		echo '</div>';//for tab-content
		
		echo '</div>';//for srcms collapsible
	}

	if($user_info['type']=='srcm' || $user_info['type']=='srcms')
	{	

		/////
		//3//
		/////
		echo '<h3 data-toggle="collapse" data-target="#srcm" class="bg-warning">Activity as SRCM</h3>';

		echo '<div class=collapse id=srcm>';
		

			
		/////
		//4//
		/////		
		if($_POST['action']=='approve')
		{
			save_approve($link,$_SESSION['login'],$_POST['proposal_id'],$_POST['comment']);
			if(pending_review($link,$_POST['proposal_id'],'srcm')==0)
			{
					set_application_status($link,$_POST['proposal_id'],'020.srcm_approved');
			}
			$_SESSION['dsp']='srcm';
		}	
						
		//if($_POST['action']=='view_application' || $_POST['action']=='save_comment' ||$_POST['action']=='approve')
		if($_POST['action']=='view_application' ||$_POST['action']=='approve')
		{
			view_entire_application($link,$_POST['proposal_id']);
			$_SESSION['dsp']='srcm';
		}		
		
	
			echo '<div class="jumbotron tab-pane container active" id=assigned>';
				list_application_for_reviewer($link,'010.srcm_assigned','view_application',$_SESSION['login']);
			echo '</div>';
			
			echo '</div>'; //for srcm collapse
			
			
	}

   if(
		$user_info['type']=='researcher' ||
		$user_info['type']=='srcm' || 
		$user_info['type']=='srcms' ||
		$user_info['type']=='ecms' ||
		$user_info['type']=='ecm'
		)
	 {
		echo '<h3 data-toggle="collapse" data-target="#researcher" class="bg-warning">Activity as RESEARCHER</h3>';
		 
		echo '<div class=collapse id=researcher>';
		
		if($_POST['action']=='manage_application')
        {	
			view_entire_application_for_applicant($link,$_POST['proposal_id']);
			
			$_SESSION['dsp']='researcher';
		}
			
		if($_POST['action']=='new_application')
        {		
		    get_application_data($link);  
			$_SESSION['dsp']='researcher';
	    }
	    
	    if($_POST['action']=='insert_application')
        {
			//$app_blob=file_to_str($link,$_FILES['application']);
			//if($app_blob==false){$app_blob='';}

			//$ref_blob=file_to_str($link,$_FILES['reference']);
			//if($ref_blob==false){$ref_blob='';}
			//insert_application($link,$_POST['applicant_id'],$_POST['proposal_name'],$app_blob,$ref_blob);
			insert_application($link,$_POST['applicant_id'],$_POST['proposal_name'],$_POST['type'],$_POST['guide']);
			$_SESSION['dsp']='researcher';
	    }


	    if($_POST['action']=='update_application')
        {
			//$app_blob=file_to_str($link,$_FILES['application']);
			//$ref_blob=file_to_str($link,$_FILES['reference']);
          //status($link,$_POST['id']);
			save_application_field($link,$_POST['id'],'proposal_name',$_POST['proposal_name']); 
			save_application_field($link,$_POST['id'],'type',$_POST['type']); 
			save_application_field($link,$_POST['id'],'guide',$_POST['guide']); 

			
			view_entire_application_for_applicant($link,$_POST['id']);
			$_SESSION['dsp']='researcher';
	    }

	    if($_POST['action']=='upload_attachment')
        {   
			//status($link,$_POST['proposal_id']);
			$blob=file_to_str($link,$_FILES['attachment']);
			save_attachement($link,$_POST['proposal_id'],$_POST['type'],$blob,$_FILES['attachment']['name']);		
			view_entire_application_for_applicant($link,$_POST['proposal_id']);
			$_SESSION['dsp']='researcher';
			
	    }
	    	    
		if($_POST['action']=='delete_appication')
        	{
				delete($link,'research',$_POST['table'],$_POST['primary_key'],$_POST['primary_key_value']);
				$_SESSION['dsp']='researcher';
			}
       
       list_researcher_application($link);
	
		echo '</div><div></div>'; //for researcher collapse
	}


if($user_info['type']=='ecms')
	{	
		/////
		//1//
		/////
		echo '<h3 data-toggle="collapse" data-target="#ecms" class="bg-warning">Activity as ECMS</h3>';
		
		echo '<div id="ecms" class="collapse">';
		if($_POST['action']=='assign_reviewer')
		{
			echo '<div class="jumbotron">';
				list_single_application($link,$_POST['proposal_id']);
			//echo '</div>';
			//echo '<div class="jumbotron">';
				list_ecm_reviewer($link,$_POST['proposal_id']);
			echo '</div>';
			$_SESSION['dsp']='ecms';
		}
		if($_POST['action']=='ecms_approve')
		{
			set_application_status($link,$_POST['proposal_id'],'070.ecms_approved');
			$_SESSION['dsp']='ecms';
		}
			/////
		//2//
		/////
		if($_POST['action']=='save_reviewer')
		{
			save_ecm_reviewer($link,$_POST);
			//$applicant_id=get_applicant_id($link,$_POST['proposal_id']);
			
			//insert_reviewer($link,$_POST['proposal_id'],$applicant_id);
			
			echo '<div class="jumbotron">';
				list_single_application($link,$_POST['proposal_id']);
				list_ecm_reviewer($link,$_POST['proposal_id']);
			echo '</div>';
			$_SESSION['dsp']='ecms';
		}
	echo '<ul class="nav nav-pills">
			<li class="nav-item"><a class="nav-link active" data-toggle="pill" href="#applied">Assign EC Reviewer</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="pill" href="#assigned">EC Reviewers Assigned</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="pill" href="#ecms_approve">Require ECMS approval</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="pill" href="#print">ECMS Approved</a></li>
		</ul>
		
		<div class="tab-content">';
		
			echo '<div class="jumbotron tab-pane container active" id=applied>';
				list_application_status($link,'030.sent_to_ecms','assign_reviewer');
			echo '</div>';
			echo '<div class="jumbotron tab-pane container" id=assigned>';
				list_application_status($link,'040.ecm_assigned','assign_reviewer');
			echo '</div>';
			echo '<div class="jumbotron tab-pane container" id=ecms_approve><p>';		
				list_application_status($link,'060.ecm_approved','ecms_approve','Approve as ECMS');
			echo '</p></div>';
			echo '<div class="jumbotron tab-pane container" id=print>';
			//echo 'Print approval here';
				print_approval_latter($link,'070.ecms_approved','print.php','Print Approval Letter');
			echo '</div>';
			
		echo '</div>';//for tab-content
		
		echo '</div>';//for ecms collapsible
	}

if($user_info['type']=='ecm' || $user_info['type']=='ecms')
	{	

		/////
		//3//
		/////
		echo '<h3 data-toggle="collapse" data-target="#ecm" class="bg-warning">Activity as ECM</h3>';

		echo '<div class=collapse id=ecm>';
		

			
		/////
		//4//
		/////		
		if($_POST['action']=='approve')
		{
			save_approve($link,$_SESSION['login'],$_POST['proposal_id'],$_POST['comment']);
			if(pending_review($link,$_POST['proposal_id'],'ecm')==0)
			{
					set_application_status($link,$_POST['proposal_id'],'060.ecm_approved');
			}
			$_SESSION['dsp']='ecm';
		}	
						
		//if($_POST['action']=='view_application' || $_POST['action']=='save_comment' ||$_POST['action']=='approve')
		if($_POST['action']=='view_application' ||$_POST['action']=='approve')
		{
			view_entire_application_ecm($link,$_POST['proposal_id']);
			$_SESSION['dsp']='ecm';
		}		
		
	
			echo '<div class="jumbotron tab-pane container active" id=assigned>';
				list_application_for_reviewer($link,'040.ecm_assigned','view_application',$_SESSION['login']);
			echo '</div>';
			
			echo '</div>'; //for ecm collapse
			
			
	}
	

//////////////user code ends////////////////
tail();
//$result=run_query($link,'research',"select * from user");
//while($ar=get_single_row($result))
//{
//	my_print_r($ar);
//}
//my_print_r($_POST);
//my_print_r($_FILES);
//my_print_r($_SESSION);
//my_print_r($_SERVER);
?>
<script>
var xx= '#'+'<?php  echo $_SESSION['dsp']; ?>';
jQuery(document).ready(
	function() 
	{
		jQuery(xx).addClass("show");
		//alert(xx);
	}
);
</script>
