object frmSolicitacao: TfrmSolicitacao
  Left = 192
  Top = 103
  Width = 652
  Height = 491
  BorderIcons = [biSystemMenu, biMinimize]
  Caption = 'SICOF - Cadastro de Solicita'#231#227'o'
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'MS Sans Serif'
  Font.Style = []
  OldCreateOrder = False
  Position = poMainFormCenter
  OnCreate = FormCreate
  OnShow = FormShow
  PixelsPerInch = 96
  TextHeight = 13
  object ToolBar1: TToolBar
    Left = 0
    Top = 0
    Width = 644
    Height = 44
    ButtonHeight = 37
    Caption = 'ToolBar1'
    EdgeBorders = [ebLeft, ebTop, ebRight, ebBottom]
    TabOrder = 0
    object wwDBNavigator2: TwwDBNavigator
      Left = 0
      Top = 2
      Width = 251
      Height = 37
      AutosizeStyle = asSizeNavButtons
      DataSource = dmCadastroFiscalizacao.dsSolicitacao
      RepeatInterval.InitialDelay = 500
      RepeatInterval.Interval = 100
      object wwDBNavigator2Post: TwwNavButton
        Left = 0
        Top = 0
        Width = 126
        Height = 37
        Hint = 'Salvar registro'
        ImageIndex = -1
        NumGlyphs = 2
        ShowText = True
        Spacing = 4
        Transparent = False
        Caption = 'Salvar'
        Enabled = False
        DisabledTextColors.ShadeColor = clGray
        DisabledTextColors.HighlightColor = clBtnHighlight
        Index = 0
        Style = nbsPost
      end
      object wwDBNavigator2Cancel: TwwNavButton
        Left = 126
        Top = 0
        Width = 125
        Height = 37
        Hint = 'Cancelar'
        ImageIndex = -1
        NumGlyphs = 2
        ShowText = True
        Spacing = 4
        Transparent = False
        Caption = 'Cancelar'
        Enabled = False
        DisabledTextColors.ShadeColor = clGray
        DisabledTextColors.HighlightColor = clBtnHighlight
        Index = 1
        Style = nbsCancel
      end
    end
  end
  object Panel1: TPanel
    Left = 0
    Top = 44
    Width = 644
    Height = 401
    Align = alClient
    BevelInner = bvLowered
    TabOrder = 1
    object Label7: TLabel
      Left = 275
      Top = 112
      Width = 41
      Height = 13
      Caption = 'Assunto:'
    end
    object Label8: TLabel
      Left = 275
      Top = 158
      Width = 61
      Height = 13
      Caption = 'Observa'#231#227'o:'
    end
    object Label9: TLabel
      Left = 18
      Top = 11
      Width = 67
      Height = 13
      Caption = 'Id Solicita'#231#227'o:'
    end
    object Label10: TLabel
      Left = 108
      Top = 11
      Width = 81
      Height = 13
      Caption = 'Data Solicita'#231#227'o:'
    end
    object Label3: TLabel
      Left = 227
      Top = 11
      Width = 33
      Height = 13
      Caption = 'Origem'
    end
    object Label1: TLabel
      Left = 18
      Top = 63
      Width = 98
      Height = 13
      Caption = 'Tipo de Requerente '
    end
    object Label2: TLabel
      Left = 275
      Top = 63
      Width = 102
      Height = 13
      Caption = 'Nome do Requerente'
    end
    object SpeedButton1: TSpeedButton
      Left = 606
      Top = 77
      Width = 24
      Height = 23
      Hint = 'Busca de Cidad'#227'o'
      Enabled = False
      Flat = True
      Glyph.Data = {
        76010000424D7601000000000000760000002800000020000000100000000100
        04000000000000010000130B0000130B00001000000000000000000000000000
        800000800000008080008000000080008000808000007F7F7F00BFBFBF000000
        FF0000FF000000FFFF00FF000000FF00FF00FFFF0000FFFFFF00333333333333
        33333333333FFFFFFFFF333333000000000033333377777777773333330FFFFF
        FFF03333337F333333373333330FFFFFFFF03333337F3FF3FFF73333330F00F0
        00F03333F37F773777373330330FFFFFFFF03337FF7F3F3FF3F73339030F0800
        F0F033377F7F737737373339900FFFFFFFF03FF7777F3FF3FFF70999990F00F0
        00007777777F7737777709999990FFF0FF0377777777FF37F3730999999908F0
        F033777777777337F73309999990FFF0033377777777FFF77333099999000000
        3333777777777777333333399033333333333337773333333333333903333333
        3333333773333333333333303333333333333337333333333333}
      NumGlyphs = 2
      OnClick = SpeedButton1Click
    end
    object dataSolicitacao: TwwDBEdit
      Left = 107
      Top = 29
      Width = 95
      Height = 21
      Color = clInfoBk
      DataField = 'datahorasolicitacao'
      DataSource = dmCadastroFiscalizacao.dsSolicitacao
      TabOrder = 1
      UnboundDataType = wwDefault
      WantReturns = False
      WordWrap = False
    end
    object idSolicitacao: TwwDBEdit
      Left = 17
      Top = 29
      Width = 56
      Height = 21
      Color = clAqua
      DataField = 'idsolicitacao'
      DataSource = dmCadastroFiscalizacao.dsSolicitacao
      ReadOnly = True
      TabOrder = 0
      UnboundDataType = wwDefault
      WantReturns = False
      WordWrap = False
    end
    object assunto: TwwDBEdit
      Left = 275
      Top = 131
      Width = 354
      Height = 21
      DataField = 'assunto'
      DataSource = dmCadastroFiscalizacao.dsSolicitacao
      TabOrder = 6
      UnboundDataType = wwDefault
      WantReturns = False
      WordWrap = False
    end
    object wwDBRichEdit1: TwwDBRichEdit
      Left = 275
      Top = 176
      Width = 354
      Height = 55
      AutoURLDetect = False
      DataField = 'observacao'
      DataSource = dmCadastroFiscalizacao.dsSolicitacao
      PrintJobName = 'Delphi 6'
      TabOrder = 7
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
        810000007B5C727466315C616E73695C616E7369637067313235325C64656666
        305C6465666C616E67313034367B5C666F6E7474626C7B5C66305C666E696C20
        4D532053616E732053657269663B7D7D0D0A5C766965776B696E64345C756331
        5C706172645C66305C6673313620777744425269636845646974315C7061720D
        0A7D0D0A00}
    end
    object GroupBox3: TGroupBox
      Left = 16
      Top = 237
      Width = 623
      Height = 158
      Caption = 'Den'#250'ncias  '
      TabOrder = 8
      object wwDBGrid1: TwwDBGrid
        Left = 6
        Top = 18
        Width = 611
        Height = 131
        ControlType.Strings = (
          'codlotacao;CustomEdit;LookupCodLotacao;F'
          'idfiscal;CustomEdit;LookupIdFiscal;F'
          'idsituacao;CustomEdit;LookupIdSituacao;F'
          'idinfrator;CustomEdit;LookupIdInfrator;F'
          'idbairroinfracao;CustomEdit;LookupIdBairroInfracao;F'
          'idlogradouroinfracao;CustomEdit;LookupidLogradouroInfracao;F')
        Selected.Strings = (
          'NomeInfrator'#9'25'#9'Nome Infrator'#9'F'#9
          'assunto'#9'42'#9'Assunto'#9#9
          'NomeSecretaria'#9'20'#9'Nome Secretaria'#9'F')
        IniAttributes.Delimiter = ';;'
        TitleColor = clBtnFace
        FixedCols = 0
        ShowHorzScrollBar = True
        Options = [dgEditing, dgTitles, dgIndicator, dgColumnResize, dgColLines, dgRowLines, dgTabs, dgRowSelect, dgConfirmDelete, dgCancelOnExit, dgWordWrap]
        ReadOnly = True
        TabOrder = 0
        TitleAlignment = taLeftJustify
        TitleFont.Charset = DEFAULT_CHARSET
        TitleFont.Color = clWindowText
        TitleFont.Height = -11
        TitleFont.Name = 'MS Sans Serif'
        TitleFont.Style = []
        TitleLines = 1
        TitleButtons = False
        PaintOptions.AlternatingRowColor = clMoneyGreen
        PaintOptions.ActiveRecordColor = clBlue
        object wwDBGrid1IButton: TwwIButton
          Left = 0
          Top = 0
          Width = 22
          Height = 22
          Hint = 'Cadastrar den'#250'ncia para esta solicita'#231#227'o.'
          AllowAllUp = True
          Enabled = False
          Glyph.Data = {
            76010000424D7601000000000000760000002800000020000000100000000100
            04000000000000010000120B0000120B00001000000000000000000000000000
            800000800000008080008000000080008000808000007F7F7F00BFBFBF000000
            FF0000FF000000FFFF00FF000000FF00FF00FFFF0000FFFFFF00333333333333
            333333333333FF3333333333333C0C333333333333F777F3333333333CC0F0C3
            333333333777377F33333333C30F0F0C333333337F737377F333333C00FFF0F0
            C33333F7773337377F333CC0FFFFFF0F0C3337773F33337377F3C30F0FFFFFF0
            F0C37F7373F33337377F00FFF0FFFFFF0F0C7733373F333373770FFFFF0FFFFF
            F0F073F33373F333373730FFFFF0FFFFFF03373F33373F333F73330FFFFF0FFF
            00333373F33373FF77333330FFFFF000333333373F333777333333330FFF0333
            3333333373FF7333333333333000333333333333377733333333333333333333
            3333333333333333333333333333333333333333333333333333}
          NumGlyphs = 2
          OnClick = wwDBGrid1IButtonClick
        end
      end
    end
    object GroupBox2: TGroupBox
      Left = 16
      Top = 111
      Width = 249
      Height = 120
      Caption = '  Protocolo  '
      TabOrder = 5
      object Label5: TLabel
        Left = 14
        Top = 58
        Width = 26
        Height = 13
        Caption = 'Data:'
      end
      object Label6: TLabel
        Left = 16
        Top = 87
        Width = 24
        Height = 13
        Caption = 'Tipo:'
      end
      object Label4: TLabel
        Left = 25
        Top = 27
        Width = 15
        Height = 13
        Caption = 'N'#186':'
      end
      object LookupIdTipoProtocolo: TwwDBLookupCombo
        Left = 48
        Top = 83
        Width = 165
        Height = 21
        DropDownAlignment = taLeftJustify
        Selected.Strings = (
          'descricao'#9'30'#9'descricao'#9'F'#9
          'codigo'#9'10'#9'codigo'#9'F'#9)
        DataField = 'idtipoprotocolo'
        DataSource = dmCadastroFiscalizacao.dsSolicitacao
        LookupTable = dmCadastroFiscalizacao.qryLookup
        TabOrder = 2
        AutoDropDown = False
        ShowButton = True
        AllowClearKey = False
        OnBeforeDropDown = LookupIdTipoProtocoloBeforeDropDown
      end
      object numProtocolo: TwwDBEdit
        Left = 48
        Top = 23
        Width = 99
        Height = 21
        DataField = 'numprotocolo'
        DataSource = dmCadastroFiscalizacao.dsSolicitacao
        TabOrder = 0
        UnboundDataType = wwDefault
        WantReturns = False
        WordWrap = False
      end
      object DTPDataProtocolo: TwwDBDateTimePicker
        Left = 49
        Top = 52
        Width = 121
        Height = 21
        CalendarAttributes.Font.Charset = DEFAULT_CHARSET
        CalendarAttributes.Font.Color = clWindowText
        CalendarAttributes.Font.Height = -11
        CalendarAttributes.Font.Name = 'MS Sans Serif'
        CalendarAttributes.Font.Style = []
        DataField = 'dataprotocolo'
        DataSource = dmCadastroFiscalizacao.dsSolicitacao
        Epoch = 1950
        ShowButton = True
        TabOrder = 1
      end
    end
    object LookupIdOrigem: TwwDBLookupCombo
      Left = 224
      Top = 29
      Width = 121
      Height = 21
      DropDownAlignment = taLeftJustify
      Selected.Strings = (
        'descricao'#9'30'#9'descricao'#9'F'#9
        'codigo'#9'10'#9'codigo'#9'F'#9)
      DataField = 'idorigem'
      DataSource = dmCadastroFiscalizacao.dsSolicitacao
      LookupTable = dmCadastroFiscalizacao.qryLookup
      TabOrder = 2
      AutoDropDown = False
      ShowButton = True
      AllowClearKey = False
      OnBeforeDropDown = LookupIdOrigemBeforeDropDown
    end
    object LookupIdTipoRequerente: TwwDBLookupCombo
      Left = 17
      Top = 79
      Width = 248
      Height = 21
      DropDownAlignment = taLeftJustify
      Selected.Strings = (
        'descricao'#9'30'#9'descricao'#9'F'#9
        'codigo'#9'10'#9'codigo'#9'F'#9)
      DataField = 'idtiporequerente'
      DataSource = dmCadastroFiscalizacao.dsSolicitacao
      LookupTable = dmCadastroFiscalizacao.qryLookup
      TabOrder = 3
      AutoDropDown = False
      ShowButton = True
      AllowClearKey = False
      OnChange = LookupIdTipoRequerenteChange
      OnBeforeDropDown = LookupIdTipoRequerenteBeforeDropDown
    end
    object LookupIdRequerente: TwwDBLookupCombo
      Left = 275
      Top = 79
      Width = 321
      Height = 21
      DropDownAlignment = taLeftJustify
      Selected.Strings = (
        'nome_cidadao'#9'50'#9'NOME CIDAD'#195'O'#9'F'
        'cod_cidadao'#9'10'#9'C'#211'DIGO'#9'F')
      DataField = 'idrequerente'
      DataSource = dmCadastroFiscalizacao.dsSolicitacao
      LookupTable = dmCadastroFiscalizacao.qryBuscaCidadao
      LookupField = 'cod_cidadao'
      Enabled = False
      TabOrder = 4
      AutoDropDown = False
      ShowButton = True
      AllowClearKey = False
    end
  end
  object StatusBar1: TStatusBar
    Left = 0
    Top = 445
    Width = 644
    Height = 19
    Panels = <>
    SimplePanel = False
  end
end
