<?php
    function add_dish_head(){
        $styleFiles = array('../CSS/layout/add_dish.layout.css', '../CSS/style/add_dish.style.css');
        foreach($styleFiles as $file){
            echo '<link rel = "stylesheet" href="'.$file.'">';
        }
        ?>
            </head>
            <body> 
    <?php }

    function add_restaurant_head(){
        $styleFiles = array('../CSS/layout/add_restaurant.layout.css', '../CSS/style/add_restaurant.style.css');
        foreach($styleFiles as $file){
            echo '<link rel = "stylesheet" href="'.$file.'">';
        }?> <script src="../javascript/categories.js" defer></script>
        </head>
        <body>
        <?php
    }

    function change_password_head(){
        $styleFiles = array('../CSS/layout/change_password.layout.css', '../CSS/style/change_password.style.css');
        foreach($styleFiles as $file){
            echo '<link rel = "stylesheet" href="'.$file.'">';
        }
        ?> 
        </head>
        <body>
    <?php }

    function edit_profile_head(){
        $styleFiles = array('../CSS/layout/edit_profile.layout.css', '../CSS/style/edit_profile.style.css');
        foreach($styleFiles as $file){
            echo '<link rel = "stylesheet" href="'.$file.'">';
        }
        ?> 
        </head>
        <body>
    <?php }

    function edit_restaurant_head(){
        $styleFiles = array('../CSS/layout/edit_restaurant.layout.css', '../CSS/style/edit_restaurant.style.css');
        foreach($styleFiles as $file){
            echo '<link rel = "stylesheet" href="'.$file.'">';
        }        
        ?> <script src="../javascript/categories.js" defer></script> 
            </head>
            <body>
        <?php
    }

    function manage_dishes_head(){
        $styleFiles = array('../CSS/layout/manage_dishes.layout.css', '../CSS/style/manage_dishes.style.css');
        foreach($styleFiles as $file){
            echo '<link rel = "stylesheet" href="'.$file.'">';
        }?> <script src="../javascript/image_upload.js" defer></script> 
        </head>
        <body>
        <?php
    }

    function index_head(){
        $styleFiles = array('../CSS/layout/index.layout.css', '../CSS/style/index.style.css');
        foreach($styleFiles as $file){
            echo '<link rel = "stylesheet" href="'.$file.'">';
        }
        ?> <script src="../javascript/favorite_restaurant.js" defer></script>
    </head>
    <body>
        <?php
    }

    function login_head(){
        $styleFiles = array('../CSS/layout/login.layout.css', '../CSS/style/login.style.css');
        foreach($styleFiles as $file){
            echo '<link rel = "stylesheet" href="'.$file.'">';
        }
        ?> 
        </head>
        <body>
    <?php }

    function profile_head(){
        $styleFiles = array('../CSS/layout/userProfile.layout.css', '../CSS/style/userProfile.style.css');
        foreach($styleFiles as $file){
            echo '<link rel = "stylesheet" href="'.$file.'">';
        }
        ?> <script src="../javascript/image_upload.js" defer></script>
            <script src="../javascript/favorite_dish.js" defer></script>
            <script src="../javascript/favorite_restaurant.js" defer></script>
            </head>
            <body>
        <?php
    }

    function register_head(){
        $styleFiles = array('../CSS/layout/register.layout.css', '../CSS/style/register.style.css');
        foreach($styleFiles as $file){
            echo '<link rel = "stylesheet" href="'.$file.'">';
        }
        ?>
        </head>
        <body> 
    <?php }

    function restaurant_head(){
        $styleFiles = array('../CSS/layout/restaurant.layout.css', '../CSS/style/restaurant.style.css');
        foreach($styleFiles as $file){
            echo '<link rel = "stylesheet" href="'.$file.'">';
        }
        ?> <script src="../javascript/image_upload.js" defer></script> 
           <script src="../javascript/review_response.js" defer></script>
           <script src = "../javascript/shoppingCart.js" defer></script> 
           <script src="../javascript/favorite_dish.js" defer></script>
           <script src="../javascript/order.js" defer></script>
           </head>
           <body> 
        <?php
           
    }

    function search_head(){
        $styleFiles = array('../CSS/layout/search.layout.css', '../CSS/style/search.style.css');
        foreach($styleFiles as $file){
            echo '<link rel = "stylesheet" href="'.$file.'">';
        }
        ?>
        <script src="../javascript/favorite_restaurant.js" defer></script>
        </head>
        <body>
    <?php }
?>