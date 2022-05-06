--Restaurant
INSERT INTO Restaurant VALUES ("Il Pizzaiolo Clérigos", "Rua de Candido dos Reis", "Italiano");
INSERT INTO Restaurant VALUES ("Tokkotai", "Rua do Comércio do Porto", "Japonês");
INSERT INTO Restaurant VALUES ("McDonalds", "Estrada da Circunvalação", "FastFood");

--Dish
INSERT INTO Dish VALUES ("Tiramisu", 5, "Sobremesa");
INSERT INTO Dish VALUES ("Calzone Napolitana", 9, "Pizza");
INSERT INTO Dish VALUES ("Lasagna", 10, "Principal");
INSERT INTO Dish VALUES ("Camarão Tigre Asiático", 23, "Entradas");
INSERT INTO Dish VALUES ("Salmão (6 peças)", 11, "Sashimi Tradicional");
INSERT INTO Dish VALUES ("Água", 2, "Bebida");
INSERT INTO Dish VALUES ("BigMac", 5, "Hamburguer");
INSERT INTO Dish VALUES ("McFlurry KitKat", 2, "Sobremesa");
INSERT INTO Dish VALUES ("Coca-Cola", 2, "Bebida");

--Menu
INSERT INTO Menu VALUES (0, 0);
INSERT INTO Menu VALUES (0, 1);
INSERT INTO Menu VALUES (0, 2);
INSERT INTO Menu VALUES (1, 3);
INSERT INTO Menu VALUES (1, 4);
INSERT INTO Menu VALUES (1, 5);
INSERT INTO Menu VALUES (2, 6);
INSERT INTO Menu VALUES (2, 7);
INSERT INTO Menu VALUES (2, 8);

--User
INSERT INTO User VALUES ("maria20", "maria20@gmail.com", "123456", "Rua das Flores", "962156489");
INSERT INTO User VALUES ("ricardo32", "ricardo32@gmail.com", "6543210", "Rua Dr. António José Almeida", "956320145");
INSERT INTO User VALUES ("miguel_012", "miguel012@gmail.com", "5864102", "Rua Nova do Crasto", "93201523");
INSERT INTO User VALUES ("joana26", "joana26@gmail.com", "hfg41", "Rua Santa Luzia", "96254123");
INSERT INTO User VALUES ("1mafalda3", "mafalda13@gmail.com", "mfhg4", "Avenida 5 de Outubro", "91520236");

--Costumer
INSERT INTO Costumer VALUES ("maria20");
INSERT INTO Costumer VALUES ("miguel_012");
INSERT INTO Costumer VALUES ("1mafalda3");

--Owner
INSERT INTO Owner VALUES ("ricardo32");
INSERT INTO Owner VALUES ("joana26");

--Order
INSERT INTO Order VALUES ("preparing");
INSERT INTO Order VALUES ("received");
INSERT INTO Order VALUES ("ready");

--Order_Restaurant_User
INSERT INTO OrderRestaurantUser VALUES (0, 0, 0);
INSERT INTO OrderRestaurantUser VALUES (1, 2, 1);
INSERT INTO OrderRestaurantUser VALUES (2, 5, 2);

--Order_Dish
INSERT INTO OrderDish VALUES (0, 1);
INSERT INTO OrderDish VALUES (1, 3);
INSERT INTO OrderDish VALUES (2, 7);

--Review
INSERT INTO Review VALUES (7, "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.");
INSERT INTO Review VALUES (8, "Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.");
INSERT INTO Review VALUES (9, "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.");

--User_Review
INSERT INTO UserReview VALUES (0, 0, 0);
INSERT INTO UserReview VALUES (1, 2, 1);
INSERT INTO UserReview VALUES (2, 5, 2);

--Favorite_Dish
INSERT INTO FavoriteDish VALUES (1, 0);
INSERT INTO FavoriteDish VALUES (3, 2);
INSERT INTO FavoriteDish VALUES (7, 5);

--Favorite_Restaurant
INSERT INTO FavoriteRestaurant VALUES (0, 0);
INSERT INTO FavoriteRestaurant VALUES (1, 2);
INSERT INTO FavoriteRestaurant VALUES (2, 5);
