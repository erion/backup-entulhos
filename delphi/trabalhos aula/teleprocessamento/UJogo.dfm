object fmJogoTP: TfmJogoTP
  Left = 201
  Top = 6
  BorderStyle = bsDialog
  Caption = 'Jogo Teleprocessamento'
  ClientHeight = 707
  ClientWidth = 707
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'MS Sans Serif'
  Font.Style = []
  OldCreateOrder = False
  OnShow = FormShow
  PixelsPerInch = 96
  TextHeight = 13
  object Panel1: TPanel
    Left = 0
    Top = 0
    Width = 707
    Height = 707
    Align = alClient
    BevelInner = bvLowered
    TabOrder = 0
    object tabuleiro: TStringGrid
      Left = 9
      Top = 8
      Width = 689
      Height = 689
      ColCount = 19
      DefaultColWidth = 32
      DefaultRowHeight = 32
      FixedCols = 0
      RowCount = 19
      FixedRows = 0
      Font.Charset = DEFAULT_CHARSET
      Font.Color = clWindowText
      Font.Height = -31
      Font.Name = 'MS Sans Serif'
      Font.Style = [fsBold]
      GridLineWidth = 4
      ParentFont = False
      TabOrder = 0
      OnClick = tabuleiroClick
    end
  end
end
