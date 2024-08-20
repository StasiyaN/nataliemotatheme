jQuery(document).ready(function($) {
    console.log('lightbox ok');
    let currentPhotoIndex = 0;
    
    function openLightbox(ref) {
        if (!window.allPhotos || window.allPhotos.length === 0) return;
        
        const photo = window.allPhotos.find(p => p.ref === ref); // Use all photos for lightbox
        if (!photo) return;
        
        currentPhotoIndex = window.allPhotos.indexOf(photo);
        $('.lightbox-image').attr('src', photo.src);
        $('.lightbox-reference').text(photo.ref || "No reference");
        $('.lightbox-categorie').text(photo.categorie.join(', ') || "Unknown");
        $('.lightbox').fadeIn(); // Show lightbox with fade-in effect
    }
    
    function closeLightbox() {
        $('.lightbox').fadeOut(); // Hide lightbox with fade-out effect
    }
    
    function showNextPhoto() {
        currentPhotoIndex = (currentPhotoIndex + 1) % window.allPhotos.length;
        openLightbox(window.allPhotos[currentPhotoIndex].ref);
    }
    
    function showPreviousPhoto() {
        currentPhotoIndex = (currentPhotoIndex - 1 + window.allPhotos.length) % window.allPhotos.length;
        openLightbox(window.allPhotos[currentPhotoIndex].ref);
    }
    // Event listener for the expand icon to open the lightbox
    $(document).on('click', '.show-full', function() {
        const photoRef = $(this).closest('.photo-item, .related-photo').data('ref'); // Get photo reference
        
        if (window.allPhotos && window.allPhotos.length > 0) {
            openLightbox(photoRef);
        }
    });
    
    $('.lightbox-close').click(closeLightbox);
    $('.lightbox-next').click(showNextPhoto);
    $('.lightbox-prev').click(showPreviousPhoto);
    // Handle click outside the lightbox to close
    $(document).click(function(event) {
        if ($(event.target).closest('.lightbox-container').length === 0 && $(event.target).is('.lightbox')) {
            closeLightbox();
        }
    });
    
    // Function to initialize the lightbox with the photos data
    window.initializeLightbox = function(loadedPhotos) {
        if (Array.isArray(loadedPhotos)) {
            window.allPhotos = loadedPhotos; // Store all photos for the lightbox
        } else {
            console.error('Expected an array of photos, but got:', loadedPhotos);
            window.allPhotos = [];
        }
    };
    
    // Initialize lightbox on page load if `window.allPhotos` is set
    if (window.allPhotos && window.allPhotos.length > 0) {
        window.initializeLightbox(window.allPhotos);
    }
});
