var objform = document.querySelector("form")
var objuser = document.querySelector("input[name=u_real]")
var objphone = document.querySelector("input[name=u_phone]")
var objemail = document.querySelector("input[name=u_email]")
var tip = document.getElementById("tip")
var atip = document.getElementById("atip")
var ptip = document.getElementById("ptip")
objuser.onblur = function () {
    var user = objuser.value
    if (user == "") {
        // alert("姓名不能为空")
        tip.innerHTML = "姓名不能为空!"
        return false;
    }
    if (user.length < 2 || user.length > 6) {
        // alert("姓名长度为2-6")
        tip.innerHTML = "姓名长度为2-6个！"
        return false;
    }
    if (!user.match(/^[\u4E00-\u9FA5]{1,5}$/)) {
        // alert("请输入汉字")
        tip.innerHTML = "请输入汉字！"
        return false;
    }
    return true
}
objuser.onfocus = function () {
    tip.innerHTML = ""
}

objphone.onblur = function(){
    var phone = objphone.value
    if(phone ==""){
        ptip.innerHTML="请输入电话！"
        return false;
    }
    if(phone.length>11||phone.length<11){
        ptip.innerHTML="请输入11位的电话号码"
        return false;
    }
    if(!phone.match(/^[1][3|5|7|8|9][0-9]{9}$/g)){
        ptip.innerHTML="输入号码的格式不正确"
        return false;
    }
    return ture;
}
objphone.onfocus = function(){
    ptip.innerHTML=""
}

objemail.onblur = function(){
    var phone = objemail.value
    if(phone ==""){
        atip.innerHTML="请输入邮箱！"
        return false;
    }

    if(!phone.match(/^([a-zA-Z0-9._-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/)){
        atip.innerHTML="输入邮箱的格式不正确"
        return false;
    }
    return ture;
}
objemail.onfocus = function(){
    ptip.innerHTML=""
}

