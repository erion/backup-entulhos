object frmDenuncia: TfrmDenuncia
  Left = 279
  Top = 181
  Width = 480
  Height = 365
  Caption = 'SICOF - Cadastro de Den'#250'ncia'
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
  object Panel1: TPanel
    Left = 0
    Top = 44
    Width = 472
    Height = 275
    Align = alClient
    BevelOuter = bvLowered
    TabOrder = 0
    object Label1: TLabel
      Left = 13
      Top = 28
      Width = 58
      Height = 13
      Caption = 'Id Den'#250'ncia'
    end
    object Label2: TLabel
      Left = 242
      Top = 28
      Width = 39
      Height = 13
      Caption = 'Lota'#231#227'o'
    end
    object Label3: TLabel
      Left = 38
      Top = 76
      Width = 33
      Height = 13
      Caption = 'Infrator'
    end
    object Label4: TLabel
      Left = 133
      Top = 28
      Width = 23
      Height = 13
      Caption = 'Data'
    end
    object Label5: TLabel
      Left = 33
      Top = 52
      Width = 38
      Height = 13
      Caption = 'Assunto'
    end
    object Label6: TLabel
      Left = 23
      Top = 110
      Width = 48
      Height = 13
      Caption = 'Descri'#231#227'o'
    end
    object Label7: TLabel
      Left = 205
      Top = 233
      Width = 58
      Height = 13
      Caption = 'Observa'#231#227'o'
    end
    object Label8: TLabel
      Left = 262
      Top = 166
      Width = 27
      Height = 13
      Caption = 'Bairro'
    end
    object Label9: TLabel
      Left = 17
      Top = 143
      Width = 54
      Height = 13
      Caption = 'Logradouro'
    end
    object Label10: TLabel
      Left = 404
      Top = 143
      Width = 12
      Height = 13
      Caption = 'N'#186
    end
    object Label11: TLabel
      Left = 7
      Top = 167
      Width = 64
      Height = 13
      Caption = 'Complemento'
    end
    object Label12: TLabel
      Left = 46
      Top = 191
      Width = 25
      Height = 13
      Caption = 'Setor'
    end
    object Label13: TLabel
      Left = 188
      Top = 191
      Width = 35
      Height = 13
      Caption = 'Quadra'
    end
    object Label14: TLabel
      Left = 335
      Top = 191
      Width = 21
      Height = 13
      Caption = 'Lote'
    end
    object Label15: TLabel
      Left = 31
      Top = 233
      Width = 40
      Height = 13
      Caption = 'Unidade'
    end
    object SpeedButton1: TSpeedButton
      Left = 300
      Top = 73
      Width = 24
      Height = 21
      Hint = 'Busca de Cidad'#227'o'
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
    object LookupIdInfrator: TwwDBLookupCombo
      Left = 80
      Top = 72
      Width = 209
      Height = 21
      Hint = 'Clique no bot'#227'o ao loado para realizar uma busca para infrator'
      DropDownAlignment = taLeftJustify
      Selected.Strings = (
        'nome_cidadao'#9'50'#9'NOME CIDAD'#195'O'#9#9)
      DataField = 'idinfrator'
      DataSource = dmFiscalizacao2.dsCadDenuncia
      LookupTable = dmFiscalizacao2.qryCidadao
      LookupField = 'cod_cidadao'
      TabOrder = 0
      AutoDropDown = False
      ShowButton = True
      AllowClearKey = False
    end
    object LookupIdLogradouro: TwwDBLookupCombo
      Left = 80
      Top = 139
      Width = 238
      Height = 21
      DropDownAlignment = taLeftJustify
      Selected.Strings = (
        'descricao'#9'40'#9'Logradouro'#9#9)
      DataField = 'idlogradouroinfracao'
      DataSource = dmFiscalizacao2.dsCadDenuncia
      LookupTable = dmFiscalizacao2.qryLogradouro
      LookupField = 'cod_logradouro'
      TabOrder = 1
      AutoDropDown = False
      ShowButton = True
      AllowClearKey = False
    end
    object LookupIdBairro: TwwDBLookupCombo
      Left = 294
      Top = 163
      Width = 169
      Height = 21
      DropDownAlignment = taLeftJustify
      Selected.Strings = (
        'nome'#9'25'#9'Bairro'#9#9)
      DataField = 'idbairroinfracao'
      DataSource = dmFiscalizacao2.dsCadDenuncia
      LookupTable = dmFiscalizacao2.qryBairro
      LookupField = 'cod_bairro'
      TabOrder = 2
      AutoDropDown = False
      ShowButton = True
      AllowClearKey = False
    end
    object LookupIdLotacao: TwwDBLookupCombo
      Left = 290
      Top = 24
      Width = 172
      Height = 21
      DropDownAlignment = taLeftJustify
      Selected.Strings = (
        'nome'#9'50'#9'Secretaria'#9'F'#9)
      DataField = 'codlotacao'
      DataSource = dmFiscalizacao2.dsCadDenuncia
      LookupTable = dmFiscalizacao2.qryLotacao
      LookupField = 'codlotacao'
      TabOrder = 3
      AutoDropDown = False
      ShowButton = True
      AllowClearKey = False
    end
    object idDenuncia: TwwDBEdit
      Left = 81
      Top = 24
      Width = 48
      Height = 21
      Color = clAqua
      DataField = 'iddenuncia'
      DataSource = dmFiscalizacao2.dsCadDenuncia
      ReadOnly = True
      TabOrder = 4
      UnboundDataType = wwDefault
      WantReturns = False
      WordWrap = False
    end
    object dataDenuncia: TwwDBEdit
      Left = 164
      Top = 24
      Width = 74
      Height = 21
      Color = clInfoBk
      DataField = 'datahoradenuncia'
      DataSource = dmFiscalizacao2.dsCadDenuncia
      TabOrder = 5
      UnboundDataType = wwDefault
      WantReturns = False
      WordWrap = False
    end
    object assuntoDenuncia: TwwDBEdit
      Left = 80
      Top = 48
      Width = 382
      Height = 21
      DataField = 'assunto'
      DataSource = dmFiscalizacao2.dsCadDenuncia
      TabOrder = 6
      UnboundDataType = wwDefault
      WantReturns = False
      WordWrap = False
    end
    object descricaoDenuncia: TwwDBRichEdit
      Left = 80
      Top = 96
      Width = 382
      Height = 40
      AutoURLDetect = False
      DataField = 'descricao'
      DataSource = dmFiscalizacao2.dsCadDenuncia
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
        640000007B5C727466315C616E73695C64656666307B5C666F6E7474626C7B5C
        66305C666E696C204D532053616E732053657269663B7D7D0D0A5C766965776B
        696E64345C7563315C706172645C6C616E67313034365C66305C667331365C70
        61720D0A7D0D0A00}
    end
    object numero: TwwDBEdit
      Left = 421
      Top = 139
      Width = 41
      Height = 21
      DataField = 'numeroinfracao'
      DataSource = dmFiscalizacao2.dsCadDenuncia
      TabOrder = 8
      UnboundDataType = wwDefault
      WantReturns = False
      WordWrap = False
    end
    object complemento: TwwDBEdit
      Left = 80
      Top = 163
      Width = 177
      Height = 21
      DataField = 'complementoinfracao'
      DataSource = dmFiscalizacao2.dsCadDenuncia
      TabOrder = 9
      UnboundDataType = wwDefault
      WantReturns = False
      WordWrap = False
    end
    object quadra: TwwDBEdit
      Left = 228
      Top = 187
      Width = 98
      Height = 21
      DataField = 'quadra'
      DataSource = dmFiscalizacao2.dsCadDenuncia
      TabOrder = 10
      UnboundDataType = wwDefault
      WantReturns = False
      WordWrap = False
    end
    object setor: TwwDBEdit
      Left = 80
      Top = 187
      Width = 100
      Height = 21
      DataField = 'setor'
      DataSource = dmFiscalizacao2.dsCadDenuncia
      TabOrder = 11
      UnboundDataType = wwDefault
      WantReturns = False
      WordWrap = False
    end
    object lote: TwwDBEdit
      Left = 362
      Top = 187
      Width = 102
      Height = 21
      DataField = 'lote'
      DataSource = dmFiscalizacao2.dsCadDenuncia
      TabOrder = 12
      UnboundDataType = wwDefault
      WantReturns = False
      WordWrap = False
    end
    object unidade: TwwDBEdit
      Left = 80
      Top = 229
      Width = 121
      Height = 21
      DataField = 'unidade'
      DataSource = dmFiscalizacao2.dsCadDenuncia
      TabOrder = 13
      UnboundDataType = wwDefault
      WantReturns = False
      WordWrap = False
    end
    object observacao: TwwDBRichEdit
      Left = 267
      Top = 211
      Width = 197
      Height = 56
      AutoURLDetect = False
      DataField = 'observacao'
      DataSource = dmFiscalizacao2.dsCadDenuncia
      PrintJobName = 'Delphi 6'
      TabOrder = 14
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
        640000007B5C727466315C616E73695C64656666307B5C666F6E7474626C7B5C
        66305C666E696C204D532053616E732053657269663B7D7D0D0A5C766965776B
        696E64345C7563315C706172645C6C616E67313034365C66305C667331365C70
        61720D0A7D0D0A00}
    end
  end
  object StatusBar1: TStatusBar
    Left = 0
    Top = 319
    Width = 472
    Height = 19
    Panels = <>
    SimplePanel = False
  end
  object ToolBar1: TToolBar
    Left = 0
    Top = 0
    Width = 472
    Height = 44
    ButtonHeight = 38
    Caption = 'ToolBar1'
    TabOrder = 2
    object wwDBNavigator1: TwwDBNavigator
      Left = 0
      Top = 2
      Width = 472
      Height = 38
      AutosizeStyle = asSizeNavButtons
      DataSource = dmFiscalizacao2.dsCadDenuncia
      RepeatInterval.InitialDelay = 500
      RepeatInterval.Interval = 100
      object wwDBNavigator1First: TwwNavButton
        Left = 0
        Top = 0
        Width = 53
        Height = 38
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
        Left = 53
        Top = 0
        Width = 53
        Height = 38
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
        Left = 106
        Top = 0
        Width = 53
        Height = 38
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
        Left = 159
        Top = 0
        Width = 53
        Height = 38
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
        Left = 212
        Top = 0
        Width = 52
        Height = 38
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
        Left = 264
        Top = 0
        Width = 52
        Height = 38
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
        Left = 316
        Top = 0
        Width = 52
        Height = 38
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
      object wwDBNavigator1Post: TwwNavButton
        Left = 368
        Top = 0
        Width = 52
        Height = 38
        Hint = 'Post changes of current record'
        ImageIndex = -1
        NumGlyphs = 2
        Spacing = 4
        Transparent = False
        Caption = 'wwDBNavigator1Post'
        Enabled = False
        DisabledTextColors.ShadeColor = clGray
        DisabledTextColors.HighlightColor = clBtnHighlight
        Index = 7
        Style = nbsPost
      end
      object wwDBNavigator1Cancel: TwwNavButton
        Left = 420
        Top = 0
        Width = 52
        Height = 38
        Hint = 'Cancel changes made to current record'
        ImageIndex = -1
        NumGlyphs = 2
        Spacing = 4
        Transparent = False
        Caption = 'wwDBNavigator1Cancel'
        Enabled = False
        DisabledTextColors.ShadeColor = clGray
        DisabledTextColors.HighlightColor = clBtnHighlight
        Index = 8
        Style = nbsCancel
      end
    end
  end
end
