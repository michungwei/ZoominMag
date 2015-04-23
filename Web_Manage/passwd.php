<?php 
$inc_path = "../inc/";
$manage_path = "";
include_once('_config.php');

if(isset($_POST["oldpass"])){
	$oldpass = md5(post("oldpass", 1));
	$newpass = md5(post("newpass", 1));
	
	$db = new Database($HS, $ID, $PW, $DB);
	$db -> connect();
	$sql = "SELECT admin_password 
			FROM $table_admin 
			WHERE admin_username = '".$_SESSION["madmin"]."' AND admin_password = '$oldpass'";
	$row = $db -> query_first($sql);
	if($row){
		$db -> query("UPDATE $table_admin SET admin_password = '$newpass' WHERE admin_username = '".$_SESSION["madmin"]."'");
		script("密碼修改成功!!");
	}else{
		script("對不起,舊密碼錯誤!!");
	}
	$db -> close();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>Untitled Document</title>
<link href="css/admin_style_gray.css" rel="stylesheet" />
<script src="../scripts/jquery-1.6.1rc1.min.js"></script>
<script src="../scripts/public.js"></script>
<script src="../scripts/function.js"></script>
<script>
$(document).ready(function(){
	$("form").submit(function(){
		var re = true;
		err_msg = '';
		if(re){re = isnull("oldpass","舊密碼",0,1,20);}
		if(re){re = isnull("newpass","新密碼",0,1,20);}
		if(re){re = isnull("newpass2","確認新密碼",0,1,20);}
		if(re){re = checkPassword("newpass","newpass2");}
			if (!re){
				alert(err_msg)
				return false;
			}
		 return true;
	});
});
</script>
</head>

<body>
<div id="mgbody-content">
    <div id="adminlist">
        <h2> <img src="images/admintitle.png" />&nbsp;&nbsp;修改密碼</h2>
        <div class="accordion ">
            <div class="tableheader">
                <div class="handlediv"></div>
                <p>修改密碼</p>
            </div>
            <div class="listshow">
                <form action="passwd.php" method="post" name="form1" id="form1">
                    <div>
                        <h4 class="input-text-title">舊密碼</h4>
                        <div class="input-text">
                            <input name="oldpass" type="password" id="oldpass"   value="" size="30" maxlength="30" />
                            <span class="red">*</span><span></span> </div>
                        <h4 class="input-text-title">新密碼</h4>
                        <div class="input-text">
                            <input name="newpass" type="password" id="newpass"   value="" size="30" maxlength="30" />
                            <span class="red">*</span><span></span></div>
                        <h4 class="input-text-title">確認新密碼</h4>
                        <div class="input-text">
                            <input name="newpass2" type="password" id="newpass2"   value="" size="30" maxlength="30" />
                            <span class="red">*</span><span></span></div>
                        <p class="submit">
                            <input name="s" type="submit" class="button" id="s" value="送出"/>
                            <input name="" type="reset" value="重設" class="button"/>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>