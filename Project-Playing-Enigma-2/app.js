let create = document.getElementById('create');
let login = document.getElementById('login');
let cancelBtn = document.getElementById('cancel');
let newuser = document.getElementById('newuser');
window.addEventListener('load',function(){
    create.setAttribute("style", "display:none;");
});
cancelBtn.addEventListener('click', function(e){
    create.setAttribute("style", "display:none;");
    login.setAttribute("style", "display:block;");
});
newuser.addEventListener('click', function(e){
    login.setAttribute("style", "display:none;");
    create.setAttribute("style", "display:block;");
});
