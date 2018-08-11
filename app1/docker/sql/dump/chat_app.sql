-- Adminer 4.6.3 PostgreSQL dump

DROP TABLE IF EXISTS "users";
DROP SEQUENCE IF EXISTS users_id_seq;
CREATE SEQUENCE users_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."users" (
    "id" integer DEFAULT nextval('users_id_seq') NOT NULL,
    "name" character varying(100) NOT NULL,
    "password" character varying(255) NOT NULL,
    CONSTRAINT "users_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "users" ("id", "name", "password") VALUES
(1,	'woprrr',	'$2y$10$ja0j2v6x0XU1a6VX2YQiiOjdLN/ckTKxf/0CXZOOOJN7V6Prdrkj2'),
(2,	'woprrr2',	'$2y$10$ja0j2v6x0XU1a6VX2YQiiOjdLN/ckTKxf/0CXZOOOJN7V6Prdrkj2');

DROP TABLE IF EXISTS "chats";
DROP SEQUENCE IF EXISTS chats_id_seq;
CREATE SEQUENCE chats_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."chats" (
    "id" integer DEFAULT nextval('chats_id_seq') NOT NULL,
    "type" character varying(10) NOT NULL,
    CONSTRAINT "chats_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "chats" ("id", "type") VALUES
(1,	'public'),
(2,	'private');

DROP TABLE IF EXISTS "messages";
DROP SEQUENCE IF EXISTS messages_id_seq;
CREATE SEQUENCE messages_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 9223372036854775807 START 1 CACHE 1;

CREATE TABLE "public"."messages" (
    "id" integer DEFAULT nextval('messages_id_seq') NOT NULL,
    "user_id" integer NOT NULL,
    "chat_id" integer NOT NULL,
    "text" text NOT NULL,
    "created_at" timestamp DEFAULT now() NOT NULL,
    CONSTRAINT "messages_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "messages_chat_id_fkey" FOREIGN KEY (chat_id) REFERENCES chats(id) ON UPDATE CASCADE ON DELETE SET NULL NOT DEFERRABLE,
    CONSTRAINT "messages_user_id_fkey" FOREIGN KEY (user_id) REFERENCES users(id) NOT DEFERRABLE
) WITH (oids = false);

INSERT INTO "messages" ("id", "user_id", "chat_id", "text", "created_at") VALUES
(55,	1,	1,	'Bienvenue dans le IAD France chat :)',	'2018-08-11 13:53:52.734156'),
(56,	1,	1,	'Vous pouvez entrer tout type de messages ici, c’est public !!',	'2018-08-11 13:55:10.473385'),
(57,	1,	2,	'Ceci est une démonstration du mode Private room entre deux users.',	'2018-08-11 14:01:25.226099'),
(58,	1,	2,	'Malheureusement, il me manque un peu de temps pour pouvoir coder le en-point qui permet de générer les requests permettant de le faire avec n’importe quel user. Le but de cette room, c’est de le démontrer.',	'2018-08-11 14:03:13.254587');

DROP TABLE IF EXISTS "user_chats";
CREATE TABLE "public"."user_chats" (
    "chat_id" integer NOT NULL,
    "user_chat_id" integer NOT NULL,
    "user2_chat_id" integer NOT NULL,
    CONSTRAINT "user_chats_chat_id_fkey" FOREIGN KEY (chat_id) REFERENCES chats(id) ON DELETE SET NULL NOT DEFERRABLE,
    CONSTRAINT "user_chats_user2_chat_id_fkey" FOREIGN KEY (user2_chat_id) REFERENCES users(id) ON DELETE SET NULL NOT DEFERRABLE,
    CONSTRAINT "user_chats_user_chat_id_fkey" FOREIGN KEY (user_chat_id) REFERENCES users(id) ON DELETE SET NULL NOT DEFERRABLE
) WITH (oids = false);

INSERT INTO "user_chats" ("chat_id", "user_chat_id", "user2_chat_id") VALUES
(2,	1,	2);

-- 2018-08-11 14:05:33.132732+00
