const userbtn=document.querySelector('#user-btn');
userbtn.addEventListener('click',function() {
    const userbox=document.querySelector('.profile-detail');
    userbox.classList.toggle('active');
})

const toggle=document.querySelector('.toggle-btn');
toggle.addEventListener('click',function() {
    const sidebar=document.querySelector('.sidebar');
    sidebar.classList.toggle('active');

});








