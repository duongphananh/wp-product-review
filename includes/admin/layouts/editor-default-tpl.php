<?php
/**
 *  Editor Metabox layout for post page.
 *
 * @package     WPPR
 * @subpackage  Layouts
 * @copyright   Copyright (c) 2017, Bogdan Preda
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       3.0.0
 */

$review = $model->review;
$check  = $review->is_active() ? 'yes' : 'no';
?>
<p class="wppr-active wppr-<?php echo $check; ?>">
	<label for="wppr-review-yes"><?php _e( 'Is this a review post ?', 'wp-product-review' ); ?> </label>
	<?php
	echo $html_helper->radio( array(
		'name'    => 'wppr-review-status',
		'id'      => 'wppr-review-yes',
		'class'   => 'wppr-review-status',
		'value'   => 'yes',
		'current' => $check,
	) );
	?>
	<label for="wppr-review-no"><?php _e( 'Yes', 'wp-product-review' ); ?></label>
	<?php
	echo $html_helper->radio( array(
		'name'    => 'wppr-review-status',
		'id'      => 'wppr-review-no',
		'class'   => 'wppr-review-status',
		'value'   => 'no',
		'current' => $check,
	) );
	?>
	<label for="wppr-review-no"><?php _e( 'No', 'wp-product-review' ); ?></label>

