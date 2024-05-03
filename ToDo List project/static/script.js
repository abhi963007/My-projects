let Action = document.getElementById('formId');
let Head = document.getElementById('headId');
let Button = document.getElementById('buttonId');
function loginForm() {
    Action.setAttribute('action','/login');
    Head.innerHTML = "Login";
    Button.innerHTML = "Login";
}
function signupForm() {
    Action.setAttribute('action','/register');
    Head.innerHTML = "Signup";
    Button.innerHTML = "Signup";
}

function startTime() {
    const today = new Date();
    let h = today.getHours(), m = today.getMinutes(), s = today.getSeconds(), AP = "AM";
    if(h > 12 ){
        h=h-12;
        AP = "PM"
    }
    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);
    let date = today.toLocaleDateString('default',{weekday: 'long',year: 'numeric',month: 'long',day: 'numeric'});
    document.getElementById('liveTime').innerHTML = h + ":" +m+ ":"+s +" "+ AP +"   "+ date;
    setTimeout(startTime,1000);
}
function checkTime(tms) {
    if(tms<10){tms = "0" + tms;}
        return tms;
}