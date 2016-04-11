function deadline(timeInHours,timeInMinutes,timeInSeconds) {
	var currentTime = Date.parse(new Date());
	var dl = new Date(currentTime + timeInHours*60*60*1000 + timeInMinutes*60*1000 + timeInSeconds*1000);
	return dl;
}
function getTimeRemaining(endtime) {
	var t = Date.parse(endtime) - Date.parse(new Date());
	var seconds = Math.floor((t / 1000) % 60);
	var minutes = Math.floor((t / 1000 / 60) % 60);
	var hours = Math.floor((t / (1000 * 60 * 60) ));
		return {
		'total': t,
		'hours': hours,
		'minutes': minutes,
		'seconds': seconds  
	};
}
function initializeClock(id, endtime) {
	var clock = document.getElementById(id);
	var hoursSpan = clock.querySelector('.hours');
	var minutesSpan = clock.querySelector('.minutes');
	var secondsSpan = clock.querySelector('.seconds');
	function updateClock() {
		var t = getTimeRemaining(endtime);
		hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
		minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
		secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
		if (t.total <= 0) {      
			clearInterval(timeinterval);
			eraseCookie('myClock');
			window.location = 'evaluate_exam.php';
		}  
	}
	updateClock();
	var timeinterval = setInterval(updateClock, 1000);
}

function createCookie(name, value, days) {
    var expires = '',
        date = new Date();
    if (days!=0) {
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = '; expires=' + date.toGMTString();
    }
    document.cookie = name + '=' + value + expires + '; path=/' ;
    // alert('createcookie ' + document.cookie);
}

function readCookie(name) {
    var cookies = document.cookie.split(';'),
        length = cookies.length,
        i,
        cookie,
        nameEQ = name + '=';
    for (i = 0; i < length; i += 1) {
        cookie = cookies[i];
        while (cookie.charAt(0) === ' ') {
            cookie = cookie.substring(1, cookie.length);
        }
        if (cookie.indexOf(nameEQ) === 0) {
            return cookie.substring(nameEQ.length, cookie.length);
        }
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, '', -1);
}

// if there's a cookie with the name myClock, use that value as the deadline
if (document.cookie != '') {
	// read deadline from cookie
	endtime = readCookie('myClock');
	if(endtime == null ) {
		// create deadline from now
		var endtime = deadline(0,20,0);
		// store deadline in cookie for future reference
		createCookie('myClock',endtime.toGMTString(),1);
	}
	//deadline = document.cookie.split(';')[0].split('=')[1];
	// alert('endtime' + endtime);
}

// otherwise, set a deadline 10 minutes from now and 
// save it in a cookie with that name
else {
	// create deadline from now
	var endtime = deadline(0,20,0);
	// store deadline in cookie for future reference
	createCookie('myClock',endtime.toGMTString(),1);
}
initializeClock('flatclock',endtime);