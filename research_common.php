<?php

function get_user_info($link,$id)
{
	$result=run_query($link,'research','select * from user where id=\''.$id.'\'');
	return get_single_row($result);
}

function my_print_r($a)
{
	echo '<pre>';
	print_r($a);
	echo '</pre>';
}

function list_application_for_srcm_assignment($link)
{
	$result=run_query($link,'research','select * from proposal where status=\'001.applied\'');
	echo '<table class="table table-striped"><tr><th colspan=10>List of research application where reviewer assignment is incomplate</th></tr>
			<tr><th>proposal id</th><th>Applicant id/Name/Department</th><th>Proposal</th><th>DateTime</th><th>Status</th></tr>';
	while($ar=get_single_row($result))
	{
		$user_info=get_user_info($link,$ar['applicant_id']);
		echo '<tr>
				<td>
					<form method=post>
						<button class="btn btn-sm btn-block btn-info" name=action value=assign_reviewer >'.$ar['id'].'</button>
						<input type=hidden name=proposal_id value=\''.$ar['id'].'\'>
						<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
					</form>
				</td>
				<td><span class="text-primary">'.$ar['applicant_id'].'</span>/<span class="text-danger">'.$user_info['name'].'</span>/<span class="text-primary">'.$user_info['department'].'</span></td>
				<td>'.$ar['proposal_name'].'</td>
				<td>'.$ar['date_time'].'</td>
				<td>'.$ar['status'].'</td>
		</tr>';
	}
	echo '</table>';
}

function list_application_status($link,$status,$action='none',$message='')
{
	$result=run_query($link,'research','select * from proposal where status=\''.$status.'\'');
	echo '<table class="table table-striped"><tr><th colspan=10>List of research application with current status of <span class=bg-danger>'.$status.'</span></th></tr>
			<tr><th>proposal id</th><th>Applicant id/Name/Department</th><th>Proposal</th><th>DateTime</th><th>Status</th></tr>';
	while($ar=get_single_row($result))
	{
		$user_info=get_user_info($link,$ar['applicant_id']);
		echo '<tr>
				<td>';
		
		if($action!='none')
		{
					echo '<form method=post>
						<button class="btn btn-sm btn-block btn-info" name=action value=\''.$action.'\' >'.$ar['id'].' '.$message.'</button>
						<input type=hidden name=proposal_id value=\''.$ar['id'].'\'>
						<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
					</form>';
		}
		else
		{
			echo $ar['id'];
		}			
		echo ' </td>
				<td><span class="text-primary">'.$ar['applicant_id'].'</span>/<span class="text-danger">'.$user_info['name'].'</span>/<span class="text-primary">'.$user_info['department'].'</span></td>
				<td>'.$ar['proposal_name'].'</td>
				<td>'.$ar['date_time'].'</td>
				<td>'.$ar['status'].'</td>
		</tr>';
	}
	echo '</table>';
}


function list_application_for_reviewer($link,$status,$action='none',$reviewer_id)
{
	$sql='select * from proposal,decision where 
					proposal.id=decision.proposal_id
						and
					status=\''.$status.'\'
						and
					decision.reviewer_id=\''.$reviewer_id.'\'';
					
	$result=run_query($link,'research',$sql);
	echo '<table class="table table-striped">
			<tr><th colspan=10>List of research application with current status of <span class=bg-danger>'.$status.'</span></th></tr>
			<tr><th>proposal id</th><th>Applicant</th><th>Reviewer</th><th>Proposal</th><th>DateTime</th><th>Status</th></tr>';
	while($ar=get_single_row($result))
	{
		$user_info=get_user_info($link,$ar['applicant_id']);
		$reviewer_info=get_user_info($link,$reviewer_id);
		echo '<tr>
				<td>';
		
		if($action!='none')
		{
					echo '<form method=post>
						<button class="btn btn-sm btn-block btn-info" name=action value=\''.$action.'\' >'.$ar['id'].'</button>
						<input type=hidden name=proposal_id value=\''.$ar['id'].'\'>
						<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
					</form>';
		}
		else
		{
			echo $ar['id'];
		}			
		echo ' </td>
				<td><span class="text-primary">'.$ar['applicant_id'].'</span>/<span class="text-danger">'.$user_info['name'].'</span>/<span class="text-primary">'.$user_info['department'].'</span></td>
				<td><span class="text-primary">'.$reviewer_id.'</span>/<span class="text-danger">'.$reviewer_info['name'].'</span>/<span class="text-primary">'.$reviewer_info['department'].'</span></td>
				<td>'.$ar['proposal_name'].'</td>
				<td>'.$ar['date_time'].'</td>
				<td>'.$ar['status'].'</td>
		</tr>';
	}
	echo '</table>';
}

