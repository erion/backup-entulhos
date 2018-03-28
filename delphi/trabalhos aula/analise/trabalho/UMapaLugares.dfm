object frmMapaLugares: TfrmMapaLugares
  Left = 222
  Top = 103
  Width = 441
  Height = 480
  Caption = 'Mapa de Lugares'
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
    Width = 433
    Height = 19
    Panels = <>
    SimplePanel = False
  end
  object Panel1: TPanel
    Left = 0
    Top = 0
    Width = 433
    Height = 434
    Align = alClient
    BevelInner = bvLowered
    TabOrder = 1
    object Label1: TLabel
      Left = 16
      Top = 36
      Width = 69
      Height = 13
      Caption = 'C'#243'd. Excurs'#227'o'
    end
    object Label2: TLabel
      Left = 310
      Top = 36
      Width = 23
      Height = 13
      Caption = 'Data'
    end
    object Label3: TLabel
      Left = 64
      Top = 66
      Width = 22
      Height = 13
      Caption = 'Guia'
    end
    object Label4: TLabel
      Left = 48
      Top = 96
      Width = 41
      Height = 13
      Caption = 'Empresa'
    end
    object Label5: TLabel
      Left = 174
      Top = 36
      Width = 48
      Height = 13
      Caption = 'N'#186' '#212'nibus'
    end
    object Edit1: TEdit
      Left = 96
      Top = 32
      Width = 65
      Height = 21
      TabOrder = 0
    end
    object Edit2: TEdit
      Left = 96
      Top = 62
      Width = 313
      Height = 21
      TabOrder = 1
    end
    object Edit3: TEdit
      Left = 96
      Top = 92
      Width = 313
      Height = 21
      TabOrder = 2
    end
    object MaskEdit1: TMaskEdit
      Left = 342
      Top = 32
      Width = 67
      Height = 21
      EditMask = '!99/99/0000;1;_'
      MaxLength = 10
      TabOrder = 3
      Text = '  /  /    '
    end
    object Edit4: TEdit
      Left = 230
      Top = 32
      Width = 65
      Height = 21
      TabOrder = 4
    end
    object DBNavigator1: TDBNavigator
      Left = 2
      Top = 407
      Width = 429
      Height = 25
      Align = alBottom
      TabOrder = 5
    end
    object Memo1: TMemo
      Left = 48
      Top = 152
      Width = 313
      Height = 193
      Lines.Strings = (
        'Ver o que colocar no lugar deste memo. N'#227'o entendi o que est'#225' '
        'no .doc!')
      TabOrder = 6
    end
  end
end
