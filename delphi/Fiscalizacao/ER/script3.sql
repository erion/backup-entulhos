
CREATE TABLE fis_lotacao (
       codLotacao           varchar(30) not null,
       nome                 varchar(50) with null
);

CREATE UNIQUE INDEX XPKfis_lotacao ON fis_lotacao
(
       codLotacao                     ASC
);


ALTER TABLE fis_lotacao
       ADD CONSTRAINT XPKfis_lotacao PRIMARY KEY (codLotacao);


CREATE TABLE fis_usuario (
       idUsuario            integer not null,
       codLotacao           varchar(30) with null,
       nome                 varchar(20) with null,
       login                varchar(20) with null,
       senha                varchar(20) with null,
       matricula            varchar(20) with null
);

CREATE UNIQUE INDEX XPKfis_usuario ON fis_usuario
(
       idUsuario                      ASC
);

CREATE INDEX XIF52fis_usuario ON fis_usuario
(
       codLotacao                     ASC
);


ALTER TABLE fis_usuario
       ADD CONSTRAINT XPKfis_usuario PRIMARY KEY (idUsuario);


CREATE TABLE fis_fiscal (
       idUsuario            integer not null
);

CREATE UNIQUE INDEX XPKfis_fiscal ON fis_fiscal
(
       idUsuario                      ASC
);


ALTER TABLE fis_fiscal
       ADD CONSTRAINT XPKfis_fiscal PRIMARY KEY (idUsuario);


CREATE TABLE fis_tiporequerente (
       idTipoRequerente     integer not null,
       descricao            varchar(30) with null
);

CREATE UNIQUE INDEX XPKfis_tiporequerente ON fis_tiporequerente
(
       idTipoRequerente               ASC
);


ALTER TABLE fis_tiporequerente
       ADD CONSTRAINT XPKfis_tiporequerente PRIMARY KEY (
              idTipoRequerente);


CREATE TABLE fis_cidadao (
       idCidadao            char(18) not null,
       cpf                  varchar(20) with null,
       nome                 varchar(20) with null,
       numero               integer with null,
       fone                 varchar(20) with null,
       fax                  varchar(20) with null,
       email                varchar(20) with null,
       rg                   varchar(20) with null,
       cnpj                 varchar(20) with null,
       carteiraTrabalho     varchar(20) with null,
       serie                varchar(20) with null,
       terceira             varchar(20) with null,
       inscricaoEstadual    varchar(20) with null
);

CREATE UNIQUE INDEX XPKfis_cidadao ON fis_cidadao
(
       idCidadao                      ASC
);


ALTER TABLE fis_cidadao
       ADD CONSTRAINT XPKfis_cidadao PRIMARY KEY (idCidadao);


CREATE TABLE fis_origem (
       idOrigem             integer not null,
       descricao            varchar(30) with null
);

CREATE UNIQUE INDEX XPKfis_origem ON fis_origem
(
       idOrigem                       ASC
);


ALTER TABLE fis_origem
       ADD CONSTRAINT XPKfis_origem PRIMARY KEY (idOrigem);


CREATE TABLE fis_tipoprotocolo (
       idTipoProtocolo      integer not null,
       descricao            varchar(30) with null
);

CREATE UNIQUE INDEX XPKfis_tipoprotocolo ON fis_tipoprotocolo
(
       idTipoProtocolo                ASC
);


ALTER TABLE fis_tipoprotocolo
       ADD CONSTRAINT XPKfis_tipoprotocolo PRIMARY KEY (
              idTipoProtocolo);


CREATE TABLE fis_solicitacao (
       idSolicitacao        integer not null,
       idTipoRequerente     integer with null,
       idUsuario            integer with null,
       idRequerente         char(18) with null,
       idOrigem             integer with null,
       idTipoProtocolo      integer with null,
       numProtocolo         varchar(20) with null,
       dataProtocolo        date with null,
       datahoraSolicitacao  date with null,
       assunto              varchar(50) with null,
       observacao           long varchar with null
);

