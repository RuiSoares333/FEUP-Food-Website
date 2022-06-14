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
    city VARCHAR,
    phone VARCHAR(9) unique,
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
INSERT INTO User VALUES (NULL, "maria20", "maria", "maria20@gmail.com", "$2y$10$VcHZmDeVLgA68RF0sG9/5.eJGjW9LoBhOesQ1qdJKI06FzygZNAia", "Rua das Flores", "962156489", false); --123456
INSERT INTO User VALUES (NULL, "ricardo32", "ricardo", "ricardo32@gmail.com", "$2y$10$9BNa1sHmFqQ3FyCauIwVBeMOpvB1yxAIgCwLBEZRjbY3FC0Y//ahC", "Rua Dr. António José Almeida", "956320145", true); --6543210
INSERT INTO User VALUES (NULL, "miguel_012", "miguel", "miguel012@gmail.com", "$2y$10$KBUzlo8RhUiXbdfyPldToeDUkv2tKHoBjUT2yAsxkIUZ57oFmMVhi", "Rua Nova do Crasto", "93201523", false); --5864102
INSERT INTO User VALUES (NULL, "joana26", "joana", "joana26@gmail.com", "$2y$10$YgG5MAcExiGly5WKZKXqH.NztfzPAgETDxg93QGzNhXt.NgC5TrNi", "Rua Santa Luzia", "96254123", true); --hfg41
INSERT INTO User VALUES (NULL, "1mafalda3", "mafalda", "mafalda13@gmail.com", "$2y$10$qdEFUXyVB2Ad9d5DvF7gXuSuig.mr2QJ23UPUD.emognZumqYKGJ6", "Avenida 5 de Outubro", "91520236", true); --mfhg4

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
INSERT INTO Restaurant VALUES (NULL, "Il Pizzaiolo Clérigos", "Rua de Candido dos Reis", "Porto","222055071", 2);
INSERT INTO Restaurant VALUES (NULL, "Tokkotai", "Rua do Comércio do Porto", "Porto","913037171", 2);
INSERT INTO Restaurant VALUES (NULL, "McDonalds", "Estrada da Circunvalação", "Porto","225091784", 4);
INSERT INTO Restaurant VALUES (NULL, "O Charco", "Rua Nossa Senhora Amparo 143", "Porto","223754618", 5);
INSERT INTO Restaurant VALUES (NULL, "Temple Rio", "Rua D. Afonso Henriques 745", "Porto","932464670", 5);
INSERT INTO Restaurant VALUES (NULL, "O Cardeal", "Largo de São Brás 102", "Porto","224801268", 5);
INSERT INTO Restaurant VALUES (NULL, "Thamel Restaurant", "Rua da Picaria 25", "Porto","221113947", 2);
INSERT INTO Restaurant VALUES (NULL, "Boteco Mexicano", "Campo dos Mártires da Pátria 38", "Porto","964249974", 4);
INSERT INTO Restaurant VALUES (NULL, "Beher Porto", "Rua de Sá da Bandeira 589", "Porto","222053048", 4);
INSERT INTO Restaurant VALUES (NULL, "Salve Simpatia Porto", "Rua da Picaria 89", "Porto","960374589", 4);
INSERT INTO Restaurant VALUES (NULL, "KOB by Olivier", "Rua Conde de Vizela 149", "Porto","918280080", 5);
INSERT INTO Restaurant VALUES (NULL, "Portucale", "Rua da Alegria 598", "Porto","225370717", 5);
INSERT INTO Restaurant VALUES (NULL, "Rua Tapas e Music Bar", "Tv. de Cedofeita 24", "Porto","917356644", 5);
INSERT INTO Restaurant VALUES (NULL, "Pizzeria Bella Mia!", "Rua do Ferraz 22", "Porto","934895680", 2);
INSERT INTO Restaurant VALUES (NULL, "Boulevard Burger House", "Rua de Adolfo Casais Monteiro 17", "Porto","226000570", 2);
INSERT INTO Restaurant VALUES (NULL, "Indian Palace", "Rua Pedro Homem de Melo 244 B", "Porto","220155415", 4);
INSERT INTO Restaurant VALUES (NULL, "Dona Picanha", "Rua do Padre Luís Cabral 1086", "Porto","224920292", 4);
INSERT INTO Restaurant VALUES (NULL, "Nogueira's Porto", "Rua de Ceuta 23", "Porto","915181515", 5);
INSERT INTO Restaurant VALUES (NULL, "Sagardi Porto", "Rua de São João 54", "Porto","221130987", 5);
INSERT INTO Restaurant VALUES (NULL, "Artesão Bistrô", "Rua de Mouzinho da Silveira 218", "Porto","913753002", 5);


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
INSERT INTO RestaurantCategory VALUES (7, "indian");
INSERT INTO RestaurantCategory VALUES (8, "latino");
INSERT INTO RestaurantCategory VALUES (9, "spanish");
INSERT INTO RestaurantCategory VALUES (10, "brazilian");
INSERT INTO RestaurantCategory VALUES (10, "latino");
INSERT INTO RestaurantCategory VALUES (11, "steakhouse");
INSERT INTO RestaurantCategory VALUES (12, "international");
INSERT INTO RestaurantCategory VALUES (13, "international");
INSERT INTO RestaurantCategory VALUES (14, "pizzaria");
INSERT INTO RestaurantCategory VALUES (14, "italian");
INSERT INTO RestaurantCategory VALUES (15, "american");
INSERT INTO RestaurantCategory VALUES (16, "indian");
INSERT INTO RestaurantCategory VALUES (17, "latino");
INSERT INTO RestaurantCategory VALUES (17, "brazilian");
INSERT INTO RestaurantCategory VALUES (18, "steakhouse");
INSERT INTO RestaurantCategory VALUES (19, "spanish");
INSERT INTO RestaurantCategory VALUES (20, "portuguese");

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

