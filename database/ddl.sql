-- ************************************** `website`.`user`
CREATE TABLE `website`.`user`
(
 `user_id`           int NOT NULL AUTO_INCREMENT,
 `login`             varchar(45) NOT NULL UNIQUE,
 `password`          varchar(45) NOT NULL ,
 `email`             varchar(100) NOT NULL UNIQUE,
 `registration_date` datetime NOT NULL ,

PRIMARY KEY (`user_id`)
);

-- ************************************** `website`.`movie`
CREATE TABLE `website`.`movie`
(
 `movie_id`     int NOT NULL AUTO_INCREMENT,
 `title`        varchar(100) NOT NULL ,
 `director`     varchar(100) NOT NULL ,
 `release_date` date NOT NULL ,
 `genre`        varchar(100) NOT NULL ,

PRIMARY KEY (`movie_id`)
);

-- ************************************** `website`.`reviews`
CREATE TABLE `website`.`reviews`
(
 `review_id` int NOT NULL AUTO_INCREMENT,
 `user_id`   int NOT NULL ,
 `movie_id`  int NOT NULL ,
 `rating`    int NOT NULL ,
 `text`      text NOT NULL ,

PRIMARY KEY (`review_id`, `user_id`, `movie_id`),
KEY `FK_26` (`user_id`),
CONSTRAINT `FK_24` FOREIGN KEY `FK_26` (`user_id`) REFERENCES `website`.`user` (`user_id`),
KEY `FK_29` (`movie_id`),
CONSTRAINT `FK_27` FOREIGN KEY `FK_29` (`movie_id`) REFERENCES `website`.`movie` (`movie_id`)
);