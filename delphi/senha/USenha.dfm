object Form1: TForm1
  Left = 192
  Top = 114
  Width = 696
  Height = 480
  Caption = 'Form1'
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'MS Sans Serif'
  Font.Style = []
  OldCreateOrder = False
  PixelsPerInch = 96
  TextHeight = 13
  object Edit1: TEdit
    Left = 244
    Top = 80
    Width = 121
    Height = 21
    TabOrder = 0
    Text = 'Edit1'
  end
  object Timer1: TTimer
    Interval = 9000
    OnTimer = Timer1Timer
    Left = 156
    Top = 20
  end
end
