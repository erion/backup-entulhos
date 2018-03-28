object frmBuscaCidadao: TfrmBuscaCidadao
  Left = 322
  Top = 226
  Width = 433
  Height = 264
  BorderIcons = [biSystemMenu, biMinimize]
  Caption = 'SICOF - Busca Cidad'#227'o'
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'MS Sans Serif'
  Font.Style = []
  OldCreateOrder = False
  Position = poMainFormCenter
  OnClose = FormClose
  PixelsPerInch = 96
  TextHeight = 13
  object Panel1: TPanel
    Left = 0
    Top = 0
    Width = 425
    Height = 218
    Align = alClient
    BevelInner = bvLowered
    TabOrder = 0
    object SpeedButton1: TSpeedButton
      Left = 337
      Top = 9
      Width = 27
      Height = 25
      Glyph.Data = {
        76010000424D7601000000000000760000002800000020000000100000000100
        04000000000000010000130B0000130B00001000000000000000000000000000
        800000800000008080008000000080008000808000007F7F7F00BFBFBF000000
        FF0000FF000000FFFF00FF000000FF00FF00FFFF0000FFFFFF00333333333333
        33033333333333333F7F3333333333333000333333333333F777333333333333
        000333333333333F777333333333333000333333333333F77733333333333300
        033333333FFF3F777333333700073B703333333F7773F77733333307777700B3
        33333377333777733333307F8F8F7033333337F333F337F3333377F8F9F8F773
        3333373337F3373F3333078F898F870333337F33F7FFF37F333307F99999F703
        33337F377777337F3333078F898F8703333373F337F33373333377F8F9F8F773
        333337F3373337F33333307F8F8F70333333373FF333F7333333330777770333
        333333773FF77333333333370007333333333333777333333333}
      NumGlyphs = 2
      OnClick = SpeedButton1Click
    end
    object edtBuscaCidadao: TEdit
      Left = 8
      Top = 12
      Width = 320
      Height = 21
      CharCase = ecUpperCase
      TabOrder = 0
      OnKeyPress = edtBuscaCidadaoKeyPress
    end
    object wwDBGrid1: TwwDBGrid
      Left = 7
      Top = 42
      Width = 410
      Height = 167
      Selected.Strings = (
        'nome_cidadao'#9'100'#9'Nome'
        'cod_cidadao'#9'10'#9'C'#243'digo'#9'F')
      IniAttributes.Delimiter = ';;'
      TitleColor = clBtnFace
      FixedCols = 0
      ShowHorzScrollBar = True
      DataSource = dmCadastroFiscalizacao.dsBuscaCidadao
      Options = [dgEditing, dgTitles, dgIndicator, dgColumnResize, dgColLines, dgRowLines, dgTabs, dgRowSelect, dgConfirmDelete, dgCancelOnExit, dgWordWrap]
      ReadOnly = True
      TabOrder = 1
      TitleAlignment = taLeftJustify
      TitleFont.Charset = DEFAULT_CHARSET
      TitleFont.Color = clWindowText
      TitleFont.Height = -11
      TitleFont.Name = 'MS Sans Serif'
      TitleFont.Style = []
      TitleLines = 1
      TitleButtons = False
      OnDblClick = wwDBGrid1DblClick
    end
  end
  object StatusBar1: TStatusBar
    Left = 0
    Top = 218
    Width = 425
    Height = 19
    Panels = <>
    SimplePanel = False
  end
end
