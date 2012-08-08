<? // main gallery page where you can page through the thumbs of all pictures
?>
<? include "common.php" ?>
<? $_GET["page"] = ($_GET["page"]) ? $_GET["page"] : 1; ?>
<? $pictures_per_page = 36; ?>
<? $pictures = paginated_pictures($pictures_per_page, $_GET["page"]); ?>
<? $title = "Your title here"; ?>
<html>
    <head>
      <title><?= $title ?></title>
      <link type="text/css" rel="stylesheet" href="css/index.css" media="screen"/>
    </head>
    <body>
        <div id="header"><p><?= $title ?></p></div>
        <div id="pictures">
          <?= generate_page_navigation($pictures_per_page, $_GET["page"]) ?>
          <? foreach ($pictures as $picture) { ?>
            <div class="picture-container1">
                <div class="picture-container">
                    <div class="img-container">
                       <a href="<?= picture_link($picture) ?>">
                           <img src="<?= picture_thumb($picture) ?>"/>
                       </a>
                    </div>
                </div>
            </div>
          <? } ?>
          <div id="bottom">
            <?= generate_page_navigation($pictures_per_page, $_GET["page"]) ?>
          </div>
        </div>
    </body>
</html>
