CREATE TABLE User (
    id INTEGER,
    username VARCHAR UNIQUE NOT NULL,
    name VARCHAR NOT NULL,
    email VARCHAR(320) UNIQUE NOT NULL,
    password VARCHAR(40) NOT NULL,
    address VARCHAR,
    phone VARCHAR(9) UNIQUE,
    owner BOOLEAN DEFAULT FALSE,
    CONSTRAINT PK_User PRIMARY KEY (id)
);

CREATE TABLE Category (
    name VARCHAR,
    CONSTRAINT PK_RestaurantCategory PRIMARY KEY (name)
);

CREATE TABLE Restaurant (
    id INTEGER,
    name VARCHAR,
    address VARCHAR,
    phone VARCHAR(9),
    ownerId INTEGER,
    CONSTRAINT PK_Restaurant PRIMARY KEY (id),
    FOREIGN KEY (ownerId) REFERENCES User(id)
            ON DELETE CASCADE
);

CREATE TABLE RestaurantCategory (
    restaurant INTEGER,
    category VARCHAR,
    FOREIGN KEY (restaurant) REFERENCES Restaurant(id)
        ON DELETE CASCADE,
    FOREIGN KEY (category) REFERENCES Category(name)
);

CREATE TABLE Dish (
    id INTEGER,
    name VARCHAR NOT NULL,
    price INTEGER NOT NULL,
    category VARCHAR CHECK (category IN ('appetizer', 'drink', 'soup', 'main_course', 'dessert')),
    restaurantId INTEGER,
    CONSTRAINT PK_Dish PRIMARY KEY (id),
    FOREIGN KEY (restaurantId) REFERENCES Restaurant(id)
            ON DELETE CASCADE
);

CREATE TABLE Ord (
    id INTEGER,
    userId INTEGER REFERENCES User(id),
    restaurantId INTEGER REFERENCES Restaurant(id),
    price INTEGER,
    state TEXT NOT NULL CHECK (state IN ('received', 'preparing', 'ready', 'delivered')),
    CONSTRAINT PK_Order PRIMARY KEY (id)
);

CREATE TABLE OrderDish (
    orderId INTEGER REFERENCES Ord,
    dishId INTEGER REFERENCES Dish,
    quantity INTEGER,
    CONSTRAINT Order_Dish_ID PRIMARY KEY (orderId, dishId)
);

CREATE TABLE Review (
    id INTEGER,
    restaurantId INTEGER,
    userId INTEGER,
    rating INTEGER NOT NULL, 
    published INTEGER,
    comment VARCHAR,
    CONSTRAINT PK_Review PRIMARY KEY (id),
    FOREIGN KEY (restaurantId) REFERENCES Restaurant (id)
            ON DELETE CASCADE ,
    FOREIGN KEY (userId) REFERENCES User (id)
            ON DELETE NO ACTION 
);

CREATE TABLE Response (
    id INTEGER,
    reviewId INTEGER NOT NULL,
    userId INTEGER NOT NULL,
    published INTEGER,
    comment VARCHAR,
    CONSTRAINT PK_Response PRIMARY KEY (id),
    FOREIGN KEY (reviewId) REFERENCES Review (id)
        ON DELETE CASCADE,
    FOREIGN KEY (userId) REFERENCES User(id)
); 

CREATE TABLE FavoriteDish (
    dishId INTEGER,
    userId INTEGER,
    CONSTRAINT FavoriteDish_ID PRIMARY KEY(dishId, userId),
    FOREIGN KEY (dishId) REFERENCES Dish(id)
            ON DELETE CASCADE ,
    FOREIGN KEY (userId) REFERENCES User(id)
            ON DELETE CASCADE 
);

CREATE TABLE FavoriteRestaurant (
    restaurantId INTEGER,
    userId INTEGER,
    CONSTRAINT FavoriteRestaurant_ID PRIMARY KEY(restaurantId, userId),
    FOREIGN KEY (restaurantId) REFERENCES Restaurant(id)
            ON DELETE CASCADE ,
    FOREIGN KEY (userId) REFERENCES User(id)
            ON DELETE CASCADE 
);


---------------------------------------------------------------------------------------


PRAGMA foreign_keys = ON;

