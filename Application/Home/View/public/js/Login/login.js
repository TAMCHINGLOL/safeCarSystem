$(document).ready(function(){
	/*登陆模块*/
	$(document.getElementsByName('user')).blur(function(){
	  if($(this).val()==""){
	  	var erorr='<div class="passport-note passport-error-text"><span>请输入账号</span></div>';
	  	$(this).parent().addClass("has-error");
	  	$(this).after(erorr);
	  }
	});
	$(document.getElementsByName('user')).focus(function(){
	  $(this).parent().removeClass("has-error");
	  $(this).next().remove(); 
	});
	$(document.getElementsByName('password')).blur(function(){
	  if($(this).val()==""){
	  	var erorr='<div class="passport-note passport-error-text"><span>请输入密码</span></div>';
	  	$(this).parent().addClass("has-error");
	  	$(this).after(erorr);
	  }
	});
	$(document.getElementsByName('password')).focus(function(){
	  $(this).parent().removeClass("has-error");
	  $(this).next().remove(); 
	});
	$(document.getElementsByName('verify')).blur(function(){
	  if($(this).val()==""){
	  	var erorr='<div class="passport-note passport-error-text"><span>请输入验证码</span></div>';
	  	$(this).parent().addClass("has-error");
	  	$(this).after(erorr);
	  }
	});
	$(document.getElementsByName('verify')).focus(function(){
	  $(this).parent().removeClass("has-error");
	  $(this).next().remove(); 
	});
	/*注册*/
	$(document.getElementsByName('phone')).blur(function(){
	  if($(this).val()==""){
	  	var erorr='<div class="passport-note passport-error-text"><span>请输入手机号码</span></div>';
	  	$(this).parent().addClass("has-error");
	  	$(this).after(erorr);
	  }
	});
	$(document.getElementsByName('phone')).focus(function(){
	  $(this).parent().removeClass("has-error");
	  $(this).next().remove(); 
	});
	$(document.getElementsByName("code")).blur(function(){
	  if($(this).val()==""){
	  	var erorr='<div class="passport-note passport-error-text"><span>请输入动态码</span></div>';
	  	$(this).addClass("has-error");
	  	$(this).after(erorr);
	  }
	});
	//$(document.getElementsByName('code')).focus(function(){
	//  $(this).removeClass("has-error");
	//  $(this).next().remove();
	//});
	
});





























