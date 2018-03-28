object frmSimplex: TfrmSimplex
  Left = 202
  Top = 149
  Width = 696
  Height = 480
  Caption = 'Otimiza'#231#227'o Simplex'
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'MS Sans Serif'
  Font.Style = []
  OldCreateOrder = False
  PixelsPerInch = 96
  TextHeight = 13
  object StatusBar1: TStatusBar
    Left = 0
    Top = 434
    Width = 688
    Height = 19
    Panels = <>
    SimplePanel = False
  end
  object Panel1: TPanel
    Left = 0
    Top = 0
    Width = 688
    Height = 434
    Align = alClient
    BevelInner = bvLowered
    TabOrder = 1
    object Label1: TLabel
      Left = 28
      Top = 76
      Width = 90
      Height = 13
      Caption = 'Fun'#231#227'o Objetivo ->'
    end
    object Button1: TButton
      Left = 176
      Top = 24
      Width = 121
      Height = 25
      Caption = 'Adicionar Vari'#225'vel'
      TabOrder = 0
    end
    object Edit1: TEdit
      Left = 128
      Top = 72
      Width = 33
      Height = 21
      TabOrder = 1
    end
    object Edit2: TEdit
      Left = 165
      Top = 72
      Width = 33
      Height = 21
      TabOrder = 2
    end
  end
end
