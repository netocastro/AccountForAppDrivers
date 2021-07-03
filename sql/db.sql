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

    insert into `users`(cpf, email, name, password) VALUES('000.000.000-01','admin@admin.com','Admin','$2y$10$VcJ3jxidUIENrTywpUpe..1m37YJZiAbif7uarDLF5HlsmCrAmLZ6');
    insert into `users`(cpf, email, name, password) VALUES('072.726.284.05','netocastrotec@gmail.com','Neto Castro','$2y$10$VcJ3jxidUIENrTywpUpe..1m37YJZiAbif7uarDLF5HlsmCrAmLZ6');

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

    insert into apps(name) VALUES ('Uber'), ('99'),('cabify'),('maxim'),('2v');

    CREATE TABLE `user_dates`(
        `id` INTEGER UNIQUE NOT NULL AUTO_INCREMENT,
        `user_id` INTEGER NOT NULL,
        `date_id` INTEGER NOT NULL,

        PRIMARY KEY(id)
    ); 

    ALTER TABLE user_dates ADD FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE on DELETE CASCADE;
    ALTER TABLE user_dates ADD FOREIGN KEY (date_id) REFERENCES dates(id) ON UPDATE CASCADE on DELETE CASCADE;

    CREATE TABLE `user_apps`(
        `id` INTEGER UNIQUE NOT NULL AUTO_INCREMENT,
        `user_id` INTEGER NOT NULL,
        `app_id` INTEGER NOT NULL,

        PRIMARY KEY(id)
    ); 

    ALTER TABLE user_apps ADD FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE on DELETE CASCADE;
    ALTER TABLE user_apps ADD FOREIGN KEY (app_id) REFERENCES apps(id) ON UPDATE CASCADE on DELETE CASCADE;

    insert into user_apps(user_id, app_id) VALUES ('1','1'), ('1','2'),('2','1'), ('2','2');

    CREATE TABLE `apps_accounts`(
        `id` INTEGER UNIQUE NOT NULL AUTO_INCREMENT,
        `user_date_id` INTEGER NOT null,
        `user_app_id` INTEGER  NOT NULL,
        `money` FLOAT(6,2) NOT null,        

        PRIMARY KEY(id)
    );

    ALTER TABLE apps_accounts ADD FOREIGN KEY (user_date_id) REFERENCES user_dates(id) ON UPDATE CASCADE on DELETE CASCADE;
    ALTER TABLE apps_accounts ADD FOREIGN KEY (user_app_id) REFERENCES user_apps(id) ON UPDATE CASCADE on DELETE CASCADE;

    CREATE TABLE `historic`(
        `id` INTEGER UNIQUE NOT NULL AUTO_INCREMENT,
        `user_date_id` INTEGER UNIQUE not null,
        `money` FLOAT(6,2) NOT NULL , -- dinheiro
        `expenses` FLOAT(6,2) NOT NULL, -- gastos
        `balance` FLOAT(6,2) NOT NULL , -- saldo

        PRIMARY KEY(id)
    );

    ALTER TABLE historic ADD FOREIGN KEY (user_date_id) REFERENCES user_dates(id) ON UPDATE CASCADE on DELETE CASCADE;
