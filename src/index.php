<?php

// Define a global basepath
// define('BASEPATH','/draadriana');
define('BASEPATH','/dradriana/dist');
// define('BASEPATH', '/');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Doctora Adriana Rios">
    <link rel="stylesheet" href="<?php echo BASEPATH . '/assets/css/imports.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo BASEPATH . '/assets/css/style.min.css'; ?>">
    <link rel="shortcut icon" href="<?php echo BASEPATH . '/assets/img/favicon.png'; ?>" type="image/png"> 
    <title>Dra. Adriana Reyes</title>
</head>
<body>
<div id="page-container">
<?php

// Use this namespace
use Steampixel\Route;

// Include router class
include 'includes/routes.inc.php';


// If your script lives in a subfolder you can use the following example
// Do not forget to edit the basepath in .htaccess if you are on apache
// define('BASEPATH','/api/v1');

function navi($lang = 'esp') {
    if($lang == 'esp'){
      require_once 'components/navbar.php';
    }
    elseif($lang == 'eng'){
      require_once 'components/navbar_eng.php';
    }
}

function footer(){
  require_once 'components/footer.php';  
}

function loadTemplate(string $template, string $lang = 'esp'){
    if($lang == 'esp'){
      require_once 'paths/'. $template .'.path.php';
    }
    elseif($lang == 'eng'){
      require_once 'paths/' . $lang.'/' . $template . '.path.php';
    }
}

Route::add('/', function() {
  navi();
  $template = 'index';
  loadTemplate($template);
  footer();
}, 'get');

Route::add('/blog/([0-9-]*)',function($foo){
  navi();
  if(!empty($foo)){
    $template = 'blog/'.$foo;
    loadTemplate($template);
  } else {
    echo '404';
  }
  footer();
});
Route::add('/blog', function(){
  navi();
  $template = 'blog';
  loadTemplate($template);
  footer();
}, 'get');

Route::add('/experiencia', function() {
  navi();
  $template = 'experiencia';
  loadTemplate($template);
  footer();
});

Route::add('/eng', function() {
  navi($lang = "eng");
  $template = 'index';
  loadTemplate($template, $lang = "eng");
  footer();
}, 'get');

Route::add('/eng/blog/([0-9-]*)',function($foo){
  navi($lang = "eng");
  if(!empty($foo)){
    $template = 'blog/'.$foo;
    loadTemplate($template, $lang = "eng");
  } else {
    echo '404';
  }
  footer();
});
Route::add('/eng/blog', function(){
  navi($lang="eng");
  $template = 'blog';
  loadTemplate($template, $lang = "eng");
  footer();
}, 'get');

Route::add('/eng/experiencia', function() {
  navi($lang = "eng");
  $template = 'experiencia';
  loadTemplate($template, $lang = "eng");
  footer();
});

Route::add('/dermabay/faciales', function(){
  navi($lang = "esp");
  $template = 'faciales';
  loadTemplate($template);
  footer();
}, 'get');

Route::add('/dermabay/depilacion', function(){
  navi($lang = "esp");
  $template = 'depilacion';
  loadTemplate($template);
  footer();
}, 'get');


// Modal
require_once 'components/modal.php';

// Run the Router with the given Basepath
Route::run(BASEPATH);

?>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
<!-- <script src="../node_modules/bulma-carousel/dist/js/bulma-carousel.min.js"></script> -->
<script src="<?php echo BASEPATH . '/assets/js/all.min.js'; ?>"></script>
</body>
</html>