<?php get_header(); ?>
<header class="header-category">
<div class="navbar menubar">
<h1><a href="<?php echo home_url( '/' ); ?>">Pantera Restaurant</a></h1>
<div class="menu"><?php wp_nav_menu( array( 'theme_location' => 'main' ) ); ?></div>
</div>
<div class="first-title">
    <p>The Chef's selection</p>
    <p class="upp"> RECIPES BLOG </p>
</div>
<div class="left-bars">
    <div class="bars bars-1"></div>
    <div class="bars bars-2"></div>
    <div class="bars bars-3"></div>
    <div class="bars bars-4"></div>
</div>
<div class="subtitle">
<div class="white-bar"></div><a href="#"> check our menu </a>
</div>

</header>

<div class="bg">

<div class="main container home">

<div class="color">
<?php $cuisines = get_terms(['taxonomy' => 'cuisine']); ?>

<ul class="nav nav-pills my-6">
    <?php foreach($cuisines as $cuisine): ?>
		 <li class="nav-item d-flex justify-content-center">
			 <img src="<?php echo get_template_directory_uri(); ?>/svg/cutelry.svg" alt="" style="width: 15px;margin-right: 5px;">
		<a href="<?= get_term_link($cuisine) ?>" class="nav-link <?= is_tax('cuisine', $cuisine->term_id) ? 'active' : '' ?>"><?= $cuisine->name ?></a>
		
    </li>
    <?php endforeach; ?>
</ul></div>


<?php

$category = get_the_category();

$subCat;
foreach($category as $cat): 
	if($cat->parent != 0):
		$subCat = $cat;
	endif;	
endforeach;

$args = array(
	'post_type'   => 'post',
	'category__in' => array( $subCat->term_id ),
	'nopaging'       => true
	);
	
	$the_query = new WP_Query( $args );

$i=0; if( $the_query->have_posts() ) : while( $the_query->have_posts() ) : $the_query->the_post();

	if ($i==0){ $i++;


	?>

    <div class="main container">
    <div class="row border">
	 <div class="col-lg-7 col-md-12 col-sm-12 reset"><?php the_post_thumbnail("post-thumbnail", ["class" => "card-img", "alt" => "", "style" => "height: auto;"
    ]) ?> </div>
	<div class="col-lg-5 col-md-12 col-sm-12 reset main-content card-body">
	<i class="far fa-clock"></i> <?php the_time( get_option( 'date_format' ) ); ?> 
	</p>
	<article class="post-t"><div class="d-flex align-items-center"> <img src="<?php echo get_template_directory_uri(); ?>/svg/cutelry.svg" alt="" style="width: 15px;margin-right: 5px;"><?php the_category() ?></div>
		<h5 class="card-title"><?php the_title(); ?></h5>
            
			<p class="card-text">
			<?php echo get_field('banner_top')['text'] ?>
		<p class="d-flex justify-content-center">
                <a href="<?php the_permalink(); ?>" class="post__link"><button type="button" class="btn btn-dark">Read more</button></a>
            </p>
		</article>
  </div>
</div>
 </div>
<?php } 
else{?><div class="main container">
    <div class="row border">
	 
	<div class="col-lg-5 col-md-12 col-sm-12 reset main-content card-body">
	<i class="far fa-clock"></i> <?php the_time( get_option( 'date_format' ) ); ?> 
	</p>
	<article class="post-t"><div class="d-flex align-items-center"> <img src="<?php echo get_template_directory_uri(); ?>/svg/cutelry.svg" alt="" style="width: 15px;margin-right: 5px;"><?php the_category() ?></div>
		<h5 class="card-title"><?php the_title(); ?></h5>
            
			<p class="card-text">
			<?php echo get_field('banner_top')['text'] ?>
		<p class="d-flex justify-content-center">
                <a href="<?php the_permalink(); ?>" class="post__link"><button type="button" class="btn btn-dark">Read more</button></a>
            </p>
		</article>
  </div>
  <div class="col-lg-7 col-md-12 col-sm-12 reset"><?php the_post_thumbnail("post-thumbnail", ["class" => "card-img", "alt" => "", "style" => "height: auto;"
    ]) ?> </div>
</div>
 </div>
<?php $i=0;
}
?>
	<?php endwhile; endif; ?>

	</div>

<?php include("menuoverview.php"); ?>



<?php get_footer(); ?>
