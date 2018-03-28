object dmCadastroFiscalizacao: TdmCadastroFiscalizacao
  OldCreateOrder = False
  Left = 244
  Top = 177
  Height = 214
  Width = 370
  object dbPmnh: TADOConnection
    Connected = True
    ConnectionString = 
      'Provider=MSDASQL.1;Persist Security Info=False;Data Source=pmnh_' +
      'teste'
    LoginPrompt = False
    Left = 40
    Top = 24
  end
  object tbSolicitacao: TADOTable
    Connection = dbPmnh
    BeforePost = tbSolicitacaoBeforePost
    TableName = 'fis_solicitacao'
    Left = 40
    Top = 72
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
  end
  object tbDenuncia: TADOTable
    Connection = dbPmnh
    BeforePost = tbDenunciaBeforePost
    TableName = 'fis_denuncia'
    Left = 40
    Top = 120
    object tbDenunciaiddenuncia: TIntegerField
      FieldName = 'iddenuncia'
    end
    object tbDenunciaidsolicitacao: TIntegerField
      FieldName = 'idsolicitacao'
    end
    object tbDenunciacodlotacao: TStringField
      FieldName = 'codlotacao'
      Size = 30
    end
    object tbDenunciaidfiscal: TIntegerField
      FieldName = 'idfiscal'
    end
    object tbDenunciaidsituacao: TIntegerField
      FieldName = 'idsituacao'
    end
    object tbDenunciaidinfrator: TIntegerField
      FieldName = 'idinfrator'
    end
    object tbDenunciadatahoradenuncia: TDateTimeField
      FieldName = 'datahoradenuncia'
    end
    object tbDenunciaassunto: TStringField
      FieldName = 'assunto'
      Size = 50
    end
    object tbDenunciadescricao: TMemoField
      FieldName = 'descricao'
      BlobType = ftMemo
    end
    object tbDenunciaprocedimentos: TMemoField
      FieldName = 'procedimentos'
      BlobType = ftMemo
    end
    object tbDenunciadatahoraatendimento: TDateTimeField
      FieldName = 'datahoraatendimento'
    end
    object tbDenunciaobservacao: TMemoField
      FieldName = 'observacao'
      BlobType = ftMemo
    end
    object tbDenunciaidbairroinfracao: TIntegerField
      FieldName = 'idbairroinfracao'
    end
    object tbDenunciaidlogradouroinfracao: TIntegerField
      FieldName = 'idlogradouroinfracao'
    end
    object tbDenuncianumeroinfracao: TStringField
      FieldName = 'numeroinfracao'
      Size = 10
    end
    object tbDenunciacomplementoinfracao: TStringField
      FieldName = 'complementoinfracao'
      Size = 30
    end
    object tbDenunciasetor: TStringField
      FieldName = 'setor'
    end
    object tbDenunciaquadra: TIntegerField
      FieldName = 'quadra'
    end
    object tbDenuncialote: TIntegerField
      FieldName = 'lote'
    end
    object tbDenunciaunidade: TStringField
      FieldName = 'unidade'
    end
  end
  object dsSolicitacao: TwwDataSource
    DataSet = tbSolicitacao
    Left = 110
    Top = 72
  end
  object dsDenuncia: TwwDataSource
    DataSet = tbDenuncia
    Left = 112
    Top = 121
  end
  object qryLookup: TADOQuery
    Connection = dbPmnh
    CursorType = ctStatic
    Parameters = <>
    SQL.Strings = (
      
        'select idtiporequerente as codigo, descricao from fis_tiporequer' +
        'ente ')
    Left = 193
    Top = 25
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
    Left = 194
    Top = 72
    object qryValoresChavecampo: TStringField
      FieldName = 'campo'
      Size = 30
    end
    object qryValoresChavevalor: TIntegerField
      FieldName = 'valor'
    end
  end
  object qryBuscaCidadao: TADOQuery
    Active = True
    Connection = dbPmnh
    CursorType = ctStatic
    Parameters = <>
    SQL.Strings = (
      'select nome_cidadao, cod_cidadao from ger_cidadao'
      'where cod_cidadao = 70182')
    Left = 283
    Top = 26
    object qryBuscaCidadaonome_cidadao: TStringField
      DisplayLabel = 'Nome'
      DisplayWidth = 100
      FieldName = 'nome_cidadao'
      Size = 100
    end
    object qryBuscaCidadaocod_cidadao: TIntegerField
      DisplayLabel = 'C'#243'digo'
      DisplayWidth = 10
      FieldName = 'cod_cidadao'
    end
  end
  object dsBuscaCidadao: TwwDataSource
    DataSet = qryBuscaCidadao
    Left = 284
    Top = 73
  end
end
