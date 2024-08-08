
<?php
// récupere les infos : image mise en avant(thumbnail_url), url du post, titre, categorie, réf
$thumbnail_url = get_the_post_thumbnail_url();
$post_url = get_permalink();
$photo_reference = get_post_meta(get_the_ID(), 'reference', true);
$categories = get_the_terms(get_the_ID(), 'categorie'); ?>




<div class="photos">

    
</div>

