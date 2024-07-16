document.addEventListener('DOMContentLoaded', function () { 
    console.log('script ok');

    // Declaration de variables
    let burgerBtn = document.querySelector('.burger-menu');
    let menuContent = document.querySelector('.nav');
    let contactBtnMobile = document.getElementById('contactBtn');
    let popupWindow = document.querySelector('.contact-popup');
    let popup = document.querySelector('.popup-wrapper');
    let pageContent = document.querySelector('.page-content');

    burgerBtn.addEventListener('click', function () {
        burgerBtn.classList.toggle('open');
        menuContent.classList.toggle('active');
        document.body.classList.toggle('lock');
        
        // Close the popup if it is open
        if (popupWindow.classList.contains('active')) {
            popupWindow.classList.remove('active');
            pageContent.classList.remove('hidden');
        }
    });

    contactBtnMobile.addEventListener('click', function () {
        menuContent.classList.remove('active');
        burgerBtn.classList.remove('open');
        document.body.classList.remove('lock');

        // Open the popup
        popupWindow.classList.add('active');
        pageContent.classList.add('hidden');
    });

    // Prevent click inside the popup from closing it
    popup.addEventListener('click', function (event) {
        event.stopPropagation();
    });

    // Close the popup when clicking outside of it
    document.addEventListener('click', function (event) {
        if (popupWindow.classList.contains('active') && !popup.contains(event.target) && !contactBtnMobile.contains(event.target)) {
            popupWindow.classList.remove('active');
            pageContent.classList.remove('hidden');
        }
    });
});
