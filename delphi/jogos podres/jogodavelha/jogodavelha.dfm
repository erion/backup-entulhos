object Form1: TForm1
  Left = 358
  Top = 159
  AlphaBlend = True
  BorderIcons = [biSystemMenu, biMinimize]
  BorderStyle = bsSingle
  Caption = 
    '---------------------------  Jogo da Velha  --------------------' +
    '---'
  ClientHeight = 507
  ClientWidth = 447
  Color = clGreen
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'MS Sans Serif'
  Font.Style = []
  Icon.Data = {
    000001000200101010000000000028010000260000002020100000000000E802
    00004E0100002800000010000000200000000100040000000000C00000000000
    0000000000000000000000000000000000000000800000800000008080008000
    00008000800080800000C0C0C000808080000000FF0000FF000000FFFF00FF00
    0000FF00FF00FFFF0000FFFFFF00000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000E3C7FFFFE3C7FFFFE3C7FFFF0000FFFF0000
    FFFF0000FFFFE3C7FFFFE3C7FFFFE3C7FFFFE3C7FFFF0000FFFF0000FFFF0000
    FFFFE3C7FFFFE3C7FFFFE3C7FFFF280000002000000040000000010004000000
    0000800200000000000000000000000000000000000000000000000080000080
    00000080800080000000800080008080000080808000C0C0C0000000FF0000FF
    000000FFFF00FF000000FF00FF00FFFF0000FFFFFF0000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    00000000000000000000000000000000000000000000FFFFFFFFFFFFFFFFFFFF
    FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
    FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
    FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
    FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF}
  OldCreateOrder = False
  OnShow = FormShow
  PixelsPerInch = 96
  TextHeight = 13
  object Label1: TLabel
    Left = 24
    Top = 40
    Width = 64
    Height = 13
    Caption = 'Jogador1: (O)'
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWhite
    Font.Height = -11
    Font.Name = 'MS Sans Serif'
    Font.Style = []
    ParentFont = False
  end
  object Label2: TLabel
    Left = 309
    Top = 40
    Width = 63
    Height = 13
    Caption = 'Jogador2: (X)'
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWhite
    Font.Height = -11
    Font.Name = 'MS Sans Serif'
    Font.Style = []
    ParentFont = False
  end
  object Label3: TLabel
    Left = 100
    Top = 4
    Width = 103
    Height = 40
    Alignment = taRightJustify
    Caption = 'Label3'
    Font.Charset = ANSI_CHARSET
    Font.Color = clYellow
    Font.Height = -35
    Font.Name = 'Times New Roman'
    Font.Style = [fsBold]
    ParentFont = False
  end
  object Label4: TLabel
    Left = 214
    Top = 4
    Width = 26
    Height = 40
    Caption = 'X'
    Font.Charset = ANSI_CHARSET
    Font.Color = clYellow
    Font.Height = -35
    Font.Name = 'Times New Roman'
    Font.Style = [fsBold]
    ParentFont = False
  end
  object Label5: TLabel
    Left = 250
    Top = 4
    Width = 103
    Height = 40
    Caption = 'Label3'
    Font.Charset = ANSI_CHARSET
    Font.Color = clYellow
    Font.Height = -35
    Font.Name = 'Times New Roman'
    Font.Style = [fsBold]
    ParentFont = False
  end
  object Memo1: TMemo
    Left = 19
    Top = 87
    Width = 415
    Height = 401
    BevelKind = bkTile
    BorderStyle = bsNone
    Color = clTeal
    Enabled = False
    Lines.Strings = (
      'Memo1')
    ReadOnly = True
    TabOrder = 11
  end
  object Edit1: TEdit
    Left = 20
    Top = 88
    Width = 118
    Height = 119
    BevelInner = bvNone
    BevelKind = bkTile
    BiDiMode = bdLeftToRight
    CharCase = ecUpperCase
    Color = clBlack
    DragCursor = crDefault
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWhite
    Font.Height = -96
    Font.Name = 'MS Sans Serif'
    Font.Style = []
    ParentBiDiMode = False
    ParentFont = False
    ReadOnly = True
    TabOrder = 0
    OnClick = Edit1Click
  end
  object Edit2: TEdit
    Left = 159
    Top = 88
    Width = 122
    Height = 119
    BevelKind = bkTile
    CharCase = ecUpperCase
    Color = clBlack
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWhite
    Font.Height = -96
    Font.Name = 'MS Sans Serif'
    Font.Style = []
    ParentFont = False
    ReadOnly = True
    TabOrder = 1
    OnClick = Edit2Click
  end
  object Edit3: TEdit
    Left = 305
    Top = 87
    Width = 129
    Height = 119
    BevelKind = bkTile
    CharCase = ecUpperCase
    Color = clBlack
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWhite
    Font.Height = -96
    Font.Name = 'MS Sans Serif'
    Font.Style = []
    ParentFont = False
    ReadOnly = True
    TabOrder = 2
    OnClick = Edit3Click
  end
  object Edit4: TEdit
    Left = 19
    Top = 228
    Width = 118
    Height = 119
    BevelKind = bkTile
    CharCase = ecUpperCase
    Color = clBlack
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWhite
    Font.Height = -96
    Font.Name = 'MS Sans Serif'
    Font.Style = []
    ParentFont = False
    ReadOnly = True
    TabOrder = 3
    OnClick = Edit4Click
  end
  object Edit5: TEdit
    Left = 159
    Top = 228
    Width = 122
    Height = 119
    BevelKind = bkTile
    CharCase = ecUpperCase
    Color = clBlack
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWhite
    Font.Height = -96
    Font.Name = 'MS Sans Serif'
    Font.Style = []
    ParentFont = False
    ReadOnly = True
    TabOrder = 4
    OnClick = Edit5Click
  end
  object Edit6: TEdit
    Left = 305
    Top = 228
    Width = 129
    Height = 119
    BevelKind = bkTile
    CharCase = ecUpperCase
    Color = clBlack
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWhite
    Font.Height = -96
    Font.Name = 'MS Sans Serif'
    Font.Style = []
    ParentFont = False
    ReadOnly = True
    TabOrder = 5
    OnClick = Edit6Click
  end
  object Edit7: TEdit
    Left = 19
    Top = 369
    Width = 118
    Height = 119
    BevelKind = bkTile
    CharCase = ecUpperCase
    Color = clBlack
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWhite
    Font.Height = -96
    Font.Name = 'MS Sans Serif'
    Font.Style = []
    ParentFont = False
    ReadOnly = True
    TabOrder = 6
    OnClick = Edit7Click
  end
  object Edit8: TEdit
    Left = 159
    Top = 369
    Width = 122
    Height = 119
    BevelKind = bkTile
    CharCase = ecUpperCase
    Color = clBlack
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWhite
    Font.Height = -96
    Font.Name = 'MS Sans Serif'
    Font.Style = []
    ParentFont = False
    ReadOnly = True
    TabOrder = 7
    OnClick = Edit8Click
  end
  object Edit9: TEdit
    Left = 305
    Top = 369
    Width = 129
    Height = 119
    BevelKind = bkTile
    CharCase = ecUpperCase
    Color = clBlack
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWhite
    Font.Height = -96
    Font.Name = 'MS Sans Serif'
    Font.Style = []
    ParentFont = False
    ReadOnly = True
    TabOrder = 8
    OnClick = Edit9Click
  end
  object Edit10: TEdit
    Left = 19
    Top = 56
    Width = 121
    Height = 21
    TabOrder = 9
    Text = 'Jogador1'
  end
  object Edit11: TEdit
    Left = 312
    Top = 56
    Width = 121
    Height = 21
    TabOrder = 10
    Text = 'Jogador2'
  end
  object Timer1: TTimer
    Interval = 1
    OnTimer = Timer1Timer
    Left = 96
  end
end
