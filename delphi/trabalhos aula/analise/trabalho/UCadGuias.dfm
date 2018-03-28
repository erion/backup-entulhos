object frmCadastroGuias: TfrmCadastroGuias
  Left = 192
  Top = 103
  Width = 549
  Height = 480
  Caption = 'Cadastro de Guias'
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
    Width = 541
    Height = 19
    Panels = <>
    SimplePanel = False
  end
  object Panel1: TPanel
    Left = 0
    Top = 0
    Width = 541
    Height = 434
    Align = alClient
    BevelInner = bvLowered
    TabOrder = 1
    object Label1: TLabel
      Left = 25
      Top = 29
      Width = 54
      Height = 13
      Caption = 'N'#186' Registro'
    end
    object Label2: TLabel
      Left = 217
      Top = 29
      Width = 28
      Height = 13
      Caption = 'Nome'
    end
    object Label3: TLabel
      Left = 33
      Top = 57
      Width = 46
      Height = 13
      Caption = 'Endere'#231'o'
    end
    object Label4: TLabel
      Left = 46
      Top = 86
      Width = 33
      Height = 13
      Caption = 'Cidade'
    end
    object Label5: TLabel
      Left = 22
      Top = 114
      Width = 57
      Height = 13
      Caption = 'Fone(s)/Fax'
    end
    object Label6: TLabel
      Left = 368
      Top = 114
      Width = 32
      Height = 13
      Caption = 'Celular'
    end
    object Label7: TLabel
      Left = 344
      Top = 86
      Width = 27
      Height = 13
      Caption = 'Bairro'
    end
    object Label9: TLabel
      Left = 258
      Top = 86
      Width = 14
      Height = 13
      Caption = 'UF'
    end
    object DBNavigator1: TDBNavigator
      Left = 2
      Top = 407
      Width = 537
      Height = 25
      Align = alBottom
      Flat = True
      TabOrder = 0
    end
    object Edit1: TEdit
      Left = 88
      Top = 25
      Width = 121
      Height = 21
      TabOrder = 1
    end
    object Edit2: TEdit
      Left = 252
      Top = 25
      Width = 277
      Height = 21
      TabOrder = 2
    end
    object Edit3: TEdit
      Left = 88
      Top = 53
      Width = 441
      Height = 21
      TabOrder = 3
    end
    object Edit4: TEdit
      Left = 88
      Top = 82
      Width = 161
      Height = 21
      TabOrder = 4
    end
    object ComboBox1: TComboBox
      Left = 279
      Top = 82
      Width = 57
      Height = 21
      ItemHeight = 13
      TabOrder = 5
    end
    object Edit5: TEdit
      Left = 378
      Top = 82
      Width = 151
      Height = 21
      TabOrder = 6
    end
    object Edit6: TEdit
      Left = 88
      Top = 110
      Width = 131
      Height = 21
      TabOrder = 7
    end
    object Edit7: TEdit
      Left = 226
      Top = 110
      Width = 131
      Height = 21
      TabOrder = 8
    end
    object Edit8: TEdit
      Left = 408
      Top = 110
      Width = 121
      Height = 21
      TabOrder = 9
    end
    object CheckBox1: TCheckBox
      Left = 23
      Top = 139
      Width = 78
      Height = 17
      Alignment = taLeftJustify
      BiDiMode = bdLeftToRight
      Caption = 'Funcion'#225'rio'
      ParentBiDiMode = False
      TabOrder = 10
    end
    object GroupBox1: TGroupBox
      Left = 24
      Top = 164
      Width = 505
      Height = 111
      Caption = '  Cidades Conhecidas  '
      TabOrder = 11
      object DBGrid1: TDBGrid
        Left = 8
        Top = 17
        Width = 489
        Height = 86
        TabOrder = 0
        TitleFont.Charset = DEFAULT_CHARSET
        TitleFont.Color = clWindowText
        TitleFont.Height = -11
        TitleFont.Name = 'MS Sans Serif'
        TitleFont.Style = []
        Columns = <
          item
            Expanded = False
            Title.Caption = 'Cidades Conhecidas'
            Width = 468
            Visible = True
          end>
      end
    end
    object GroupBox2: TGroupBox
      Left = 24
      Top = 282
      Width = 505
      Height = 118
      Caption = '  Excurs'#245'es Conduzidas  '
      TabOrder = 12
      object DBGrid2: TDBGrid
        Left = 8
        Top = 19
        Width = 489
        Height = 91
        TabOrder = 0
        TitleFont.Charset = DEFAULT_CHARSET
        TitleFont.Color = clWindowText
        TitleFont.Height = -11
        TitleFont.Name = 'MS Sans Serif'
        TitleFont.Style = []
        Columns = <
          item
            Expanded = False
            Title.Caption = 'Excurs'#245'es'
            Width = 158
            Visible = True
          end
          item
            Expanded = False
            Title.Caption = 'Data'
            Width = 71
            Visible = True
          end
          item
            Expanded = False
            Title.Caption = 'Avalia'#231#227'o'
            Width = 239
            Visible = True
          end>
      end
    end
  end
end
