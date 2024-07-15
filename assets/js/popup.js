document.addEventListener('DOMContentLoaded', function () {
    console.log('script loaded');
    //creation du scri^pt pout le popup
    //declaration des variables
    let contactBtn = document.getElementById('contactBtn');
    let popupWindow = document.querySelector('.contact-popup');
    let popupOverlay = document.createElement('div');

    popupOverlay.classList.add('popup-overlay');
    document.body.appendChild(popupOverlay);
    console.log(contactBtn);
    console.log(popupWindow);
    console.log(popupOverlay);
    //ajout du eventlistent on click

    if (!contactBtn) {
        console.error('Contact button not found');
        return;
    }
    if (!popupWindow) {
        console.error('Popup window not found');
        return;
    }

    contactBtn.addEventListener('click', function () {
        popupWindow.classList.add('active');
        popupOverlay.classList.add('active');
      
       
    });

    popupOverlay.addEventListener('click', function () {
        popupWindow.classList.remove('active');
        popupOverlay.classList.remove('active');
    });
});
