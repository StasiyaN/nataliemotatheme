document.addEventListener('DOMContentLoaded', function () {
    console.log('script loaded');
    //creation du scri^pt pout le popup
    //declaration des variables
    let contactBtn = document.getElementById('contactBtn');
    let popupWindow = document.querySelector('.contact-popup');
    let popup = document.querySelector('.popup-wrapper');
    //let popupOverlay = document.querySelector('.popup-overlay');
    let pageContent = document.querySelector('.page-content');



    console.log(contactBtn);
    console.log(popupWindow);

    console.log(pageContent);
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
        popupWindow.classList.toggle('active');
       //popupOverlay.classList.add('active');
        pageContent.classList.toggle('hidden');
    });

    popupWindow.addEventListener('click', function (event) {
   
            popupWindow.classList.remove('active');
            pageContent.classList.remove('hidden');
        
    });

    // Prevent click inside the popup from closing it
    popup.addEventListener('click', function (event) {
        event.stopPropagation();
    });

  
    
    // popupOverlay.addEventListener('click', function () {
    //     popupWindow.classList.remove('active');
    //    // popupOverlay.classList.remove('active');
    //     pageContent.classList.remove('hidden');
    // });
});
