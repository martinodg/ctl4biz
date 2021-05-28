<?
session_start();
echo '<Span class="company">'.$_SESSION['company_name'].'</span>';
echo '<Span class="name_user">: '.$_SESSION['intUserName'].'</span>';
?>