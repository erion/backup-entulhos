object frmSolicitacaoBilhete: TfrmSolicitacaoBilhete
  Left = 192
  Top = 103
  Width = 486
  Height = 512
  Caption = 'Solicita'#231#227'o de Emiss'#227'o de Bilhete'
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
    Top = 466
    Width = 478
    Height = 19
    Panels = <>
    SimplePanel = False
  end
  object Panel1: TPanel
    Left = 0
    Top = 0
    Width = 478
    Height = 466
    Align = alClient
    BevelInner = bvLowered
    TabOrder = 1
    object Label1: TLabel
      Left = 67
      Top = 28
      Width = 32
      Height = 13
      Caption = 'Bilhete'
    end
    object Label2: TLabel
      Left = 288
      Top = 28
      Width = 39
      Height = 13
      Caption = 'Emiss'#227'o'
    end
    object Label3: TLabel
      Left = 53
      Top = 57
      Width = 46
      Height = 13
      Caption = 'Cia A'#233'rea'
    end
    object Label4: TLabel
      Left = 53
      Top = 87
      Width = 46
      Height = 13
      Caption = 'Endere'#231'o'
    end
    object Label5: TLabel
      Left = 67
      Top = 118
      Width = 32
      Height = 13
      Caption = 'Cliente'
    end
    object Label6: TLabel
      Left = 25
      Top = 412
      Width = 74
      Height = 13
      Caption = 'N'#186' Confirma'#231#227'o'
    end
    object Label7: TLabel
      Left = 81
      Top = 144
      Width = 57
      Height = 13
      Caption = 'Passageiros'
    end
    object Edit1: TEdit
      Left = 108
      Top = 24
      Width = 73
      Height = 21
      TabOrder = 0
    end
    object MaskEdit1: TMaskEdit
      Left = 336
      Top = 24
      Width = 65
      Height = 21
      EditMask = '!99/99/0000;1;_'
      MaxLength = 10
      TabOrder = 1
      Text = '  /  /    '
    end
    object Edit2: TEdit
      Left = 108
      Top = 53
      Width = 293
      Height = 21
      TabOrder = 2
    end
    object Edit3: TEdit
      Left = 108
      Top = 83
      Width = 293
      Height = 21
      TabOrder = 3
    end
    object ComboBox1: TComboBox
      Left = 108
      Top = 114
      Width = 293
      Height = 21
      ItemHeight = 13
      TabOrder = 4
    end
    object Memo1: TMemo
      Left = 80
      Top = 160
      Width = 337
      Height = 94
      TabOrder = 5
    end
    object GroupBox1: TGroupBox
      Left = 19
      Top = 264
      Width = 441
      Height = 136
      Caption = '  Descri'#231#227'o de V'#244'os  '
      TabOrder = 6
      object DBGrid1: TDBGrid
        Left = 8
        Top = 21
        Width = 424
        Height = 106
        TabOrder = 0
        TitleFont.Charset = DEFAULT_CHARSET
        TitleFont.Color = clWindowText
        TitleFont.Height = -11
        TitleFont.Name = 'MS Sans Serif'
        TitleFont.Style = []
        Columns = <
          item
            Expanded = False
            Title.Caption = 'N'#186' V'#244'o'
            Width = 54
            Visible = True
          end
          item
            Expanded = False
            Title.Caption = 'Origem'
            Width = 108
            Visible = True
          end
          item
            Expanded = False
            Title.Caption = 'Destino'
            Width = 109
            Visible = True
          end
          item
            Expanded = False
            Title.Caption = 'N'#186' Lugares'
            Width = 59
            Visible = True
          end
          item
            Expanded = False
            Title.Caption = 'Valor'
            Width = 74
            Visible = True
          end>
      end
    end
    object DBNavigator1: TDBNavigator
      Left = 2
      Top = 440
      Width = 474
      Height = 24
      Align = alBottom
      Flat = True
      TabOrder = 7
    end
    object Edit4: TEdit
      Left = 108
      Top = 408
      Width = 73
      Height = 21
      TabOrder = 8
    end
  end
end
