DROP DATABASE IF EXISTS tp2;
CREATE DATABASE tp2;

USE tp2;

/*
 * Définition des tables.
 */

CREATE TABLE users 
(
    id               INT                 NOT NULL AUTO_INCREMENT,
    email            VARCHAR(100) UNIQUE NOT NULL,
    password         TEXT                NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE product 
(
    sku         CHAR(8)       NOT NULL,
    name        VARCHAR(255)  NOT NULL,
    description TEXT          NOT NULL,
    price       DECIMAL(15,2) NOT NULL,
    stock       INT           NOT NULL DEFAULT 0,
	PRIMARY KEY(sku)
);

CREATE TABLE `order` (
    id            INT      NOT NULL AUTO_INCREMENT,
    user_id       INT      NOT NULL,
    creation_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(id),
	FOREIGN KEY(user_id) REFERENCES users(id)
);

CREATE TABLE order_item (
    id          INT     NOT NULL AUTO_INCREMENT,
    order_id    INT     NOT NULL,
    product_sku CHAR(8) NOT NULL,
    quantity    INT     NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(order_id) REFERENCES `order`(id),
    FOREIGN KEY(product_sku) REFERENCES product(sku)
);

/*
 * Insertion des données de départ.
 *
 * Pour vous aider dans vos tests, quelques produits sont en faibles quantités (voir déjà indisponibles). 
 * En voici la liste :
 *
 *   - Manteau d'hiver Ursidae (x0)
 *   - Foulard polaire (x1)
 *   - Foulard gris (x2)
 *   - Sac à dos (x2)
 *   - Tuque rouge (x2)
 */

INSERT INTO product 
	(sku, name, description, price, stock)
VALUES 
	("CW612458", "T-shirt blanc", "100% polyester. Facile à laver.", 9.99, 50),
	("CW612457", "T-shirt noir", "100% polyester. Facile à laver.", 9.99, 30),
    ("CW963258", "Chaussettes Ourson (x5)", "Lot de cinq chaussettes avec motif ourson. Très mignonnes.", 6.99, 200),
    ("CW887414", "Bas Grizzly (x10)", "Dix bas de laine gris. Très résistants.", 19.99, 200),
    ("AW325698", "Foulard gris", "Écharpe douce et chaude en laine. Idéale pour l'hiver.", 14.99, 2),
    ("AW124876", "Foulard polaire", "En cachemire doux pour un confort optimal pendant les journées froides.", 24.99, 1), 
    ("AW745821", "Gants Nounours", "Gants confortables en laine pour garder vos mains au chaud.", 7.99, 40),
    ("AW678523", "Mitaines grises", "Fabriquées en laine chaude et confortable. Très résistantes.", 14.99, 20),
    ("CW154789", "Manteau d'hiver Ursidae", "Manteau pour l'hiver très chaud avec doublure.", 209.99, 0),
    ("CW478512", "Chandail de laine", "Chandail élégant en laine. Parfait pour toutes les saisons.", 34.99, 40),
    ("AW632147", "Tuque rouge", "Tuque rouge vif. Style décontracté et abordable.", 5.99, 2),
    ("CW785412", "Chemise à carreaux", "Chemise classique à carreaux pour un look décontracté.", 29.99, 40),
    ("CW874596", "Coton-ouaté blanc", "Coton-ouaté à capuche. Confortable et stylé.", 35.99, 10),
    ("CW874123", "Chandail à col roulé", "Chandail à col roulé chaud et confortable. Idéal pour l'automne.", 29.99, 10),
    ("AW453271", "Sac à dos", "Sac à dos noir. Parfait pour l'école ou les déplacements.", 65.99, 2);