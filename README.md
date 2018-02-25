### Context
ESIGELEC is proud to be one of the leading school in foreign students welcoming in France.
To promote mutual knowledge of each other’s culture, the school would like to set up a web site
where students could share cooking recipes from their own country. Your job is to create this web
site with the following objectives:
1. Let student add recipes for a given country,
2. Let students create categories and assign category tags to recipes,
3. Let the web site manager edit categories and remove tags.

### Website Scheme
The Following diagram describes the website scheme and the various navigations in the
website.
![scheme](https://user-images.githubusercontent.com/27300641/36646525-e8318688-1a78-11e8-9697-91338638d1ef.jpg)

### Queries
1. USERS
2. CATEGORY
3. RECIPE


CREATE DATABASE project;

USE project;

CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    admin BIT(1) DEFAULT 0 NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE category (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE recipe (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL UNIQUE,
    ingredients VARCHAR(255) NOT NULL,
    description VARCHAR(3000) NOT NULL,
    admin BIT(1) DEFAULT 0 NOT NULL,
    category_id INT,
    user_id INT NOT NULL,
    CONSTRAINT FK_CategoryRecipe FOREIGN KEY (category_id) REFERENCES category(id),
    CONSTRAINT FK_UserRecipe FOREIGN KEY (user_id) REFERENCES users(id)
);
