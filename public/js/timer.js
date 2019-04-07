function startCountdown(t) {
    // Countdown Settings
    seconds = t;
    container = "ctd"; 
    oncomplete = function() { alert('TIME UP!'); }
    isover = false; 

    var startTime, timer, obj, ms = seconds*1000,
        display = document.getElementById(container);
    obj = {};
    obj.resume = function() {
        startTime = new Date().getTime();
        timer = setInterval(obj.step,250); // adjust this number to affect granularity
                            // lower numbers are more accurate, but more CPU-expensive
    };
    obj.pause = function() {
        ms = obj.step();
        clearInterval(timer);
    };
    obj.step = function() {
        var now = Math.max(0,ms-(new Date().getTime()-startTime)),zz
            m = Math.floor(now/60000), s = Math.floor(now/1000)%60;
            // h = Math.floor(now/60000/60), m = Math.floor(now/60000)%60, s = Math.floor(now/1000)%60;
        s = (s < 10 ? "0" : "")+s;

        // Output Text
        display.innerHTML = '<span class="ctd m">' + m + '</span><span class="ctd ctd-word-mins">mins</span>' + " " + '<span class="ctd s">' + s + '</span><span class="ctd ctd-word-secs">secs</span>';

        if(isover) {
            // DO NOTHING ANYMORE
        } else {
            if( now == 0) {
                clearInterval(timer);
                obj.resume = function() {};
                if( oncomplete ) oncomplete();

                // Set isover as true after oncomplete function executes
                isover = true;
            }
        }
        return now;
    };

    // added
    obj.isover = function() {
        return isover;
    }
    obj.resume();
    return obj;
}


// Usage
// var countdown = startCountdown(3*60);
// countdown.pause(); // to pause
// countdown.resume(); // to resume