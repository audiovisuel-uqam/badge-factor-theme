<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php /* This place is reserved to add all you Open Graph */ ?>

        <meta property="og:url"           content="<?php echo WP_HOME.$_SERVER['REQUEST_URI']; ?>" />
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="<?php echo get_the_title(); ?>" />
    <?php /* End of Open Graph */ ?>



    <?php wp_head(); ?>

    <?php /* This place is reserved to add the GA tracking @Todo: add a possibility to modify the GA tracking from the theme configuration */ ?>
        <script></script>
    <?php /* END of GA zone */ ?>

</head>