document.addEventListener('DOMContentLoaded', function () { 
    console.log('burger menu script ok');
    //declaration de variables
    let burgerBtn = document.querySelector('.burger-menu');
    let menuContent = document.querySelector('.nav');

    burgerBtn.addEventListener('click', function () {
        burgerBtn.classList.toggle('open');
        menuContent.classList.toggle('active');
        document.body.classList.toggle('lock');
    });



    console.log(burgerBtn);
});