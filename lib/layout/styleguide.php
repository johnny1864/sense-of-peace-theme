<?php if (!is_user_logged_in()) {
	auth_redirect();
	exit;
}
get_header();
?>
<div class="styleguide">
	<?php get_template_part('lib/layout/flexible'); ?>
</div>

<?php get_footer(); ?>