</p>
<div class="wppr-review-editor " id="wppr-meta-<?php echo $check; ?>">

	<?php do_action( 'wppr_editor_before', $model->post ); ?>
	<div class="wppr-review-details wppr-review-section">
		<h4><?php _e( 'Product Details', 'wp-product-review' ); ?></h4>
		<p><?php _e( 'Specify the general details for the reviewed product.', 'wp-product-review' ); ?></p>
		<?php do_action( 'wppr_editor_details_before', $model->post ); ?>
		<div class="wppr-review-details-fields wppr-review-fieldset">
			<ul>
				<li>
					<label for="wppr-editor-product-name"><?php _e( 'Product Name', 'wp-product-review' ); ?></label>
					<?php
					echo $html_helper->text( array(
						'name'        => 'wppr-editor-product-name',
						'value'       => $review->get_name(),
						'placeholder' => __( 'Product name', 'wp-product-review' ),
					) );
					?>
				</li>
				<li>
					<label for="wppr-editor-product-image"><?php _e( 'Product Image', 'wp-product-review' ); ?></label>
					<?php
					echo $html_helper->image( array(
						'name'   => 'wppr-editor-image',
						'value'  => $review->get_image(),
						'action' => __( 'Choose or Upload an Image', 'wp-product-review' ),
					) )
					?>
					<small>
						*<?php _e( 'If no image is provided, featured image is used', 'wp-product-review' ); ?></small>
				</li>
				<li>
							<span><?php _e( 'Product Image Click', 'wp-product-review' ); ?>
								: </span>
					<?php
					echo $html_helper->radio( array(
						'name'    => 'wppr-editor-link',
						'id'      => 'wppr-editor-link-show',
						'class'   => 'wppr-editor-link',
						'value'   => 'image',
						'current' => $model->get_value( 'wppr-editor-link' ),
					) );
					?>
					<label for="wppr-editor-link-show"><?php _e( 'Show Whole Image', 'wp-product-review' ); ?></label>
					<?php
					echo $html_helper->radio( array(
						'name'    => 'wppr-editor-link',
						'id'      => 'wppr-editor-link-open',
						'class'   => 'wppr-editor-link',
						'value'   => 'link',
						'current' => $model->get_value( 'wppr-editor-link' ),
					) );
					?>
					<label for="wppr-editor-link-open"><?php _e( 'Open Affiliate link', 'wp-product-review' ); ?> </label>

				</li>
				<?php
				$links = $review->get_links();
				?>
				<li>
					<label for="wppr-editor-button-text"><?php _e( 'Affiliate Button Text', 'wp-product-review' ); ?> </label>
					<?php
					echo $html_helper->text( array(
						'name'        => 'wppr-editor-button-text',
						'value'       => $model->get_value( 'wppr-editor-button-text' ),
						'placeholder' => __( 'Affiliate Button Text', 'wp-product-review' ),
					) );
					?>
				</li>
				<li>
					<label for="wppr-editor-button-link"><?php _e( 'Affiliate Link', 'wp-product-review' ); ?> </label>
					<?php
					echo $html_helper->text( array(
						'name'        => 'wppr-editor-button-link',
						'value'       => $model->get_value( 'wppr-editor-button-link' ),
						'placeholder' => __( 'Affiliate Link', 'wp-product-review' ),
					) );
					?>
					<?php if ( count( $links ) < 2 ) : ?>
						<a id="wppr-editor-new-link"
						   title="<?php _e( 'Add new link', 'wp-product-review' ); ?>">+
						</a>
					<?php endif; ?>
				</li>
				<?php if ( count( $links ) < 2 ) { ?>
					<li class="hidden_fields" style="display: none;">
						<label for="wppr-editor-button-text"><?php _e( 'Affiliate Button Text', 'wp-product-review' ); ?> </label>
						<?php
						echo $html_helper->text( array(
							'name'        => 'wppr-editor-button-text-2',
							'value'       => $model->get_value( 'wppr-editor-button-text-2' ),
							'placeholder' => __( 'Affiliate Button Text', 'wp-product-review' ),
						) );
						?>
					</li>
					<li class="hidden_fields" style="display: none;">
						<label for="wppr-editor-button-link"><?php _e( 'Affiliate Link', 'wp-product-review' ); ?> </label>
						<?php
						echo $html_helper->text( array(
							'name'        => 'wppr-editor-button-link-2',
							'value'       => $model->get_value( 'wppr-editor-button-link-2' ),
							'placeholder' => __( 'Affiliate Link', 'wp-product-review' ),
						) );
						?>
					</li>
					<?php
} ?>
				<?php
				if ( ! empty( $links ) ) {
					if ( count( $links ) > 1 ) {
						$i = 1;
						foreach ( $links as $text => $url ) {
							if ( $i > 1 ) {
								?>
								<li>
									<label for="wppr-editor-button-text-<?php $i; ?>"><?php echo __( 'Affiliate Button Text', 'wp-product-review' ) . ' ' . $i; ?> </label>
									<?php
									echo $html_helper->text( array(
										'name'        => 'wppr-editor-button-text-' . $i,
										'value'       => $text,
										'placeholder' => __( 'Affiliate Button Text', 'wp-product-review' ) . ' ' . $i,
									) );
									?>
								</li>
								<li>
									<label for="wppr-editor-button-link-<?php $i; ?>"><?php echo __( 'Affiliate Link', 'wp-product-review' ) . ' ' . $i; ?> </label>
									<?php
									echo $html_helper->text( array(
										'name'        => 'wppr-editor-button-link-' . $i,
										'value'       => $url,
										'placeholder' => __( 'Affiliate Link', 'wp-product-review' ) . ' ' . $i,
									) );
									?>
								</li>
								<?php
							}
							$i ++;
						}
					}
				}
				?>

				<li>
					<label for="wppr-editor-price"><?php _e( 'Product Price', 'wp-product-review' ); ?> </label>
					<?php
					echo $html_helper->text( array(
						'name'        => 'wppr-editor-price',
						'value'       => $review->get_price(),
						'placeholder' => __( 'Product Price', 'wp-product-review' ),
					) );
					?>
				</li>

			</ul>
		</div>
		<?php do_action( 'wppr_editor_details_after', $model->post ); ?>
	</div><!-- end .review-settings-notice -->
	<div class="wppr-review-options  wppr-review-section">
		<h4><?php _e( 'Product Options', 'wp-product-review' ); ?></h4>
		<p><?php _e( 'Insert your options and their grades. Grading must be done from 0 to 100.', 'wp-product-review' ); ?></p>
        <?php
        if ( $model->wppr_get_option( 'cwppos_show_poweredby' ) === 'yes' || class_exists( 'WPPR_Pro' ) || function_exists( 'wppr_ep_js_preloader' ) ) { ?>
        <a href="#" class="preload_info"><?php _e( 'Preload Info', 'cwppos' ); ?></a>
        <?php
        } else {
            echo __( ' In order to be able to automatically load your options from another posts, you need the PRO add-on', 'cwppos' ) . '<a href="http://bit.ly/2bpC3vT" target="_blank" class="preload_info_upsell">' . __( 'View Preload features','cwppos' ) . '</a>';
        } ?>
		<?php do_action( 'wppr_editor_options_before', $model->post ); ?>
		<div class="wppr-review-fieldset wppr-review-options-fields">
			<ul class="wppr-review-options-list clear">
				<?php
				$options_nr = $model->wppr_get_option( 'cwppos_option_nr' );
				for ( $i = 1; $i <= $options_nr; $i ++ ) {
					?>
					<li>
						<label for="wppr-editor-options-text-<?php echo $i; ?>"><?php echo $i; ?></label>
						<?php
						echo $html_helper->text( array(
							'name'        => 'wppr-editor-options-name[]',
							'id'          => 'wppr-editor-options-name-' . $i,
							'value'       => $model->get_value( 'wppr-option-name-' . $i ),
							'placeholder' => __( 'Option', 'wp-product-review' ) . ' ' . $i,
						) );
						echo $html_helper->text( array(
							'name'        => 'wppr-editor-options-value[]',
							'id'          => 'wppr-editor-options-value-' . $i,
							'class'       => 'wppr-text wppr-option-number',
							'value'       => $model->get_value( 'wppr-option-value-' . $i ),
							'placeholder' => __( 'Grade', 'wp-product-review' ),
						) );
						?>
					</li>
					<?php
				}
				?>
			</ul>
		</div>
		<?php do_action( 'wppr_editor_options_after', $model->post ); ?>

	</div>
	<div class="wppr-review-pros  wppr-review-section">
		<h4><?php _e( 'Pro Features', 'wp-product-review' ); ?></h4>
		<p><?php _e( 'Insert product\'s pro features below.', 'wp-product-review' ); ?></p>

		<?php do_action( 'wppr_editor_pros_before', $model->post ); ?>
		<div class="wppr-review-fieldset wppr-review-pros-fields">
			<ul class="wppr-review-options-list clear">
				<?php
				$options_nr = $model->wppr_get_option( 'cwppos_option_nr' );
				$pros       = $review->get_pros();
				for ( $i = 1; $i <= $options_nr; $i ++ ) {
					?>
					<li>
						<label for="wppr-editor-pros-<?php echo $i; ?>"><?php echo $i; ?></label>
						<?php
						echo $html_helper->text( array(
							'name'        => 'wppr-editor-pros[]',
							'id'          => 'wppr-editor-pros-' . $i,
							'value'       => isset( $pros[ $i - 1 ] ) ? $pros[ $i - 1 ] : '',
							'placeholder' => __( 'Option', 'wp-product-review' ) . ' ' . $i,
						) );
						?>
					</li>
					<?php
				}
				?>
			</ul>
		</div>
		<?php do_action( 'wppr_editor_pros_after', $model->post ); ?>
	</div>
	<div class="wppr-review-cons  wppr-review-section">
		<h4><?php _e( 'Cons Features', 'wp-product-review' ); ?></h4>
		<p><?php _e( 'Insert product\'s cons features below.', 'wp-product-review' ); ?></p>
		<?php do_action( 'wppr_editor_cons_before', $model->post ); ?>
		<div class="wppr-review-fieldset wppr-review-cons-fields">
			<ul class="wppr-review-options-list clear">
				<?php
				$options_nr = $model->wppr_get_option( 'cwppos_option_nr' );
				$cons       = $review->get_cons();
				for ( $i = 1; $i <= $options_nr; $i ++ ) {
					?>
					<li>
						<label for="wppr-editor-cons-<?php echo $i; ?>"><?php echo $i; ?></label>
						<?php
						echo $html_helper->text( array(
							'name'        => 'wppr-editor-cons[]',
							'id'          => 'wppr-editor-cons-' . $i,
							'value'       => isset( $cons[ $i - 1 ] ) ? $cons[ $i - 1 ] : '',
							'placeholder' => __( 'Option', 'wp-product-review' ) . ' ' . $i,
						) );
						?>
					</li>
					<?php
				}
				?>
			</ul>
		</div>
		<?php do_action( 'wppr_editor_cons_after', $model->post ); ?>
	</div>

	<br class="clear">

	<?php if ( ! shortcode_exists( 'P_REVIEW' ) ) :  ?>
		<label> You can use the shortcode <b>[P_REVIEW]</b> to show a review you already made or
			<b>[wpr_landing]</b> to display a comparision table of them. The shortcodes are available on the <a
					target="_blank" href="http://bit.ly/2bpKIlP">Pro Bundle</a><br/><br/></label>
	<?php endif; ?>

	<?php do_action( 'wppr_editor_after', $model->post ); ?>
</div>
