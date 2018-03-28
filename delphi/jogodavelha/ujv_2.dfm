object Form2: TForm2
  Left = 309
  Top = 271
  BorderStyle = bsNone
  Caption = 'Form2'
  ClientHeight = 159
  ClientWidth = 552
  Color = clBlack
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'MS Sans Serif'
  Font.Style = []
  OldCreateOrder = False
  Position = poMainFormCenter
  PixelsPerInch = 96
  TextHeight = 13
  object Label1: TLabel
    Left = 48
    Top = 0
    Width = 101
    Height = 41
    Caption = 'Label1'
    Font.Charset = ANSI_CHARSET
    Font.Color = clWhite
    Font.Height = -35
    Font.Name = 'Times New Roman'
    Font.Style = [fsBold, fsItalic]
    ParentFont = False
  end
  object Label2: TLabel
    Left = 174
    Top = 61
    Width = 216
    Height = 31
    Caption = 'Jogar Novamente?'
    Font.Charset = ANSI_CHARSET
    Font.Color = clWhite
    Font.Height = -27
    Font.Name = 'Times New Roman'
    Font.Style = [fsBold, fsItalic]
    ParentFont = False
  end
  object Button1: TButton
    Left = 174
    Top = 117
    Width = 75
    Height = 25
    Caption = 'Sim'
    TabOrder = 0
    OnClick = Button1Click
  end
  object Button2: TButton
    Left = 310
    Top = 117
    Width = 75
    Height = 25
    Caption = 'N'#227'o'
    TabOrder = 1
    OnClick = Button2Click
  end
end
