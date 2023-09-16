create database nequa01;

use nequa01;

CREATE TABLE `nequa01`. `nequa_cadastrop` (
  `id` INT UNSIGNED NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `email` VARCHAR(130) NOT NULL,
  `telefone` VARCHAR(15) NOT NULL,
  `sexo` VARCHAR(15) NOT NULL,
  `data_nasc` DATE NOT NULL,
  `cidade` VARCHAR(45) NOT NULL,
  `estado` VARCHAR(45) NOT NULL,
  `endereco` VARCHAR(60) NOT NULL,
  `cpf` VARCHAR(11) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`));
  
  
  CREATE TABLE `nequa01`. `nequa_cadastroe` (
  `id` INT UNSIGNED NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `email` VARCHAR(130) NOT NULL,
  `telefone` VARCHAR(15) NOT NULL,
  `cidade` VARCHAR(45) NOT NULL,
  `estado` VARCHAR(45) NOT NULL,
  `endereco` VARCHAR(60) NOT NULL,
  `cpnj` VARCHAR(14) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`));


CREATE TABLE `nequa01`.`nequa_template` (
  `id` INT NOT NULL,
  `titulo_template` VARCHAR(45) NOT NULL,
  `descricao_template` VARCHAR(500) NOT NULL,
  `patch` VARCHAR(100) NOT NULL,
  `data_upload` DATETIME DEFAULT NOW(),
  PRIMARY KEY (`id`)
  );

CREATE TABLE `nequa01`.`nequa_usuario` (
  `id` INT UNSIGNED NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `areas_atuacao` VARCHAR(45) NOT NULL,
  `contatos` VARCHAR(45) NOT NULL,
  `biografia` VARCHAR(1500) NOT NULL,
  `patch_banner` VARCHAR(100) NOT NULL,
  `patch_imagem` VARCHAR(100) NOT NULL,
  `data_upload` DATETIME DEFAULT NOW(),
  `visitas` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
 foreign key (id) references nequa_cadastrop (id),
	foreign key (nome) references nequa_cadastrop (nome),
	foreign key (email) references nequa_cadastrop (email)
  );
  

  
  
  



select * from nequa_cadastrop;
select * from nequa_cadastroe;
select * from nequa_template;
select * from nequa_usuario;
select * from nequa_visitas;

insert into nequa_cadastrop (id, nome, email, telefone, sexo, data_nasc, cidade, estado, endereco, cpf, senha) values (
	28,
	'aaa',
	"aaa@gmail",
	"3213123123",
	"masculino",
	"2022-01-01",
	"bh",
	"mg",
	"rua teste",
	"88945949",
	"@@123"
);

insert into nequa_usuario (id, nome, email, areas_atuacao, contatos, biografia, patch_banner, patch_imagem, data_upload) values (
	"01",
    "gunter",
    "dvas@sg.com",
    "front-end back-end",
    "@mmatosog",
    "tenho 14 anos de iadde",
    "index.html",
    "index.jpg",
    "2004-05-23T14:25:10.487"
);