function list_single_application($link,$id)
{
	$result=run_query($link,'research','select * from proposal where id=\''.$id.'\'');
	echo '<table class="table table-warning table-bordered">
			<tr><th>proposal id</th><th>applicant id/name/department</th><th>Proposal</th><th>DateTime</th><th>Status</th></tr>';
	while($ar=get_single_row($result))
	{
		$user_info=get_user_info($link,$ar['applicant_id']);
		echo '<tr>
				<td>'.$ar['id'].'</td>
				<td><span class="text-primary">'.$ar['applicant_id'].'</span>/<span class="text-danger">'.$user_info['name'].'</span>/<span class="text-primary">'.$user_info['department'].'</span></td>
				<td>'.$ar['proposal_name'].'</td>
				<td>'.$ar['date_time'].'</td>
				<td>'.$ar['status'].'</td>
		</tr>';
	}
	echo '</table>';
}



function echo_download_button($table,$field,$primary_key,$primary_key_value)
{
	echo '<form method=post action=download.php>
			<input type=hidden name=table value=\''.$table.'\'>
			<input type=hidden name=field value=\''.$field.'\' >
			<input type=hidden name=primary_key value=\''.$primary_key.'\'>
			<input type=hidden name=primary_key_value value=\''.$primary_key_value.'\'>
			<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>
			
			<button class="btn btn-primary btn-block"  
			formtarget=_blank
			type=submit
			name=action
			value=download>Download</button>
		</form>';
}


function list_single_application_with_all_fields($link,$id)
{
	$result=run_query($link,'research','select * from proposal where id=\''.$id.'\'');
	echo '<table class="table table-warning table-bordered">
			<tr><th>proposal id</th><th>applicant id/name/department</th><th>Proposal</th><th>DateTime</th><th>Status</th></tr>';
	while($ar=get_single_row($result))
	{
		$user_info=get_user_info($link,$ar['applicant_id']);
		echo '<tr>
				<td>'.$ar['id'].'</td>
				<td><span class="text-primary">'.$ar['applicant_id'].'</span>/<span class="text-danger">'.$user_info['name'].'</span>/<span class="text-primary">'.$user_info['department'].'</span></td>
				<td>'.$ar['proposal_name'].'</td>
				<td>'.$ar['date_time'].'</td>
				<td>'.$ar['status'].'</td>
		</tr>';
		echo '<tr><th>Application</th><td>';
		echo_download_button('proposal','application','id',$id);
		echo '</td></tr>';
		
		echo '<tr><th>Reference</th><td>';
		echo_download_button('proposal','reference','id',$id);
		echo '</td></tr>';	
	}
	echo '</table>';
}

function display_comment($link,$proposal_id)
{
	echo '<div class="jumbotron" >';
	echo '<h3 class="bg-warning">Comments</h3>';

	
	$result=run_query($link,'research','select * from comment where proposal_id=\''.$proposal_id.'\' order by date_time');
	while($ar=get_single_row($result))
	{
		echo '<div class="border border-secondary" >';
		//my_print_r($ar);
		$ri=get_user_info($link,$ar['reviewer_id']);
		//my_print_r($ri);
		echo '	<h3 class="d-inline"><span class="badge badge-primary ">'.$ri['name'].'</span></h3>
				<h4 class="d-inline"><span class="badge badge-secondary">'.$ri['department'].'</span></h4>
				<h5 class="d-inline"><span class="badge badge-info rounded-circle">'.$ri['type'].'</span></h5>';
		echo 	'<span class="d-block pl-5 text-primary"><pre>'.$ar['comment'].'</pre></span>';

		echo '<mark class="font-italic pl-5 small"> Commented on '.$ar['date_time'].'</mark>
			';
		echo '</div>';
	}	
	echo '</div>';
}

