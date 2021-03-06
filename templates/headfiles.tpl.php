<?php
    function add_dish_head(){
        $styleFiles = array('../CSS/layout/add_dish.layout.css', '../CSS/style/add_dish.style.css');
        foreach($styleFiles as $file){
            echo '<link rel = "stylesheet" href="'.$file.'">';
        }
        ?>
            <link rel = "stylesheet" href="../CSS/responsive.css">
            <script src="../javascript/form_validation/add_dish.js" defer></script>
            </head>
            <body> 
    <?php }

    function add_restaurant_head(){
        $styleFiles = array('../CSS/layout/add_restaurant.layout.css', '../CSS/style/add_restaurant.style.css');
        foreach($styleFiles as $file){
            echo '<link rel = "stylesheet" href="'.$file.'">';
        }?> 
        <link rel = "stylesheet" href="../CSS/responsive.css">
        <script src="../javascript/categories.js" defer></script>
        <script src="../javascript/form_validation/add_restaurant.js" defer></script>
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
        <link rel = "stylesheet" href="../CSS/responsive.css">
        <script src="../javascript/form_validation/change_password.js" defer></script>
        </head>
        <body>
    <?php }

    function edit_profile_head(){
        $styleFiles = array('../CSS/layout/edit_profile.layout.css', '../CSS/style/edit_profile.style.css');
        foreach($styleFiles as $file){
            echo '<link rel = "stylesheet" href="'.$file.'">';
        }
        ?> 
        <link rel = "stylesheet" href="../CSS/responsive.css">
        <script src ="../javascript/form_validation/edit_profile.js" defer></script>
        </head>
        <body>
    <?php }

    function edit_restaurant_head(){
        $styleFiles = array('../CSS/layout/edit_restaurant.layout.css', '../CSS/style/edit_restaurant.style.css');
        foreach($styleFiles as $file){
            echo '<link rel = "stylesheet" href="'.$file.'">';
        }        
        ?> 
            <link rel = "stylesheet" href="../CSS/responsive.css">
            <script src="../javascript/categories.js" defer></script> 
            <script src="../javascript/form_validation/edit_restaurant.js" defer></script>
            </head>
            <body>
        <?php
    }

    function manage_dishes_head(){
        $styleFiles = array('../CSS/layout/manage_dishes.layout.css', '../CSS/style/manage_dishes.style.css');
        foreach($styleFiles as $file){
            echo '<link rel = "stylesheet" href="'.$file.'">';
        }?> 
        <link rel = "stylesheet" href="../CSS/responsive.css">
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
        ?>
        <link rel = "stylesheet" href="../CSS/responsive.css"> 
        <script src="../javascript/favorite_restaurant.js" defer></script>
        <script src="../javascript/carousel.js" defer></script>
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
        <link rel = "stylesheet" href="../CSS/responsive.css">
        </head>
        <body>
    <?php }

    function profile_head(){
        $styleFiles = array('../CSS/layout/userProfile.layout.css', '../CSS/style/userProfile.style.css');
        foreach($styleFiles as $file){
            echo '<link rel = "stylesheet" href="'.$file.'">';
        }
        ?> 
            <link rel = "stylesheet" href="../CSS/responsive.css">
            <script src="../javascript/image_upload.js" defer></script>
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
        <script src="../javascript/form_validation/register.js" defer></script>  
        <link rel = "stylesheet" href="../CSS/responsive.css">
        <body> 
    <?php }

    function restaurant_head(){
        $styleFiles = array('../CSS/layout/restaurant.layout.css', '../CSS/style/restaurant.style.css');
        foreach($styleFiles as $file){
            echo '<link rel = "stylesheet" href="'.$file.'">';
        }
        ?> 
            <link rel = "stylesheet" href="../CSS/responsive.css">
            <script src="../javascript/image_upload.js" defer></script> 
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
        <link rel = "stylesheet" href="../CSS/responsive.css">
        <script src="../javascript/favorite_restaurant.js" defer></script>
        </head>
        <body>
    <?php }

    function orders_head() {
        $styleFiles = array('../CSS/layout/orders.layout.css', '../CSS/style/orders.style.css');
        foreach($styleFiles as $file){
            echo '<link rel = "stylesheet" href="'.$file.'">';
        }
        ?>
        <link rel = "stylesheet" href="../CSS/responsive.css">
        <script src ="../javascript/show_more.js" defer></script>
        </head>
        <body>
    <?php }

    function restaurant_orders_head() {
        $styleFiles = array('../CSS/layout/owner_orders.layout.css' , '../CSS/style/owner_orders.style.css');
        foreach($styleFiles as $file){
            echo '<link rel = "stylesheet" href="'.$file.'">';
        }
        ?>
        <link rel = "stylesheet" href="../CSS/responsive.css">
        <script src ="../javascript/show_more.js" defer></script>
        <script src="../javascript/orderState.js" defer></script>
        </head>
        <body> 
    <?php }
?>