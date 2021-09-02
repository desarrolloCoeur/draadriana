
<nav class="navbar">
    <div class="navbar-brand">
        <a href="<?php echo BASEPATH?>" class="navbar-item">
            <img id="blanco"src="<?php echo BASEPATH . 'assets/img/BLANCO.png'; ?>" alt="logo"> 
            <img id="color" src="<?php echo BASEPATH . 'assets/img/COLOR.png'; ?>" alt="logo"> 
        </a>
        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarLinks">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
        </a>
    </div>

    <div class="navbar-menu">
        <div id="navbarLinks" class="navbar-start">
            <a href="<?php echo BASEPATH . 'eng/#home'; ?>" class="navbar-item">home</a>
            <a href="<?php echo BASEPATH . 'eng/#tratamientosYServicios'; ?>" class="navbar-item">services</a>
            <a href="<?php echo BASEPATH . 'eng/experiencia/'; ?>" class="navbar-item">experience</a>
            <a href="<?php echo BASEPATH . 'eng/#instalaciones'; ?>" class="navbar-item">facilities</a>
            <a href="<?php echo BASEPATH . 'eng/blog/';?>" class="navbar-item">blog</a>
            <a href="#contactame" class="navbar-item">contact me</a>
            <?php
                /*
                * @param array      $array
                * @param ing|string $position
                * @param mixed      $insert
                */
                function array_insert(&$array, $position, $insert){
                    if(is_int($position)){
                        array_splice($array, $position, 0, $insert);

                    }else{
                        $pos = array_search($posituion, array_keys($array));
                        $array = array_merge(
                            array_slice($array, 0, $pos),
                            $insert,
                            array_slice($array, $pos)
                        );
                    }
                }

                $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                $list_url = explode("/", $path);
                $lang = "esp";
                $list_sites = array('experiencia', 'blog');
                $list_size = count($list_url);
                $last_element = $list_url[count($list_url)-1];
                if(!in_array($last_element, $list_sites) && $last_element !== 'eng' && $last_element !== ''){
                    $en_la_lista = false;
                    $insert_location = count($list_url)-2;
                    $last_element = $list_url[count($list_url)-2];
                    // array_insert($list_url, $insert_location, $lang);
                }elseif($last_element === 'eng' && $list_size < 3){
                    $en_la_lista = false;
                    $insert_location = count($list_url);
                    array_pop($list_url);
                }else{
                    $en_la_lista = true;
                    $remove_key = array_search('eng', $list_url);
                    $insert_location = $remove_key;

                    // array_insert($list_url, $insert_location, $lang);
                }
                if($en_la_lista){
                    $final_path = implode('/', array_splice($list_url, $insert_location+1));
                }else{
                    $final_path = implode('/', array_splice($list_url, $insert_location+1));
                }

            ?>
            <a href="<?php echo BASEPATH . $final_path; ?>" class="navbar-item"><?php echo 'ESPAÑOL';?></a>
        </div>

        <div class="navbar-end">
            <a href="<?php echo BASEPATH . $final_path; ?>">
                <img class="lang" src="<?php echo BASEPATH . 'assets/img/esp.png'; ?>" alt="Español" style="width:1.5rem; height:1.5rem;">
            </a>
            <a href="https://www.instagram.com/dra.adrianareyes/" target="_blank">
                <img src="<?php echo BASEPATH . 'assets/img/instagram.svg'; ?>" alt="Instagram logo">
            </a>
            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarLinks">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>

        </div>
    </div>
        
</nav>