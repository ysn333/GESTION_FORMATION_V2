document.querySelector('#save-changes').addEventListener('click',()=>{
    document.querySelector('#email_modal').value = document.querySelector('#email').value;
    document.querySelector('#tel_modal').value = document.querySelector('#tel').value;
})
document.querySelector('#password_confirmation form').addEventListener('submit',e=>{
    let emailReg= /^\w+@\w+.\w+$/i;
    let telReg = /^((\+212)|(0212)|(0))([678])[0-9]{8}$/i;
    let key = true;
    if (document.querySelector('#password').value === ""){
        key = false;
        document.querySelector('#password_confirmation .error p:first-child').classList.add('show');
        document.querySelector('#password_confirmation .error').classList.add('show');
    }else {
        if (!telReg.test(document.querySelector('#tel_modal').value)){
            key = false;
            document.querySelector('#password_confirmation .error p:last-child').classList.add('show');
            document.querySelector('#password_confirmation .error').classList.add('show');
        }else {
            document.querySelector('#password_confirmation .error p:last-child').classList.remove('show');
        }
        if (!emailReg.test(document.querySelector('#email_modal').value)){
            key = false;
            document.querySelector('#password_confirmation .error p:nth-child(2)').classList.add('show');
            document.querySelector('#password_confirmation .error').classList.add('show');
        }else {
            document.querySelector('#password_confirmation .error p:nth-child(2)').classList.remove('show');
        }
        document.querySelector('#password_confirmation .error p:first-child').classList.remove('show');
    }
    if (!key) {
        e.preventDefault();
    }
})
document.querySelector('#password_change form').addEventListener('submit',e=>{
    let key = true;
    let pwdReg = /^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{8,}$/i;
    if (document.querySelector('#old_password').value === "" ||document.querySelector('#new_password').value === "" || document.querySelector('#new_password_confirm').value === ""){
        key = false;
        document.querySelector('#password_change .error p:first-child').classList.add('show');
        document.querySelector('#password_change .error').classList.add('show');
    }else {
        document.querySelector('#password_change .error p:first-child').classList.remove('show');
        if (document.querySelector('#new_password').value !== document.querySelector('#new_password_confirm').value){
           document.querySelector('#password_change .error p:last-child').classList.add('show');
           document.querySelector('#password_change .error').classList.add('show');
            document.querySelector('#password_change .error p:nth-child(2)').classList.remove('show');
            key=false;
       }else  {
            if (!pwdReg.test(document.querySelector('#password').value)){
                key = false;
                document.querySelector('#password_change .error p:nth-child(2)').classList.add('show');
                document.querySelector('#password_change .error').classList.add('show');
            }
        }
    }
    if (!key) {
        e.preventDefault();
    }
})