INSERT INTO Dish VALUES (NULL, "Pakoda de couve-ﬂor", 5, "appetizer", 7);
INSERT INTO Dish VALUES (NULL, "Momo Vegetarianos", 5, "appetizer", 7);
INSERT INTO Dish VALUES (NULL, "Thukpa", 12, "soup", 7);
INSERT INTO Dish VALUES (NULL, "Choila de galinha", 14, "main_course", 7);
INSERT INTO Dish VALUES (NULL, "Arroz frito com camarão", 15, "main_course", 7);
INSERT INTO Dish VALUES (NULL, "Chow Mein - vaca", 14, "main_course", 7);
INSERT INTO Dish VALUES (NULL, "Phad Thai - tofu", 14, "main_course", 7);
INSERT INTO Dish VALUES (NULL, "Caril cremoso", 17, "main_course", 7);
INSERT INTO Dish VALUES (NULL, "Mousse de Chocolate com côco", 6, "dessert", 7);
INSERT INTO Dish VALUES (NULL, "Café", 1, "drink", 8);
INSERT INTO Dish VALUES (NULL, "Água", 2, "drink", 8);

INSERT INTO Dish VALUES (NULL, "Nachos com guacamole (vegan)", 7, "appetizer", 8);
INSERT INTO Dish VALUES (NULL, "Nachos com chili de carne", 10, "appetizer", 8);
INSERT INTO Dish VALUES (NULL, "Pastel de carnitas", 3, "appetizer", 8);
INSERT INTO Dish VALUES (NULL, "Chili de carne com arroz", 10, "main_course", 8);
INSERT INTO Dish VALUES (NULL, "Ceviche de garoupa", 7, "main_course", 8);
INSERT INTO Dish VALUES (NULL, "Quesadilha de camarao", 9, "main_course", 8);
INSERT INTO Dish VALUES (NULL, "Taco de fajitas de picanha", 9, "main_course", 8);
INSERT INTO Dish VALUES (NULL, "Burrito vegetariano", 7, "main_course", 8);
INSERT INTO Dish VALUES (NULL, "Tarte de lima e chocolate", 4, "dessert", 8);
INSERT INTO Dish VALUES (NULL, "Brigadeiro de tequilla", 4, "dessert", 8);
INSERT INTO Dish VALUES (NULL, "Água", 2, "drink", 8);

