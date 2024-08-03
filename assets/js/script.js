document.addEventListener('DOMContentLoaded', function () {
    
    console.log('test script loaded');
    // Declaration de variables
    let burgerBtn = document.querySelector('.burger-menu');
    let menuContent = document.querySelector('.nav');
    let contactLink = document.getElementById('contactBtn');
    let contactBtn = document.getElementById('single-page-contact');
    let popupWindow = document.querySelector('.contact-popup');
    let popup = document.querySelector('.popup-wrapper');
    let pageContent = document.querySelector('.page-content');
    let overlay = document.querySelector('.popup-overlay');
    
    
    
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
    
    contactLink.addEventListener('click', function () {
        menuContent.classList.remove('active');
        burgerBtn.classList.remove('open');
        document.body.classList.remove('lock');
        popupWindow.classList.add('active');
    });
    
    
    overlay.addEventListener('click', function () {
        popupWindow.classList.remove('active');
    });
    //propritété de l'element = fonction si null 0 propriete 
    //si n'est pas null
    if (contactBtn)  {        
            contactBtn.addEventListener('click', function () {
                popupWindow.classList.add('active');
                
                // Ensure the button has the dataset attribute
                
                const photoReference = contactBtn.dataset.photoRef;
                const photoRefField = document.getElementById('photoReference');
                
                // Check if both the reference and the field are available
                if (photoReference && photoRefField) {
                    photoRefField.value = photoReference;
                    
                }
            });   
        }

        // Prevent closing the popup when clicking inside the form
        popup.addEventListener('click', function (event) {
            event.stopPropagation(); // This prevents the event from bubbling up to the overlay
        });
    
});