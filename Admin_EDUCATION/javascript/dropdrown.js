document.querySelector("#dropdownUserAvatarButton").addEventListener('click',()=>{
    document.querySelector('#dropdownAvatar').classList.toggle('hidden');
})
document.querySelector("#dropdownUserAvatarButton").addEventListener('blur',()=>{
    setTimeout(()=>{
        document.querySelector('#dropdownAvatar').classList.add('hidden');
    },100)
})


