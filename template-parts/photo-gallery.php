<div class="photo-gallery">
 <!-- liste des photos apparentées -->
 <?php

    // Get the URL of the post's featured image (thumbnail)
    $thumbnail_url = get_the_post_thumbnail_url();

    // Get the URL (permalink) of the post
    $post_url = get_permalink();

    // Get the title of the post
    $post_title = get_the_title();

    // Get the value of a custom field named 'reference'
    $reference = get_field('reference');

    // Get the categories associated with the post
    $categories = get_the_terms(get_the_ID(), 'categorie');

    // Check if the post has categories and there are no errors
    if ($categories && !is_wp_error($categories)) {
        // Loop through each category
        foreach ($categories as $categorie) {
            // Get the name of each category and assign it to $categorie_name
            $categorie_name = $categorie->name;
        }
    }
?>
</div>