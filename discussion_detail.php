<?php

include("config.php");
include("ckeditor/ckeditor.php");


error_reporting(0);

?>

<?php
$discussion_message = getAllDataFromTable('discussion_message',array('discussion_id'=>$_REQUEST['dis']),'','*');
//var_dump($discussion_message);
//die;
$discussion_title = getAllRecordFromTableWithJoin
        ('discussion_message',array('discussion'=>'discussion.discussion_id=discussion_message.discussion_id')
        ,array('discussion_message.discussion_id'=>$_REQUEST['dis']),
        'discussion_message.*,discussion.*');
$discussion_title1= $discussion_title[0];
//var_dump($discussion_title1['topic_type']);
//die;
?>
<?php
if(isset($_POST['submit']) && $_POST['submit'] == 'submit'){  
    extract($_POST);
    //var_dump($_POST);
    //die();
       $author = ($_SESSION['Doctors_id']!='')?$_SESSION['Doctors_id']:$_SESSION['Patient_id'];
       $active_date = date('Y-m-d H:i:s') ;
       $Post_data = array('message'=>$content,
                            'discussion_id'=>$_REQUEST['dis'],
                             'reply_by'=>$author,
                              'message_date'=>$active_date);
       $rs_discussion_message= insert_table('discussion_message',$Post_data);
        $rs_discussion_message1 =$rs_discussion_message[0]; 
} ?>
<?php
     include_once ('Includes/header.php');
     ?>
<div id="prescription-column-middle">
<div id="appointment-story-box" style=height:auto; class="patient-background">
    <div id="title-box2" class="title-box-background-orange title-medium" style="display:block "></div>
    
<table style="width:100%;" border="0" cellspacing="15" cellpadding="10">

    <tr id="dis_detail" style="color:whitesmoke;"> 
        <td style="width: 15%;"> <b>TITLE:</b></td> 
        <td style="text-align:left;"><b><?php echo strtoupper($discussion_title1['subject']);?></b></td>
</tr>
 <?php $i = 1;foreach($discussion_title as $dismessage_list){
             if($i%2 == 0){
			$preclass = 'style="background-color:#ecf0f1;padding: 6px 10px;font-size: 15px;"';
		}else {
			$preclass = 'style="background-color:#e4e6e8;padding: 6px 10px;font-size: 15px;"';
		}
   ?>
<tr <?php echo $preclass;?>><td colspan="2"><?php echo $dismessage_list['message'];?></td></tr>
<?php $i++; } ?>

<tr id="replyTR">
           <td colspan="2"> <button id="reply" style="float:right;">REPLY 
              </button>
          </td>
       </tr>
       <form method="post" name="disreply" action="" enctype="multipart/form-data">
       <tr id ="disreply" style="disply:none">
           
       <td>
          <?php 
         $oFCKeditor = new CKEditor();
         $oFCKeditor->basePath = 'ckeditor/';
         $value = $content;
         $oFCKeditor->config['width']  = '300%' ;
         $oFCKeditor->config['height'] = '300' ;
         $oFCKeditor->config ['margin-bottom']= '20px';
         $oFCKeditor->editor('content',$value);
         ?>
           <br><br>
           <input type="file" name="dicussionReplyImage" >
           <br><br>
           <input type="submit" name="submit" value="submit">
       </td>
       
            </tr>
                 </form>

           
</table>
    </div>


</div>

</body>
</html>