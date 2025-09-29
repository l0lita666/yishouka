<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>卡类支付接口</title>
</head>
<body>
<br>
<?php
function order($str=''){
	return $str.time().substr(microtime(),2,6).rand(0,9);
}

?>
<form name="createOrder" action="pay.php" method="POST">
	<table>
		<tr>
			<td>
				<font color=red>*</font>订单号
			</td>

			<td>
                    <input type="text" name="orderId" value="<?php echo order("C");?>" maxlength="20"> &nbsp;
            </td>
		</tr>
		<tr>
			<td>
				<font color=red>*</font>点卡面值
			</td>

			<td>
                    <input type="text" name="amount" value="10" maxlength="20"> &nbsp;(不可以是小数)
            </td>
		</tr>
		<tr>
			<td>
				<font color=red>*</font>点卡类型
			</td>

			<td>
                    <input type="text" name="productCode" value="12" > &nbsp;
            </td>
		</tr>
		
		<tr>
			<td>
				<font color=red>*</font>点卡卡号
			</td>

			<td>
                    <input type="text" name="cardNumber" value="12345888" > &nbsp;
            </td>
		</tr>
		<tr>
			<td>
				<font color=red>*</font>点卡密码
			</td>

			<td>
                    <input type="text" name="cardPassword" value="dsfsdfsdfs" > &nbsp;
            </td>
		</tr>
		
		
		<tr>
			<td>
				<font color=red>*</font>异步通知地址
			</td>

			<td>
                    <input type="text" name="notify_url" value="http://localhost/pay/index.php" maxlength="100"> &nbsp;
            </td>
		</tr>
		<tr>
			<td>
				<font color=red>*</font>自定义参数
			</td>

			<td>
                    <input type="text" name="custom" value="" maxlength="30"> 
            </td>
		</tr>
		
		
	
	</table>
	<input type='button' value='提交订单' onClick='document.createOrder.submit()'>
</form>
</body>
</html>