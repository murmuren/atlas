<?php
require_once './common_func.php';

class html_parts{
    
    
    function load_script($type, $page){
        
        if($type == 'css'){
            ?>
            <link rel="stylesheet" href="<?php echo ABS_URL; ?>css/jquery-ui.structure.css">
<!--            <link rel="stylesheet" href="css/jquery-ui.theme.css">-->
            <link rel="stylesheet" href="<?php echo ABS_URL; ?>css/jquery-ui.css">
            <link rel="stylesheet" href="<?php echo ABS_URL; ?>css/main.css">
            <?php
        }elseif ($type == 'js') {
            if($page == 'statistics'){
                ?><script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script><?php
            }
            ?>
            <script src="<?php echo ABS_URL; ?>js/jquery-2.1.3.min.js"></script>
            <script src="<?php echo ABS_URL; ?>js/jquery-ui.js"></script>
            <script src="<?php echo ABS_URL; ?>js/main.js"></script>
            <?php
        }
    }
    
    
    function html_header($page){
        
        global $abs_url;
        $arr_meta = $this->meta($page);
        $title = $arr_meta['title'];
        ?>
        <html lang="heb">
            <head>
                <meta charset="UTF-8">
                <meta name="description" content="<?php echo str_replace('-', ' ', $arr_meta['desc']); ?>">
                <title><?php echo $title; ?></title>
                <link rel="shortcut icon" href="<?php echo $abs_url; ?>img/favicon-32x32.png"/>
                <?php 
                if($page == '404'){ 
                    ?><meta http-equiv="refresh" content="10;url=<?php echo $abs_url; ?>"> <?php 
                }
                $this->load_script('css', $page);
                ?>
            </head>
            <body>
                <div class="site">
                        <header>

                        </header>
                        <div class="content">
                        <?php $this->htmlNavbar();
    }
    
    
    function htmlNavbar(){
        ?>
        <nav class="top_nav">
            <a href="<?php echo ABS_URL; ?>">Home</a>
            <a href="<?php echo ABS_URL . 'statistics'; ?>">Statistics</a>
            <a href="<?php echo ABS_URL . 'shifts'; ?>">Shifts</a>
            <a href="<?php echo ABS_URL . 'add-resident'; ?>">Add New Resident</a>
            <a href="<?php echo ABS_URL . 'login'; ?>">Admin</a>
        </nav>                 
        <?php
    }
    
    
    function meta($page){
        
        $title = $h1 = $h2 = $desc = '';
        $arr_meta = ['title'=>$title, 'h1'=>$h1, 'h2'=>$h2, 'desc'=>$desc];
        return $arr_meta;
    }
    
    
    function html_footer($page){
        
        ?>
                        </div>
                    <footer>
                        <span class="footer_title">Atlas - center for victims of trafficking, slavery and forced labor</span>
                        <span class="controller" data-page="<?php echo $page; ?>" data-abs-url="<?php echo ABS_URL; ?>"></span>
                    </footer>
                </div>
                <?php
                $this->load_script('js', $page);
                ?>
            </body>
        </html>   
        <?php
    }
}