INSERT INTO Dish VALUES (NULL, "Rolinhos de Carrillera", 9, "appetizer", 9);
INSERT INTO Dish VALUES (NULL, "Croquetas de Presunto", 9, "appetizer", 9);
INSERT INTO Dish VALUES (NULL, "Hamburguer Ibérico", 10, "main_course", 9);
INSERT INTO Dish VALUES (NULL, "Preher", 10, "main_course", 9);
INSERT INTO Dish VALUES (NULL, "Bocadillo de Secreto Marinado", 9, "main_course", 9);
INSERT INTO Dish VALUES (NULL, "Bocadillo de Lomo de Belota", 8, "main_course", 9);
INSERT INTO Dish VALUES (NULL, "Tábua Trijamón", 30, "main_course", 9);
INSERT INTO Dish VALUES (NULL, "Tábua de Queijos Ibéricos", 15, "main_course", 9);
INSERT INTO Dish VALUES (NULL, "Ovos Rotos", 4, "main_course", 9);
INSERT INTO Dish VALUES (NULL, "Creme Catalana", 4, "dessert", 9);
INSERT INTO Dish VALUES (NULL, "Tarte de Lima", 4, "dessert", 9);
INSERT INTO Dish VALUES (NULL, "Strudel de Maçã", 6, "dessert", 9);
INSERT INTO Dish VALUES (NULL, "Água", 3, "drink", 9);
INSERT INTO Dish VALUES (NULL, "Café", 1, "drink", 9);

INSERT INTO Dish VALUES (NULL, "Bruchetta clássica", 5, "appetizer", 10);
INSERT INTO Dish VALUES (NULL, "Mini Coxinhas de frango", 6, "appetizer", 10);
INSERT INTO Dish VALUES (NULL, "Queijo Provolone empanado", 8, "appetizer", 10);
INSERT INTO Dish VALUES (NULL, "Caldinho de feijoada", 5, "soup", 10);
INSERT INTO Dish VALUES (NULL, "Feijoada brasileira", 7, "main_course", 10);
INSERT INTO Dish VALUES (NULL, "Costela de vitela", 7, "main_course", 10);
INSERT INTO Dish VALUES (NULL, "Picanha à Brasileira", 16, "main_course", 10);
INSERT INTO Dish VALUES (NULL, "Moqueca de Peixe com Camarão", 15, "main_course", 10);
INSERT INTO Dish VALUES (NULL, "Brasileirinho", 11, "main_course", 10);
INSERT INTO Dish VALUES (NULL, "Taça ferrero", 9, "dessert", 10);
INSERT INTO Dish VALUES (NULL, "Pudim de leite", 4, "dessert", 10);
INSERT INTO Dish VALUES (NULL, "Brownie com gelado de baunilha e paçoca", 7, "dessert", 10);
INSERT INTO Dish VALUES (NULL, "Água", 2, "drink", 9);
INSERT INTO Dish VALUES (NULL, "Café", 1, "drink", 9);

INSERT INTO Dish VALUES (NULL, "Pão, manteiga e fuet", 3, "appetizer", 11);
INSERT INTO Dish VALUES (NULL, "Pimentos Padrón", 10, "appetizer", 11);
INSERT INTO Dish VALUES (NULL, "Carpaccio de polvo", 12, "appetizer", 11);
INSERT INTO Dish VALUES (NULL, "Croquete KOB", 3, "appetizer", 11);
INSERT INTO Dish VALUES (NULL, "Vieiras gratinadas com béchamel de trufa e parmesão", 25, "main_course", 11);
INSERT INTO Dish VALUES (NULL, "Bife Tártaro", 20, "main_course", 11);
INSERT INTO Dish VALUES (NULL, "Bife K.O.B", 23, "main_course", 11);
INSERT INTO Dish VALUES (NULL, "Bife Olivier", 27, "main_course", 11);
INSERT INTO Dish VALUES (NULL, "New York Black Angus Steak", 42, "main_course", 11);
INSERT INTO Dish VALUES (NULL, "Cheesecake KOB", 8, "dessert", 11);
INSERT INTO Dish VALUES (NULL, "Fruta da época", 6, "dessert", 11);
INSERT INTO Dish VALUES (NULL, "Água", 3, "drink", 11);