--User
INSERT INTO User VALUES (NULL, "maria20", "maria", "maria20@gmail.com", "7c4a8d09ca3762af61e59520943dc26494f8941b", "Rua das Flores", "962156489", false); --123456
INSERT INTO User VALUES (NULL, "ricardo32", "ricardo", "ricardo32@gmail.com", "5347c8d36f07b8c333b2c40272d3269b38ed810a", "Rua Dr. António José Almeida", "956320145", true); --6543210
INSERT INTO User VALUES (NULL, "miguel_012", "miguel", "miguel012@gmail.com", "fb4369d81f91586ce212bf0ef9c6186efb37919e", "Rua Nova do Crasto", "93201523", false); --5864102
INSERT INTO User VALUES (NULL, "joana26", "joana", "joana26@gmail.com", "1401dad399850fedbcbc78380934b126f708a618", "Rua Santa Luzia", "96254123", true); --hfg41
INSERT INTO User VALUES (NULL, "1mafalda3", "mafalda", "mafalda13@gmail.com", "62458713c0b5c07c221d3e85e1300d6a781d83ce", "Avenida 5 de Outubro", "91520236", true); --mfhg4

--Category
INSERT INTO Category VALUES ("portuguese");
INSERT INTO Category VALUES ("international");
INSERT INTO Category VALUES ("asian");
INSERT INTO Category VALUES ("italian");
INSERT INTO Category VALUES ("japanese");
INSERT INTO Category VALUES ("latino");
INSERT INTO Category VALUES ("brazilian");
INSERT INTO Category VALUES ("steakhouse");
INSERT INTO Category VALUES ("pizzaria");
INSERT INTO Category VALUES ("spanish");
INSERT INTO Category VALUES ("indian");
INSERT INTO Category VALUES ("american");

--Restaurant
INSERT INTO Restaurant VALUES (NULL, "Il Pizzaiolo Clérigos", "Rua de Candido dos Reis", "22 205 5071", 2);
INSERT INTO Restaurant VALUES (NULL, "Tokkotai", "Rua do Comércio do Porto", "913 037 171", 2);
INSERT INTO Restaurant VALUES (NULL, "McDonalds", "Estrada da Circunvalação", "22 509 1784", 4);
INSERT INTO Restaurant VALUES (NULL, "O Charco", "Rua Nossa Senhora Amparo 143", "22 375 4618", 5);
INSERT INTO Restaurant VALUES (NULL, "Temple Rio", "Rua D. Afonso Henriques 745", "932 464 670", 5);
INSERT INTO Restaurant VALUES (NULL, "O Cardeal", "Largo de São Brás 102", "22 480 1268", 5);

--RestaurantCategory
INSERT INTO RestaurantCategory VALUES (1, "italian");
INSERT INTO RestaurantCategory VALUES (1, "pizzaria");
INSERT INTO RestaurantCategory VALUES (2, "japanese");
INSERT INTO RestaurantCategory VALUES (2, "asian");
INSERT INTO RestaurantCategory VALUES (3, "american");
INSERT INTO RestaurantCategory VALUES (4, "portuguese");
INSERT INTO RestaurantCategory VALUES (5, "japanese");
INSERT INTO RestaurantCategory VALUES (5, "asian");
INSERT INTO RestaurantCategory VALUES (6, "portuguese");


--Dish
INSERT INTO Dish VALUES (NULL, "Tiramisu", 5, "dessert", 1);
INSERT INTO Dish VALUES (NULL, "Neapolitan Calzone", 9, "main_course", 1);
INSERT INTO Dish VALUES (NULL, "Lasagna Bolognese", 10, "main_course", 1);

INSERT INTO Dish VALUES (NULL, "Asian Tiger Shrimp", 23, "appetizer", 2);
INSERT INTO Dish VALUES (NULL, "Salmão (6 peças)", 11, "main_course", 2);
INSERT INTO Dish VALUES (NULL, "Water", 2, "drink", 2);

INSERT INTO Dish VALUES (NULL, "BigMac", 5, "main_course", 3);
INSERT INTO Dish VALUES (NULL, "McFlurry KitKat", 2, "dessert", 3);
INSERT INTO Dish VALUES (NULL, "Coca-Cola", 2, "drink", 3);

