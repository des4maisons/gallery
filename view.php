<?
// the full-size view of the pictures
include "common.php";
$picture = picture_from_REQUEST();
?>
<html>
    <title><?= $picture ?></title>
    <head>
        <link type="text/css" rel="stylesheet" href="css/full.css" media="screen"/>
    </head>
    <body>
        <form>
            <div class="picture-container">
                <ul>
                    <li>
                        <? $prev = picture_prev($picture); ?>
                        <? if ($prev) { ?>
                          <a href="<?= $prev ?>">&lt; previous</a>
                        <? } else { ?>
                          &lt; previous
                        <? } ?>
                    </li>
                    <li>
                        <a href=".">all</a>
                    </li>
                    <li>
                        <? $next = picture_next($picture); ?>
                        <? if ($next) { ?>
                          <a href="<?= $next ?>">next &gt;</a>
                        <? } else { ?>
                          next &gt;
                        <? } ?>
                    </li>
                </ul>
                <img src="<?= picture_src($picture) ?>"></img>
            </div>
        </form>
    </body>
</html>