INSERT INTO Dish VALUES (NULL, "Salada De Endívias Com Molho Roquefort", 12, "appetizer", 12);
INSERT INTO Dish VALUES (NULL, "Salmão Da Escócia Fumado", 13, "appetizer", 12);
INSERT INTO Dish VALUES (NULL, "Concha De Gambas Gratinada", 13, "appetizer", 12);
INSERT INTO Dish VALUES (NULL, "Abacate Recheado Com Frutos Do Mar", 14, "appetizer", 12);
INSERT INTO Dish VALUES (NULL, "Sopa De Cebola Gratinada", 8, "soup", 12);
INSERT INTO Dish VALUES (NULL, "reme De Marisco", 9, "soup", 12);
INSERT INTO Dish VALUES (NULL, "Filetes De Linguado Walewska", 36, "main_course", 12);
INSERT INTO Dish VALUES (NULL, "Bacalhau À Marinheiro", 23, "main_course", 12);
INSERT INTO Dish VALUES (NULL, "Bife À Portucale", 26, "main_course", 12);
INSERT INTO Dish VALUES (NULL, "Chateaubriand Com Cogumelos", 26, "main_course", 12);
INSERT INTO Dish VALUES (NULL, "Doces Conventuais", 9, "dessert", 12);
INSERT INTO Dish VALUES (NULL, "Frutos Tropicais", 7, "dessert", 12);
INSERT INTO Dish VALUES (NULL, "Água", 3, "drink", 12);

INSERT INTO Dish VALUES (NULL, "Croquetes de camarão", 7, "appetizer", 13);
INSERT INTO Dish VALUES (NULL, "Tábua mista", 12, "appetizer", 13);
INSERT INTO Dish VALUES (NULL, "Risotto de bacalhau", 9, "main_course", 13);
INSERT INTO Dish VALUES (NULL, "Choco frito com maionese de lima", 9, "main_course", 13);
INSERT INTO Dish VALUES (NULL, "Tártaro de atum", 11, "main_course", 13);
INSERT INTO Dish VALUES (NULL, "Brownie de chocolate com gelado de avelã", 5, "dessert", 13);
INSERT INTO Dish VALUES (NULL, "Pudim abade priscos", 6, "dessert", 13);
INSERT INTO Dish VALUES (NULL, "Água", 3, "drink", 13);

INSERT INTO Dish VALUES (NULL, "Burrata", 14, "appetizer", 14);
INSERT INTO Dish VALUES (NULL, "Pizza TOSCANA", 11, "main_course", 14);
INSERT INTO Dish VALUES (NULL, "Pizza EMILIA ROMAGNA", 12, "main_course", 14);
INSERT INTO Dish VALUES (NULL, "Pizza LOMBARDIA", 10, "main_course", 14);
INSERT INTO Dish VALUES (NULL, "Pizza LAZIO", 10, "main_course", 14);
INSERT INTO Dish VALUES (NULL, "Panna Cotta", 4, "dessert", 14);
INSERT INTO Dish VALUES (NULL, "Pizza Nutella", 9, "dessert", 14);
INSERT INTO Dish VALUES (NULL, "Água", 3, "drink", 14);
INSERT INTO Dish VALUES (NULL, "Café", 1, "drink", 14);

INSERT INTO Dish VALUES (NULL, "Mac & Cheese", 4, "appetizer", 15);
INSERT INTO Dish VALUES (NULL, "Onion rings", 3, "appetizer", 15);
INSERT INTO Dish VALUES (NULL, "Classic Hot Dog", 6, "main_course", 15);
INSERT INTO Dish VALUES (NULL, "Cheeseburger", 6, "main_course", 15);
INSERT INTO Dish VALUES (NULL, "Barbecue Ribs", 14, "main_course", 15);
INSERT INTO Dish VALUES (NULL, "Bife da Vazia", 16, "main_course", 15);
INSERT INTO Dish VALUES (NULL, "Apple pie", 4, "dessert", 15);
INSERT INTO Dish VALUES (NULL, "New York Cheescake", 5, "dessert", 15);
INSERT INTO Dish VALUES (NULL, "Brownie de Chocolate", 4, "dessert", 15);
INSERT INTO Dish VALUES (NULL, "Água", 2, "drink", 15);
INSERT INTO Dish VALUES (NULL, "Café", 1, "drink", 15);

