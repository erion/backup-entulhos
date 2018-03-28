object Form2: TForm2
  Left = 233
  Top = 162
  Width = 423
  Height = 336
  Caption = 'Fonte'
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'MS Sans Serif'
  Font.Style = []
  OldCreateOrder = False
  PixelsPerInch = 96
  TextHeight = 13
  object Label1: TLabel
    Left = 11
    Top = 8
    Width = 30
    Height = 13
    Caption = 'Fonte:'
  end
  object Label2: TLabel
    Left = 140
    Top = 8
    Width = 73
    Height = 13
    Caption = 'Estilo da Fonte:'
  end
  object Label3: TLabel
    Left = 266
    Top = 8
    Width = 48
    Height = 13
    Caption = 'Tamanho:'
  end
  object Label4: TLabel
    Left = 113
    Top = 257
    Width = 30
    Height = 13
    Caption = 'Script:'
  end
  object ListBox1: TListBox
    Left = 267
    Top = 48
    Width = 57
    Height = 97
    ItemHeight = 13
    Items.Strings = (
      '8'
      '10'
      '11'
      '12'
      '14'
      '16'
      '18'
      '20'
      '22'
      '24'
      '26'
      '28'
      '36'
      '48'
      '72')
    TabOrder = 0
  end
  object ListBox2: TListBox
    Left = 137
    Top = 48
    Width = 121
    Height = 97
    ItemHeight = 13
    Items.Strings = (
      'Normal'
      'It'#225'lico'
      'Negrito'
      'Negrito e it'#225'lico')
    TabOrder = 1
  end
  object ListBox3: TListBox
    Left = 8
    Top = 48
    Width = 121
    Height = 97
    ItemHeight = 13
    TabOrder = 2
  end
  object Button1: TButton
    Left = 336
    Top = 27
    Width = 75
    Height = 25
    Caption = 'OK'
    TabOrder = 3
  end
  object Button2: TButton
    Left = 336
    Top = 59
    Width = 75
    Height = 25
    Caption = 'Cancelar'
    TabOrder = 4
  end
  object Edit1: TEdit
    Left = 8
    Top = 27
    Width = 121
    Height = 21
    TabOrder = 5
  end
  object Edit2: TEdit
    Left = 137
    Top = 27
    Width = 121
    Height = 21
    TabOrder = 6
  end
  object Edit3: TEdit
    Left = 267
    Top = 27
    Width = 56
    Height = 21
    TabOrder = 7
  end
  object GroupBox1: TGroupBox
    Left = 113
    Top = 155
    Width = 185
    Height = 97
    Caption = ' Exemplo '
    TabOrder = 8
    object Edit4: TEdit
      Left = 32
      Top = 29
      Width = 121
      Height = 41
      Color = cl3DLight
      TabOrder = 0
      Text = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNn'
    end
  end
  object ComboBox1: TComboBox
    Left = 113
    Top = 273
    Width = 145
    Height = 21
    ItemHeight = 13
    TabOrder = 9
    Text = 'ComboBox1'
    Items.Strings = (
      'Ocidental'
      'Grego'
      'Turco'
      'Centrto-europeu'
      'Cir'#237'lico')
  end
end
