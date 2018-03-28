object dmFiscalizacao: TdmFiscalizacao
  OldCreateOrder = False
  Left = 234
  Top = 160
  Height = 409
  Width = 623
  object dbPmnh: TADOConnection
    Connected = True
    ConnectionString = 
      'Provider=MSDASQL.1;Persist Security Info=False;Data Source=pmnh_' +
      'teste'
    LoginPrompt = False
    Left = 41
    Top = 2
  end
  object qryDenuncia: TADOQuery
    Connection = dbPmnh
    CursorType = ctStatic
    Parameters = <>
    SQL.Strings = (
      'select  d.datahoraDenuncia'
      ',          d.assunto'
      ',          c1.nome_cidadao as Requerente'
      ',          c2.nome_cidadao as Infrator'
      ',          d.idInfrator'
      ',          si.descricao'
      ',          d.iddenuncia'
      ',          d.idsolicitacao'
      'from    fis_denuncia d'
      ',          fis_solicitacao s'
      ',          fis_situacao si'
      ',          ger_cidadao c1'
      ',          ger_cidadao c2'
      'where d.idSolicitacao = s.idSolicitacao'
      'and     si.idSituacao = d.idSituacao'
      'and     s.idRequerente = c1.cod_cidadao'
      'and     d.idinfrator = c2.cod_cidadao'
      'and     si.descricao = '#39'ABERTO'#39
      'and    d.codlotacao like '#39'1.01.02.15.01%'#39)
    Left = 40
    Top = 50
    object qryDenunciadatahoradenuncia: TDateTimeField
      DisplayLabel = 'DATA'
      DisplayWidth = 10
      FieldName = 'datahoradenuncia'
    end
    object qryDenunciaassunto: TStringField
      DisplayLabel = 'ASSUNTO'
      DisplayWidth = 50
      FieldName = 'assunto'
      Size = 50
    end
    object qryDenunciainfrator: TStringField
      DisplayLabel = 'INFRATOR'
      DisplayWidth = 45
      FieldName = 'infrator'
      Size = 100
    end
    object qryDenunciarequerente: TStringField
      DisplayLabel = 'REQUERENTE'
      DisplayWidth = 45
      FieldName = 'requerente'
      Size = 100
    end
    object qryDenunciaidinfrator: TStringField
      DisplayWidth = 18
      FieldName = 'idinfrator'
      Visible = False
      FixedChar = True
      Size = 18
    end
    object qryDenunciadescricao: TStringField
      DisplayWidth = 30
      FieldName = 'descricao'
      Visible = False
      Size = 30
    end
    object qryDenunciaiddenuncia: TIntegerField
      DisplayWidth = 10
      FieldName = 'iddenuncia'
      Visible = False
    end
    object qryDenunciaidsolicitacao: TIntegerField
      DisplayWidth = 10
      FieldName = 'idsolicitacao'
      Visible = False
    end
  end
  object dsDenuncia: TwwDataSource
    AutoEdit = False
    DataSet = qryDenuncia
    Left = 135
    Top = 51
  end
  object qryLogin: TADOQuery
    Connection = dbPmnh
    Parameters = <>
    SQL.Strings = (
      'select * from fis_usuario')
    Left = 135
    Top = 3
    object qryLoginidusuario: TIntegerField
      FieldName = 'idusuario'
    end
    object qryLogincodlotacao: TStringField
      FieldName = 'codlotacao'
      Size = 30
    end
    object qryLoginnome: TStringField
      FieldName = 'nome'
    end
    object qryLoginlogin: TStringField
      FieldName = 'login'
    end
    object qryLoginsenha: TStringField
      FieldName = 'senha'
    end
    object qryLoginmatricula: TStringField
      FieldName = 'matricula'
    end
  end
  object qryDenunciaSolicitacao: TADOQuery
    Connection = dbPmnh
    CursorType = ctStatic
    Parameters = <>
    SQL.Strings = (
      'select idinfrator, assunto, codlotacao from fis_denuncia')
    Left = 287
    Top = 276
  end
  object tbSolicitacao: TADOTable
    Connection = dbPmnh
    CursorType = ctStatic
    AfterInsert = tbSolicitacaoAfterInsert
    BeforePost = tbSolicitacaoBeforePost
    AfterCancel = tbSolicitacaoAfterCancel
    TableName = 'fis_solicitacao'
    Left = 40
    Top = 98
    object tbSolicitacaoidsolicitacao: TIntegerField
      FieldName = 'idsolicitacao'
    end
    object tbSolicitacaoidtiporequerente: TIntegerField
      FieldName = 'idtiporequerente'
    end
    object tbSolicitacaoidusuario: TIntegerField
      FieldName = 'idusuario'
    end
    object tbSolicitacaoidrequerente: TStringField
      FieldName = 'idrequerente'
      FixedChar = True
      Size = 18
    end
    object tbSolicitacaoidorigem: TIntegerField
      FieldName = 'idorigem'
    end
    object tbSolicitacaoidtipoprotocolo: TIntegerField
      FieldName = 'idtipoprotocolo'
    end
    object tbSolicitacaonumprotocolo: TStringField
      FieldName = 'numprotocolo'
    end
    object tbSolicitacaodataprotocolo: TDateTimeField
      FieldName = 'dataprotocolo'
    end
    object tbSolicitacaodatahorasolicitacao: TDateTimeField
      FieldName = 'datahorasolicitacao'
    end
    object tbSolicitacaoassunto: TStringField
      FieldName = 'assunto'
      Size = 50
    end
    object tbSolicitacaoobservacao: TMemoField
      FieldName = 'observacao'
      BlobType = ftMemo
    end
    object tbSolicitacaoRequerente: TStringField
      FieldKind = fkLookup
      FieldName = 'Requerente'
      LookupDataSet = qryCidadao
      LookupKeyFields = 'cod_cidadao'
      LookupResultField = 'nome_cidadao'
      KeyFields = 'idrequerente'
      Lookup = True
    end
  end
  object dsSolicitacao: TwwDataSource
    AutoEdit = False
    DataSet = tbSolicitacao
    Left = 138
    Top = 98
  end
  object qrySolicitacaoProtocolo: TADOQuery
    Connection = dbPmnh
    CursorType = ctStatic
    Parameters = <>
    SQL.Strings = (
      'select * from fis_tipoprotocolo'
      'order by descricao')
    Left = 535
    Top = 97
    object qrySolicitacaoProtocolodescricao: TStringField
      DisplayLabel = 'Descricao'
      DisplayWidth = 30
      FieldName = 'descricao'
      Size = 30
    end
    object qrySolicitacaoProtocoloidtipoprotocolo: TIntegerField
      DisplayWidth = 10
      FieldName = 'idtipoprotocolo'
      Visible = False
    end
  end
  object qrySolicitacaoRequerente: TADOQuery
    Connection = dbPmnh
    CursorType = ctStatic
    Parameters = <>
    SQL.Strings = (
      'select * from fis_tiporequerente'
      'order by descricao')
    Left = 531
    Top = 5
    object qrySolicitacaoRequerentedescricao: TStringField
      DisplayLabel = 'Descricao'
      DisplayWidth = 30
      FieldName = 'descricao'
      Size = 30
    end
    object qrySolicitacaoRequerenteidtiporequerente: TIntegerField
      DisplayWidth = 10
      FieldName = 'idtiporequerente'
      Visible = False
    end
  end
  object qrySolicitacaoOrigem: TADOQuery
    Connection = dbPmnh
    CursorType = ctStatic
    Parameters = <>
    SQL.Strings = (
      'select * from fis_origem'
      'order by descricao')
    Left = 533
    Top = 53
    object qrySolicitacaoOrigemdescricao: TStringField
      DisplayLabel = 'Descricao'
      DisplayWidth = 30
      FieldName = 'descricao'
      Size = 30
    end
    object qrySolicitacaoOrigemidorigem: TIntegerField
      DisplayWidth = 10
      FieldName = 'idorigem'
      Visible = False
    end
  end
  object tbDenuncia: TADOTable
    Connection = dbPmnh
    CursorType = ctStatic
    BeforePost = tbDenunciaBeforePost
    IndexFieldNames = 'idsolicitacao'
    MasterFields = 'idsolicitacao'
    MasterSource = dsSolicitacao
    TableName = 'fis_denuncia'
    Left = 39
    Top = 143
    object tbDenunciaNomeInfrator: TStringField
      DisplayLabel = 'Nome Infrator'
      DisplayWidth = 25
      FieldKind = fkLookup
      FieldName = 'NomeInfrator'
      LookupDataSet = qryCidadao
      LookupKeyFields = 'cod_cidadao'
      LookupResultField = 'nome_cidadao'
      KeyFields = 'idinfrator'
      Lookup = True
    end
    object tbDenunciaassunto: TStringField
      DisplayLabel = 'Assunto'
      DisplayWidth = 42
      FieldName = 'assunto'
      Size = 50
    end
    object tbDenunciaNomeSecretaria: TStringField
      DisplayLabel = 'Nome Secretaria'
      DisplayWidth = 20
      FieldKind = fkLookup
      FieldName = 'NomeSecretaria'
      LookupDataSet = qryLotacao
      LookupKeyFields = 'codlotacao'
      LookupResultField = 'nome'
      KeyFields = 'codlotacao'
      Lookup = True
    end
    object tbDenunciacodlotacao: TStringField
      DisplayLabel = 'Lota'#231#227'o'
      DisplayWidth = 25
      FieldName = 'codlotacao'
      Visible = False
      Size = 30
    end
    object tbDenunciaidinfrator: TStringField
      DisplayLabel = 'Infrator'
      DisplayWidth = 25
      FieldName = 'idinfrator'
      Visible = False
      FixedChar = True
      Size = 18
    end
    object tbDenunciaiddenuncia: TIntegerField
      DisplayLabel = 'Den'#250'ncia'
      DisplayWidth = 10
      FieldName = 'iddenuncia'
      Visible = False
    end
    object tbDenunciaidfiscal: TIntegerField
      DisplayLabel = 'Fiscal'
      DisplayWidth = 10
      FieldName = 'idfiscal'
      Visible = False
    end
    object tbDenunciaidsituacao: TIntegerField
      DisplayLabel = 'Situa'#231#227'o'
      DisplayWidth = 10
      FieldName = 'idsituacao'
      Visible = False
    end
    object tbDenunciadatahoradenuncia: TDateTimeField
      DisplayLabel = 'Data Den'#250'ncia'
      DisplayWidth = 18
      FieldName = 'datahoradenuncia'
      Visible = False
    end
    object tbDenunciadescricao: TMemoField
      DisplayLabel = 'Descri'#231#227'o'
      DisplayWidth = 10
      FieldName = 'descricao'
      Visible = False
      BlobType = ftMemo
    end
    object tbDenunciaprocedimentos: TMemoField
      DisplayLabel = 'Procedimentos'
      DisplayWidth = 10
      FieldName = 'procedimentos'
      Visible = False
      BlobType = ftMemo
    end
    object tbDenunciadatahoraatendimento: TDateTimeField
      DisplayLabel = 'Data Atendimento'
      DisplayWidth = 18
      FieldName = 'datahoraatendimento'
      Visible = False
    end
    object tbDenunciaobservacao: TMemoField
      DisplayLabel = 'Observa'#231#227'o'
      DisplayWidth = 10
      FieldName = 'observacao'
      Visible = False
      BlobType = ftMemo
    end
    object tbDenunciaidbairroinfracao: TIntegerField
      DisplayLabel = 'Bairro Infra'#231#227'o'
      DisplayWidth = 10
      FieldName = 'idbairroinfracao'
      Visible = False
    end
    object tbDenunciaidlogradouroinfracao: TIntegerField
      DisplayLabel = 'Logradouro Infra'#231#227'o'
      DisplayWidth = 10
      FieldName = 'idlogradouroinfracao'
      Visible = False
    end
    object tbDenuncianumeroinfracao: TStringField
      DisplayLabel = 'N'#186
      DisplayWidth = 10
      FieldName = 'numeroinfracao'
      Visible = False
      Size = 10
    end
    object tbDenunciacomplementoinfracao: TStringField
      DisplayLabel = 'Complemento'
      DisplayWidth = 30
      FieldName = 'complementoinfracao'
      Visible = False
      Size = 30
    end
    object tbDenunciasetor: TStringField
      DisplayLabel = 'Setor'
      DisplayWidth = 20
      FieldName = 'setor'
      Visible = False
    end
    object tbDenunciaquadra: TIntegerField
      DisplayLabel = 'Quadra'
      DisplayWidth = 10
      FieldName = 'quadra'
      Visible = False
    end
    object tbDenuncialote: TIntegerField
      DisplayLabel = 'Lote'
      DisplayWidth = 10
      FieldName = 'lote'
      Visible = False
    end
    object tbDenunciaunidade: TStringField
      DisplayLabel = 'Unidade'
      DisplayWidth = 20
      FieldName = 'unidade'
      Visible = False
    end
    object tbDenunciaidsolicitacao: TIntegerField
      DisplayWidth = 10
      FieldName = 'idsolicitacao'
      Visible = False
    end
  end
  object dsCadDenuncia: TwwDataSource
    AutoEdit = False
    DataSet = tbDenuncia
    Left = 136
    Top = 143
  end
  object qryCidadao: TADOQuery
    Connection = dbPmnh
    CursorType = ctStatic
    Parameters = <>
    SQL.Strings = (
      'select cod_cidadao, nome_cidadao from ger_cidadao'
      'where cod_cidadao = -1')
    Left = 41
    Top = 328
    object qryCidadaonome_cidadao: TStringField
      DisplayLabel = 'NOME CIDAD'#195'O'
      DisplayWidth = 50
      FieldName = 'nome_cidadao'
      Size = 100
    end
    object qryCidadaocod_cidadao: TIntegerField
      DisplayLabel = 'C'#211'DIGO'
      DisplayWidth = 10
      FieldName = 'cod_cidadao'
    end
  end
  object qrySituacao: TADOQuery
    Connection = dbPmnh
    Parameters = <>
    SQL.Strings = (
      'select * from fis_situacao'
      'order by descricao')
    Left = 435
    Top = 5
    object qrySituacaodescricao: TStringField
      DisplayLabel = 'Descri'#231#227'o'
      DisplayWidth = 30
      FieldName = 'descricao'
      Size = 30
    end
    object qrySituacaoidsituacao: TIntegerField
      DisplayWidth = 10
      FieldName = 'idsituacao'
      Visible = False
    end
  end
  object qryLotacao: TADOQuery
    Connection = dbPmnh
    Parameters = <>
    SQL.Strings = (
      'select * from fis_lotacao'
      'order by nome')
    Left = 536
    Top = 143
    object qryLotacaonome: TStringField
      DisplayLabel = 'Secretaria'
      DisplayWidth = 50
      FieldName = 'nome'
      Size = 50
    end
    object qryLotacaocodlotacao: TStringField
      DisplayWidth = 30
      FieldName = 'codlotacao'
      Visible = False
      Size = 30
    end
  end
  object qryLogradouro: TADOQuery
    Connection = dbPmnh
    Parameters = <>
    SQL.Strings = (
      'select cod_logradouro, descricao from ger_logradouro'
      'order by descricao')
    Left = 441
    Top = 104
    object qryLogradourodescricao: TStringField
      DisplayLabel = 'Logradouro'
      DisplayWidth = 40
      FieldName = 'descricao'
      Size = 40
    end
    object qryLogradourocod_logradouro: TIntegerField
      DisplayWidth = 10
      FieldName = 'cod_logradouro'
      Visible = False
    end
  end
  object qryBairro: TADOQuery
    Connection = dbPmnh
    Parameters = <>
    SQL.Strings = (
      'select * from ger_bairro'
      'order by nome')
    Left = 437
    Top = 52
    object qryBairronome: TStringField
      DisplayLabel = 'Bairro'
      DisplayWidth = 25
      FieldName = 'nome'
      Size = 25
    end
    object qryBairrocod_bairro: TSmallintField
      DisplayWidth = 10
      FieldName = 'cod_bairro'
      Visible = False
    end
  end
  object tbNotificacao: TADOTable
    Connection = dbPmnh
    TableName = 'fis_notificacao'
    Left = 39
    Top = 189
    object tbNotificacaocodnotificacao: TStringField
      FieldName = 'codnotificacao'
    end
    object tbNotificacaoiddenuncia: TIntegerField
      FieldName = 'iddenuncia'
    end
    object tbNotificacaoidfiscal: TIntegerField
      FieldName = 'idfiscal'
    end
    object tbNotificacaoidsituacao: TIntegerField
      FieldName = 'idsituacao'
    end
    object tbNotificacaoidocorrencia: TIntegerField
      FieldName = 'idocorrencia'
    end
    object tbNotificacaodatahoranotificacao: TDateTimeField
      FieldName = 'datahoranotificacao'
    end
    object tbNotificacaoobservacao: TMemoField
      FieldName = 'observacao'
      BlobType = ftMemo
    end
    object tbNotificacaocodbaselegal: TIntegerField
      FieldName = 'codbaselegal'
    end
  end
  object dsNotificacao: TwwDataSource
    AutoEdit = False
    DataSet = tbNotificacao
    Left = 136
    Top = 190
  end
  object dsCidadao: TwwDataSource
    DataSet = qryCidadao
    Left = 138
    Top = 328
  end
  object dsDenunciaSolicitacao: TwwDataSource
    AutoEdit = False
    DataSet = qryDenunciaSolicitacao
    Left = 403
    Top = 276
  end
  object qry: TADOQuery
    Connection = dbPmnh
    Parameters = <>
    Left = 535
    Top = 229
  end
  object tbValoresChave: TADOTable
    Connection = dbPmnh
    TableName = 'fis_valoreschave'
    Left = 537
    Top = 327
    object tbValoresChavecampo: TStringField
      FieldName = 'campo'
      Size = 30
    end
    object tbValoresChavevalor: TFloatField
      FieldName = 'valor'
    end
  end
  object qryValoresChave: TADOQuery
    Connection = dbPmnh
    Parameters = <
      item
        Name = 'campo'
        Size = -1
        Value = Null
      end>
    SQL.Strings = (
      
        'select * from fis_valoreschave where campo = :campo order by val' +
        'or')
    Left = 537
    Top = 279
    object qryValoresChavecampo: TStringField
      FieldName = 'campo'
      Size = 30
    end
    object qryValoresChavevalor: TIntegerField
      FieldName = 'valor'
    end
  end
  object qryVisualizaSolicitacao: TADOQuery
    Connection = dbPmnh
    Parameters = <>
    SQL.Strings = (
      'select   S.idsolicitacao'
      ',           C.nome_cidadao as requerente'
      ',           U.nome'
      ',           TR.descricao as TipoRequerente'
      ',           O.descricao as Origem'
      ',           TP.descricao as TipoProtocolo'
      ',           S.numprotocolo'
      ',           S.dataProtocolo'
      ',           S.datahoraSolicitacao'
      ',           S.assunto, S.observacao'
      'from    fis_solicitacao S'
      ',          ger_cidadao C'
      ',          fis_usuario U'
      ',          fis_tiporequerente TR'
      ',          fis_tipoprotocolo TP'
      ',          fis_Origem O'
      'where C.cod_cidadao = S.idrequerente '
      'and     U.idusuario = S.idusuario '
      'and     TR.idtiporequerente = S.idtiporequerente '
      'and     TP.idtipoprotocolo = S.idtipoprotocolo '
      'and     O.idorigem = S.idorigem '
      'and     S.idsolicitacao = 1')
    Left = 288
    Top = 327
    object qryVisualizaSolicitacaoidsolicitacao: TIntegerField
      FieldName = 'idsolicitacao'
    end
    object qryVisualizaSolicitacaorequerente: TStringField
      FieldName = 'requerente'
      Size = 100
    end
    object qryVisualizaSolicitacaonome: TStringField
      FieldName = 'nome'
    end
    object qryVisualizaSolicitacaotiporequerente: TStringField
      FieldName = 'tiporequerente'
      Size = 30
    end
    object qryVisualizaSolicitacaoorigem: TStringField
      FieldName = 'origem'
      Size = 30
    end
    object qryVisualizaSolicitacaotipoprotocolo: TStringField
      FieldName = 'tipoprotocolo'
      Size = 30
    end
    object qryVisualizaSolicitacaonumprotocolo: TStringField
      FieldName = 'numprotocolo'
    end
    object qryVisualizaSolicitacaodataprotocolo: TDateTimeField
      FieldName = 'dataprotocolo'
    end
    object qryVisualizaSolicitacaodatahorasolicitacao: TDateTimeField
      FieldName = 'datahorasolicitacao'
    end
    object qryVisualizaSolicitacaoassunto: TStringField
      FieldName = 'assunto'
      Size = 50
    end
    object qryVisualizaSolicitacaoobservacao: TMemoField
      FieldName = 'observacao'
      BlobType = ftMemo
    end
  end
  object dsVisualizaSolicitacao: TwwDataSource
    DataSet = qryVisualizaSolicitacao
    Left = 402
    Top = 327
  end
  object qryHistoricoInfrator: TADOQuery
    Connection = dbPmnh
    CursorType = ctStatic
    Parameters = <>
    SQL.Strings = (
      'select  d.iddenuncia'
      ',          ci.codinfrator'
      ',          ci.infrator'
      ',          ci.cpf'
      ',          ci.cnpj '
      ',          d.datahoradenuncia'
      ',          d.datahoraatendimento'
      ',          d.assunto '
      ',          d.descricao'
      ',          d.procedimentos'
      ',          s.descricao as situacao '
      ',          cr.requerente'
      ',          tr.descricao as tiporequerente'
      ',          n.codNotificacao '
      ',          n.dataHoraNotificacao'
      ',          o.descricao as ocorrencia'
      ',          a.codAutoinfracao '
      ',          a.dataHoraInfracao'
      ',          a.descricao as descricaoInfracao '
      ',          a.exigencia as exigenciaInfracao'
      ',          r.codApreensao'
      ',          r.dataHoraapreensao '
      'from    fis_denuncia d left join fis_notificacao n on '
      
        '             n.iddenuncia = d.iddenuncia left join fis_ocorrenci' +
        'a o on '
      
        '             o.idOcorrencia = n.idocorrencia left join fis_autoi' +
        'nfracao a on '
      
        '             a.codNotificacao = n.codNotificacao left join fis_r' +
        'egistroapreensao r on '
      '             r.codNotificacao = n.codNotificacao '
      
        ',          fis_situacao s, fis_solicitacao si, fis_tiporequerent' +
        'e tr '
      ',          session.cidadaoInf ci, session.cidadaoReq cr '
      'where s.idSituacao = d.idSituacao '
      'and    si.idsolicitacao = d.idsolicitacao '
      'and    tr.idtiporequerente = si.idtiporequerente '
      'and    ci.codinfrator = d.idinfrator '
      'and    cr.idsolicitacao = si.idsolicitacao '
      'and    ci.iddenuncia = d.iddenuncia '
      'and    cr.codrequerente = si.idrequerente '
      'and    ci.codInfrator = 22')
    Left = 39
    Top = 234
    object qryHistoricoInfratoriddenuncia: TIntegerField
      FieldName = 'iddenuncia'
    end
    object qryHistoricoInfratorcodinfrator: TIntegerField
      FieldName = 'codinfrator'
    end
    object qryHistoricoInfratorinfrator: TStringField
      FieldName = 'infrator'
      Size = 100
    end
    object qryHistoricoInfratorcpf: TStringField
      FieldName = 'cpf'
    end
    object qryHistoricoInfratorcnpj: TStringField
      FieldName = 'cnpj'
    end
    object qryHistoricoInfratordatahoradenuncia: TDateTimeField
      FieldName = 'datahoradenuncia'
    end
    object qryHistoricoInfratordatahoraatendimento: TDateTimeField
      FieldName = 'datahoraatendimento'
    end
    object qryHistoricoInfratorassunto: TStringField
      FieldName = 'assunto'
      Size = 50
    end
    object qryHistoricoInfratordescricao: TMemoField
      FieldName = 'descricao'
      BlobType = ftMemo
    end
    object qryHistoricoInfratorprocedimentos: TMemoField
      FieldName = 'procedimentos'
      BlobType = ftMemo
    end
    object qryHistoricoInfratorsituacao: TStringField
      FieldName = 'situacao'
      Size = 30
    end
    object qryHistoricoInfratorrequerente: TStringField
      FieldName = 'requerente'
      Size = 100
    end
    object qryHistoricoInfratortiporequerente: TStringField
      FieldName = 'tiporequerente'
      Size = 30
    end
    object qryHistoricoInfratorcodnotificacao: TStringField
      FieldName = 'codnotificacao'
    end
    object qryHistoricoInfratordatahoranotificacao: TDateTimeField
      FieldName = 'datahoranotificacao'
    end
    object qryHistoricoInfratorocorrencia: TStringField
      FieldName = 'ocorrencia'
      Size = 200
    end
    object qryHistoricoInfratorcodautoinfracao: TStringField
      FieldName = 'codautoinfracao'
      FixedChar = True
      Size = 10
    end
    object qryHistoricoInfratordatahorainfracao: TDateTimeField
      FieldName = 'datahorainfracao'
    end
    object qryHistoricoInfratordescricaoinfracao: TStringField
      FieldName = 'descricaoinfracao'
      Size = 200
    end
    object qryHistoricoInfratorexigenciainfracao: TStringField
      FieldName = 'exigenciainfracao'
      Size = 200
    end
    object qryHistoricoInfratorcodapreensao: TStringField
      FieldName = 'codapreensao'
      FixedChar = True
      Size = 10
    end
    object qryHistoricoInfratordatahoraapreensao: TDateTimeField
      FieldName = 'datahoraapreensao'
    end
  end
  object dsHistoricoInfrator: TwwDataSource
    DataSet = qryHistoricoInfrator
    Left = 135
    Top = 234
  end
  object qryHistoricoInfrator2: TADOQuery
    Connection = dbPmnh
    CursorType = ctStatic
    Parameters = <>
    SQL.Strings = (
      'select n.codnotificacao'
      ',      n.datahoranotificacao'
      ',      o.descricao as ocorrenciaNotificacao'
      ',      a.codautoinfracao'
      ',      a.datahorainfracao'
      ',      r.codapreensao'
      ',      r.datahoraapreensao'
      'from   fis_notificacao n left join fis_autoinfracao a on'
      
        '         n.codnotificacao = a.codnotificacao left join fis_regis' +
        'troapreensao r on'
      
        '         n.codnotificacao = r.codnotificacao left join fis_ocorr' +
        'encia o on'
      '         n.idocorrencia   = o.idocorrencia'
      ',      fis_denuncia d'
      'where  n.iddenuncia     = d.iddenuncia')
    Left = 40
    Top = 282
    object qryHistoricoInfrator2codnotificacao: TStringField
      DisplayLabel = 'NOTIFICA'#199#195'O'
      DisplayWidth = 18
      FieldName = 'codnotificacao'
    end
    object qryHistoricoInfrator2datahoranotificacao: TDateTimeField
      DisplayLabel = 'DATA'
      DisplayWidth = 11
      FieldName = 'datahoranotificacao'
    end
    object qryHistoricoInfrator2ocorrencianotificacao: TStringField
      DisplayLabel = 'OCORR'#202'NCIA'
      DisplayWidth = 200
      FieldName = 'ocorrencianotificacao'
      Size = 200
    end
    object qryHistoricoInfrator2codautoinfracao: TStringField
      DisplayWidth = 10
      FieldName = 'codautoinfracao'
      Visible = False
      FixedChar = True
      Size = 10
    end
    object qryHistoricoInfrator2datahorainfracao: TDateTimeField
      DisplayWidth = 18
      FieldName = 'datahorainfracao'
      Visible = False
    end
    object qryHistoricoInfrator2codapreensao: TStringField
      DisplayWidth = 10
      FieldName = 'codapreensao'
      Visible = False
      FixedChar = True
      Size = 10
    end
    object qryHistoricoInfrator2datahoraapreensao: TDateTimeField
      DisplayWidth = 18
      FieldName = 'datahoraapreensao'
      Visible = False
    end
  end
  object dsHistoricoInfrator2: TwwDataSource
    DataSet = qryHistoricoInfrator2
    Left = 137
    Top = 282
  end
end
