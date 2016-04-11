var fnv=false;
	var lnv=false;
	var emidv=false;
	var pwv=false;
	var conpwv=false;
		function validatefn() {
			var fn = document.getElementById('fn');
			var parent = document.getElementById('fndiv');
			var span = document.getElementById('fnspan');
			var help = document.getElementById('fnhelp');
			if(fn.value === '' || fn.value === ' ') {
				parent.className = "form-group has-feedback has-error";
				span.className = "form-control-feedback glyphicon glyphicon-remove";
				help.className = "help-block text-muted";
				fnv = false;
			} else {
				parent.className = "form-group has-feedback has-success";
				span.className = "form-control-feedback glyphicon glyphicon-ok";
				help.className = "help-block text-muted hidden";
				fnv = true;
			}
		}
		function validateln() {
			var ln = document.getElementById('ln');
			var parent = document.getElementById('lndiv');
			var span = document.getElementById('lnspan');
			var help = document.getElementById('lnhelp');
			if(ln.value === '' || ln.value === ' ') {
				parent.className = "form-group has-feedback has-error";
				span.className = "form-control-feedback glyphicon glyphicon-remove";
				// help.className = "help-block text-muted";
				lnv = false;
			} else {
				parent.className = "form-group has-feedback has-success";
				span.className = "form-control-feedback glyphicon glyphicon-ok";
				// help.className = "help-block text-muted hidden";
				lnv = true;
			}
		}
		function validatemid() {
			var emid = document.getElementById('emid').value;
			var parent = document.getElementById('emiddiv');
			var span = document.getElementById('emidspan');
			var help = document.getElementById('emidhelp');
			var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
			if(filter.test(emid)) {
				emailCheck(emid);
				// parent.className = "form-group has-feedback has-success";
				// span.className = "form-control-feedback glyphicon glyphicon-ok";
				emidv = true;
			} else {
				parent.className = "form-group has-feedback has-error";
				span.className = "form-control-feedback glyphicon glyphicon-remove";
				emidv = false;
			}
			if (emid === '' || emid === ' ') {
				parent.className = "form-group has-feedback";
				span.className = "form-control-feedback glyphicon";
			}
		}
		function reCheck() {
			var emid = document.getElementById('emid').value;
			var parent = document.getElementById('emiddiv');
			var span = document.getElementById('emidspan');
			var help = document.getElementById('emidhelp');
			var mcheckpar = document.getElementById('ajaxpar').innerHTML;
			var mcheck = document.getElementById('mailcheck').innerHTML.trim();
			// alert(mcheck);
			if (mcheck.startsWith("Email") || mcheck.startsWith("Already")) {
				parent.className = "form-group has-feedback has-error";
				span.className = "form-control-feedback glyphicon glyphicon-remove";
				emidv = false;
			} else {
				parent.className = "form-group has-feedback has-success";
				span.className = "form-control-feedback glyphicon glyphicon-ok";
				emidv = true;
			}
				
		}
		function emailCheck(str) {
			if (str.length == 0) { 
				document.getElementById("mailcheck").innerHTML = "";
				return;
			} else {
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("mailcheck").innerHTML = xmlhttp.responseText;
						reCheck();
					}
				};
				xmlhttp.open("POST", "emailcheckajax.php", true);
				xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlhttp.send("emailcheck="+str);
				return;
			}
		}
		function validatepw() {
			var pw = document.getElementById('pw');
			var parent = document.getElementById('pwdiv');
			var span = document.getElementById('pwspan');
			var help = document.getElementById('pwhelp');
			if(pw.value.length < 8 || pw.value.length > 15) {
				parent.className = "form-group has-feedback has-error";
				span.className = "form-control-feedback glyphicon glyphicon-remove";
				help.className = "help-block text-muted";
				pwv = false;
			} else {
				parent.className = "form-group has-feedback has-success";
				span.className = "form-control-feedback glyphicon glyphicon-ok";
				help.className = "help-block text-muted hidden";
				pwv = true;
			}
		}
		function confirmpw() {
			var pw = document.getElementById('pw').value;
			var con_pw = document.getElementById('con_pw').value;
			var parent = document.getElementById('con_pwdiv');
			var span = document.getElementById('con_pwspan');
			var help = document.getElementById('conpwhelp');
			// alert("pw : "+pw+" con_pw : "+con_pw);
			if(pw != con_pw || pw.length == 0) {
				parent.className = "form-group has-feedback has-error";
				span.className = "form-control-feedback glyphicon glyphicon-remove";
				help.className = "help-block text-muted";
				conpwv = false;
			} else {
				parent.className = "form-group has-feedback has-success";
				span.className = "form-control-feedback glyphicon glyphicon-ok";
				help.className = "help-block text-muted hidden";
				conpwv = true;
			}
		}
		function Final() {
			var flag = true;
			if(fnv==false) {
				flag = false;
				validatefn();
			}
			if(emidv==false) {
				flag = false;
				validatemid();
				document.getElementById('fn').focus;
			}
			if(pwv==false) {
				flag = false;
				validatepw();
				document.getElementById('fn').focus;
			}
			if(conpwv==false) {
				flag = false;
				confirmpw();
				document.getElementById('fn').focus;
			}
			return flag;
		}