document.addEventListener('DOMContentLoaded', function(){
    console.log('DOM Loaded');

    jQuery(document).ready(function($) {
        let offset = 0;
    
        function loadPhotos(initialLoad = false) {
            const category = $('#categorie').val();
            const format = $('#format').val();
            const sort = $('#sort').val();
    
            $.ajax({
                url: ajax_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'filter_photos',
                    category: category,
                    format: format,
                    sort: sort,
                    offset: offset,
                },
                success: function(response) {
                    if (initialLoad) {
                        $('.photo-container').html(response);
                    } else {
                        $('.photo-container').append(response);
                    }
                }
            });
        }
    
        $('#categorie, #format, #sort').change(function() {
            offset = 0;
            loadPhotos(true);
        });
    
        $('#load-more').click(function() {
            offset += 8;
            loadPhotos();
        });
    
        // Initial load
        loadPhotos(true);
    });
    
});