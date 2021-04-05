    drop table if exists historic;
    drop table if exists apps_accounts;
    drop table if exists user_apps;
    drop table if exists user_dates;
    drop table if exists dates;
    drop table if exists apps;
    drop table if exists users;

    CREATE TABLE `users`(
        `id` INTEGER UNIQUE NOT NULL AUTO_INCREMENT,
        `cpf` CHARACTER(15) UNIQUE NOT NULL,
        `email` varchar(50) UNIQUE NOT NULL,
        `name` varchar(50) NOT NULL,
        `password` varchar(64) NOT NULL,
        
        PRIMARY KEY(id)
    );  

    insert into `users`(cpf, email, name, password) VALUES('000.000.000-01','a@a.com','Joao Silva','QL0AFWMIX8NRZTKeof9cXsvbvu8=');

    CREATE TABLE `dates`(
        `id` INTEGER UNIQUE NOT NULL AUTO_INCREMENT,
        `date` date  NOT NULL,
        
        PRIMARY KEY(id)
    );   

    CREATE TABLE `apps`(
        `id` INTEGER UNIQUE NOT NULL AUTO_INCREMENT,
        `name` varchar(20) UNIQUE NOT NULL,

        PRIMARY KEY(id)
    ); 

    insert into apps(name) VALUES ('Uber'), ('99'),('cabify'),('2v'),('Extra');

    CREATE TABLE `user_dates`(
        `id` INTEGER UNIQUE NOT NULL AUTO_INCREMENT,
        `user_id` INTEGER NOT NULL,
        `date_id` INTEGER NOT NULL,

        PRIMARY KEY(id)
    ); 

    ALTER TABLE user_dates ADD FOREIGN KEY (user_id) REFERENCES Users(id) ON UPDATE CASCADE on DELETE CASCADE;
    ALTER TABLE user_dates ADD FOREIGN KEY (date_id) REFERENCES Dates(id) ON UPDATE CASCADE on DELETE CASCADE;

    CREATE TABLE `user_apps`(
        `id` INTEGER UNIQUE NOT NULL AUTO_INCREMENT,
        `user_id` INTEGER NOT NULL,
        `app_id` INTEGER NOT NULL,

        PRIMARY KEY(id)
    ); 

    ALTER TABLE user_apps ADD FOREIGN KEY (user_id) REFERENCES Users(id) ON UPDATE CASCADE on DELETE CASCADE;
    ALTER TABLE user_apps ADD FOREIGN KEY (app_id) REFERENCES Apps(id) ON UPDATE CASCADE on DELETE CASCADE;

    insert into user_apps(user_id, app_id) VALUES ('1','1'), ('1','2');

    CREATE TABLE `apps_accounts`(
        `id` INTEGER UNIQUE NOT NULL AUTO_INCREMENT,
        `user_date_id` INTEGER NOT null,
        `user_app_id` INTEGER  NOT NULL,
        `money` FLOAT(6,2) NOT null,        

        PRIMARY KEY(id)
    );

    ALTER TABLE apps_accounts ADD FOREIGN KEY (user_date_id) REFERENCES user_dates(id) ON UPDATE CASCADE on DELETE CASCADE;
    ALTER TABLE apps_accounts ADD FOREIGN KEY (user_app_id) REFERENCES User_apps(id) ON UPDATE CASCADE on DELETE CASCADE;

    CREATE TABLE `historic`(
        `id` INTEGER UNIQUE NOT NULL AUTO_INCREMENT,
        `user_date_id` INTEGER UNIQUE not null,
        `money` FLOAT(6,2) NOT NULL , -- dinheiro
        `expenses` FLOAT(6,2) NOT NULL, -- gastos
        `balance` FLOAT(6,2) NOT NULL , -- saldo

        PRIMARY KEY(id)
    );

    ALTER TABLE historic ADD FOREIGN KEY (user_date_id) REFERENCES user_dates(id) ON UPDATE CASCADE on DELETE CASCADE;