INSERT INTO Dish VALUES (NULL, "Bacalhau Especial à Charco", 22, "main_course", 4);
INSERT INTO Dish VALUES (NULL, "Bacalhau à moda de Braga", 22, "main_course", 4);
INSERT INTO Dish VALUES (NULL, "Arroz de Marisco", 29, "main_course", 4);
INSERT INTO Dish VALUES (NULL, "Francesinha", 11, "main_course", 4);
INSERT INTO Dish VALUES (NULL, "Cachorro Especial", 9, "main_course", 4);
INSERT INTO Dish VALUES (NULL, "Prego no Prato", 14, "main_course", 4);
INSERT INTO Dish VALUES (NULL, "Super Bock", 2, "drink", 4);
INSERT INTO Dish VALUES (NULL, "Fanta Laranja", 3, "drink", 4);
INSERT INTO Dish VALUES (NULL, "Coca-Cola", 2, "drink", 4);
INSERT INTO Dish VALUES (NULL, "Mousse de Chocolate", 3, "dessert", 4);

INSERT INTO Dish VALUES (NULL, "Crepe de Legumes", 2, "appetizer", 5);
INSERT INTO Dish VALUES (NULL, "Espetada de Frango", 2, "appetizer", 5);
INSERT INTO Dish VALUES (NULL, "Camarão Panado", 4, "appetizer", 5);
INSERT INTO Dish VALUES (NULL, "Nigiri Salmão", 8, "main_course", 5);
INSERT INTO Dish VALUES (NULL, "Gukan de Morango", 9, "main_course", 5);
INSERT INTO Dish VALUES (NULL, "Hot Roll", 7, "main_course", 5);
INSERT INTO Dish VALUES (NULL, "Noodles Frango", 11, "main_course", 5);
INSERT INTO Dish VALUES (NULL, "Noodles Vaca", 12, "main_course", 5);
INSERT INTO Dish VALUES (NULL, "Tempura de Gambas", 11, "main_course", 5);
INSERT INTO Dish VALUES (NULL, "Água", 1, "drink", 5);
INSERT INTO Dish VALUES (NULL, "Coca-cola", 1, "drink", 5);
INSERT INTO Dish VALUES (NULL, "Cerveja Japonesa", 3, "drink", 5);

INSERT INTO Dish VALUES (NULL, "Cesto de Pão", 1, "appetizer", 6);
INSERT INTO Dish VALUES (NULL, "Azeitonas", 1, "appetizer", 6);
INSERT INTO Dish VALUES (NULL, "Pratinho de Presunto", 5, "appetizer", 6);
INSERT INTO Dish VALUES (NULL, "Sopa", 2, "soup", 6);
INSERT INTO Dish VALUES (NULL, "Canja de Galinha", 2, "soup", 6);
INSERT INTO Dish VALUES (NULL, "Bacalhau à Cardeal", 23, "main_course", 6);
INSERT INTO Dish VALUES (NULL, "Bacalhau Assado na Brasa", 23, "main_course", 6);
INSERT INTO Dish VALUES (NULL, "Polvo à Lagareiro", 43, "main_course", 6);
INSERT INTO Dish VALUES (NULL, "Bife à Cardeal", 29, "main_course", 6);
INSERT INTO Dish VALUES (NULL, "Costeletas de Vitela", 37, "main_course", 6);
INSERT INTO Dish VALUES (NULL, "Francesinha à Cardeal", 11, "main_course", 6);
INSERT INTO Dish VALUES (NULL, "Baba de Camelo", 2, "dessert", 6);
INSERT INTO Dish VALUES (NULL, "Pudim Molotof", 1, "dessert", 6);
INSERT INTO Dish VALUES (NULL, "Melão", 2, "dessert", 6);
INSERT INTO Dish VALUES (NULL, "Água", 2, "drink", 6);
INSERT INTO Dish VALUES (NULL, "Garrafa de Vinho", 6, "drink", 6);


--Order
INSERT INTO Ord VALUES (NULL, 1, 2, "preparing");
INSERT INTO Ord VALUES (NULL, 3, 1, "received");
INSERT INTO Ord VALUES (NULL, 5, 3,"ready");

