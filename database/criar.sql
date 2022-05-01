CREATE TABLE Restaurant (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    adress VARCHAR,
    category VARCHAR
);

CREATE TABLE Dish (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR NOT NULL,
    price INTEGER NOT NULL,
    category VARCHAR
);

CREATE TABLE Menu (
    restaurantId INTEGER REFERENCES Restaurant (id),
    dishId INTEGER REFERENCES Dish (id),
    COINSTRAINT MENU_ID PRIMARY KEY (restaurantId, dishId)
);

CREATE TABLE User (
    username VARCHAR PRIMARY KEY,
    email VARCHAR NOT NULL,
    password VARCHAR NOT NULL,
    adress VARCHAR,
    phone VARCHAR,
    CONSTRAINT email UNIQUE
);

CREATE TABLE Custumer (
    username VARCHAR REFERENCES User (username),
    CONSTRAINT Costumer_ID PRIMARY KEY(username)
);

CREATE TABLE Owner (
    username VARCHAR REFERENCES User(username),
    CONSTRAINT Owner_ID PRIMARY KEY(username)
);

CREATE TABLE Order (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    state VARCHAR, NOT NULL
);

CREATE TABLE OrderRestaurantUser(
    restaurantId INTEGER REFERENCES Restaurant (id),
    userId INTEGER REFERENCES User(id),
    orderId INTEGER REFERENCES Order (id),
    CONSTRAINT OrderRestaurantUser_ID PRIMARY KEY(restaurantId, userId, orderId)
);

CREATE TABLE OrderDish (
    orderId INTEGER REFERENCES Order (id),
    dishId INTEGER REFERENCES Dish (id),
    CONSTRAINT OrderDish_ID PRIMARY KEY(orderId, dishId)
);

CREATE TABLE Review (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    rating REAL NOT NULL, 
    comment VARCHAR
);

CREATE TABLE UserReview (
    restaurantId INTEGER REFERENCES Restaurant (id),
    userId INTEGER REFERENCES User (id),
    reviewId INTEGER REFERENCES Review (id),
    CONSTRAINT UserReview_ID PRIMARY KEY(restaurantId, userId, reviewId)
);

CREATE TABLE FavoriteDish (
    dishId INTEGER REFERENCES Dish (id),
    costumerId INTEGER REFERENCES Costumer (id),
    CONSTRAINT FavoriteDish_ID PRIMARY KEY(dishId, costumerId)
);

CREATE TABLE FavoriteRestaurant (
    restaurantId INTEGER REFERENCES Restaurant (id),
    costumerId INTEGER REFERENCES Costumer (id),
    CONSTRAINT FavoriteRestaurant_ID PRIMARY KEY(restaurantId, costumerId)
);
