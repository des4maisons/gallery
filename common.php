<?

if (isset($_GET["secret_admin_mode"])) {
  setcookie("secret_admin_mode", $_GET["secret_admin_mode"]);
  $_COOKIE["secret_admin_mode"] = $_GET["secret_admin_mode"];
}

// comment out the next line if you are using the "remotely hosted
// pictures" version, below.
$_all_pictures = glob("pictures/*.jpg");

// uncomment this version if pictures are hosted remotely.
// You need to make a list of the remote pictures in
// list.txt, and give a good value to the prefix variable
// which should contain the web path to the pictures dir
// where they are hosted.
/*
function _list_pictures() {
  $pictures = array();
  $f = fopen("list.txt", "r");
  $prefix = "http://pictures.wolever.net/Missionfest2011/";
  while (($line = fgets($f)) !== FALSE) {
    array_push($pictures, $prefix . trim($line));
  }
  fclose($f);
  return $pictures;
}
$_all_pictures = _list_pictures();
*/

function list_pictures() {
  global $_all_pictures;
  return $_all_pictures;
}

function picture_link($picture) {
  return "view.php?picture=$picture";
}

function picture_thumb($picture) {
  return preg_replace("/^(.*)\/([^\/]+)$/", "$1/thumbs/$2", $picture);
}

function picture_src($picture) {
  return $picture;
}

function picture_next($picture) {
  $all_pictures = list_pictures();
  $index = array_search($picture, $all_pictures);
  if ($index >= 0 && $index < (count($all_pictures) - 1))
    return picture_link($all_pictures[$index + 1]);
  return NULL;
}

function picture_prev($picture) {
  $all_pictures = list_pictures();
  $index = array_search($picture, $all_pictures);
  if ($index > 0)
    return picture_link($all_pictures[$index - 1]);
  return NULL;
}

function picture_from_REQUEST() {
  $picture = $_REQUEST["picture"];
  if (!$picture)
    exit("no picture :(");

  if (array_search($picture, list_pictures()) === FALSE)
    exit("bad picture :(");

  return $picture;
}

function generate_page_navigation($pictures_per_page, $cur_page) {
  $navigation_html = "<hr/><ul class='page_navigation'><li>";
  if ($cur_page > 1) {
    $navigation_html .= '<a href="?page=';
    $navigation_html .= $cur_page - 1;
    $navigation_html .= '">&lt; Previous</a>';
  } else {
    $navigation_html .= "&lt; Previous";
  }
  $navigation_html .= "</li>";

  $num_pages = floor((count(list_pictures()) + $pictures_per_page) /
                     $pictures_per_page);
  for ($i = 1; $i <= $num_pages; $i++) {
    $navigation_html .= "<li>";
    if ($i == $cur_page) {
      $navigation_html .= $i;
    } else {
      $navigation_html .= '<a href="?page=';
      $navigation_html .= $i;
      $navigation_html .= '">';
      $navigation_html .= $i;
      $navigation_html .= "</a>";
    }

    $navigation_html .= "</li>";
  }

  $navigation_html .= "<li>";
  if ($cur_page < $num_pages) {
    $navigation_html .= '<a href="?page=';
    $navigation_html .= $cur_page + 1;
    $navigation_html .= '">Next &gt;</a>';
  } else {
    $navigation_html .= "Next &gt;";
  }

  $navigation_html .= "</li></ul><hr/>";
  
  return $navigation_html;
}

function paginated_pictures($pictures_per_page, $page_number) {
  $page_number -= 1;  // comes in 1-based, make 0-based;
  $all_pictures = list_pictures();
  $pictures_on_page = array();

  // get all the pictures on the page
  for ($i = 0; $i < $pictures_per_page; $i++) {
    $picture = $all_pictures[$i + $pictures_per_page*$page_number];

    // if the array indexing returned null, no more pictures
    if ($picture === NULL) {
      break;
    }

    $pictures_on_page[$i] = $picture;
  }

  return $pictures_on_page;
}

?>
