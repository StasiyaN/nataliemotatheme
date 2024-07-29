document.addEventListener('DOMContentLoaded', function () { 
    console.log('script ok');

    // Declaration de variables
    let burgerBtn = document.querySelector('.burger-menu');
    let menuContent = document.querySelector('.nav');
    let contactBtn = document.getElementById('contactBtn');
    let popupWindow = document.querySelector('.contact-popup');
    let popup = document.querySelector('.popup-wrapper');
    let pageContent = document.querySelector('.page-content');
    let singleContact = document.getElementById('single-page-contact');
    let overlay = document.querySelector('.popup-overlay');
    let photoRef = document.getElementById('photoReference');

    console.log(singleContact);

    singleContact.addEventListener('click', function() {
        photoRef.value = singleContact.getAttribute('data-photo-ref');
        popupWindow.classList.add('active');
    });

    overlay.addEventListener('click', function() {
        popupWindow.classList.remove('active');

    });


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

    contactBtn.addEventListener('click', function () {
        menuContent.classList.remove('active');
        burgerBtn.classList.remove('open');
        document.body.classList.remove('lock');

        // Open the popup
        popupWindow.classList.add('active');
    });



    //Prevent click inside the popup from closing it
    popup.addEventListener('click', function (event) {
        event.stopPropagation();
    }); 

});