CREATE UNIQUE INDEX XPKfis_solicitacao ON fis_solicitacao
(
       idSolicitacao                  ASC
);

CREATE INDEX XIF34fis_solicitacao ON fis_solicitacao
(
       idUsuario                      ASC
);

CREATE INDEX XIF42fis_solicitacao ON fis_solicitacao
(
       idTipoRequerente               ASC
);

CREATE INDEX XIF5fis_solicitacao ON fis_solicitacao
(
       idTipoProtocolo                ASC
);

CREATE INDEX XIF6fis_solicitacao ON fis_solicitacao
(
       idOrigem                       ASC
);

CREATE INDEX XIF7fis_solicitacao ON fis_solicitacao
(
       idRequerente                   ASC
);


ALTER TABLE fis_solicitacao
       ADD CONSTRAINT XPKfis_solicitacao PRIMARY KEY (idSolicitacao);


CREATE TABLE fis_situacao (
       idSituacao           integer not null,
       descricao            varchar(30) with null
);

CREATE UNIQUE INDEX XPKfis_situacao ON fis_situacao
(
       idSituacao                     ASC
);


ALTER TABLE fis_situacao
       ADD CONSTRAINT XPKfis_situacao PRIMARY KEY (idSituacao);


CREATE TABLE fis_denuncia (
       idDenuncia           integer not null,
       idSolicitacao        integer with null,
       codLotacao           varchar(30) with null,
       idFiscal             integer with null,
       idSituacao           integer with null,
       idInfrator           varchar(18) with null,
       datahoraDenuncia     date with null,
       assunto              varchar(50) with null,
       descricao            long varchar with null,
       procedimentos        long varchar with null,
       datahoraAtendimento  date with null,
       observacao           long varchar with null,
       idBairroInfracao     integer with null,
       idLogradouroInfracao integer with null,
       numeroInfracao       varchar(10) with null,
       complementoInfracao  varchar(30) with null,
       setor                varchar(20) with null,
       quadra               integer with null,
       lote                 integer with null,
       unidade              varchar(20) with null
);

CREATE UNIQUE INDEX XPKfis_denuncia ON fis_denuncia
(
       idDenuncia                     ASC
);

CREATE INDEX XIF12fis_denuncia ON fis_denuncia
(
       idSituacao                     ASC
);

CREATE INDEX XIF41fis_denuncia ON fis_denuncia
(
       idSolicitacao                  ASC
);

CREATE INDEX XIF48fis_denuncia ON fis_denuncia
(
       idFiscal                       ASC
);

CREATE INDEX XIF53fis_denuncia ON fis_denuncia
(
       codLotacao                     ASC
);

CREATE INDEX XIF9fis_denuncia ON fis_denuncia
(
       idInfrator                     ASC
);


ALTER TABLE fis_denuncia
       ADD CONSTRAINT XPKfis_denuncia PRIMARY KEY (idDenuncia);


CREATE TABLE fis_ocorrencia (
       idOcorrencia         integer not null,
       codLotacao           varchar(30) with null,
       descricao            varchar(200) with null
);

CREATE UNIQUE INDEX XPKfis_ocorrencia ON fis_ocorrencia
(
       idOcorrencia                   ASC
);

CREATE INDEX XIF51fis_ocorrencia ON fis_ocorrencia
(
       codLotacao                     ASC
);


ALTER TABLE fis_ocorrencia
       ADD CONSTRAINT XPKfis_ocorrencia PRIMARY KEY (idOcorrencia);


CREATE TABLE fis_notificacao (
       codNotificacao       varchar(20) not null,
       idDenuncia           integer with null,
       idFiscal             integer with null,
       idSituacao           integer with null,
       idOcorrencia         integer with null,
       datahoraNotificacao  date with null,
       observacao           long varchar with null,
       codBaseLegal         integer with null
);

