<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php /* This place is reserved to add all you Open Graph */ ?>

        <meta property="og:url"           content="<?php echo WP_HOME.$_SERVER['REQUEST_URI']; ?>" />
        <meta property="og:type"          content="website" />
        <?php if(strpos($_SERVER['REQUEST_URI'],'badges') !== false){
            global $badgeImage, $currentBadgePost;
            ?>
            <meta property="og:title"         content="<?php echo $currentBadgePost->post_title; ?>" />
            <meta property="og:description"   content="<?php echo $currentBadgePost->post_content ?:'';?>" />
            <meta property="og:image"         content="<?php echo $badgeImage ?:get_stylesheet_directory_uri().'/assets/img/default-badge-image.png'; ?>" />
        <?php }else{ ?>
            <meta property="og:title"         content="<?php echo get_the_title(); ?>" />
            <meta property="og:description"   content="Pour les enseignants et les enseignantes désirant s’engager dans une démarche active de développement professionnel, la plateforme de formation continue du CADRE21 procure des occasions d’apprentissages personnalisés. Elle permet une reconnaissance efficace des compétences au moyen de badges numériques reconnus." />
            <meta property="og:image"         content="https://www.cadre21.org/app/themes/cadre21/assets/images/logo-cadre21.png" />
        <?php } ?>
    <?php /* End of Open Graph */ ?>



    <?php wp_head(); ?>

    <?php /* This place is reserved to add the GA tracking @Todo: add a possibility to modify the GA tracking from the theme configuration */ ?>
        <script></script>
    <?php /* END of GA zone */ ?>

</head>