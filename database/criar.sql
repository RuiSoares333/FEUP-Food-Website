DROP TABLE IF EXISTS Restaurant;
DROP TABLE IF EXISTS Dish;
DROP TABLE IF EXISTS Menu;
DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Owner;
DROP TABLE IF EXISTS Ord;
DROP TABLE IF EXISTS RestaurantOwner;
DROP TABLE IF EXISTS OrderDish;
DROP TABLE IF EXISTS Review;
DROP TABLE IF EXISTS FavoriteDish;
DROP TABLE IF EXISTS FavoriteRestaurant;



CREATE TABLE Restaurant (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    restaurantName VARCHAR,
    adress VARCHAR,
    category VARCHAR CHECK (category IN ('italian', 'japanese', 'portuguese', 'fast food', 'european', 'mexican'))
);

CREATE TABLE Dish (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    dishName VARCHAR NOT NULL,
    price INTEGER NOT NULL,
    category VARCHAR
);

CREATE TABLE Menu (
    restaurantId INTEGER REFERENCES Restaurant (id),
    dishId INTEGER REFERENCES Dish (id),
    CONSTRAINT MENU_ID PRIMARY KEY (restaurantId, dishId)
);

CREATE TABLE User (
    username VARCHAR PRIMARY KEY,
    name VARCHAR NOT NULL,
    email VARCHAR UNIQUE NOT NULL,
    password VARCHAR NOT NULL,
    adress VARCHAR,
    phone VARCHAR UNIQUE
);


CREATE TABLE Owner (
    username VARCHAR REFERENCES User(username),
    CONSTRAINT Owner_ID PRIMARY KEY(username)
);

CREATE TABLE RestaurantOwner (
    username VARCHAR REFERENCES Owner(username),
    restaurantId INTEGER REFERENCES Restaurant(id),
    CONSTRAINT Restaurant_Owner_ID PRIMARY KEY (username, restaurantId)
);

CREATE TABLE Ord (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username VARCHAR REFERENCES User,
    restaurantId INTEGER REFERENCES Restaurant,
    state TEXT NOT NULL CHECK (state IN ('received', 'preparing', 'ready', 'delivered'))
);

CREATE TABLE OrderDish (
    orderId INTEGER REFERENCES Ord,
    dishId INTEGER REFERENCES Dish,
    CONSTRAINT Order_Dish_ID PRIMARY KEY (orderId, dishId)
);

CREATE TABLE Review (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    restaurantId INTEGER REFERENCES Restaurant (id),
    username VARCHAR REFERENCES User (username),
    rating REAL NOT NULL, 
    comment VARCHAR
);

CREATE TABLE FavoriteDish (
    dishId INTEGER REFERENCES Dish (id),
    userId VARCHAR REFERENCES User (username),
    CONSTRAINT FavoriteDish_ID PRIMARY KEY(dishId, userId)
);

CREATE TABLE FavoriteRestaurant (
    restaurantId INTEGER REFERENCES Restaurant (id),
    userId VARCHAR REFERENCES User (username),
    CONSTRAINT FavoriteRestaurant_ID PRIMARY KEY(restaurantId, userId)
);
