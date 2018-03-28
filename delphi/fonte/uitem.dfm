object Form5: TForm5
  Left = 294
  Top = 253
  BorderIcons = [biSystemMenu]
  BorderStyle = bsSingle
  Caption = 
    '-----------------------------------Loja de items----------------' +
    '------------------'
  ClientHeight = 272
  ClientWidth = 522
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
  OldCreateOrder = False
  OnClose = FormClose
  OnCreate = FormCreate
  OnShow = FormShow
  PixelsPerInch = 96
  TextHeight = 13
  object Label1: TLabel
    Left = 16
    Top = 16
    Width = 30
    Height = 20
    Caption = 'PO:'
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWindowText
    Font.Height = -16
    Font.Name = 'MS Sans Serif'
    Font.Style = [fsBold]
    ParentFont = False
  end
  object Label2: TLabel
    Left = 49
    Top = 16
    Width = 55
    Height = 20
    Caption = 'Label2'
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWindowText
    Font.Height = -16
    Font.Name = 'MS Sans Serif'
    Font.Style = [fsBold]
    ParentFont = False
  end
  object Label3: TLabel
    Left = 6
    Top = 75
    Width = 65
    Height = 13
    Caption = 'Total a gastar'
  end
  object Label4: TLabel
    Left = 8
    Top = 144
    Width = 56
    Height = 13
    Caption = 'PO restante'
  end
  object GroupBox1: TGroupBox
    Left = 224
    Top = 16
    Width = 289
    Height = 241
    Caption = 'Marque o item que deseja comprar  '
    TabOrder = 0
    object CheckBox1: TCheckBox
      Left = 15
      Top = 19
      Width = 97
      Height = 17
      Caption = 'Elmo de metal'
      TabOrder = 0
      OnClick = CheckBox1Click
    end
    object CheckBox2: TCheckBox
      Left = 15
      Top = 41
      Width = 97
      Height = 17
      Caption = 'Elmo de bronze'
      TabOrder = 1
      OnClick = CheckBox2Click
    end
    object CheckBox3: TCheckBox
      Left = 15
      Top = 63
      Width = 97
      Height = 17
      Caption = 'Elmo de prata'
      TabOrder = 2
      OnClick = CheckBox3Click
    end
    object CheckBox4: TCheckBox
      Left = 15
      Top = 85
      Width = 97
      Height = 17
      Caption = 'Elmo de ouro'
      TabOrder = 3
      OnClick = CheckBox4Click
    end
    object CheckBox5: TCheckBox
      Left = 15
      Top = 107
      Width = 97
      Height = 17
      Caption = 'Espada longa'
      TabOrder = 4
      OnClick = CheckBox5Click
    end
    object CheckBox6: TCheckBox
      Left = 15
      Top = 130
      Width = 104
      Height = 17
      Caption = 'Espada bastarda'
      TabOrder = 5
      OnClick = CheckBox6Click
    end
    object CheckBox7: TCheckBox
      Left = 15
      Top = 152
      Width = 97
      Height = 17
      Caption = 'Cimitarra'
      TabOrder = 6
      OnClick = CheckBox7Click
    end
    object CheckBox8: TCheckBox
      Left = 15
      Top = 174
      Width = 116
      Height = 17
      Caption = 'Machado Pequeno'
      TabOrder = 7
      OnClick = CheckBox8Click
    end
    object CheckBox9: TCheckBox
      Left = 15
      Top = 196
      Width = 111
      Height = 17
      Caption = 'Machado Grande'
      TabOrder = 8
      OnClick = CheckBox9Click
    end
    object CheckBox10: TCheckBox
      Left = 15
      Top = 219
      Width = 97
      Height = 17
      Caption = 'Arco Curto'
      TabOrder = 9
      OnClick = CheckBox10Click
    end
    object CheckBox11: TCheckBox
      Left = 156
      Top = 14
      Width = 97
      Height = 17
      Caption = 'Arco Longo'
      TabOrder = 10
      OnClick = CheckBox11Click
    end
    object CheckBox12: TCheckBox
      Left = 156
      Top = 37
      Width = 122
      Height = 17
      Caption = 'Pequeno de Madeira'
      TabOrder = 11
      OnClick = CheckBox12Click
    end
    object CheckBox13: TCheckBox
      Left = 156
      Top = 60
      Width = 109
      Height = 17
      Caption = 'Pequeno de Ferro'
      TabOrder = 12
      OnClick = CheckBox13Click
    end
    object CheckBox14: TCheckBox
      Left = 156
      Top = 83
      Width = 115
      Height = 17
      Caption = 'Grande de Madeira'
      TabOrder = 13
      OnClick = CheckBox14Click
    end
    object CheckBox15: TCheckBox
      Left = 156
      Top = 106
      Width = 102
      Height = 17
      Caption = 'Grande de Ferro'
      TabOrder = 14
      OnClick = CheckBox15Click
    end
    object CheckBox16: TCheckBox
      Left = 156
      Top = 129
      Width = 120
      Height = 17
      Caption = 'Escamas de Drag'#227'o'
      TabOrder = 15
      OnClick = CheckBox16Click
    end
    object CheckBox17: TCheckBox
      Left = 156
      Top = 152
      Width = 97
      Height = 17
      Caption = 'Couro '
      TabOrder = 16
      OnClick = CheckBox17Click
    end
    object CheckBox18: TCheckBox
      Left = 156
      Top = 175
      Width = 97
      Height = 17
      Caption = 'Couro Batido'
      TabOrder = 17
      OnClick = CheckBox18Click
    end
    object CheckBox19: TCheckBox
      Left = 156
      Top = 198
      Width = 131
      Height = 17
      Caption = 'Armadura de Correntes'
      TabOrder = 18
      OnClick = CheckBox19Click
    end
    object CheckBox20: TCheckBox
      Left = 156
      Top = 222
      Width = 122
      Height = 17
      Caption = 'Armadura de Guerra'
      TabOrder = 19
      OnClick = CheckBox20Click
    end
  end
  object Edit1: TEdit
    Left = 77
    Top = 72
    Width = 71
    Height = 21
    TabOrder = 1
  end
  object Edit2: TEdit
    Left = 77
    Top = 140
    Width = 70
    Height = 21
    TabOrder = 2
  end
  object Button1: TButton
    Left = 72
    Top = 216
    Width = 75
    Height = 25
    Caption = 'Comprar'
    TabOrder = 3
    OnClick = Button1Click
  end
end
