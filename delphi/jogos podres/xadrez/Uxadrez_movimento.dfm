object Form2: TForm2
  Left = 369
  Top = 197
  BorderStyle = bsDialog
  Caption = 'Movimento'
  ClientHeight = 280
  ClientWidth = 336
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'MS Sans Serif'
  Font.Style = []
  OldCreateOrder = False
  Position = poDefault
  PixelsPerInch = 96
  TextHeight = 13
  object RadioGroup1: TRadioGroup
    Left = 15
    Top = 10
    Width = 145
    Height = 127
    Caption = '  Movimentar na vertical  '
    Columns = 2
    Items.Strings = (
      '1'
      '2'
      '3'
      '4'
      '5'
      '6'
      '7'
      '8')
    TabOrder = 0
  end
  object RadioGroup2: TRadioGroup
    Left = 175
    Top = 11
    Width = 145
    Height = 127
    Caption = '  Movimentar na horizontal  '
    Columns = 2
    Items.Strings = (
      '1'
      '2'
      '3'
      '4'
      '5'
      '6'
      '7'
      '8')
    TabOrder = 1
  end
  object Memo1: TMemo
    Left = 16
    Top = 208
    Width = 305
    Height = 33
    Lines.Strings = (
      'Observa'#231#227'o: Se voc'#234' deseja andar na diagonal, coloque o '
      'mesmo valor para o lado e para frente!')
    ReadOnly = True
    TabOrder = 2
  end
  object RadioGroup3: TRadioGroup
    Left = 176
    Top = 144
    Width = 145
    Height = 57
    Caption = '  Dire'#231#227'o movimento  '
    Columns = 2
    Items.Strings = (
      'Esquerda'
      'Direita')
    TabOrder = 3
  end
  object RadioGroup4: TRadioGroup
    Left = 16
    Top = 144
    Width = 145
    Height = 57
    Caption = '  Dire'#231#227'o movimento  '
    Columns = 2
    Items.Strings = (
      'Cima'
      'Baixo')
    TabOrder = 4
  end
  object Button1: TButton
    Left = 128
    Top = 248
    Width = 75
    Height = 25
    Caption = 'OK'
    TabOrder = 5
    OnClick = Button1Click
  end
end
