object dmFiscalizacao2: TdmFiscalizacao2
  OldCreateOrder = False
  Left = 323
  Top = 226
  Height = 297
  Width = 399
  object qrySolicitacaoProtocolo: TADOQuery
    Connection = dbPmnh
    CursorType = ctStatic
    Parameters = <>
    SQL.Strings = (
      'select * from fis_tipoprotocolo'
      'order by descricao')
    Left = 302
    Top = 111
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
    Left = 305
    Top = 11
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
    Left = 303
    Top = 59
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
  object qrySituacao: TADOQuery
    Connection = dbPmnh
    Parameters = <>
    SQL.Strings = (
      'select * from fis_situacao'
      'order by descricao')
    Left = 190
    Top = 11
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
    CursorType = ctStatic
    Parameters = <>
    SQL.Strings = (
      'select * from fis_lotacao'
      'order by nome')
    Left = 102
    Top = 13
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
    Left = 188
    Top = 110
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
    Left = 189
    Top = 58
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
  object dbPmnh: TADOConnection
    Connected = True
    ConnectionString = 
      'Provider=MSDASQL.1;Persist Security Info=False;Data Source=pmnh_' +
      'teste'
    LoginPrompt = False
    Left = 25
    Top = 10
  end
  object tbSolicitacao: TADOTable
    Connection = dbPmnh
    CursorType = ctStatic
    AfterInsert = tbSolicitacaoAfterInsert
    BeforePost = tbSolicitacaoBeforePost
    TableName = 'fis_solicitacao'
    Left = 28
    Top = 64
    object tbSolicitacaoidsolicitacao: TIntegerField
      FieldName = 'idsolicitacao'
    end
    object tbSolicitacaoidtiporequerente: TIntegerField
      FieldName = 'idtiporequerente'
    end
    object tbSolicitacaoidusuario: TIntegerField
      FieldName = 'idusuario'
    end
    object tbSolicitacaoidrequerente: TIntegerField
      FieldName = 'idrequerente'
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
    Left = 101
    Top = 65
  end
  object tbDenuncia: TADOTable
    Connection = dbPmnh
    CursorType = ctStatic
    BeforePost = tbDenunciaBeforePost
    IndexFieldNames = 'idsolicitacao'
    MasterFields = 'idsolicitacao'
    MasterSource = dsSolicitacao
    TableName = 'fis_denuncia'
    Left = 27
    Top = 109
    object tbDenunciaNomeInfrator: TStringField
      DisplayLabel = 'Nome Infrator'
      DisplayWidth = 25
      FieldKind = fkLookup
      FieldName = 'NomeInfrator'
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
    object tbDenunciaidinfrator: TIntegerField
      FieldName = 'idinfrator'
    end
  end
  object dsCadDenuncia: TwwDataSource
    AutoEdit = False
    DataSet = tbDenuncia
    Left = 99
    Top = 110
  end
  object qryCidadao: TADOQuery
    Active = True
    Connection = dbPmnh
    CursorType = ctStatic
    Parameters = <>
    SQL.Strings = (
      'select cod_cidadao, nome_cidadao from ger_cidadao'
      'where cod_cidadao = -1')
    Left = 28
    Top = 163
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
  object dsCidadao: TwwDataSource
    DataSet = qryCidadao
    Left = 98
    Top = 163
  end
  object qryDenunciaSolicitacao: TADOQuery
    Connection = dbPmnh
    CursorType = ctStatic
    Parameters = <>
    SQL.Strings = (
      'select idinfrator, assunto, codlotacao from fis_denuncia')
    Left = 188
    Top = 164
  end
  object dsDenunciaSolicitacao: TwwDataSource
    AutoEdit = False
    DataSet = qryDenunciaSolicitacao
    Left = 302
    Top = 164
  end
  object tbValoresChave: TADOTable
    Connection = dbPmnh
    TableName = 'fis_valoreschave'
    Left = 98
    Top = 216
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
    Left = 29
    Top = 215
    object qryValoresChavecampo: TStringField
      FieldName = 'campo'
      Size = 30
    end
    object qryValoresChavevalor: TIntegerField
      FieldName = 'valor'
    end
  end
end
