object frmNotificacao: TfrmNotificacao
  Left = 192
  Top = 103
  Width = 696
  Height = 470
  Caption = 'SICOF - Cadastro de Notifica'#231#245'es'
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'MS Sans Serif'
  Font.Style = []
  OldCreateOrder = False
  OnClose = FormClose
  OnShow = FormShow
  PixelsPerInch = 96
  TextHeight = 13
  object GroupBox1: TGroupBox
    Left = 3
    Top = 26
    Width = 681
    Height = 393
    TabOrder = 0
    object Label3: TLabel
      Left = 224
      Top = 71
      Width = 30
      Height = 13
      Caption = 'Fiscal:'
    end
    object Label4: TLabel
      Left = 456
      Top = 71
      Width = 45
      Height = 13
      Caption = 'Situa'#231#227'o:'
    end
    object Label5: TLabel
      Left = 25
      Top = 128
      Width = 98
      Height = 13
      Caption = 'Data da Notifica'#231#227'o:'
    end
    object Label6: TLabel
      Left = 323
      Top = 128
      Width = 55
      Height = 13
      Caption = 'Ocorr'#234'ncia:'
    end
    object Label7: TLabel
      Left = 26
      Top = 176
      Width = 56
      Height = 13
      Caption = 'Base Legal:'
    end
    object Label8: TLabel
      Left = 27
      Top = 222
      Width = 66
      Height = 13
      Caption = 'Observa'#231#245'es:'
    end
    object GroupBox2: TGroupBox
      Left = 8
      Top = 9
      Width = 201
      Height = 88
      Caption = '  Notifica'#231#227'o  '
      TabOrder = 0
      object Label1: TLabel
        Left = 16
        Top = 30
        Width = 18
        Height = 13
        Caption = 'N'#186' :'
      end
      object Label2: TLabel
        Left = 24
        Top = 61
        Width = 101
        Height = 13
        Caption = 'referente a den'#250'ncia:'
      end
      object codNotificacao: TwwDBEdit
        Left = 40
        Top = 26
        Width = 79
        Height = 21
        DataField = 'codnotificacao'
        DataSource = dmFiscalizacao.dsNotificacao
        TabOrder = 0
        UnboundDataType = wwDefault
        WantReturns = False
        WordWrap = False
      end
      object idDenuncia: TwwDBEdit
        Left = 132
        Top = 58
        Width = 59
        Height = 21
        DataField = 'iddenuncia'
        DataSource = dmFiscalizacao.dsNotificacao
        TabOrder = 1
        UnboundDataType = wwDefault
        WantReturns = False
        WordWrap = False
      end
    end
    object lookupIdFiscal: TwwDBLookupCombo
      Left = 259
      Top = 67
      Width = 182
      Height = 21
      DropDownAlignment = taLeftJustify
      Selected.Strings = (
        'nome'#9'20'#9'Nome'#9#9)
      DataField = 'idfiscal'
      DataSource = dmFiscalizacao.dsNotificacao
      LookupTable = dmFiscalizacao.qryFiscal
      LookupField = 'idusuario'
      TabOrder = 1
      AutoDropDown = False
      ShowButton = True
      AllowClearKey = False
    end
    object lookupIdSituacao: TwwDBLookupCombo
      Left = 505
      Top = 67
      Width = 160
      Height = 21
      DropDownAlignment = taLeftJustify
      Selected.Strings = (
        'descricao'#9'30'#9'Descri'#231#227'o'#9#9)
      DataField = 'idsituacao'
      DataSource = dmFiscalizacao.dsNotificacao
      LookupTable = dmFiscalizacao.qrySituacao
      LookupField = 'idsituacao'
      TabOrder = 2
      AutoDropDown = False
      ShowButton = True
      AllowClearKey = False
    end
    object dataNotificacao: TwwDBEdit
      Left = 131
      Top = 125
      Width = 97
      Height = 21
      DataField = 'datahoranotificacao'
      DataSource = dmFiscalizacao.dsNotificacao
      TabOrder = 3
      UnboundDataType = wwDefault
      WantReturns = False
      WordWrap = False
    end
    object lookupIdOcorrencia: TwwDBLookupCombo
      Left = 383
      Top = 125
      Width = 282
      Height = 21
      DropDownAlignment = taLeftJustify
      Selected.Strings = (
        'descricao'#9'200'#9'Descri'#231#227'o'#9'F')
      DataField = 'idocorrencia'
      DataSource = dmFiscalizacao.dsNotificacao
      LookupTable = dmFiscalizacao.qryOcorrencia
      LookupField = 'idocorrencia'
      TabOrder = 4
      AutoDropDown = False
      ShowButton = True
      AllowClearKey = False
    end
    object lookupCodBaseLegal: TwwDBLookupComboDlg
      Left = 87
      Top = 173
      Width = 274
      Height = 21
      GridOptions = [dgTitles, dgIndicator, dgColumnResize, dgColLines, dgRowLines, dgTabs, dgRowSelect, dgAlwaysShowSelection, dgConfirmDelete, dgPerfectRowFit]
      GridColor = clWhite
      GridTitleAlignment = taLeftJustify
      Caption = 'Lookup'
      MaxWidth = 0
      MaxHeight = 209
      Selected.Strings = (
        'descricao'#9'60'#9'Descri'#231#227'o'#9'F'#9)
      DataField = 'codbaselegal'
      DataSource = dmFiscalizacao.dsNotificacao
      LookupTable = dmFiscalizacao.qryBaseLegal
      LookupField = 'cod_base_legal'
      TabOrder = 5
      AutoDropDown = False
      ShowButton = True
      AllowClearKey = False
    end
    object observacao: TwwDBRichEdit
      Left = 27
      Top = 246
      Width = 636
      Height = 77
      AutoURLDetect = False
      DataField = 'observacao'
      DataSource = dmFiscalizacao.dsNotificacao
      PrintJobName = 'Delphi 6'
      TabOrder = 6
      EditorCaption = 'Edit Rich Text'
      EditorPosition.Left = 0
      EditorPosition.Top = 0
      EditorPosition.Width = 0
      EditorPosition.Height = 0
      MeasurementUnits = muInches
      PrintMargins.Top = 1
      PrintMargins.Bottom = 1
      PrintMargins.Left = 1
      PrintMargins.Right = 1
      RichEditVersion = 2
      Data = {
        7E0000007B5C727466315C616E73695C616E7369637067313235325C64656666
        305C6465666C616E67313034367B5C666F6E7474626C7B5C66305C666E696C20
        4D532053616E732053657269663B7D7D0D0A5C766965776B696E64345C756331
        5C706172645C66305C66733136206F62736572766163616F5C7061720D0A7D0D
        0A00}
    end
  end
  object StatusBar1: TStatusBar
    Left = 0
    Top = 424
    Width = 688
    Height = 19
    Panels = <>
    SimplePanel = False
  end
  object wwDBNavigator1: TwwDBNavigator
    Left = 3
    Top = 0
    Width = 680
    Height = 26
    AutosizeStyle = asSizeNavButtons
    DataSource = dmFiscalizacao.dsNotificacao
    RepeatInterval.InitialDelay = 500
    RepeatInterval.Interval = 100
    object wwDBNavigator1First: TwwNavButton
      Left = 0
      Top = 0
      Width = 49
      Height = 26
      Hint = 'Move to first record'
      ImageIndex = -1
      NumGlyphs = 2
      Spacing = 4
      Transparent = False
      Caption = 'wwDBNavigator1First'
      Enabled = False
      DisabledTextColors.ShadeColor = clGray
      DisabledTextColors.HighlightColor = clBtnHighlight
      Index = 0
      Style = nbsFirst
    end
    object wwDBNavigator1PriorPage: TwwNavButton
      Left = 49
      Top = 0
      Width = 49
      Height = 26
      Hint = 'Move backward 10 records'
      ImageIndex = -1
      NumGlyphs = 2
      Spacing = 4
      Transparent = False
      Caption = 'wwDBNavigator1PriorPage'
      Enabled = False
      DisabledTextColors.ShadeColor = clGray
      DisabledTextColors.HighlightColor = clBtnHighlight
      Index = 1
      Style = nbsPriorPage
    end
    object wwDBNavigator1Prior: TwwNavButton
      Left = 98
      Top = 0
      Width = 49
      Height = 26
      Hint = 'Move to prior record'
      ImageIndex = -1
      NumGlyphs = 2
      Spacing = 4
      Transparent = False
      Caption = 'wwDBNavigator1Prior'
      Enabled = False
      DisabledTextColors.ShadeColor = clGray
      DisabledTextColors.HighlightColor = clBtnHighlight
      Index = 2
      Style = nbsPrior
    end
    object wwDBNavigator1Next: TwwNavButton
      Left = 147
      Top = 0
      Width = 49
      Height = 26
      Hint = 'Move to next record'
      ImageIndex = -1
      NumGlyphs = 2
      Spacing = 4
      Transparent = False
      Caption = 'wwDBNavigator1Next'
      Enabled = False
      DisabledTextColors.ShadeColor = clGray
      DisabledTextColors.HighlightColor = clBtnHighlight
      Index = 3
      Style = nbsNext
    end
    object wwDBNavigator1NextPage: TwwNavButton
      Left = 196
      Top = 0
      Width = 49
      Height = 26
      Hint = 'Move forward 10 records'
      ImageIndex = -1
      NumGlyphs = 2
      Spacing = 4
      Transparent = False
      Caption = 'wwDBNavigator1NextPage'
      Enabled = False
      DisabledTextColors.ShadeColor = clGray
      DisabledTextColors.HighlightColor = clBtnHighlight
      Index = 4
      Style = nbsNextPage
    end
    object wwDBNavigator1Last: TwwNavButton
      Left = 245
      Top = 0
      Width = 49
      Height = 26
      Hint = 'Move to last record'
      ImageIndex = -1
      NumGlyphs = 2
      Spacing = 4
      Transparent = False
      Caption = 'wwDBNavigator1Last'
      Enabled = False
      DisabledTextColors.ShadeColor = clGray
      DisabledTextColors.HighlightColor = clBtnHighlight
      Index = 5
      Style = nbsLast
    end
    object wwDBNavigator1Insert: TwwNavButton
      Left = 294
      Top = 0
      Width = 49
      Height = 26
      Hint = 'Insert new record'
      ImageIndex = -1
      NumGlyphs = 2
      Spacing = 4
      Transparent = False
      Caption = 'wwDBNavigator1Insert'
      Enabled = False
      DisabledTextColors.ShadeColor = clGray
      DisabledTextColors.HighlightColor = clBtnHighlight
      Index = 6
      Style = nbsInsert
    end
    object wwDBNavigator1Delete: TwwNavButton
      Left = 343
      Top = 0
      Width = 49
      Height = 26
      Hint = 'Delete current record'
      ImageIndex = -1
      NumGlyphs = 2
      Spacing = 4
      Transparent = False
      Caption = 'wwDBNavigator1Delete'
      Enabled = False
      DisabledTextColors.ShadeColor = clGray
      DisabledTextColors.HighlightColor = clBtnHighlight
      Index = 7
      Style = nbsDelete
    end
    object wwDBNavigator1Edit: TwwNavButton
      Left = 392
      Top = 0
      Width = 48
      Height = 26
      Hint = 'Edit current record'
      ImageIndex = -1
      NumGlyphs = 2
      Spacing = 4
      Transparent = False
      Caption = 'wwDBNavigator1Edit'
      Enabled = False
      DisabledTextColors.ShadeColor = clGray
      DisabledTextColors.HighlightColor = clBtnHighlight
      Index = 8
      Style = nbsEdit
    end
    object wwDBNavigator1Post: TwwNavButton
      Left = 440
      Top = 0
      Width = 48
      Height = 26
      Hint = 'Post changes of current record'
      ImageIndex = -1
      NumGlyphs = 2
      Spacing = 4
      Transparent = False
      Caption = 'wwDBNavigator1Post'
      Enabled = False
      DisabledTextColors.ShadeColor = clGray
      DisabledTextColors.HighlightColor = clBtnHighlight
      Index = 9
      Style = nbsPost
    end
    object wwDBNavigator1Cancel: TwwNavButton
      Left = 488
      Top = 0
      Width = 48
      Height = 26
      Hint = 'Cancel changes made to current record'
      ImageIndex = -1
      NumGlyphs = 2
      Spacing = 4
      Transparent = False
      Caption = 'wwDBNavigator1Cancel'
      Enabled = False
      DisabledTextColors.ShadeColor = clGray
      DisabledTextColors.HighlightColor = clBtnHighlight
      Index = 10
      Style = nbsCancel
    end
    object wwDBNavigator1Refresh: TwwNavButton
      Left = 536
      Top = 0
      Width = 48
      Height = 26
      Hint = 'Refresh the contents of the dataset'
      ImageIndex = -1
      NumGlyphs = 2
      Spacing = 4
      Transparent = False
      Caption = 'wwDBNavigator1Refresh'
      Enabled = False
      DisabledTextColors.ShadeColor = clGray
      DisabledTextColors.HighlightColor = clBtnHighlight
      Index = 11
      Style = nbsRefresh
    end
    object wwDBNavigator1SaveBookmark: TwwNavButton
      Left = 584
      Top = 0
      Width = 48
      Height = 26
      Hint = 'Bookmark current record'
      ImageIndex = -1
      NumGlyphs = 2
      Spacing = 4
      Transparent = False
      Caption = 'wwDBNavigator1SaveBookmark'
      Enabled = False
      DisabledTextColors.ShadeColor = clGray
      DisabledTextColors.HighlightColor = clBtnHighlight
      Index = 12
      Style = nbsSaveBookmark
    end
    object wwDBNavigator1RestoreBookmark: TwwNavButton
      Left = 632
      Top = 0
      Width = 48
      Height = 26
      Hint = 'Go back to saved bookmark'
      ImageIndex = -1
      NumGlyphs = 2
      Spacing = 4
      Transparent = False
      Caption = 'wwDBNavigator1RestoreBookmark'
      Enabled = False
      DisabledTextColors.ShadeColor = clGray
      DisabledTextColors.HighlightColor = clBtnHighlight
      Index = 13
      Style = nbsRestoreBookmark
    end
  end
end
