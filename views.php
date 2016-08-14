<?php
session_start();

include_once("functions/montage.php");
include_once("functions/like.php");

$imagePerPages = 5;

$montages = get_montages(0, $imagePerPages);
$more = false;
$lastMontageId = 0;
if ($montages != "" && array_key_exists("more", $montages)) {
  $more = true;
  $lastMontageId = $montages[count($montages) - 2]['id'];
}
?>
<!DOCTYPE html>
<HTML>
  <header>
    <link rel="stylesheet" type="text/css" href="style/views.css">
    <link rel="stylesheet" type="text/css" href="style/modal.css">
    <meta charset="UTF-8">
    <title>CAMAGRU</title>
  </header>
  <body>
    <?php include('fragments/header.php') ?>
    <div id="views">
      <?php
        $gallery = "";
        if ($montages != null && $montages['error'] == null) {
          for ($i = 0; $montages[$i] && $i < $imagePerPages; $i++) {
            $class = "icon";
            if ($montages[$i]['userid'] === $_SESSION['id']) {
              $class .= " removable";
            }
            $comments = get_comments($montages[$i]['img']);
            $j = 0;
            $commentsHTML = "";
            while ($comments[$j] != null) {
              $commentsHTML .= "<span class=\"comment\">" . htmlspecialchars($comments[$j]['username']) .": " . htmlspecialchars($comments[$j]['comment']) . "</span>";
              $j++;
            }
            $gallery .= "
            <div class=\"img\" data-img=\"" . $montages[$i]['img'] . "\">
              <img class=\"" . $class . "\" src=\"montage/" . $montages[$i]['img'] . "\"></img>
              <div id=\"buttons-like\">
                <img class=\"button-like\" src=\"img/up.png\" data-image=\"". $montages[$i]['img'] ."\"></img>
                <span class=\"nb-like\" data-src=\"". $montages[$i]['img'] ."\">" . get_nb_likes($montages[$i]['img']) . "</span>
                <img class=\"button-dislike\" src=\"img/down.png\" data-image=\"". $montages[$i]['img'] ."\"></img>
                <span class=\"nb-dislike\" data-src=\"". $montages[$i]['img'] ."\">" . get_nb_dislikes($montages[$i]['img']) . "</span>
              </div>"
              . $commentsHTML .
            "</div>";
          }
          echo $gallery;
        }
       ?>
     </div>
     <div id="modal">
      <div class="modal-content">
        <div class="modal-header">
          <span class="close">×</span>
        </div>
        <div class="modal-body">
          <img id="img-modal"></img>
        </div>
        <div class="modal-footer">
          <textarea <?php if (!$_SESSION['id']) echo "disabled" ?> id="comment" placeholder="Comment..." rows="5" cols="50" maxlength="255"></textarea>
          <div <?php if (!$_SESSION['id']) echo "disabled=\"true\"" ?> id="send-comment" class="button-send <?php if (!$_SESSION['id']) echo "disabled" ?>">Send</div>
        </div>
      </div>
    </div>
    <?php if ($more == true) { ?>
    <div id="load-more" onclick="loadMore(<?php echo($lastMontageId) ?>, <?php echo($imagePerPages) ?>)">... LOAD MORE</div>
    <?php } ?>
    <?php include('fragments/footer.php') ?>
  </body>
  <script type="text/javascript" src="js/modal.js"></script>
  <script type="text/javascript" src="js/like.js"></script>
  <script type="text/javascript" src="js/loadMore.js"></script>
</HTML>
