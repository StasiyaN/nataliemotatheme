document.addEventListener('DOMContentLoaded', function () { 
    console.log('burger menu script ok');
    //declaration de variables
    let burgerBtn = document.querySelector('.burger-menu');
    let menuContent = document.querySelector('.nav');
    let contactBtnMobile = document.getElementById('contactBtn');

    burgerBtn.addEventListener('click', function () {
        burgerBtn.classList.toggle('open');
        menuContent.classList.toggle('active');
       document.body.classList.toggle('lock');
    });

    contactBtnMobile.addEventListener ('click', function (){
        menuContent.classList.remove('active');
        burgerBtn.classList.add('open');
        document.body.classList.remove('lock');

    });



});