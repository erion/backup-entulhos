object frmPedidoSeguro: TfrmPedidoSeguro
  Left = 192
  Top = 103
  Width = 461
  Height = 480
  Caption = 'Pedido de Seguro de Viagem'
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'MS Sans Serif'
  Font.Style = []
  OldCreateOrder = False
  PixelsPerInch = 96
  TextHeight = 13
  object Label7: TLabel
    Left = 35
    Top = 380
    Width = 59
    Height = 13
    Caption = 'C'#243'd. Seguro'
  end
  object StatusBar1: TStatusBar
    Left = 0
    Top = 434
    Width = 453
    Height = 19
    Panels = <>
    SimplePanel = False
  end
  object Panel1: TPanel
    Left = 0
    Top = 0
    Width = 453
    Height = 434
    Align = alClient
    BevelInner = bvLowered
    TabOrder = 1
    object Label1: TLabel
      Left = 36
      Top = 36
      Width = 59
      Height = 13
      Caption = 'C'#243'd. Seguro'
    end
    object Label2: TLabel
      Left = 259
      Top = 36
      Width = 39
      Height = 13
      BiDiMode = bdLeftToRight
      Caption = 'Emiss'#227'o'
      ParentBiDiMode = False
    end
    object Label3: TLabel
      Left = 40
      Top = 67
      Width = 55
      Height = 13
      Caption = 'Seguradora'
    end
    object Label4: TLabel
      Left = 49
      Top = 99
      Width = 46
      Height = 13
      Caption = 'Endere'#231'o'
    end
    object Label5: TLabel
      Left = 63
      Top = 130
      Width = 32
      Height = 13
      Caption = 'Cliente'
    end
    object Label6: TLabel
      Left = 49
      Top = 163
      Width = 46
      Height = 13
      Caption = 'Segurado'
    end
    object Label8: TLabel
      Left = 21
      Top = 380
      Width = 74
      Height = 13
      Caption = 'N'#186' Confirma'#231#227'o'
    end
    object Edit1: TEdit
      Left = 102
      Top = 32
      Width = 65
      Height = 21
      TabOrder = 0
    end
    object MaskEdit1: TMaskEdit
      Left = 306
      Top = 32
      Width = 65
      Height = 21
      EditMask = '!99/99/0000;1;_'
      MaxLength = 10
      TabOrder = 1
      Text = '  /  /    '
    end
    object Edit2: TEdit
      Left = 102
      Top = 63
      Width = 269
      Height = 21
      TabOrder = 2
    end
    object Edit3: TEdit
      Left = 102
      Top = 95
      Width = 269
      Height = 21
      TabOrder = 3
    end
    object ComboBox1: TComboBox
      Left = 102
      Top = 126
      Width = 269
      Height = 21
      ItemHeight = 13
      TabOrder = 4
    end
    object Edit4: TEdit
      Left = 102
      Top = 159
      Width = 269
      Height = 21
      TabOrder = 5
    end
    object GroupBox1: TGroupBox
      Left = 16
      Top = 200
      Width = 425
      Height = 169
      Caption = '  Descri'#231#227'o  '
      TabOrder = 6
      object DBGrid1: TDBGrid
        Left = 8
        Top = 22
        Width = 409
        Height = 138
        TabOrder = 0
        TitleFont.Charset = DEFAULT_CHARSET
        TitleFont.Color = clWindowText
        TitleFont.Height = -11
        TitleFont.Name = 'MS Sans Serif'
        TitleFont.Style = []
        Columns = <
          item
            Expanded = False
            Title.Caption = 'Tipo Plano'
            Width = 61
            Visible = True
          end
          item
            Expanded = False
            Title.Caption = 'RG'
            Width = 92
            Visible = True
          end
          item
            Expanded = False
            Title.Caption = 'Passaporte'
            Width = 84
            Visible = True
          end
          item
            Expanded = False
            Title.Caption = 'In'#237'cio Seguro'
            Width = 73
            Visible = True
          end
          item
            Expanded = False
            Title.Caption = 'T'#233'rmino Seguro'
            Width = 79
            Visible = True
          end>
      end
    end
    object DBNavigator1: TDBNavigator
      Left = 2
      Top = 407
      Width = 449
      Height = 25
      Align = alBottom
      Flat = True
      TabOrder = 7
    end
  end
  object Edit5: TEdit
    Left = 102
    Top = 376
    Width = 65
    Height = 21
    TabOrder = 2
  end
end
