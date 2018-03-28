object frmCadastroMotorista: TfrmCadastroMotorista
  Left = 192
  Top = 103
  Width = 483
  Height = 456
  Caption = 'Cadastro de Motoristas'
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
    Top = 410
    Width = 475
    Height = 19
    Panels = <>
    SimplePanel = False
  end
  object Panel1: TPanel
    Left = 0
    Top = 0
    Width = 475
    Height = 410
    Align = alClient
    BevelInner = bvLowered
    TabOrder = 1
    object Label1: TLabel
      Left = 15
      Top = 36
      Width = 82
      Height = 13
      Caption = 'Carteira Motorista'
    end
    object Label2: TLabel
      Left = 69
      Top = 66
      Width = 28
      Height = 13
      Caption = 'Nome'
    end
    object Label3: TLabel
      Left = 51
      Top = 95
      Width = 46
      Height = 13
      Caption = 'Endere'#231'o'
    end
    object Label4: TLabel
      Left = 40
      Top = 124
      Width = 57
      Height = 13
      Caption = 'Fone(s)/Fax'
    end
    object Label5: TLabel
      Left = 64
      Top = 155
      Width = 32
      Height = 13
      Caption = 'Celular'
    end
    object DBNavigator1: TDBNavigator
      Left = 2
      Top = 383
      Width = 471
      Height = 25
      Align = alBottom
      Flat = True
      TabOrder = 0
    end
    object CheckBox1: TCheckBox
      Left = 376
      Top = 32
      Width = 81
      Height = 17
      Alignment = taLeftJustify
      Caption = 'Funcion'#225'rio'
      TabOrder = 1
    end
    object Edit1: TEdit
      Left = 108
      Top = 32
      Width = 98
      Height = 21
      TabOrder = 2
    end
    object Edit2: TEdit
      Left = 107
      Top = 62
      Width = 250
      Height = 21
      TabOrder = 3
    end
    object Edit3: TEdit
      Left = 107
      Top = 91
      Width = 350
      Height = 21
      TabOrder = 4
    end
    object Edit4: TEdit
      Left = 107
      Top = 120
      Width = 121
      Height = 21
      TabOrder = 5
    end
    object Edit5: TEdit
      Left = 235
      Top = 120
      Width = 121
      Height = 21
      TabOrder = 6
    end
    object Edit6: TEdit
      Left = 107
      Top = 151
      Width = 121
      Height = 21
      TabOrder = 7
    end
    object GroupBox1: TGroupBox
      Left = 16
      Top = 184
      Width = 441
      Height = 185
      Caption = '  Excurs'#245'es  '
      TabOrder = 8
      object DBGrid1: TDBGrid
        Left = 14
        Top = 24
        Width = 411
        Height = 146
        TabOrder = 0
        TitleFont.Charset = DEFAULT_CHARSET
        TitleFont.Color = clWindowText
        TitleFont.Height = -11
        TitleFont.Name = 'MS Sans Serif'
        TitleFont.Style = []
        Columns = <
          item
            Expanded = False
            Title.Caption = 'C'#243'digo'
            Width = 58
            Visible = True
          end
          item
            Expanded = False
            Title.Caption = 'Data'
            Visible = True
          end
          item
            Expanded = False
            Title.Caption = 'Avalia'#231#227'o'
            Width = 168
            Visible = True
          end
          item
            Expanded = False
            Title.Caption = #212'nibus'
            Width = 101
            Visible = True
          end>
      end
    end
  end
end
