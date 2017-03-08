<?php

	$userID = bp_displayed_user_id();
	$currentUserBadgeList = badgeos_get_user_earned_achievement_ids($userID, 'badges');

	$htmlTemplateBadge = '';

$htmlTemplateBadge .=
'<div class="vc_row wpb_row vc_row-fluid">
	<div class="wpb_column vc_column_container vc_col-sm-12">
		<div class="wpb_wrapper">
			<div class="stm_featured_products_unit featured_products_list">
				<div class="row">';

					foreach ($currentUserBadgeList as $badgeId) {

							$badgePost = get_post($badgeId);
							$badgeImage = '';

							if (has_post_thumbnail($badgeId)) {
								$badgeImage = wp_get_attachment_image_src( get_post_thumbnail_id( $badgeId ), 'single-post-thumbnail' );
							}

						$htmlTemplateBadge .=
						'<div class="col-md-3 col-sm-4 col-xs-12">
							<div class="stm_featured_product_single_unit heading_font">
								<div class="stm_featured_product_single_unit_centered">
									<div class="stm_featured_product_image">
										<a href="#TODO" title="TODO">
											<img width="270" height="283" src="'. $badgeImage[0].'" class="img-responsive wp-post-image" alt="Business round table. Flat design vector illustration." />									
										</a>
									</div>
									
									<div class="stm_featured_product_body">
										<a href="#TODO"  title="TODO">
											<div class="title">' . $badgePost->post_title . '</div>
										</a>
										<div class="expert">&nbsp;</div>
									</div>
								
									<div class="stm_featured_product_footer">
										<div class="clearfix">
											<div class="pull-left">
												<div class="stm_featured_product_stock">
													<i class="fa-icon-stm_icon_user"></i><span>0</span>
												</div>
											</div>
										</div>
									
										<div class="stm_featured_product_show_more">
											<a class="btn btn-default" href="#" title="View more">View more</a>
										</div>
									</div>
								</div>
							</div>
						</div>';
					}

$htmlTemplateBadge .= '
				</div> <!-- row -->
			</div> <!-- stm_featured_products_unit -->
		</div>
	</div>
</div>';

echo $htmlTemplateBadge;