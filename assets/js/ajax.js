jQuery(document).ready(function($) {
    let offset = 0;
    let allPhotos = []; // Array to store all response data

    function loadPhotos() {
        const categorie = $('#categorie').val();
        const format = $('#format').val();
        const sort = $('#sort').val();

        $.ajax({
            url: myAjax.ajax_url,
            type: 'POST',
            dataType: 'json', // Specify that we expect JSON data
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
                    if (offset === 0) {
                        allPhotos = response.data.photos; // Store the response data
                        $('.photos').html(generatePhotosHtml(response.data.photos));
                    } else {
                        allPhotos = allPhotos.concat(response.data.photos); // Append the response data
                        $('.photos').append(generatePhotosHtml(response.data.photos));
                    }
                } else {
                    console.log(response.data.message);
                }
            }
        });
    }

    function loadRelatedPhotos(mainPhotoId) {
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
                    $('.photo-single-unit').html(generateRelatedPhotosHtml(response.data.related_photos));
                } else {
                    $('.photo-single-unit').html('<p>No related photos found.</p>');
                }
            }
        });
    }

    function generatePhotosHtml(photos) {
        let photosHtml = '';
        photos.forEach(photo => {
            photosHtml += `<div class="photo-item">
                <img src="${photo.src}" alt="${photo.title}">
                <p>${photo.title}</p>
                <p> ${photo.ref}</p>
                <p>${photo.categorie.join(', ')}</p>
                <a href="${photo.url}" class="view-photo"><i class="fa fa-eye"></i></a>
                <i class="fa-solid fa-expand"></i>
            </div>`;
        });
        return photosHtml;
    }

    function generateRelatedPhotosHtml(relatedPhotos) {
        let relatedPhotosHtml = '';
        relatedPhotos.forEach(photo => {
            relatedPhotosHtml += `
                <div class="related-photo">
                       <img src="${photo.src}" alt="${photo.title}">
                    <p>${photo.title}</p>
                    <p> ${photo.ref}</p>
                    <p>${photo.categorie.join(', ')}</p>
                    <a href="${photo.url}" class="view-photo"><i class="fa fa-eye"></i></a>
                    <i class="fa-solid fa-expand"></i>
                </div>
                `;
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

    // Get main photo ID from data attribute and load related photos
    const mainPhotoId = $('.photo-block').data('main-single-id');
    loadRelatedPhotos(mainPhotoId);
});
