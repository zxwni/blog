<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<title>用户登陆</title>
</head>
<div style="margin-top:200px">
	<center>
	<form action="{{url('admin/checklogin')}}" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<h1>用户登录</h1>
				@if(count($errors)>0)
					<div>
						<ul >
							@foreach($errors->all() as $error)
								<li>{{$error}}</li>
							@endforeach
						</ul>
					</div>
				@endif
				@if(session('msg'))
					<p style="color: red"><?php  echo session('msg')?></p>
				@endif
		<table>
				<tr><td>用户名:</td><td><input type="text" name="user_name" /></td></tr>
				<tr><td>密码:</td><td><input type="password" name="user_pass" /></td></tr>
				<tr><td>验证码：</td><td>
						<input type="text" name="code" />
						<img src="{{url('admin/code')}}" onclick="this.src='{{url('admin/code')}}?'+Math.random()" /></td></tr>
				<tr><td><input type="submit" value="登陆" /></td>
					<td><input type="reset" value="重新填写"></td>
				</tr>
			</table>
		</form>
	</center>
</div>
</html>