--Order_Dish
INSERT INTO OrderDish VALUES (1, 4);
INSERT INTO OrderDish VALUES (1, 5);
INSERT INTO OrderDish VALUES (2, 3);
INSERT INTO OrderDish VALUES (3, 7);

--Review
INSERT INTO Review VALUES (NULL, 1, 3, 8, 1635347252, "Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.");
INSERT INTO Review VALUES (NULL, 2, 1, 9, 1635347252, "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.");
INSERT INTO Review VALUES (NULL, 2, 5, 10, 1635347252, "a");

INSERT INTO Review VALUES (NULL, 3, 5, 7, 1635347252, "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.");
INSERT INTO Review VALUES (NULL, 4, 5, 5, 1635347252, "Phasellus leo velit, mollis varius ex sagittis, congue posuere metus. Proin sit amet libero libero. Quisque nec condimentum eros. Donec sit amet mollis elit. Nullam ut ultrices enim. Phasellus ut ante nisl. Nunc ipsum lorem, porta ut erat quis, vestibulum viverra leo. Fusce accumsan ligula et vestibulum imperdiet.");
INSERT INTO Review VALUES (NULL, 4, 5, 7, 1635347252, "Praesent vestibulum cursus dignissim. Duis congue quis urna et ultricies. Aenean vitae nisl leo. In condimentum consequat justo ut consectetur. In feugiat sem sed dolor tempor, a cursus felis dignissim. Nullam porttitor urna ut est dapibus tristique. Praesent ullamcorper congue diam. Vestibulum facilisis leo ut metus porttitor, a pretium justo accumsan. Donec felis diam, eleifend eu tellus sed, feugiat imperdiet sem. In at imperdiet neque. Mauris vel sagittis ligula. Praesent scelerisque tempor condimentum. Sed rutrum est at nulla commodo dignissim ut non turpis. Nam nec arcu diam. Morbi vestibulum sagittis enim, in vehicula enim.");

INSERT INTO Review VALUES (NULL, 4, 5, 8, 1635347252, "Nulla scelerisque, tortor non luctus placerat, nisl est luctus mi, vel interdum mi dolor nec tellus. Donec quis sodales tortor, eget viverra quam. Quisque erat sapien, eleifend quis dui vel, egestas gravida quam. Suspendisse id vulputate leo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Etiam eget ornare nisi. Proin iaculis fermentum elit, quis ultricies metus rhoncus vel. Curabitur efficitur massa vitae condimentum rhoncus.");
INSERT INTO Review VALUES (NULL, 5, 5, 8, 1635347252, "Morbi consectetur diam non tellus sagittis tristique. Vivamus felis nibh, efficitur vel tempus commodo, sagittis nec tortor. Aliquam consectetur nibh metus, eget pretium enim aliquam eu. Phasellus sodales lobortis ligula, vitae ullamcorper quam. Donec ultricies feugiat diam, luctus finibus nunc euismod nec. Morbi cursus, mauris sagittis dignissim pretium, sapien mi pulvinar nunc, non finibus neque lectus eu velit. Integer ac cursus massa. Pellentesque ac massa vehicula, sollicitudin massa ac, tempus massa. Vivamus at suscipit erat. Duis vestibulum sapien nec tortor pulvinar, eu venenatis velit varius.");
INSERT INTO Review VALUES (NULL, 5, 5, 9, 1635347252, "Praesent semper sollicitudin mauris eget consequat. Vivamus et leo nec odio molestie mollis. Praesent nec nisi libero. Cras vitae felis non enim eleifend placerat et ac orci. Integer feugiat mi tristique urna vehicula porttitor. Proin condimentum tellus eu mauris finibus consectetur. Aenean eget mauris id ante vulputate pharetra lobortis a erat. Duis magna nibh, lacinia ut egestas non, tristique at est. Suspendisse iaculis rutrum leo. In nec congue purus, a ornare augue. Sed condimentum tincidunt rutrum. Cras dignissim erat in ultrices imperdiet. Quisque convallis ante eros, eget efficitur lorem sodales sed. Sed aliquet rutrum risus ultrices ultricies. Aenean ullamcorper dolor ut tristique auctor.");

