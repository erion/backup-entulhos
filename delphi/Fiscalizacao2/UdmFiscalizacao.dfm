object dmFiscalizacao: TdmFiscalizacao
  OldCreateOrder = False
  Left = 276
  Top = 214
  Height = 305
  Width = 545
  object dbPmnh: TADOConnection
    Connected = True
    ConnectionString = 
      'Provider=MSDASQL.1;Persist Security Info=False;Data Source=pmnh_' +
      'teste'
    LoginPrompt = False
    Left = 30
    Top = 11
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
    Left = 29
    Top = 59
    object qryDenunciadatahoradenuncia: TDateTimeField
      FieldName = 'datahoradenuncia'
    end
    object qryDenunciaassunto: TStringField
      FieldName = 'assunto'
      Size = 50
    end
    object qryDenunciarequerente: TStringField
      FieldName = 'requerente'
      Size = 100
    end
    object qryDenunciainfrator: TStringField
      FieldName = 'infrator'
      Size = 100
    end
    object qryDenunciaidinfrator: TIntegerField
      FieldName = 'idinfrator'
    end
    object qryDenunciadescricao: TStringField
      FieldName = 'descricao'
      Size = 30
    end
    object qryDenunciaiddenuncia: TIntegerField
      FieldName = 'iddenuncia'
    end
    object qryDenunciaidsolicitacao: TIntegerField
      FieldName = 'idsolicitacao'
    end
  end
  object dsDenuncia: TwwDataSource
    AutoEdit = False
    DataSet = qryDenuncia
    Left = 124
    Top = 60
  end
  object qryLogin: TADOQuery
    Connection = dbPmnh
    Parameters = <>
    SQL.Strings = (
      'select * from fis_usuario '
      '')
    Left = 124
    Top = 12
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
  object qry: TADOQuery
    Connection = dbPmnh
    Parameters = <>
    Left = 199
    Top = 13
  end
end
