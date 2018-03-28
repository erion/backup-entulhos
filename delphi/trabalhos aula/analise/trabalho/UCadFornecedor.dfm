object frmCadastroFornecedor: TfrmCadastroFornecedor
  Left = 192
  Top = 110
  Width = 509
  Height = 480
  Caption = 'Cadastro de Fornecedores'
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
    Width = 501
    Height = 19
    Panels = <>
    SimplePanel = False
  end
  object Panel1: TPanel
    Left = 0
    Top = 0
    Width = 501
    Height = 434
    Align = alClient
    BevelInner = bvLowered
    TabOrder = 1
    object Label1: TLabel
      Left = 23
      Top = 32
      Width = 28
      Height = 13
      Caption = 'Nome'
    end
    object Label2: TLabel
      Left = 340
      Top = 32
      Width = 20
      Height = 13
      Caption = 'CPF'
    end
    object Label3: TLabel
      Left = 5
      Top = 62
      Width = 46
      Height = 13
      Caption = 'Endere'#231'o'
    end
    object Label4: TLabel
      Left = 24
      Top = 92
      Width = 27
      Height = 13
      Caption = 'Bairro'
    end
    object Label5: TLabel
      Left = 329
      Top = 62
      Width = 33
      Height = 13
      Caption = 'Cidade'
    end
    object Label6: TLabel
      Left = 212
      Top = 92
      Width = 14
      Height = 13
      Caption = 'UF'
    end
    object Label7: TLabel
      Left = 22
      Top = 123
      Width = 29
      Height = 13
      Caption = 'Fones'
    end
    object Label8: TLabel
      Left = 22
      Top = 152
      Width = 91
      Height = 13
      Caption = 'Servi'#231'os Prestados'
    end
    object Edit1: TEdit
      Left = 56
      Top = 28
      Width = 273
      Height = 21
      TabOrder = 0
    end
    object Edit2: TEdit
      Left = 368
      Top = 28
      Width = 121
      Height = 21
      TabOrder = 1
    end
    object Edit3: TEdit
      Left = 56
      Top = 58
      Width = 269
      Height = 21
      TabOrder = 2
    end
    object Edit4: TEdit
      Left = 367
      Top = 58
      Width = 122
      Height = 21
      TabOrder = 3
    end
    object Edit5: TEdit
      Left = 56
      Top = 88
      Width = 149
      Height = 21
      TabOrder = 4
    end
    object Edit7: TEdit
      Left = 56
      Top = 119
      Width = 121
      Height = 21
      TabOrder = 5
    end
    object Edit8: TEdit
      Left = 184
      Top = 120
      Width = 121
      Height = 21
      TabOrder = 6
    end
    object Edit9: TEdit
      Left = 312
      Top = 120
      Width = 121
      Height = 21
      TabOrder = 7
    end
    object ComboBox1: TComboBox
      Left = 232
      Top = 88
      Width = 49
      Height = 21
      ItemHeight = 13
      TabOrder = 8
    end
    object DBNavigator1: TDBNavigator
      Left = 2
      Top = 407
      Width = 497
      Height = 25
      Align = alBottom
      Flat = True
      TabOrder = 9
    end
    object TDBMemo
      Left = 20
      Top = 168
      Width = 468
      Height = 87
      TabOrder = 10
    end
    object GroupBox1: TGroupBox
      Left = 20
      Top = 264
      Width = 469
      Height = 126
      Caption = '  Empresas Representadas  '
      TabOrder = 11
      object DBGrid1: TDBGrid
        Left = 9
        Top = 21
        Width = 448
        Height = 95
        TabOrder = 0
        TitleFont.Charset = DEFAULT_CHARSET
        TitleFont.Color = clWindowText
        TitleFont.Height = -11
        TitleFont.Name = 'MS Sans Serif'
        TitleFont.Style = []
        Columns = <
          item
            Expanded = False
            Title.Caption = 'Nome'
            Width = 175
            Visible = True
          end
          item
            Expanded = False
            Title.Caption = 'Servi'#231'o'
            Width = 255
            Visible = True
          end>
      end
    end
  end
end