function make_comment($link,$proposal_id)
{
	echo '<div class="jumbotron" >';
	echo '<h3 class="bg-danger">Make Comment</h3>';

		echo '<div class="border border-secondary" >';
		$ri=get_user_info($link,$_SESSION['login']);
		//my_print_r($ri);
			echo '	<h3 class="d-inline"><span class="badge badge-primary ">'.$ri['name'].'</span></h3>
			<h4 class="d-inline"><span class="badge badge-secondary">'.$ri['department'].'</span></h4>
			<h5 class="d-inline"><span class="badge badge-info rounded-circle">'.$ri['type'].'</span></h5>';
			echo '<form method=post>';
				echo '<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>';
				echo '<input type=hidden name=proposal_id value=\''.$proposal_id.'\'>';
				echo '<textarea class="form-control" name=comment></textarea>';
				echo '<button name=action value=save_comment class="btn btn-primary btn-block">Send</button>';
			echo '</form>';
		echo '</div>';
		
	echo '</div>';
}

function save_comment($link,$reviewer_id,$proposal_id,$comment)
{	
	$sql='insert into comment 
			(proposal_id,reviewer_id,comment,date_time)
			values(
			\''.$proposal_id.'\',
			\''.$reviewer_id.'\',
			\''.mysqli_real_escape_string($link,htmlspecialchars($comment)).'\',
			now()
			)';


	if(!run_query($link,'research',$sql))
	{
		echo '<span class="text-danger">Comment not Saved</span><br>';
	}
	else
	{
		echo '<span class="text-success">Comment Saved</span><br>';
	}
}


function approve($link,$proposal_id)
{
	echo '<div class="jumbotron" >';
	echo '<h3 class="bg-success">Comment and Approve</h3>';

		echo '<div class="border border-secondary" >';
		$ri=get_user_info($link,$_SESSION['login']);
		//my_print_r($ri);
			echo '	<h3 class="d-inline"><span class="badge badge-primary ">'.$ri['name'].'</span></h3>
			<h4 class="d-inline"><span class="badge badge-secondary">'.$ri['department'].'</span></h4>
			<h5 class="d-inline"><span class="badge badge-info rounded-circle">'.$ri['type'].'</span></h5>';
			echo '<form method=post>';
				echo '<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>';
				echo '<input type=hidden name=proposal_id value=\''.$proposal_id.'\'>';
				echo '<textarea class="form-control" name=comment></textarea>';
				echo '<button name=action value=approve class="btn btn-primary btn-block">Approve</button>';
			echo '</form>';
		echo '</div>';
		
	echo '</div>';
}

function pending_review($link,$proposal_id,$reviewer_type)
{	
	$sql='select count(id) as pending_review from user,decision 
			where 
				proposal_id=\''.$proposal_id.'\' and 
				user.id=decision.reviewer_id and
				approval=0 and
				user.type=\''.$reviewer_type.'\'';
				
	$result_selected=run_query($link,'research',$sql);
	$ar=get_single_row($result_selected);
	return $ar['pending_review'];
}

function save_approve($link,$reviewer_id,$proposal_id,$comment)
{	
	save_comment($link,$reviewer_id,$proposal_id,$comment.' [APPROVED]');
	
	$sql='update decision 
			set approval=1
			where
				proposal_id=\''.$proposal_id.'\' and
				reviewer_id=\''.$reviewer_id.'\'';


	if(!run_query($link,'research',$sql))
	{
		echo '<span class="text-danger">Your approval not saved</span>';
	}
	else
	{
		echo '<span class="text-success">Your Approval Saved</span>';
	}
}


