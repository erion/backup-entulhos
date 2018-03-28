object frmDenuncia: TfrmDenuncia
  Left = 301
  Top = 166
  Width = 492
  Height = 376
  BorderIcons = [biSystemMenu, biMinimize]
  Caption = 'SICOF - Cadastro de Den'#250'ncia'
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'MS Sans Serif'
  Font.Style = []
  OldCreateOrder = False
  Position = poMainFormCenter
  OnClose = FormClose
  OnCreate = FormCreate
  OnShow = FormShow
  PixelsPerInch = 96
  TextHeight = 13
  object ToolBar1: TToolBar
    Left = 0
    Top = 0
    Width = 484
    Height = 44
    ButtonHeight = 38
    Caption = 'ToolBar1'
    TabOrder = 0
    object wwDBNavigator1: TwwDBNavigator
      Left = 0
      Top = 2
      Width = 484
      Height = 38
      AutosizeStyle = asSizeNavButtons
      DataSource = dmCadastroFiscalizacao.dsDenuncia
      RepeatInterval.InitialDelay = 500
      RepeatInterval.Interval = 100
      object wwDBNavigator1Post: TwwNavButton
        Left = 0
        Top = 0
        Width = 162
        Height = 38
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
      object wwDBNavigator1Cancel: TwwNavButton
        Left = 162
        Top = 0
        Width = 161
        Height = 38
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
      object wwDBNavigator1Insert: TwwNavButton
        Left = 323
        Top = 0
        Width = 161
        Height = 38
        Hint = 'Inserir novo registro'
        ImageIndex = -1
        NumGlyphs = 2
        ShowText = True
        Spacing = 4
        Transparent = False
        Caption = 'Inserir'
        Enabled = False
        DisabledTextColors.ShadeColor = clGray
        DisabledTextColors.HighlightColor = clBtnHighlight
        Index = 2
        Style = nbsInsert
      end
    end
  end
  object Panel1: TPanel
    Left = 0
    Top = 44
    Width = 484
    Height = 286
    Align = alClient
    BevelOuter = bvLowered
    TabOrder = 1
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
      DataSource = dmCadastroFiscalizacao.dsDenuncia
      LookupTable = dmCadastroFiscalizacao.qryBuscaCidadao
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
      DataSource = dmCadastroFiscalizacao.dsDenuncia
      LookupTable = dmCadastroFiscalizacao.qryLookup
      TabOrder = 1
      AutoDropDown = False
      ShowButton = True
      AllowClearKey = False
      OnBeforeDropDown = LookupIdLogradouroBeforeDropDown
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
      DataSource = dmCadastroFiscalizacao.dsDenuncia
      LookupTable = dmCadastroFiscalizacao.qryLookup
      TabOrder = 2
      AutoDropDown = False
      ShowButton = True
      AllowClearKey = False
      OnBeforeDropDown = LookupIdBairroBeforeDropDown
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
      DataSource = dmCadastroFiscalizacao.dsDenuncia
      LookupTable = dmCadastroFiscalizacao.qryLookup
      TabOrder = 3
      AutoDropDown = False
      ShowButton = True
      AllowClearKey = False
      OnBeforeDropDown = LookupIdLotacaoBeforeDropDown
    end
    object idDenuncia: TwwDBEdit
      Left = 81
      Top = 24
      Width = 48
      Height = 21
      Color = clAqua
      DataField = 'iddenuncia'
      DataSource = dmCadastroFiscalizacao.dsDenuncia
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
      DataSource = dmCadastroFiscalizacao.dsDenuncia
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
      DataSource = dmCadastroFiscalizacao.dsDenuncia
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
      DataSource = dmCadastroFiscalizacao.dsDenuncia
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
      DataSource = dmCadastroFiscalizacao.dsDenuncia
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
      DataSource = dmCadastroFiscalizacao.dsDenuncia
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
      DataSource = dmCadastroFiscalizacao.dsDenuncia
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
      DataSource = dmCadastroFiscalizacao.dsDenuncia
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
      DataSource = dmCadastroFiscalizacao.dsDenuncia
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
      DataSource = dmCadastroFiscalizacao.dsDenuncia
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
      DataSource = dmCadastroFiscalizacao.dsDenuncia
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
    Top = 330
    Width = 484
    Height = 19
    Panels = <>
    SimplePanel = False
  end
end