INSERT INTO Review VALUES (NULL, 5, 5, 9, 1635347252, "Proin purus leo, lobortis sed enim et, sagittis dictum elit. Sed a varius velit. Donec et elit sed ligula tempor sollicitudin. Donec id est hendrerit justo imperdiet ornare. Nam non varius sapien. Phasellus non lobortis lacus, vitae blandit massa. Nulla facilisi. Mauris accumsan porttitor urna egestas ornare. Ut in magna velit. Cras massa erat, placerat eget commodo non, ornare sed velit. Fusce gravida elit at congue sodales. Pellentesque luctus sagittis elit, porttitor fermentum est auctor sit amet. In hac habitasse platea dictumst. Fusce consectetur, turpis vitae ultricies vestibulum, odio mi pharetra nisi, ut pulvinar odio ante in odio.");
INSERT INTO Review VALUES (NULL, 6, 5, 6, 1635347252, "Nam a quam hendrerit, luctus velit vel, varius sapien. Etiam odio lectus, rutrum in neque ac, interdum condimentum ipsum. Sed a risus augue. Pellentesque commodo sem nec diam vehicula finibus. Nunc ac varius neque. Praesent vulputate, sapien nec mollis commodo, ex quam efficitur velit, ut pellentesque dui mauris id felis. Curabitur felis enim, faucibus ut vehicula non, eleifend non sapien. Praesent in rutrum dui. Maecenas pretium lacus et lacus viverra pulvinar. Aliquam consectetur efficitur orci ac convallis. Integer faucibus mauris at elit vestibulum, nec laoreet leo rhoncus. Nam in neque dolor. Nam aliquet dui elementum augue gravida, euismod vulputate turpis accumsan. Sed ut ultricies tellus. In congue justo ac magna ultricies imperdiet. Vivamus semper tempus est, eget cursus eros consequat sit amet.");

INSERT INTO Review VALUES (NULL, 6, 5, 7, 1635347252, "Duis vitae tortor erat. Nulla ante ipsum, consectetur eu erat eget, dictum ornare nisl. Maecenas porta nibh augue, tincidunt fermentum massa bibendum ut. Maecenas ullamcorper interdum viverra. Sed pulvinar, metus et congue pulvinar, dolor elit mollis lacus, id euismod enim neque a est. Curabitur cursus ipsum ac mauris congue commodo. Morbi ut odio eu libero auctor facilisis. Nam vel lorem vulputate enim dapibus dictum. Vivamus faucibus rutrum sem, vel pharetra dolor laoreet quis. Mauris dignissim metus ac tortor hendrerit rutrum. Phasellus sed viverra libero, nec congue diam. Donec quis felis vel urna fringilla euismod a iaculis magna. Maecenas ac vestibulum risus. Vestibulum hendrerit tincidunt dictum.");
INSERT INTO Review VALUES (NULL, 6, 5, 9, 1635347252, "Sed justo turpis, ullamcorper non nisl ac, hendrerit mollis ipsum. In imperdiet ullamcorper ipsum, ac scelerisque erat blandit a. Nullam malesuada posuere lorem vel tristique. Donec eget lacus eget lectus venenatis pulvinar ut scelerisque sapien. Aenean id leo rutrum, eleifend quam id, fringilla mi. Mauris id erat est. Integer consectetur accumsan odio id egestas. Aliquam sit amet diam lorem. Pellentesque eget neque urna. Suspendisse placerat ultricies vehicula. Aliquam sed pretium nibh, at euismod massa. Phasellus euismod tortor ante, vel ultrices velit semper nec. Etiam in condimentum neque. In in eleifend nunc. Proin convallis dolor at ullamcorper facilisis. Morbi eget neque nulla.");

--Response 
INSERT INTO Response VALUES(NULL, 2, 2, 1635348252, 'cringe');

--Favorite_Dish
INSERT INTO FavoriteDish VALUES (1, 2);
INSERT INTO FavoriteDish VALUES (3, 4);
INSERT INTO FavoriteDish VALUES (7, 5);

--Favorite_Restaurant
INSERT INTO FavoriteRestaurant VALUES (1, 3);
INSERT INTO FavoriteRestaurant VALUES (2, 1);
INSERT INTO FavoriteRestaurant VALUES (3, 4);
