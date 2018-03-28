object frmCadastroCliente: TfrmCadastroCliente
  Left = 196
  Top = 135
  Width = 696
  Height = 480
  Caption = 'Cadastro de Clientes'
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'MS Sans Serif'
  Font.Style = []
  OldCreateOrder = False
  PixelsPerInch = 96
  TextHeight = 13
  object Panel1: TPanel
    Left = 0
    Top = 0
    Width = 688
    Height = 434
    Align = alClient
    BevelInner = bvLowered
    TabOrder = 0
    object Label1: TLabel
      Left = 35
      Top = 28
      Width = 28
      Height = 13
      Caption = 'Nome'
    end
    object Label2: TLabel
      Left = 383
      Top = 28
      Width = 20
      Height = 13
      Caption = 'CPF'
    end
    object Label3: TLabel
      Left = 531
      Top = 28
      Width = 16
      Height = 13
      Caption = 'RG'
    end
    object Label4: TLabel
      Left = 10
      Top = 56
      Width = 53
      Height = 13
      Caption = 'Passaporte'
    end
    object Label5: TLabel
      Left = 290
      Top = 84
      Width = 46
      Height = 13
      Caption = 'Endere'#231'o'
    end
    object Label6: TLabel
      Left = 36
      Top = 112
      Width = 27
      Height = 13
      Caption = 'Bairro'
    end
    object Label7: TLabel
      Left = 30
      Top = 84
      Width = 33
      Height = 13
      Caption = 'Cidade'
    end
    object Label8: TLabel
      Left = 200
      Top = 84
      Width = 14
      Height = 13
      Caption = 'UF'
    end
    object Label9: TLabel
      Left = 524
      Top = 56
      Width = 24
      Height = 13
      Caption = 'Fone'
    end
    object Label10: TLabel
      Left = 226
      Top = 56
      Width = 82
      Height = 13
      Caption = 'Data Nascimento'
    end
    object Label11: TLabel
      Left = 396
      Top = 56
      Width = 24
      Height = 13
      Caption = 'Sexo'
    end
    object Label12: TLabel
      Left = 240
      Top = 112
      Width = 60
      Height = 13
      Caption = 'Naturalidade'
    end
    object Label13: TLabel
      Left = 471
      Top = 112
      Width = 68
      Height = 13
      Caption = 'Nacionalidade'
    end
    object Label14: TLabel
      Left = 17
      Top = 140
      Width = 46
      Height = 13
      Caption = 'Vendedor'
    end
    object DBNavigator1: TDBNavigator
      Left = 2
      Top = 407
      Width = 684
      Height = 25
      Align = alBottom
      Flat = True
      TabOrder = 0
    end
    object Edit1: TEdit
      Left = 71
      Top = 24
      Width = 301
      Height = 21
      TabOrder = 1
    end
    object Edit2: TEdit
      Left = 409
      Top = 24
      Width = 111
      Height = 21
      TabOrder = 2
    end
    object Edit3: TEdit
      Left = 556
      Top = 24
      Width = 121
      Height = 21
      TabOrder = 3
    end
    object Edit4: TEdit
      Left = 71
      Top = 52
      Width = 146
      Height = 21
      TabOrder = 4
    end
    object MaskEdit1: TMaskEdit
      Left = 314
      Top = 52
      Width = 68
      Height = 21
      EditMask = '!99/99/0000;1;_'
      MaxLength = 10
      TabOrder = 5
      Text = '  /  /    '
    end
    object Edit5: TEdit
      Left = 556
      Top = 52
      Width = 121
      Height = 21
      TabOrder = 6
    end
    object Edit6: TEdit
      Left = 343
      Top = 80
      Width = 334
      Height = 21
      TabOrder = 7
    end
    object Edit7: TEdit
      Left = 71
      Top = 80
      Width = 121
      Height = 21
      TabOrder = 8
    end
    object ComboBox1: TComboBox
      Left = 224
      Top = 80
      Width = 55
      Height = 21
      ItemHeight = 13
      TabOrder = 9
    end
    object Edit8: TEdit
      Left = 71
      Top = 108
      Width = 158
      Height = 21
      TabOrder = 10
    end
    object ComboBox2: TComboBox
      Left = 426
      Top = 52
      Width = 55
      Height = 21
      ItemHeight = 13
      TabOrder = 11
    end
    object Edit9: TEdit
      Left = 305
      Top = 108
      Width = 156
      Height = 21
      TabOrder = 12
    end
    object Edit10: TEdit
      Left = 546
      Top = 108
      Width = 131
      Height = 21
      TabOrder = 13
    end
    object ComboBox3: TComboBox
      Left = 71
      Top = 136
      Width = 354
      Height = 21
      ItemHeight = 13
      TabOrder = 14
    end
    object GroupBox1: TGroupBox
      Left = 14
      Top = 164
      Width = 662
      Height = 96
      Caption = '  Dados Proficionais  '
      TabOrder = 15
      object Label15: TLabel
        Left = 20
        Top = 32
        Width = 41
        Height = 13
        Caption = 'Empresa'
      end
      object Label16: TLabel
        Left = 300
        Top = 32
        Width = 46
        Height = 13
        Caption = 'Endere'#231'o'
      end
      object Label17: TLabel
        Left = 284
        Top = 60
        Width = 27
        Height = 13
        Caption = 'Bairro'
      end
      object Label18: TLabel
        Left = 28
        Top = 60
        Width = 33
        Height = 13
        Caption = 'Cidade'
      end
      object Label19: TLabel
        Left = 560
        Top = 60
        Width = 14
        Height = 13
        Caption = 'UF'
      end
      object Edit11: TEdit
        Left = 68
        Top = 28
        Width = 225
        Height = 21
        TabOrder = 0
      end
      object Edit12: TEdit
        Left = 352
        Top = 28
        Width = 285
        Height = 21
        TabOrder = 1
      end
      object Edit13: TEdit
        Left = 320
        Top = 56
        Width = 233
        Height = 21
        TabOrder = 2
      end
      object Edit14: TEdit
        Left = 68
        Top = 56
        Width = 210
        Height = 21
        TabOrder = 3
      end
    end
    object ComboBox4: TComboBox
      Left = 598
      Top = 228
      Width = 55
      Height = 21
      ItemHeight = 13
      TabOrder = 16
    end
    object DBGrid1: TDBGrid
      Left = 16
      Top = 272
      Width = 657
      Height = 120
      TabOrder = 17
      TitleFont.Charset = DEFAULT_CHARSET
      TitleFont.Color = clWindowText
      TitleFont.Height = -11
      TitleFont.Name = 'MS Sans Serif'
      TitleFont.Style = []
      Columns = <
        item
          Expanded = False
          Title.Caption = 'Data da Compra'
          Width = 93
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'Compra'
          Width = 266
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'Nota Fiscal'
          Width = 81
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'Valor da Compra'
          Width = 198
          Visible = True
        end>
    end
  end
  object StatusBar1: TStatusBar
    Left = 0
    Top = 434
    Width = 688
    Height = 19
    Panels = <>
    SimplePanel = False
  end
end
