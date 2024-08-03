jQuery(document).ready(function($) {
    // Global variables to store the current filter criteria and loading state
    var currentCategorie = '';
    var currentFormat = '';
    var currentYear = '';
    var offset = 0;
    var loading = false; // Flag to prevent multiple AJAX requests

    // Function to load photos
    function loadPhotos(data, append = false) {
        if (loading) return; // Prevent multiple simultaneous AJAX requests
        loading = true;

        $.ajax({
            url: myAjax.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function(response) {
                loading = false; // Reset the loading flag after successful request

                if (response.success) {
                    const photos = response.data;
                    let photoHtml = '';

                    photos.forEach(photo => {
                        photoHtml += `
                            <div class="photo-thumbnail">
                                <a href="${photo.permalink}">
                                    <img src="${photo.thumbnail}" alt="${photo.title}">
                                </a>
                                <p>${photo.title}</p>
                                <p>${currentCategorie}</p> 

                            </div>
                        `;
                    });

                    if (append) {
                        $('#photo-container').append(photoHtml);
                    } else {
                        $('#photo-container').html(photoHtml);
                    }

                    // Update the offset after loading more photos
                    offset += photos.length;

                    // Show or hide the load more button
                    if (photos.length > 0) {
                        $('#load-more').show();
                    } else {
                        $('#load-more').hide(); // Hide button if no more photos
                    }
                } else {
                    $('#photo-container').html('<p>No photos found.</p>');
                    $('#load-more').hide(); // Hide button if no photos
                }
            },
            error: function() {
                loading = false; // Reset the loading flag on error
                $('#photo-container').html('<p>An error occurred.</p>');
            }
        });
    }

    // Initial load of photos
    loadPhotos({
        action: 'load_photos',
        nonce: myAjax.nonce
    });

    // Handle filter changes
    $('#filter-form select').change(function() {
        currentCategorie = $('#categorie').val();
        currentFormat = $('#format').val();
        currentYear = $('#year').val();

        // Reset offset and load photos with new filters
        offset = 0;
        loadPhotos({
            action: 'load_photos',
            categorie: currentCategorie,
            format: currentFormat,
            year: currentYear,
            nonce: myAjax.nonce
        });
    });

    // Handle load more button click
    $('#load-more').click(function() {
        var nonce = $(this).data('nonce');

        var data = {
            action: 'load_photos',
            nonce: nonce,
            offset: offset,
            categorie: currentCategorie,
            format: currentFormat,
            year: currentYear
        };

        loadPhotos(data, true);
    });
});



