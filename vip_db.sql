create database vip_db;
use vip_db;

create table veiculo (
    id_vei int auto_increment primary key unique,
    nome varchar(255),
    disponibilidade_status varchar(100),
    capacidade int,
    bagageiro boolean,
    cambio varchar(100),
    imagem varchar(255),
    placa varchar(20),
    ano_fabricacao year,
    modelo varchar(100),
    chassi varchar(100),
    renavam varchar(100),
    marca varchar(100),
    km_rodados int,
    ultima_revisao date
);

create table cliente (
    id_cli int auto_increment primary key unique,
    nome varchar(255),
    cpf varchar(14) unique,
    telefone varchar(20),
    email varchar(100),
    rua varchar(255),
    bairro varchar(100),
    cep varchar(10),
    cidade varchar(100),
    estado varchar(2),
    data_nascimento date,
    cnh varchar(20)
);
create table local_locadora (
    id_loc int auto_increment primary key unique,
    cidade varchar(100),
    estado varchar(2),
    cep varchar(10),
    rua varchar(255),
    bairro varchar(100),
    numero int,
    horario_abertura time,
    horario_fechamento time
);

create table locacao (
    id int auto_increment primary key unique,
    data_entrada date,
    data_saida date,
    horario_entrada time,
    horario_saida time,
    valor_por_dia double,
    valor_total double,
    local_retirada_cidade varchar(100),
    local_entrega varchar(100),
  	status varchar(100),
 	id_cliente_fk int,
  	id_veiculo_fk int,
  	id_local_locadora_fk int,
  	foreign key (id_cliente_fk) references cliente(id_cli),
  	foreign key (id_veiculo_fk) references veiculo(id_vei),
    foreign key (id_local_locadora_fk) references local_locadora(id_loc)
);