function view_entire_application($link,$proposal_id)
{
	echo '<ul class="nav nav-pills">
		<li class="nav-item"><a class="nav-link active" data-toggle="pill" href="#application">Application</a></li>
		<li class="nav-item"><a class="nav-link" data-toggle="pill" href="#review_status">Review Status</a></li>
		<li class="nav-item"><a class="nav-link" data-toggle="pill" href="#comment">Comments (SRC)</a></li>
		<li class="nav-item"><a class="nav-link" data-toggle="pill" href="#make_comment">Make Comment (SRC)</a></li>
		<li class="nav-item"><a class="nav-link" data-toggle="pill" href="#approve">Approve Application (SRC)</a></li>
	</ul>';
	
	echo '<div class="tab-content">';	

		echo '<div class="jumbotron tab-pane container active" id=application>';
			list_single_application_with_all_fields($link,$proposal_id);
		echo '</div>';
		echo '<div class="jumbotron tab-pane container" id=review_status>';
			show_review_status($link,$proposal_id);
		echo '</div>';
		echo '<div class="jumbotron tab-pane container" id=comment>';
			display_comment($link,$proposal_id);
		echo '</div>';
		echo '<div class="jumbotron tab-pane container" id=make_comment>';
			make_comment($link,$proposal_id);
		echo '</div>';
		echo '<div class="jumbotron tab-pane container" id=approve>';
			approve($link,$proposal_id);
		echo '</div>';

	echo '</div>';//for tab-content
	
}
function get_application_status($link,$id)
{
	$result=run_query($link,'research','select * from proposal where id=\''.$id.'\'');
	$ar=get_single_row($result);
	return $ar['status'];
}

function set_application_status($link,$id,$status)
{
	$result=run_query($link,'research','update proposal set status=\''.$status.'\' where id=\''.$id.'\'');
	return $result;
}

function get_selected_srcm_reviewer($link,$proposal_id)
{
	$sql='select * from user,decision 
			where 
				proposal_id=\''.$proposal_id.'\' and 
				user.id=decision.reviewer_id and
				user.type=\'srcm\'';
				
	$result_selected=run_query($link,'research',$sql);
	
	$ret=array();
	while($ar=get_single_row($result_selected))
	{
		$ret[]=$ar['reviewer_id'];
	}
	//my_print_r($ret);
	return $ret;
}


function count_selected_srcm_reviewer($link,$proposal_id)
{
	$sql='select count(id) as total_selected from user,decision 
			where 
				proposal_id=\''.$proposal_id.'\' and 
				user.id=decision.reviewer_id and
				user.type=\'srcm\'';
				
	$result_selected=run_query($link,'research',$sql);
	$ar=get_single_row($result_selected);
	return $ar['total_selected'];
}

function list_srcm_reviewer($link,$proposal_id)
{
	$result=run_query($link,'research','select * from user where type=\'srcm\'');

	$selected_reviewer=get_selected_srcm_reviewer($link,$proposal_id);

	echo '<form method=post>
			<input type=hidden name=proposal_id value=\''.$proposal_id.'\'>
			<input type=hidden name=session_name value=\''.$_POST['session_name'].'\'>';

	echo '<table class="table table-striped table-success">
			<tr><th>reviwer</th><th>Reviewer id/Name/Department</th><th>Type</th></tr>';
			
	while($ar=get_single_row($result))
	{
		$user_info=get_user_info($link,$ar['id']);
		if(in_array($ar['id'],$selected_reviewer)){$checked='checked';}else{$checked='';}
		
		echo '<tr>
				<td>
						<input class=sr id=ch_'.$ar['id'].' name=ch_'.$ar['id'].' type=checkbox '.$checked.'>
				</td>
				<td><label for=ch_'.$ar['id'].'><span class="text-primary">'.$ar['id'].'</span>/<span class="text-danger">'.$user_info['name'].'</span>/<span class="text-primary">'.$user_info['department'].'</span></label></td>
				<td>'.$ar['type'].'</td>
		</tr>';
	}
	echo '<tr><td colspan="3"><button name=action value=save_reviewer class="btn btn-block btn-success">Save</button></td></tr>';
	echo '</table>';	
	echo '</form>';
}