INSERT INTO Dish VALUES (NULL, "Chamuça de carne ou vegetais", 2, "appetizer", 16);
INSERT INTO Dish VALUES (NULL, "Pasteis indianos", 3, "appetizer", 16);
INSERT INTO Dish VALUES (NULL, "Galinha pakora", 3, "appetizer", 16);
INSERT INTO Dish VALUES (NULL, "Sopa de frango", 3, "soup", 16);
INSERT INTO Dish VALUES (NULL, "Caril de camarões com espinafres e especiarias", 13, "main_course", 16);
INSERT INTO Dish VALUES (NULL, "Camarões temperados com ervas e condimentos do karahi", 11, "main_course", 16);
INSERT INTO Dish VALUES (NULL, "Frango marinado em iogurte e temperos orientais", 8, "main_course", 16);
INSERT INTO Dish VALUES (NULL, "Babinca", 3, "dessert", 16);
INSERT INTO Dish VALUES (NULL, "Badam kulfi", 3, "dessert", 16);
INSERT INTO Dish VALUES (NULL, "Ras malai", 3, "dessert", 16);
INSERT INTO Dish VALUES (NULL, "Água", 2, "drink", 16);

INSERT INTO Dish VALUES (NULL, "Pão de Queijo", 4, "appetizer", 17);
INSERT INTO Dish VALUES (NULL, "Pão e Manteiga Aromatizada", 1, "appetizer", 17);
INSERT INTO Dish VALUES (NULL, "Rodizio Dona Picanha", 36, "main_course", 17);
INSERT INTO Dish VALUES (NULL, "Rodizio Picanha", 40, "main_course", 17);
INSERT INTO Dish VALUES (NULL, "Picanha Premium", 27, "main_course", 17);
INSERT INTO Dish VALUES (NULL, "Água", 2, "drink", 17);

INSERT INTO Dish VALUES (NULL, "Asas de Frango c/ Molho Bufalo", 9, "appetizer", 18);
INSERT INTO Dish VALUES (NULL, "Bolas Crocantes de Alheira", 9, "appetizer", 18);
INSERT INTO Dish VALUES (NULL, "Presunto de Bolota Ibérico", 14, "appetizer", 18);
INSERT INTO Dish VALUES (NULL, "Posta de Vitela", 19, "main_course", 18);
INSERT INTO Dish VALUES (NULL, "Costeletão de Vitela", 52, "main_course", 18);
INSERT INTO Dish VALUES (NULL, "Bife da Vazia Black Angus", 25, "main_course", 18);
INSERT INTO Dish VALUES (NULL, "Mini Preguinho c/ Ovo Estrelado e Batatas Fritas", 12, "main_course", 18);
INSERT INTO Dish VALUES (NULL, "Tataki de Salmão", 20, "main_course", 18);
INSERT INTO Dish VALUES (NULL, "Tentáculo de Polvo c/Puré de Batata Doce", 28, "main_course", 18);
INSERT INTO Dish VALUES (NULL, "Cheesecake de Banana e Twix", 8, "dessert", 18);
INSERT INTO Dish VALUES (NULL, "Bola de Gelado", 3, "dessert", 18);
INSERT INTO Dish VALUES (NULL, "Pastel de Leite Creme", 8, "dessert", 18);
INSERT INTO Dish VALUES (NULL, "Água", 2, "drink", 18);

