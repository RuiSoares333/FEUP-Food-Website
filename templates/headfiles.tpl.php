<?php
    function add_restaurant_head(){
        $styleFiles = array('');
        foreach($styleFiles as $file){
            echo '<link rel = "stylesheet" href="'.$file.'">';
        }
        ?> 
        </head>
        <body>
        <?php
    }

    function edit_profile_head(){
        $styleFiles = array('../CSS/layout/editUserInfo.layout.css', '../CSS/style/editUserInfo.style.css');
        foreach($styleFiles as $file){
            echo '<link rel = "stylesheet" href="'.$file.'">';
        }
        ?> 
        </head>
        <body>
        <?php
    }

    function edit_restaurant_head(){
        $styleFiles = array('');
        foreach($styleFiles as $file){
            echo '<link rel = "stylesheet" href="'.$file.'">';
        }
        ?> <script src="../javascript/categories.js" defer></script> 
           <script src="../javascript/image_upload.js" defer></script> 
            </head>
            <body>
           <?php
    }

    function index_head(){
        $styleFiles = array('../CSS/layout/index.layout.css', '../CSS/style/index.style.css');
        foreach($styleFiles as $file){
            echo '<link rel = "stylesheet" href="'.$file.'">';
        }
        ?> <script src="../javascript/favorite_restaurant.js"></script> 
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
        <?php
    }

    function profile_head(){
        $styleFiles = array('../CSS/layout/userProfile.layout.css', '../CSS/style/userProfile.style.css');
        foreach($styleFiles as $file){
            echo '<link rel = "stylesheet" href="'.$file.'">';
        }
        ?> <script src="../javascript/image_upload.js" defer></script> 
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
        <?php
    }

    function restaurant_head(){
        $styleFiles = array('../CSS/layout/restaurant.layout.css', '../CSS/style/restaurant.style.css');
        foreach($styleFiles as $file){
            echo '<link rel = "stylesheet" href="'.$file.'">';
        }
        ?> <script src="../javascript/image_upload.js" defer></script> 
           <script src="../javascript/review_response.js" defer></script> 
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
        </head>
        <body>
        <?php
    }
?>