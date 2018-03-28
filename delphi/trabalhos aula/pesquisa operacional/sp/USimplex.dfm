object frmSimplex: TfrmSimplex
  Left = 193
  Top = 103
  Width = 695
  Height = 480
  Caption = 'Otimiza'#231#227'o Simplex'
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'MS Sans Serif'
  Font.Style = []
  OldCreateOrder = False
  OnShow = FormShow
  PixelsPerInch = 96
  TextHeight = 13
  object StatusBar1: TStatusBar
    Left = 0
    Top = 434
    Width = 687
    Height = 19
    Panels = <>
    SimplePanel = False
  end
  object Panel1: TPanel
    Left = 0
    Top = 0
    Width = 687
    Height = 434
    Align = alClient
    BevelInner = bvLowered
    TabOrder = 1
    object Label1: TLabel
      Left = 24
      Top = 76
      Width = 109
      Height = 13
      Caption = 'Fun'#231#227'o Objetivo ->'
      Font.Charset = DEFAULT_CHARSET
      Font.Color = clWindowText
      Font.Height = -11
      Font.Name = 'MS Sans Serif'
      Font.Style = [fsBold]
      ParentFont = False
    end
    object Label2: TLabel
      Left = 155
      Top = 136
      Width = 16
      Height = 13
      Caption = ' X1'
    end
    object Label3: TLabel
      Left = 40
      Top = 140
      Width = 65
      Height = 13
      Caption = 'Restri'#231#245'es:'
      Font.Charset = DEFAULT_CHARSET
      Font.Color = clRed
      Font.Height = -11
      Font.Name = 'MS Sans Serif'
      Font.Style = [fsBold]
      ParentFont = False
    end
    object Label4: TLabel
      Left = 182
      Top = 136
      Width = 16
      Height = 13
      Caption = ' X2'
    end
    object Label5: TLabel
      Left = 210
      Top = 136
      Width = 13
      Height = 13
      Caption = 'X3'
    end
    object Label6: TLabel
      Left = 235
      Top = 136
      Width = 13
      Height = 13
      Caption = 'X4'
    end
    object Label7: TLabel
      Left = 260
      Top = 136
      Width = 21
      Height = 13
      Caption = 'Tipo'
    end
    object Label8: TLabel
      Left = 301
      Top = 136
      Width = 24
      Height = 13
      Caption = 'Total'
    end
    object Button1: TButton
      Left = 248
      Top = 32
      Width = 105
      Height = 25
      Caption = 'Calcular Otimiza'#231#227'o'
      TabOrder = 4
    end
    object Edit4: TEdit
      Left = 216
      Top = 72
      Width = 23
      Height = 21
      TabOrder = 3
    end
    object Edit3: TEdit
      Left = 190
      Top = 72
      Width = 23
      Height = 21
      TabOrder = 2
    end
    object Edit2: TEdit
      Left = 164
      Top = 72
      Width = 23
      Height = 21
      TabOrder = 1
    end
    object Edit1: TEdit
      Left = 139
      Top = 72
      Width = 23
      Height = 21
      TabOrder = 0
    end
    object Edit5: TEdit
      Left = 154
      Top = 152
      Width = 23
      Height = 21
      TabOrder = 5
    end
    object Edit6: TEdit
      Left = 179
      Top = 152
      Width = 23
      Height = 21
      TabOrder = 6
    end
    object Edit7: TEdit
      Left = 204
      Top = 152
      Width = 23
      Height = 21
      TabOrder = 7
    end
    object Edit8: TEdit
      Left = 229
      Top = 152
      Width = 23
      Height = 21
      TabOrder = 8
    end
    object ComboBox1: TComboBox
      Left = 255
      Top = 152
      Width = 39
      Height = 21
      ItemHeight = 13
      TabOrder = 9
      Items.Strings = (
        '>='
        '<=')
    end
    object Edit21: TEdit
      Left = 297
      Top = 152
      Width = 33
      Height = 21
      TabOrder = 10
    end
    object Edit22: TEdit
      Left = 297
      Top = 176
      Width = 33
      Height = 21
      TabOrder = 11
    end
    object Edit23: TEdit
      Left = 297
      Top = 200
      Width = 33
      Height = 21
      TabOrder = 12
    end
    object Edit24: TEdit
      Left = 297
      Top = 224
      Width = 33
      Height = 21
      TabOrder = 13
    end
    object ComboBox4: TComboBox
      Left = 255
      Top = 224
      Width = 39
      Height = 21
      ItemHeight = 13
      TabOrder = 14
      Items.Strings = (
        '>='
        '<=')
    end
    object ComboBox3: TComboBox
      Left = 255
      Top = 200
      Width = 39
      Height = 21
      ItemHeight = 13
      TabOrder = 15
      Items.Strings = (
        '>='
        '<=')
    end
    object ComboBox2: TComboBox
      Left = 255
      Top = 176
      Width = 39
      Height = 21
      ItemHeight = 13
      TabOrder = 16
      Items.Strings = (
        '>='
        '<=')
    end
    object Edit11: TEdit
      Left = 204
      Top = 176
      Width = 23
      Height = 21
      TabOrder = 17
    end
    object Edit12: TEdit
      Left = 229
      Top = 176
      Width = 23
      Height = 21
      TabOrder = 18
    end
    object Edit16: TEdit
      Left = 229
      Top = 200
      Width = 23
      Height = 21
      TabOrder = 19
    end
    object Edit20: TEdit
      Left = 229
      Top = 224
      Width = 23
      Height = 21
      TabOrder = 20
    end
    object Edit19: TEdit
      Left = 204
      Top = 224
      Width = 23
      Height = 21
      TabOrder = 21
    end
    object Edit15: TEdit
      Left = 204
      Top = 200
      Width = 23
      Height = 21
      TabOrder = 22
    end
    object Edit10: TEdit
      Left = 179
      Top = 176
      Width = 23
      Height = 21
      TabOrder = 23
    end
    object Edit14: TEdit
      Left = 179
      Top = 200
      Width = 23
      Height = 21
      TabOrder = 24
    end
    object Edit18: TEdit
      Left = 179
      Top = 224
      Width = 23
      Height = 21
      TabOrder = 25
    end
    object Edit17: TEdit
      Left = 154
      Top = 224
      Width = 23
      Height = 21
      TabOrder = 26
    end
    object Edit13: TEdit
      Left = 154
      Top = 200
      Width = 23
      Height = 21
      TabOrder = 27
    end
    object Edit9: TEdit
      Left = 154
      Top = 176
      Width = 23
      Height = 21
      TabOrder = 28
    end
    object Button2: TButton
      Left = 136
      Top = 32
      Width = 105
      Height = 25
      Caption = 'Adicionar Vari'#225'vel'
      TabOrder = 29
      OnClick = Button2Click
    end
    object ComboBox5: TComboBox
      Left = 255
      Top = 107
      Width = 75
      Height = 21
      ItemHeight = 13
      TabOrder = 30
      OnSelect = ComboBox5Select
      Items.Strings = (
        'Todas >='
        'Todas <=')
    end
    object CheckBox1: TCheckBox
      Left = 13
      Top = 202
      Width = 133
      Height = 17
      Alignment = taLeftJustify
      Caption = 'Ativar linha de restri'#231#227'o'
      TabOrder = 31
      OnClick = CheckBox1Click
    end
    object CheckBox2: TCheckBox
      Left = 13
      Top = 226
      Width = 133
      Height = 17
      Alignment = taLeftJustify
      BiDiMode = bdLeftToRight
      Caption = 'Ativar linha de restri'#231#227'o'
      ParentBiDiMode = False
      TabOrder = 32
      OnClick = CheckBox2Click
    end
    object Button3: TButton
      Left = 26
      Top = 163
      Width = 105
      Height = 25
      Caption = 'Adicionar Restri'#231#227'o'
      TabOrder = 33
      OnClick = Button3Click
    end
  end
end
