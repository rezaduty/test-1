<?php
include("../inc/conn.php");
include("check.php");
$fpath="text/wangkanmodify.txt";
$fcontent=file_get_contents($fpath);
$f_array=explode("|||",$fcontent) ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $f_array[2]?></title>
<link href="style/<?php echo siteskin_usercenter?>/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/3/ckeditor/ckeditor.js"></script>
<script language = "JavaScript">
function CheckForm(){
<?php echo $f_array[0]?> 
}    
</script>
</head>
<body>
<div class="main">
<?php
include("top.php");
?>
<div class="pagebody">
<div class="left">
<?php
include("left.php");
?>
</div>
<div class="right">
<div class="content">
<div class="admintitle"><?php echo $f_array[1]?> </div>
<?php
$page = isset($_GET['page'])?$_GET['page']:1;
checkid($page);
$id = isset($_GET['id'])?$_GET['id']:0;
checkid($id,1);

$sqlzh="select * from zzcms_wangkan where id='$id'";
$rszh =query($sqlzh); 
$rowzh = fetch_array($rszh);
if ($id!=0 && $rowzh["editor"]<>$username) {
markit();
showmsg('非法操作！警告：你的操作已被记录！小心封你的用户及IP！');
}
?>
<form action="wangkansave.php" method="post" name="myform" id="myform" onSubmit="return CheckForm();">    
        <table width="100%" border="0" cellpadding="3" cellspacing="1">
          <tr> 
            <td width="15%" align="right" class="border2"><?php echo $f_array[2]?> </td>
            <td width="85%" class="border2"> <select name="bigclassid" id="bigclassid" class="biaodan">
                <option value="" selected="selected"><?php echo $f_array[3]?></option>
                <?php
		$sql="select * from zzcms_wangkanclass";
		$rs=query($sql);
		while($row= fetch_array($rs)){
			?>
       <option value="<?php echo $row["classid"]?>"  <?php if ($row["classid"]==$rowzh["bigclassid"]) { echo "selected";}?> ><?php echo $row["classname"]?></option>
          <?php
		  }
		  ?>
              </select></td>
          </tr>
          <tr> 
            <td align="right" class="border"><?php echo $f_array[4]?></td>
            <td class="border"> <input name="title" type="text" id="title" class="biaodan" size="50" maxlength="255" value="<?php echo $rowzh["title"]?>" />            </td>
          </tr>
          <tr> 
            <td align="right" class="border2" ><?php echo $f_array[7]?></td>
            <td class="border2" > <textarea    name="content" id="content" class="biaodan" style="height:auto"><?php echo stripfxg($rowzh["content"])?></textarea> 
              <script type="text/javascript">
				CKEDITOR.replace('content');	
			</script>            </td>
          </tr>
          <tr> 
            <td align="right" class="border">&nbsp;</td>
            <td class="border"> <input name="Submit" type="submit" class="buttons" value="<?php echo $f_array[8]?>"> 
              <input name="action" type="hidden" id="action3" value="modify">
              <input name="editor" type="hidden" id="editor" value="<?php echo $username?>" />
              <input name="page" type="hidden" id="page" value="<?php echo $page?>" />
              <input name="id" type="hidden" id="id" value="<?php echo $rowzh["id"] ?>" /></td>
          </tr>
        </table>
</form>
</div>
</div>
</div>
</div>
<?php
unset ($f_array);
?>
</body>
</html>