USE book_club;
 
CREATE TABLE members (
 id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
 username VARCHAR(30) BINARY NOT NULL UNIQUE,
 password CHAR(41) NOT NULL,
 first_name VARCHAR(30) NOT NULL,
 last_name VARCHAR(30) NOT NULL,
 join_date DATE NOT NULL,
 gender ENUM( 'm', 'f' ) NOT NULL,
 favorite_genre ENUM( 'crime', 'horror', 'thriller', 'romance', 'sciFi', 
'adventure', 'nonFiction' ) NOT NULL,
 email_address VARCHAR(50) NOT NULL UNIQUE,
 other_interests TEXT NOT NULL,
 PRIMARY KEY (id)
);
 
INSERT INTO members VALUES( 1, 'sparky', password('mypass'), 'John', 
'Sparks', '2007-11-13', 'm', 'crime', 'jsparks@example.com', 'Football, 
fishing and gardening' );
INSERT INTO members VALUES( 2, 'mary', password('mypass'), 'Mary', 'Newton', 
'2007-02-06', 'f', 'thriller', 'mary@example.com', 'Writing, hunting and 
travel' );
INSERT INTO members VALUES( 3, 'jojo', password('mypass'), 'Jo', 'Scrivener', 
'2006-09-03', 'f', 'romance', 'jscrivener@example.com', 'Genealogy, writing, 
painting' );
INSERT INTO members VALUES( 4, 'marty', password('mypass'), 'Marty', 
'Pareene', '2007-01-07', 'm', 'horror', 'marty@example.com', 'Guitar playing, 
rock music, clubbing' );
INSERT INTO members VALUES( 5, 'nickb', password('mypass'), 'Nick', 
'Blakeley', '2007-08-19', 'm', 'sciFi', 'nick@example.com', 'Watching movies, 
cooking, socializing' );
INSERT INTO members VALUES( 6, 'bigbill', password('mypass'), 'Bill', 'Swan', 
'2007-06-11', 'm', 'nonFiction', 'billswan@example.com', 'Tennis, judo, 
music' );
INSERT INTO members VALUES( 7, 'janefield', password('mypass'), 'Jane', 
'Field', '2006-03-03', 'f', 'crime', 'janefield@example.com', 'Thai cookery, 
gardening, traveling' );
 
CREATE TABLE accessLog (
 member_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
 page_url VARCHAR(255) NOT NULL,
 num_visits MEDIUMINT NOT NULL,
 last_access TIMESTAMP NOT NULL,
 PRIMARY KEY (member_id, page_url)
);
 
INSERT INTO accessLog( member_id, page_url, num_visits ) VALUES( 1, 'diary.php', 
2 );
INSERT INTO accessLog( member_id, page_url, num_visits ) VALUES( 3, 'books.php', 
2 );
INSERT INTO accessLog( member_id, page_url, num_visits ) VALUES( 3, 'contact
.php', 1 );
INSERT INTO accessLog( member_id, page_url, num_visits ) VALUES( 6, 'books.php', 
4 );