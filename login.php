<?php
/*
 *#####################################################################
 * 機能名:         ログイン
 * ソースファイル名:   login.php
 * 概要:           ログイン画面の制御フェイル
 * 注意事項:        なし

 * 更新履歴
 * 更新日付		:担当者         :更新内容
 *#####################################################################
 * 2009/07/21	:黄燁光	  :新規作成
 * 2010/12/22	:FQC 柳下 :ブラウザ判定処理追加
 *
 * All Rights Reserved Copyright(C)SOFTROAD LIMITED 2009
 */

session_start();
include_once("common/config.php");
include_once("common/errormsg.php");
include_once("common/common.php");

//共通のクラス
$common = new Common();

if(!isset($_SESSION["userId"])){
	session_unset();
}
//エラーパラ
$errorParam = array();
$errorMessage = "";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="css/base.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/devacom.js"></script>
<script language="JavaScript">
function loingOn(){
	if(!IsReadyState()){
		alert("<?php echo COM001;?>");
		return false;
	}
	//企業ＩＤ
	var kigyouId = document.com010Form.kigyouId.value;
	//社員Ｎｏ
	var userId = document.com010Form.userId.value;
	//パスワード

	var password = document.com010Form.password.value;

	//企業ＩＤ
	if(isNull(kigyouId)) {
	    <?php 
	    $errorParam = array('企業ＩＤ');
	    $errorMessage = $common->getMsg(ERR001,$errorParam);
	    ?>
	    alert("<?php echo $errorMessage; ?>");
		setFoucs("kigyouId");
		return false;
	} else if(!isHalfNumEn(kigyouId) || !checkLen(kigyouId,8,10)){
		<?php 
	    $errorParam = array('企業ＩＤ','8','10');
	    $errorMessage = $common->getMsg(ERR007,$errorParam);
	    ?>
	    alert("<?php echo $errorMessage; ?>");
		setFoucs("kigyouId");
		return false;
	}
	if(isNull(userId)) {
	    <?php 
	    $errorParam = array('社員Ｎｏ');
	    $errorMessage = $common->getMsg(ERR001,$errorParam);
	    ?>
	    alert("<?php echo $errorMessage; ?>");
		setFoucs("userId");
		return false;
	} else if(!checkEmail1(userId) || !checkLen(userId,1,24)){
		<?php 
	    $errorParam = array('社員Ｎｏ','1','24');
	    $errorMessage = $common->getMsg(ERR007,$errorParam);
	    ?>
	    alert("<?php echo $errorMessage; ?>");
		setFoucs("userId");
		return false;
	}
	if(!isNull(password) && (!isHalfNumEn(password) 
			|| !checkLen(password,6,10))) {
	    <?php 
	    $errorParam = array('パスワード','6','10');
	    $errorMessage = $common->getMsg(ERR007,$errorParam);
	    ?>
	    alert("<?php echo $errorMessage; ?>");
		setFoucs("password");
		return false;
	}
	protocol_flag = window.location.protocol.toUpperCase();
	if(protocol_flag == "HTTP:"){
		document.com010Form.action="<?= BASE_HTTPS_URL?>" + "com010/com010Ctl.php";
	}else{
		document.com010Form.action="./com010/com010Ctl.php"
	}
	document.com010Form.submit();
}