CREATE UNIQUE INDEX XPKfis_notificacao ON fis_notificacao
(
       codNotificacao                 ASC
);

CREATE INDEX XIF16fis_notificacao ON fis_notificacao
(
       idOcorrencia                   ASC
);

CREATE INDEX XIF19fis_notificacao ON fis_notificacao
(
       idSituacao                     ASC
);

CREATE INDEX XIF43fis_notificacao ON fis_notificacao
(
       idDenuncia                     ASC
);

CREATE INDEX XIF47fis_notificacao ON fis_notificacao
(
       idFiscal                       ASC
);


ALTER TABLE fis_notificacao
       ADD CONSTRAINT XPKfis_notificacao PRIMARY KEY (codNotificacao);


CREATE TABLE fis_registroapreensao (
       codApreensao         char(10) not null,
       codNotificacao       varchar(20) with null,
       idFiscal             integer with null,
       datahoraApreensao    date with null,
       idCidadeDestino      integer with null,
       idBairroDestino      integer with null,
       idLogradouroDestino  integer with null,
       numDestino           varchar(10) with null,
       complementoDestino   varchar(30) with null,
       observacao           long varchar with null
);

CREATE UNIQUE INDEX XPKfis_registroapreensao ON fis_registroapreensao
(
       codApreensao                   ASC
);

CREATE INDEX XIF45fis_registroapreensao ON fis_registroapreensao
(
       codNotificacao                 ASC
);

CREATE INDEX XIF49fis_registroapreensao ON fis_registroapreensao
(
       idFiscal                       ASC
);


ALTER TABLE fis_registroapreensao
       ADD CONSTRAINT XPKfis_registroapreensao PRIMARY KEY (
              codApreensao);


CREATE TABLE fis_apreensaoitens (
       idRequisicaoitens    integer not null,
       codApreensao         char(10) with null,
       descricao            varchar(150) with null,
       qtd                  integer with null,
       unidadeQtd           varchar(10) with null,
       valor                NUMERIC(18,4) with null,
       unidadeVlr           varchar(10) with null
);

CREATE UNIQUE INDEX XPKfis_apreensaoitens ON fis_apreensaoitens
(
       idRequisicaoitens              ASC
);

CREATE INDEX XIF40fis_apreensaoitens ON fis_apreensaoitens
(
       codApreensao                   ASC
);


ALTER TABLE fis_apreensaoitens
       ADD CONSTRAINT XPKfis_apreensaoitens PRIMARY KEY (
              idRequisicaoitens);


CREATE TABLE fis_situacaoar (
       idSituacaoAR         integer not null,
       descricao            varchar(30) with null
);

CREATE UNIQUE INDEX XPKfis_situacaoar ON fis_situacaoar
(
       idSituacaoAR                   ASC
);


ALTER TABLE fis_situacaoar
       ADD CONSTRAINT XPKfis_situacaoar PRIMARY KEY (idSituacaoAR);


CREATE TABLE fis_autoinfracao (
       codAutoInfracao      char(10) not null,
       codNotificacao       varchar(20) with null,
       idFiscal             integer with null,
       idSituacao           integer with null,
       datahoraInfracao     date with null,
       descricao            varchar(200) with null,
       exigencia            varchar(200) with null,
       observacao           long varchar with null,
       valor                NUMERIC(18,4) with null,
       unidade              varchar(10) with null
);

CREATE UNIQUE INDEX XPKfis_autoinfracao ON fis_autoinfracao
(
       codAutoInfracao                ASC
);

CREATE INDEX XIF22fis_autoinfracao ON fis_autoinfracao
(
       idSituacao                     ASC
);

CREATE INDEX XIF44fis_autoinfracao ON fis_autoinfracao
(
       codNotificacao                 ASC
);

CREATE INDEX XIF50fis_autoinfracao ON fis_autoinfracao
(
       idFiscal                       ASC
);


