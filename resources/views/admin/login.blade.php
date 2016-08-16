<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<title>用户登陆</title>
</head>
<form action="" method="post">
	<table>
		<tr><td colspan="2"><h1>用户登录</h1></td></tr>
		<tr><td>用户名:</td><td><input type="text" name="user_name" /></td></tr>
		<tr><td>密码:</td><td><input type="password" name="user_pass" /></td></tr>
		<tr><td>验证码：</td><td>
				<input type="text" name="code" />
				<img src="#" onclick="this.src='checkCode.php?aa='+Math.random()"/></td></tr>
		<tr><td><input type="submit" value="登陆" /></td>
			<td><input type="reset" value="重新填写"></td>
		</tr>
	</table>
</form>
</html>