// ブラウザ判定
// Add 2010/12/22 FQC 柳下
function chkUsrAgt(){
	var userAgent = window.navigator.userAgent.toLowerCase();
	alert(userAgent.indexOf("msie"));
	alert(userAgent);
	if (userAgent.indexOf("msie") > -1) {	// IEの場合
		document.com010Form.Submit.disabled = false;
		
	} else if (userAgent.indexOf("trident") > -1) {	// IE11?の場合
		document.com010Form.Submit.disabled = false;
	} else {								// それ以外
	//	document.com010Form.Submit.disabled = true;
		alert('お使いのブラウザには対応しておりません。\nInternet Explore 7以降をお使いください。');
	}
}
</script>
<title>ログイン画面</title>
</head>
<body onload="setFoucs('kigyouId');chkUsrAgt();" id="pageBackGround">
<table width="100%" border="0">
  <tr>
    <td width="361" height="398" align="left" valign="top">&nbsp;</td>
    <td width="524" align="left" valign="top"><p>&nbsp;</p>
    <form name="com010Form" action="" method="post">
      <table width="514" height="319" border="0" cellpadding="0" cellspacing="0">
        <tr>
        <td id="tdBorder">
	        <table width="486" bgcolor="#FFFFFF">
	        	<tr>
		          <td width="110" height="50" bgcolor="#FFFFFF"><div align="left"><img src="image/dearslogo.png" width="110" height="52" /></div></td>
		          <td width="276" height="50" bgcolor="#FFFFFF"><div align="center"><span class="styleHead">人事考課システム</span></div></td>
		          <td width="110" height="50" bgcolor="#FFFFFF"></td>
	         	</tr>
	        </table>
        </td>
        </tr>
        <tr id="loginTable">
        <td id="tdBorder2">
		<?
		// エラーの設定

		if(isset($_SESSION[SESSION_RRORMSG_KEY])){?>
          <label>
          <div height="43" ><span class="loginstyleError"><?= $_SESSION[SESSION_RRORMSG_KEY] ?></span></div>
          </label>
		<?}?>
		<table width="486" border="0"> 
		<tr><td align="center">
              	<span class="styleLabel5">各種ＩＤを入力してログインしてください。</span>
        </td></tr>
		</table>
          <table width="400" border="0" align="center" id="tableTitle" >
              <tr>
                <td width="240" align="center" height="35"><span class="styleLabel">企業ＩＤ　</span>　　                  
                <label></label></td>
                <td width="301" height="35"><input type="textbox" id="kigyouId" name="kigyouId" 
                class="editbox" size="35" maxlength="10" style="ime-mode: disabled"  
				<?
				if(isset($_SESSION["kigyouId"])){?>
                value="<?= htmlspecialchars($_SESSION["kigyouId"])?>"
				<?}else{?>
                value=""
                <?}?>
                /></td>
              </tr>
              <tr>
                <td height="35" align="center" width="150"><span class="styleLabel">社員Ｎｏ</span>
                　                  </td>
                <td height="35"><input type="textbox" id="userId" name="userId"  
                class="editbox" size="35" maxlength="24"  style="ime-mode: disabled" 
				<?
				if(isset($_SESSION["userId"])){?>
                value="<?= htmlspecialchars($_SESSION["userId"])?>"
				<?}else{?>
                value=""
                <?}?>
                /></td>
              </tr>
              <tr>
                <td height="35" class="styleLabel" align="center" width="150">パスワード</td>
                <td height="35" ><input type="password" id="password" name="password" 
                class="editbox" style="ime-mode: disabled" 
				size="35" maxlength="10" 
				<?
				if(isset($_SESSION["password"])){?>
                value="<?= htmlspecialchars($_SESSION["password"])?>"
				<?}else{?>
                value=""
                <?}?>
                /></td>
              </tr>
              
            </table>
            <table ><tr height="10"><td></td></tr></table>
            <table width="486" border="0">
            	<tr>
                <td colspan="3" align="center">
              <input type="button" class="btn_2k3" 
                    onmouseover="this.className='btn3_mouseover'" 
					onmouseout="this.className='btn3_mouseout'" 
					onmousedown="this.className='btn3_mousedown'" 
					onmouseup="this.className='btn3_mouseup'" 
                  id="Submit" name="Submit" onclick="loingOn()" value="&nbsp;ログイン&nbsp;"/>
              </td>
              </tr>
            </table>
            </td>
        </tr>

<!-- お知らせ -->
<!--
<tr>
  <td height="20"></td>
</tr>
<tr>
  <td><font color="red">
  【メンテナンスのお知らせ】<br>
   サーバ増強作業の為、メンテナンスを下記の日時にて実施致します。<br>
   ご不便をお掛けしますが何卒ご理解とご協力のほどよろしくお願い致します。<br>
   <b>２０１０年２月１９日（金）１８：００　～　２０１０年２月２１日（日）１８：００</b></font>
  </td>
</tr>
-->
      </table>
      </form>
    <p>&nbsp;</p>    <label></label></td>
    <td width="354" align="left" valign="top">&nbsp;</td>
  </tr>
</table>

<div align="center"></div>
</body>
</html>
<?php
	//セッションのデータをクリアする
	// errorMessage
	unset($_SESSION[SESSION_RRORMSG_KEY]);
	// 企業ＩＤ
	unset($_SESSION["kigyouId"]);
	// 社員Ｎｏ
	unset($_SESSION["userId"]);
    // パスワード

	unset($_SESSION["password"]);
?>