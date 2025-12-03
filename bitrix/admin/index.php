<?php
	define('MODX_API_MODE', true);
	define('IN_MANAGER_MODE', false);	
	include_once("./../../index.php");	
	$modx->db->connect();	
	if (empty ($modx->config)) {
		$modx->getSettings();
	}
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="initial-scale=1.0, width=device-width">
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
		<link href="../js/ui/design-tokens/dist/ui.design-tokens.css" type="text/css"  rel="stylesheet" />
		<link href="../panel/main/popup.css" type="text/css"  data-template-style="true"  rel="stylesheet" />
		<link href="../panel/main/login.css" type="text/css"  data-template-style="true"  rel="stylesheet" />
		<script src="../js/main/core/core.js"></script>
		<script src="../js/main/pageobject/pageobject.js"></script>
		<script src="../js/main/core/core_window.js"></script>
		<script src="../js/main/core/core_admin_login.js"></script>
		
		
		<title>Авторизация - <?php echo $modx->config['site_name'];?></title>
		<script>
			/* <![CDATA[ */
			document.addEventListener('DOMContentLoaded', function(){
			var form = document.getElementById('loginfrm');
			
			form.onsubmit = function(e) {
				e.preventDefault();
				
				
				//document.getElementById('mainloader').classList.add('show');
				var xhr = new XMLHttpRequest();
				xhr.open('POST', './../../<?php echo MGR_DIR;?>/processors/login.processor.php', true);
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
				xhr.onload = function() {					
					if (this.readyState === 4) {
						var header = this.response.substr(0, 9);
						if (header.toLowerCase() === 'location:') {
							window.location = this.response.substr(10);
							} else {							
							alert(this.response);
						}
					}
				};
				xhr.send('ajax=1&username=' + encodeURIComponent(form.username.value) + '&password=' + encodeURIComponent(form.password.value) + (form.captcha_code ? '&captcha_code=' + encodeURIComponent(form.captcha_code.value) : '') + '&rememberme=' + form.rememberme.value);
				
				return false;
			};
			});
			/* ]]> */
		</script>
	</head>
	<body id="bx-admin-prefix">
		<!--[if lte IE 7]>
			<style type="text/css">
			#login_wrapper {display:none !important;}
			</style>
			<div id="bx-panel-error">
		Административная панель не поддерживает Internet Explorer версии 7 и ниже. Установите современный браузер <a href="http://www.firefox.com">Firefox</a>, <a href="http://www.google.com/chrome/">Chrome</a>, <a href="http://www.opera.com">Opera</a> или <a href="http://www.microsoft.com/windows/internet-explorer/">Microsoft Edge</a>.</div><![endif]-->
		<div id="login_wrapper" class="login-page login-page-bg login-main-wrapper">
			<script type="text/javascript">
				new BX.adminLogin({
					form: 'form_auth',
					start_form: 'authorize',
					post_data: '',
					popup_alignment: 'popup_alignment',
					login_wrapper: 'login_wrapper',
					window_wrapper: 'window_wrapper',
					auth_form_wrapper: 'auth_form_wrapper',
					login_variants: 'login_variants',
					url: '/bitrix/admin/'
				});
			</script>
			
			<table class="login-popup-alignment">
				<tr>
					<td class="login-popup-alignment-2" id="popup_alignment">
						<div class="login-header">
							<a href="https://<?php
								echo $_SERVER['SERVER_NAME'];
								?>" class="login-logo">
								<span class="login-logo-img"></span><span class="login-logo-text"><?php
									echo idn_to_utf8($_SERVER['SERVER_NAME']);
								?> - <?php echo $modx->config['site_name'];?></span>
							</a>
							<div class="login-language-btn-wrap"><div class="login-language-btn" id="login_lang_button">RU</div></div>
						</div>
						
						<div class="login-footer">
							<div class="login-footer-left"> 
								© 2005-<?php echo date('Y');?> by the EVO. EVO™ is licensed under the GPL.
							</div>
							<div class="login-footer-right">
								<a href="https://t.me/evo_cms" class="login-footer-link" target="_blank">Чат сообщества</a>			
							</div>
						</div>
						<form  method="post" action="./../../<?php echo MGR_DIR;?>/processors/login.processor.php" class="bx-admin-auth-form" novalidate  name="loginfrm" id="loginfrm">			
							
							<div id="auth_form_wrapper">
								<div class="login-main-popup-wrap login-popup-wrap" id="authorize">									
									<div class="login-popup">
										<div class="login-popup-title">Авторизация</div>
										<div class="login-popup-title-description">Пожалуйста, авторизуйтесь</div>
										
										<div class="login-popup-field">
											<div class="login-popup-field-title">Логин</div>
											<div class="login-input-wrap">
												<input type="text" class="login-input" onfocus="BX.addClass(this.parentNode, 'login-input-active')" onblur="BX.removeClass(this.parentNode, 'login-input-active')" name="username" value="" tabindex="1">
												<div class="login-inp-border"></div>
											</div>
										</div>
										<div class="login-popup-field" id="authorize_password">
											<div class="login-popup-field-title">Пароль</div>
											<div class="login-input-wrap">
												<input type="password" class="login-input" onfocus="BX.addClass(this.parentNode, 'login-input-active')" onblur="BX.removeClass(this.parentNode, 'login-input-active')" name="password" tabindex="2">
												<div class="login-inp-border"></div>
											</div>
											<input type="submit" value="" class="login-btn-green" tabindex="4" onfocus="BX.addClass(this, 'login-btn-green-hover');" onblur="BX.removeClass(this, 'login-btn-green-hover')">
											<div class="login-loading">
												<img class="login-waiter" alt="" src="../panel/main/images/login-waiter.gif">
											</div>
										</div>
										
										
										<div class="login-popup-checbox-block">
											<input type="checkbox" class="adm-designed-checkbox" id="rememberme" name="rememberme" value="1" tabindex="3" onfocus="BX.addClass(this.nextSibling, 'login-popup-checkbox-label-active')" onblur="BX.removeClass(this.nextSibling, 'login-popup-checkbox-label-active')">
											<label for="USER_REMEMBER" class="adm-designed-checkbox-label"></label>
											<label for="USER_REMEMBER" class="login-popup-checkbox-label">Запомнить меня на этом компьютере</label>
										</div>
										<a class="login-popup-link login-popup-forget-pas" href="javascript:void(0)" onclick="BX.adminLogin.toggleAuthForm('forgot_password')">Забыли свой пароль?</a>
										
										<div class="login-popup-field login-auth-serv-icons">
											<a href="index.php" class="login-ss-button bitrix24net-button bitrix24net-button-ru"></a>
										</div>										
										
									</div>
								</div>
								<script type="text/javascript">
									BX.adminLogin.registerForm(new BX.authFormAuthorize('authorize', {url:'./../../<?php echo MGR_DIR;?>/processors/login.processor.php'}));
								</script>
							</div>
							
						</form>
					</td>
				</tr>
			</table>
			
			
			
			<div id="login_variants" style="display: none;">
				
				<div id="forgot_password" class="login-popup-wrap-with-text">
					<div class="login-popup-wrap login-popup-request-wrap">
						
						<div class="login-popup">
							<div class="login-popup-title">Запрос пароля</div>
							<div class="login-popup-title-description">Выслать контрольную строку</div>
							<div class="login-popup-request-fields-wrap" id="forgot_password_fields">
								
								
								<div class="login-popup-field">
									<div class="login-popup-field-title">E-mail</div>
									<div class="login-input-wrap">
										<input type="text" onfocus="BX.addClass(this.parentNode, 'login-input-active')" onblur="BX.removeClass(this.parentNode, 'login-input-active')" class="login-input" id="FMP-email">
										<div class="login-inp-border"></div>
									</div>
								</div>								
								
							</div>
							<div class="login-btn-wrap" id="forgot_password_message_button">
								<a class="login-popup-link login-popup-return-auth" href="javascript:void(0)" onclick="BX.adminLogin.toggleAuthForm('authorize')">Авторизоваться</a>
								<input type="button" value="Выслать" class="login-btn" name="send_account_info" onclick="window.location = './../../<?php echo MGR_DIR;?>/index.php?action=send_email&amp;email='+encodeURIComponent(document.getElementById('FMP-email').value);">
							</div>
						</div>
					</div>
					<div class="login-popup-request-text" id="forgot_password_note">
						Если вы забыли пароль, введите ваш логин или E-Mail, указанный при регистрации. Контрольная строка для смены пароля будет выслана вам по электронной почте.<br>
					</div>
				</div>
				
				<script type="text/javascript">
					var obForgMsg = new BX.authFormForgotPasswordMessage('forgot_password_message', {url:''}),
					obForg = new BX.authFormForgotPassword('forgot_password', {
						url: '/bitrix/admin/?forgot_password=yes',
						needCaptcha: true,
						message: obForgMsg
					});
					BX.adminLogin.registerForm(obForg);
					BX.adminLogin.registerForm(obForgMsg);
				</script>
				
				
			</div>
			
		</div>
		<div style="display: none;" id="window_wrapper"></div>
		
		<script type="text/javascript">
			BX.ready(BX.defer(function(){
				BX.addClass(document.body, 'login-animate');
				BX.addClass(document.body, 'login-animate-popup');
			}));
			
			new BX.COpener({DIV: 'login_lang_button', ACTIVE_CLASS: 'login-language-btn-active', MENU: [{'TEXT':'(ru) Russian','LINK':'/bitrix/admin/?lang=ru'},{'TEXT':'(en) English','LINK':'/bitrix/admin/?lang=en'}]});
		</script>
		
	</body>
</html>