ALTER TABLE fis_autoinfracao
       ADD CONSTRAINT XPKfis_autoinfracao PRIMARY KEY (
              codAutoInfracao);


CREATE TABLE fis_infracaoar (
       idInfracaoAR         integer not null,
       idSituacaoAR         integer with null,
       codAutoInfracao      char(10) with null,
       numAR                varchar(20) with null,
       datahora             date with null
);

CREATE UNIQUE INDEX XPKfis_infracaoar ON fis_infracaoar
(
       idInfracaoAR                   ASC
);

CREATE INDEX XIF38fis_infracaoar ON fis_infracaoar
(
       codAutoInfracao                ASC
);

CREATE INDEX XIF39fis_infracaoar ON fis_infracaoar
(
       idSituacaoAR                   ASC
);


ALTER TABLE fis_infracaoar
       ADD CONSTRAINT XPKfis_infracaoar PRIMARY KEY (idInfracaoAR);


CREATE TABLE fis_infracaolei (
       codLei               integer not null,
       codAutoInfracao      char(10) not null
);

CREATE UNIQUE INDEX XPKfis_infracaolei ON fis_infracaolei
(
       codLei                         ASC,
       codAutoInfracao                ASC
);

CREATE INDEX XIF37fis_infracaolei ON fis_infracaolei
(
       codAutoInfracao                ASC
);


ALTER TABLE fis_infracaolei
       ADD CONSTRAINT XPKfis_infracaolei PRIMARY KEY (codLei, 
              codAutoInfracao);


CREATE TABLE fis_notificaprazo (
       idNotificaPrazo      integer not null,
       codNotificacao       varchar(20) with null,
       datahora             date with null,
       observacao           long varchar with null
);

CREATE UNIQUE INDEX XPKfis_notificaprazo ON fis_notificaprazo
(
       idNotificaPrazo                ASC
);

CREATE INDEX XIF35fis_notificaprazo ON fis_notificaprazo
(
       codNotificacao                 ASC
);


ALTER TABLE fis_notificaprazo
       ADD CONSTRAINT XPKfis_notificaprazo PRIMARY KEY (
              idNotificaPrazo);


CREATE TABLE fis_infracaoprazo (
       idInfracaoPrazo      integer not null,
       codAutoInfracao      char(10) with null,
       datahora             date with null,
       observacao           long varchar with null
);

CREATE UNIQUE INDEX XPKfis_infracaoprazo ON fis_infracaoprazo
(
       idInfracaoPrazo                ASC
);

CREATE INDEX XIF36fis_infracaoprazo ON fis_infracaoprazo
(
       codAutoInfracao                ASC
);


ALTER TABLE fis_infracaoprazo
       ADD CONSTRAINT XPKfis_infracaoprazo PRIMARY KEY (
              idInfracaoPrazo);


ALTER TABLE fis_usuario
       ADD CONSTRAINT R_52
              FOREIGN KEY (codLotacao)
                             REFERENCES fis_lotacao;


ALTER TABLE fis_fiscal
       ADD CONSTRAINT R_46
              FOREIGN KEY (idUsuario)
                             REFERENCES fis_usuario;


ALTER TABLE fis_solicitacao
       ADD CONSTRAINT R_42
              FOREIGN KEY (idTipoRequerente)
                             REFERENCES fis_tiporequerente;


ALTER TABLE fis_solicitacao
       ADD CONSTRAINT R_34
              FOREIGN KEY (idUsuario)
                             REFERENCES fis_usuario;


ALTER TABLE fis_solicitacao
       ADD CONSTRAINT R_7
              FOREIGN KEY (idRequerente)
                             REFERENCES fis_cidadao;


ALTER TABLE fis_solicitacao
       ADD CONSTRAINT R_6
              FOREIGN KEY (idOrigem)
                             REFERENCES fis_origem;


