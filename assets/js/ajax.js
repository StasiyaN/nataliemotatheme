jQuery(document).ready(function($) {
    function handleCustomDropdown() {
        document.querySelectorAll('.dropdown').forEach(function (dropdownWrapper) {
            const dropDownBtn = dropdownWrapper.querySelector('.dropdown-btn');
            const dropDownList = dropdownWrapper.querySelector('.dropdown-list');
            const dropDownListItems = dropDownList.querySelectorAll('.dropdown-list-item');
            const inputVal = dropdownWrapper.querySelector('.option-val');

                dropDownBtn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                dropDownList.classList.toggle('dropdown-open');
                if(dropDownList.classList.contains('dropdown-open')) {
                    dropDownBtn.classList.add('up');
                } else {
                    dropDownBtn.classList.remove('up');
                }
            }); 

         dropDownListItems.forEach(function (listItem) {
                listItem.addEventListener('click', function (e) {
                    e.stopPropagation();                    
                    // Set the button text to the selected item
                    dropDownBtn.innerText = this.innerText;
                    // Close the dropdown list
                    dropDownList.classList.remove('dropdown-open');
                    dropDownBtn.classList.remove('up');
                    // Set the hidden input value to the selected item's data-value
                    inputVal.value = this.dataset.value;
                    dropDownListItems.forEach(item => item.classList.remove('clicked'));
                    this.classList.add('clicked');
    
                    // Reset the offset and reload photos
                    loadPhotos();
                });
            });

            document.addEventListener('click', function (e) {
                if (e.target !== dropDownBtn) {
                    dropDownList.classList.remove('dropdown-open');
                }
            });
        });
    }



    let offset = 0;

    function loadPhotos() {
        //value input from custom filters
        const categorie = $('input[name="categorie"]').val(); // Use hidden input value
        const format = $('input[name="format"]').val();     // Use hidden input value
        const sort = $('input[name="sort"]').val();   

        $.ajax({
            url: myAjax.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'filter_photos',
                security: myAjax.nonce,
                categorie: categorie,
                format: format,
                sort: sort,
                offset: offset,
            },
            success: function(response) {
                if (response.success) {
                    const newPhotos = response.data.photos;
                    
                    // Debugging output
                    console.log('Photos loaded:', newPhotos.length);
    
                    // Check if there are no more photos to load
                    if (newPhotos.length < 8) {
                        $('#load-more').hide(); // Hide load-more button if fewer than 8 photos are returned
                    } else {
                        $('#load-more').show(); // Ensure the load-more button is visible when there are more photos to load
                    }
    
                    if (offset === 0) {
                        $('.photos').html(generatePhotosHtml(newPhotos));
                    } else {
                        $('.photos').append(generatePhotosHtml(newPhotos));
                    }
                } else {
                    console.log('No photos found for the current filters');
                    $('.photos').html('<p>Aucune photo correspondante</p>');
                    $('#load-more').hide(); // Hide load-more button if no photos match the filter
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    }

    function loadRelatedPhotos(mainPhotoId) {
        console.log('Loading related photos for mainPhotoId:', mainPhotoId); // Debugging line
       
        $.ajax({
            url: myAjax.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'load_related_photos',
                security: myAjax.nonce,
                main_photo_id: mainPhotoId,
            },
            success: function(response) {
                if (response.success) {
                    console.log('Related photos loaded:', response.data.related_photos.length); // Debugging line
                    $('.photo-single-unit').html(generateRelatedPhotosHtml(response.data.related_photos));
                } else {
                    $('.photo-single-unit').html('<p>No related photos found.</p>');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    }


        // Get main photo ID from data attribute and load related photos
        const mainPhotoId = $('.photo-block').data('main-single-id');
        if (mainPhotoId) {
            loadRelatedPhotos(mainPhotoId);
        }
    function fetchAllPhotos() {
        $.ajax({
            url: myAjax.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'fetch_all_photos',
                security: myAjax.nonce
            },
            success: function(response) {
                if (response.success) {
                    window.allPhotos = response.data.all_photos || []; // Store all photos
                    console.log('All photos fetched and stored:', window.allPhotos);
                    // Initialize lightbox with all photos
                    window.initializeLightbox(window.allPhotos);
                } else {
                    console.log(response.data.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    }

    function generatePhotosHtml(photos) {
        let photosHtml = '';
        photos.forEach(photo => {
            photosHtml += `<div class="photo-item" data-ref="${photo.ref}">
                <img src="${photo.src}" alt="${photo.title}">
                <div class="return-info">
                    <p class="return-title">${photo.title}</p>
                    <p class="return-ref">${photo.ref}</p>
                    <p class="return-cat">${photo.categorie.join(', ')}</p>
                    <a href="${photo.url}" class="view-photo"><i class="fa fa-eye"></i></a>
                    <i class="fa-solid fa-expand show-full"></i>
                </div>
            </div>`;
        });
        return photosHtml;
    }

    function generateRelatedPhotosHtml(relatedPhotos) {
        let relatedPhotosHtml = '';
        relatedPhotos.forEach(photo => {
            relatedPhotosHtml += `<div class="photo-item" data-ref="${photo.ref}">
                <img src="${photo.src}" alt="${photo.title}">
                <div class="return-info">
                    <p class="return-title">${photo.title}</p>
                    <p class="return-ref">${photo.ref}</p>
                    <p class="return-cat">${photo.categorie.join(', ')}</p>
                    <a href="${photo.url}" class="view-photo"><i class="fa fa-eye"></i></a>
                    <i class="fa-solid fa-expand show-full"></i>
                </div>
            </div>`;
        });
        return relatedPhotosHtml;
    }

    $('#filter-form select').change(function(){
        offset = 0;
        loadPhotos();
    });

    $('#load-more').click(function() {
        offset += 8;
        loadPhotos();
    });

    // Initial load
    loadPhotos();

  
    
    // Fetch all photos for lightbox
    fetchAllPhotos();

    //custom filters
    handleCustomDropdown();

});