function show_review_status($link,$proposal_id)
{
	$result=run_query($link,'research','select * from decision where proposal_id=\''.$proposal_id.'\'');


	echo '<table class="table table-striped table-success">
			<tr><th>Reviewer id/Name/Department</th><th>Type</th><th>Decision</th></tr>';
			
	while($ar=get_single_row($result))
	{
		if($ar['approval']==0){$ap='approval pending';}else{$ap='approved';}
		$user_info=get_user_info($link,$ar['reviewer_id']);
		echo '<tr>
				<td><span class="text-primary">'.$ar['reviewer_id'].'</span>/<span class="text-danger">'.$user_info['name'].'</span>/<span class="text-primary">'.$user_info['department'].'</span></td>
				<td>'.$user_info['type'].'</td>
				<td>'.$ap.'</td>
		</tr>';
	}
	echo '</table>';	
}

function save_srcm_reviewer($link,$post)
{
	$result=run_query($link,'research','select * from user where type=\'srcm\'');

	$selected_reviewer=get_selected_srcm_reviewer($link,$post['proposal_id']);
		
	while($ar=get_single_row($result))
	{
		if(in_array($ar['id'],$selected_reviewer))
		{
			if(!isset($post['ch_'.$ar['id']]))
			{
				$sql_del='delete from decision where 
						proposal_id=\''.$post['proposal_id'].'\' and 
						reviewer_id=\''.$ar['id'].'\'';
						
				if(!run_query($link,'research',$sql_del))
				{
					//echo $sql_del.'<br>';
					echo '<p><span class="text-danger">reviewers who already commented on proposal can not be deleted!!</span><br></p>';
				}
				else
				{
					echo '<p><span class="text-danger">...deleting user_id='.$ar['id'].' as reviewer for proposal_id='.$post['proposal_id'].'</span><br>';
				}
			}
			else
			{
				//do nothing
			}
		}
		else
		{
			if(isset($post['ch_'.$ar['id']]))
			{
				$sql='insert into decision values(
					\''.$post['proposal_id'].'\',
					\''.$ar['id'].'\',
					\'0\')';
				//echo $sql.'<br>';
				echo '<p><span class="text-danger">...adding user_id='.$ar['id'].' as reviewer for proposal_id='.$post['proposal_id'].'</span>';
				if(!run_query($link,'research',$sql))
				{
					echo '<p><span class="text-danger">'.$sql_del.'</span>';					
				}
			}
			else
			{
				//do nothing
			}			
		}
	}

/*

'001.applied',
'010.srcm_assigned',
'020.srcm_approved',
'030.sent_to_ecms',
'040.ecm_assigned',
'060.ecm_approved',
'070.ecms_approved'

*/	
	$tot=count_selected_srcm_reviewer($link,$_POST['proposal_id']);
	echo '<p><span class="text-danger">Total reviewers selected='.$tot.'</span>';
	if($tot<$GLOBALS['required_srcm_reviewer'])
	{
		echo '<p><span class="text-danger">Total reviewers selected are less then required ('.$GLOBALS['required_srcm_reviewer'].')</span>';
		set_application_status($link,$_POST['proposal_id'],'001.applied');
	}
	else
	{
		set_application_status($link,$_POST['proposal_id'],'010.srcm_assigned');		
		echo '<p><span class="text-danger">Total reviewers selected are as required ('.$GLOBALS['required_srcm_reviewer'].')</span>';
		echo '<p><span class="text-danger">Done setting application status to  ('.get_application_status($link,$_POST['proposal_id']).')</span>';
	}

}

//function save_reviewer($link,$post)
//{
	////print_r($post);
	//$sql_del='delete from decision where proposal_id=\''.$post['proposal_id'].'\''; 
	//run_query($link,'research',$sql_del);
	////echo $sql_del.'<br>';
	//echo '<p><span class="text-danger">reviewers who already commented on proposal can not be deleted!!</span></p>';
	//foreach ($post as $key=>$value)
	//{
		//if(substr($key,0,3)=='ch_')
		//{
			//$sql='insert into decision values(
					//\''.$post['proposal_id'].'\',
					//\''.substr($key,3).'\',
					//\'0\')';
		////echo $sql.'<br>';
		//echo '...saving user_id='.substr($key,3).' as reviewer for proposal_id='.$post['proposal_id'].'<br>';
		//run_query($link,'research',$sql);
		//}
	//}
//}

?>