ALTER TABLE fis_solicitacao
       ADD CONSTRAINT R_5
              FOREIGN KEY (idTipoProtocolo)
                             REFERENCES fis_tipoprotocolo;


ALTER TABLE fis_denuncia
       ADD CONSTRAINT R_53
              FOREIGN KEY (codLotacao)
                             REFERENCES fis_lotacao;


ALTER TABLE fis_denuncia
       ADD CONSTRAINT R_48
              FOREIGN KEY (idFiscal)
                             REFERENCES fis_fiscal;


ALTER TABLE fis_denuncia
       ADD CONSTRAINT R_41
              FOREIGN KEY (idSolicitacao)
                             REFERENCES fis_solicitacao;


ALTER TABLE fis_denuncia
       ADD CONSTRAINT R_12
              FOREIGN KEY (idSituacao)
                             REFERENCES fis_situacao;


ALTER TABLE fis_denuncia
       ADD CONSTRAINT R_9
              FOREIGN KEY (idInfrator)
                             REFERENCES fis_cidadao;


ALTER TABLE fis_ocorrencia
       ADD CONSTRAINT R_51
              FOREIGN KEY (codLotacao)
                             REFERENCES fis_lotacao;


ALTER TABLE fis_notificacao
       ADD CONSTRAINT R_47
              FOREIGN KEY (idFiscal)
                             REFERENCES fis_fiscal;


ALTER TABLE fis_notificacao
       ADD CONSTRAINT R_43
              FOREIGN KEY (idDenuncia)
                             REFERENCES fis_denuncia;


ALTER TABLE fis_notificacao
       ADD CONSTRAINT R_19
              FOREIGN KEY (idSituacao)
                             REFERENCES fis_situacao;


ALTER TABLE fis_notificacao
       ADD CONSTRAINT R_16
              FOREIGN KEY (idOcorrencia)
                             REFERENCES fis_ocorrencia;


ALTER TABLE fis_registroapreensao
       ADD CONSTRAINT R_49
              FOREIGN KEY (idFiscal)
                             REFERENCES fis_fiscal;


ALTER TABLE fis_registroapreensao
       ADD CONSTRAINT R_45
              FOREIGN KEY (codNotificacao)
                             REFERENCES fis_notificacao;


ALTER TABLE fis_apreensaoitens
       ADD CONSTRAINT R_40
              FOREIGN KEY (codApreensao)
                             REFERENCES fis_registroapreensao;


ALTER TABLE fis_autoinfracao
       ADD CONSTRAINT R_50
              FOREIGN KEY (idFiscal)
                             REFERENCES fis_fiscal;


ALTER TABLE fis_autoinfracao
       ADD CONSTRAINT R_44
              FOREIGN KEY (codNotificacao)
                             REFERENCES fis_notificacao;


ALTER TABLE fis_autoinfracao
       ADD CONSTRAINT R_22
              FOREIGN KEY (idSituacao)
                             REFERENCES fis_situacao;


ALTER TABLE fis_infracaoar
       ADD CONSTRAINT R_39
              FOREIGN KEY (idSituacaoAR)
                             REFERENCES fis_situacaoar;


ALTER TABLE fis_infracaoar
       ADD CONSTRAINT R_38
              FOREIGN KEY (codAutoInfracao)
                             REFERENCES fis_autoinfracao;


ALTER TABLE fis_infracaolei
       ADD CONSTRAINT R_37
              FOREIGN KEY (codAutoInfracao)
                             REFERENCES fis_autoinfracao;


ALTER TABLE fis_notificaprazo
       ADD CONSTRAINT R_35
              FOREIGN KEY (codNotificacao)
                             REFERENCES fis_notificacao;


ALTER TABLE fis_infracaoprazo
       ADD CONSTRAINT R_36
              FOREIGN KEY (codAutoInfracao)
                             REFERENCES fis_autoinfracao;



