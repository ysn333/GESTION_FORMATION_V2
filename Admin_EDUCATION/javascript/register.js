document.querySelector('form').addEventListener('submit',e=>{
    let nameReg = /^[a-z]{1,50}$/i;
    let emailReg= /^\w+@\w+.\w+$/i;
    let pwdReg = /^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{8,}$/i;
    let telReg = /^((\+212)|(0212)|0)([678])[0-9]{8}$/i;
    let key = true;
    if (!nameReg.test(document.querySelector('#name').value)){
        key = false;
        document.querySelector('#name').parentElement.parentElement.lastElementChild.classList.add('show');
    }else {
        document.querySelector('#name').parentElement.parentElement.lastElementChild.classList.remove('show');
    }
    if (!nameReg.test(document.querySelector('#last_name').value)){
        key = false;
        document.querySelector('#last_name').parentElement.parentElement.lastElementChild.classList.add('show');
    }else {
        document.querySelector('#last_name').parentElement.parentElement.lastElementChild.classList.remove('show');
    }
    if (!telReg.test(document.querySelector('#tel').value)){
        key = false;
        document.querySelector('#tel').parentElement.parentElement.lastElementChild.classList.add('show');
    }else {
        document.querySelector('#tel').parentElement.parentElement.lastElementChild.classList.remove('show');
    }
    if (!emailReg.test(document.querySelector('#email').value)){
        key = false;
        document.querySelector('#email').parentElement.parentElement.lastElementChild.classList.add('show');
    }else {
        document.querySelector('#email').parentElement.parentElement.lastElementChild.classList.remove('show');
    }
    if (!pwdReg.test(document.querySelector('#password').value)){
        key = false;
        document.querySelector('#password').parentElement.parentElement.lastElementChild.classList.add('show');
    }else {
        document.querySelector('#password').parentElement.parentElement.lastElementChild.classList.remove('show');
    }
    if ((document.querySelector('#password').value) !== document.querySelector('#confirmation').value ){
        document.querySelector('#confirmation').parentElement.parentElement.lastElementChild.classList.add('show');
        key = false;
    }else {
        document.querySelector('#confirmation').parentElement.parentElement.lastElementChild.classList.remove('show');
    }
    if (key=== false) {
        e.preventDefault()
    }
})

