object Form1: TForm1
  Left = 354
  Top = 149
  BorderIcons = [biSystemMenu, biMinimize]
  BorderStyle = bsSingle
  Caption = 'Cria'#231#227'o do Personagem'
  ClientHeight = 426
  ClientWidth = 259
  Color = clBtnFace
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
    0000000000000000000000000000FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
    FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
    FFFFFFFFFFFFFFFFFFFFFFFFFFFF280000002000000040000000010004000000
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
  Menu = MainMenu1
  OldCreateOrder = False
  Position = poMainFormCenter
  PixelsPerInch = 96
  TextHeight = 13
  object Label1: TLabel
    Left = 40
    Top = 24
    Width = 27
    Height = 13
    Caption = 'For'#231'a'
  end
  object Label2: TLabel
    Left = 40
    Top = 56
    Width = 42
    Height = 13
    Caption = 'Destreza'
  end
  object Label3: TLabel
    Left = 40
    Top = 88
    Width = 53
    Height = 13
    Caption = 'Contitui'#231#227'o'
  end
  object Label4: TLabel
    Left = 48
    Top = 232
    Width = 168
    Height = 20
    Caption = 'Equipamento Inicial'
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWindowText
    Font.Height = -16
    Font.Name = 'MS Sans Serif'
    Font.Style = [fsBold, fsItalic]
    ParentFont = False
  end
  object Label5: TLabel
    Left = 16
    Top = 387
    Width = 233
    Height = 24
    Caption = 'Pode come'#231'ar... Boa sorte!!'
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWindowText
    Font.Height = -19
    Font.Name = 'MS Sans Serif'
    Font.Style = []
    ParentFont = False
    Visible = False
  end
  object Edit1: TEdit
    Left = 104
    Top = 19
    Width = 32
    Height = 21
    ReadOnly = True
    TabOrder = 0
    Text = '0'
  end
  object Edit2: TEdit
    Left = 104
    Top = 53
    Width = 32
    Height = 21
    ReadOnly = True
    TabOrder = 1
    Text = '0'
  end
  object Edit3: TEdit
    Left = 103
    Top = 84
    Width = 32
    Height = 21
    ReadOnly = True
    TabOrder = 2
    Text = '0'
  end
  object Button1: TButton
    Left = 156
    Top = 17
    Width = 75
    Height = 25
    Caption = 'Rolar'
    Enabled = False
    TabOrder = 3
    OnClick = Button1Click
  end
  object Button2: TButton
    Left = 156
    Top = 50
    Width = 75
    Height = 25
    Caption = 'Rolar'
    Enabled = False
    TabOrder = 4
    OnClick = Button2Click
  end
  object Button3: TButton
    Left = 156
    Top = 82
    Width = 75
    Height = 25
    Caption = 'Rolar'
    Enabled = False
    TabOrder = 5
    OnClick = Button3Click
  end
  object RadioGroup1: TRadioGroup
    Left = 84
    Top = 123
    Width = 97
    Height = 97
    Caption = 'Classe'
    Enabled = False
    Items.Strings = (
      'Guerreiro'
      'Ladr'#227'o'
      'Ranger'
      'B'#225'rbaro')
    TabOrder = 6
    OnClick = RadioGroup1Click
  end
  object ComboBox1: TComboBox
    Left = 58
    Top = 271
    Width = 145
    Height = 21
    Enabled = False
    ItemHeight = 13
    TabOrder = 7
    Text = 'Elmo'
    OnChange = ComboBox1Change
    Items.Strings = (
      'Elmo de metal'
      'Elmo de Bronze'
      'Elmo de Prata'
      'Elmo de Ouro')
  end
  object ComboBox2: TComboBox
    Left = 58
    Top = 301
    Width = 145
    Height = 21
    Enabled = False
    ItemHeight = 13
    TabOrder = 8
    Text = 'Arma'
    OnChange = ComboBox2Change
    Items.Strings = (
      'Espada Longa'
      'Espada Bastarda'
      'Cimitarra'
      'Machado Pequeno'
      'Machado Grande'
      'Arco Curto'
      'Arco Longo')
  end
  object ComboBox3: TComboBox
    Left = 58
    Top = 329
    Width = 145
    Height = 21
    Enabled = False
    ItemHeight = 13
    TabOrder = 9
    Text = 'Escudo'
    OnChange = ComboBox3Change
    Items.Strings = (
      'Pequeno de Madeira'
      'Pequeno de Ferro'
      'Grande de Madeira'
      'Grande de Ferro'
      'Escamas de Drag'#227'o')
  end
  object ComboBox4: TComboBox
    Left = 58
    Top = 357
    Width = 145
    Height = 21
    Enabled = False
    ItemHeight = 13
    TabOrder = 10
    Text = 'Armadura'
    OnChange = ComboBox4Change
    Items.Strings = (
      'Couro '
      'Couro Batido'
      'Armadura de Correntes'
      'Armadura de Guerra')
  end
  object Button4: TButton
    Left = 88
    Top = 392
    Width = 75
    Height = 25
    Caption = 'Pronto'
    Enabled = False
    TabOrder = 11
    OnClick = Button4Click
  end
  object MainMenu1: TMainMenu
    Left = 16
    Top = 184
    object Jogo1: TMenuItem
      Caption = 'Jogo'
      object RolarValores1: TMenuItem
        Caption = 'Rolar Valores'
        OnClick = RolarValores1Click
      end
      object Iniciar1: TMenuItem
        Caption = 'Iniciar'
        Enabled = False
        OnClick = Iniciar1Click
      end
      object Sair1: TMenuItem
        Caption = 'Sair'
        OnClick = Sair1Click
      end
    end
    object Ajuda1: TMenuItem
      Caption = 'Ajuda'
      OnClick = Ajuda1Click
    end
  end
  object Timer1: TTimer
    Interval = 1
    OnTimer = Timer1Timer
    Left = 200
    Top = 128
  end
  object Timer2: TTimer
    OnTimer = Timer2Timer
    Left = 200
    Top = 156
  end
  object Timer3: TTimer
    OnTimer = Timer3Timer
    Left = 200
    Top = 184
  end
end
