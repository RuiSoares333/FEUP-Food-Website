<?php
    declare(strict_types = 1);

    function outputOrder(Order $order) { ?>
        <article>
            <p><?=$order->restaurant->name?></p>
            <p><?=$order->price?></p>
            <p>state: <?=$order->state->value?></p>
            <div>
                <?php
                    foreach($order->dishes as $dish) { ?>
                        <div>
                            <p><?=$dish['dish']->name?></p>
                            <p><?=$dish['dish']->price?></p>
                            <p>amount: <?=$dish['quantity']?></p>
                        </div>
                    <?php }
                ?>
            </div>
            <a href ="">Show more</a>
        </article>
    <?php }

    function outputorders(array $ongoingOrders, array $completeOrders) { ?>
            <div id = "mainDiv" class ="orders">
            <?php
                outputonGoingOrders($ongoingOrders);
                outputCompleteOrders($completeOrders);
            ?>
            </div>
    <?php }

    function outputCompleteOrders(array $orders) { ?>
        <section id ="completeOrders">
            <h1>Order History:</h1>
            <?php
            if($orders)
                foreach($orders as $order)
                    outputOrder($order);
            else
                echo '<p>No order history</p>'
            ?>
        </section>
    <?php }

    function outputonGoingOrders(array $orders) { ?>
        <section id ="completeOrders">
            <h1>Ongoing Orders:</h1>
            <?php
            if($orders)
                foreach($orders as $order)
                    outputOrder($order);
            else
                echo '<p>You have no ongoing orders</p>'
            ?>
        </section>
    <?php }

    function outputOwnerOrders(array $orders) { ?>
        <div id = "mainDiv" class ="ownerOrders">
            <h1>manage restaurant orders</h1>
            <?php
                foreach($orders as $order){
                    outputRestaurantOrders($order);
                }
            ?>
        </div>
    <?php }

    function outputRestaurantOrders(array $orders) { ?>
        <section>
            <h1><?=$orders[0]->restaurant->name?></h1>
            <?php
                foreach($orders as $order){
                    outputRestaurantOrder($order);
                }
            ?>
        </section>
    <?php }

    function outputRestaurantOrder(Order $order) { 
        $states = array('received', 'preparing', 'ready', 'delivered');
        ?>
        <article>
            <p><?=$order->costumer->address?></p>
            <p><?=$order->price?></p>
            <select>
                <?php
                    foreach($states as $state){
                        $selected = $order->state->value === $state;
                        ?> <option value ="<?=$state?>" <?php echo $selected ? 'selected' : '' ?>><?=$state?></option> <?php
                    }
                    
                ?>
            </select>
        </article>
    <?php }
?>