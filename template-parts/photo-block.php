<?php 
    $thumbnail_url = get_the_post_thumbnail_url('large');
?>

<div class="photo-apparente">
<img src="<?php echo $thumbnail_url;?>" alt="<?php the_title_attribute(); ?>">

</div>