INSERT INTO Dish VALUES (NULL, "Gamba en Carpaccio y en su Jugo", 24, "appetizer", 19);
INSERT INTO Dish VALUES (NULL, "Croquetas de Jamón Ibérico", 12, "appetizer", 19);
INSERT INTO Dish VALUES (NULL, "Lomo de Merluza con Almejas", 26, "main_course", 19);
INSERT INTO Dish VALUES (NULL, "Costilla de Cerdo de Caserío", 19, "main_course", 19);
INSERT INTO Dish VALUES (NULL, "Vaca Vieja", 7, "main_course", 19);
INSERT INTO Dish VALUES (NULL, "Tortilla de Anchoa", 12, "main_course", 19);
INSERT INTO Dish VALUES (NULL, "Tarta de Queso de Leche", 10, "dessert", 19);
INSERT INTO Dish VALUES (NULL, "Arroz con Leche", 7, "dessert", 19);
INSERT INTO Dish VALUES (NULL, "Trufas de Chocolate al Sagardoz", 7, "dessert", 19);
INSERT INTO Dish VALUES (NULL, "Arima de Gorka Izagirre", 4, "drink", 19);
INSERT INTO Dish VALUES (NULL, "Água", 2, "drink", 19);

INSERT INTO Dish VALUES (NULL, "Croquetes de Alheira", 5, "appetizer", 20);
INSERT INTO Dish VALUES (NULL, "Gambas ao Alho", 9, "appetizer", 20);
INSERT INTO Dish VALUES (NULL, "Ameijoas à Artesão", 10, "appetizer", 20);
INSERT INTO Dish VALUES (NULL, "Polvo à Lagareiro", 18, "main_course", 20);
INSERT INTO Dish VALUES (NULL, "Vitela Assada", 17, "main_course", 20);
INSERT INTO Dish VALUES (NULL, "Feijoada de Gambas", 16, "main_course", 20);
INSERT INTO Dish VALUES (NULL, "Cachaço de Porco Bísaro", 17, "main_course", 20);
INSERT INTO Dish VALUES (NULL, "Suspiro, Gin Fizz", 6, "dessert", 20);
INSERT INTO Dish VALUES (NULL, "Morango, Framboesa", 9, "dessert", 20);
INSERT INTO Dish VALUES (NULL, "Café", 1, "drink", 20);
INSERT INTO Dish VALUES (NULL, "Água", 2, "drink", 20);

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

INSERT INTO Review VALUES (NULL, 7, 5, 9, 1635347252, "Et harum quidem rerum facilis est et expedita distinctio.");

INSERT INTO Review VALUES (NULL, 8, 5, 8, 1635347252, "Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.");
INSERT INTO Review VALUES (NULL, 8, 1, 9, 1635347252, "Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.");

INSERT INTO Review VALUES (NULL, 9, 5, 9, 1635347252, "Et harum quidem rerum facilis est et expedita distinctio.");

INSERT INTO Review VALUES (NULL, 10, 3, 8, 1635347252, "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.");

INSERT INTO Review VALUES (NULL, 11, 3, 8, 1635347252, "Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.");
INSERT INTO Review VALUES (NULL, 11, 3, 6, 1635347252, "Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.");

INSERT INTO Review VALUES (NULL, 12, 5, 7, 1635347252, "Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur.");

INSERT INTO Review VALUES (NULL, 13, 1, 8, 1635347252, "Vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.");

INSERT INTO Review VALUES (NULL, 14, 1, 8, 1635347252, "Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.");

INSERT INTO Review VALUES (NULL, 15, 1, 7, 1635347252, "Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur.");

INSERT INTO Review VALUES (NULL, 16, 1, 8, 1635347252, "Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur.");
INSERT INTO Review VALUES (NULL, 16, 3, 5, 1635347252, "Adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.");

INSERT INTO Review VALUES (NULL, 17, 1, 5, 1635347252, "Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur.");

INSERT INTO Review VALUES (NULL, 18, 3, 7, 1635347252, "Vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.");

INSERT INTO Review VALUES (NULL, 19, 3, 6, 1635347252, "Id est laborum et dolorum fuga.");

INSERT INTO Review VALUES (NULL, 20, 3, 6, 1635347252, "Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus.");
INSERT INTO Review VALUES (NULL, 20, 1, 9, 1635347252, "Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.");


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
