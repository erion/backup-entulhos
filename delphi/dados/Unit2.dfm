object Form2: TForm2
  Left = 316
  Top = 308
  BorderIcons = []
  BorderStyle = bsNone
  Caption = 'Form2'
  ClientHeight = 128
  ClientWidth = 429
  Color = clBtnFace
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
    Left = 32
    Top = 8
    Width = 376
    Height = 55
    Caption = 'Jogar novamente?'
    Font.Charset = ANSI_CHARSET
    Font.Color = clWindowText
    Font.Height = -48
    Font.Name = 'Times New Roman'
    Font.Style = [fsBold]
    ParentFont = False
  end
  object Button1: TButton
    Left = 112
    Top = 80
    Width = 75
    Height = 25
    Caption = 'Sim'
    TabOrder = 0
    OnClick = Button1Click
  end
  object Button2: TButton
    Left = 248
    Top = 80
    Width = 75
    Height = 25
    Caption = 'N'#227'o'
    TabOrder = 1
    OnClick = Button2Click
  end
end
