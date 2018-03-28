object frmVoucherLocacaoVeiculos: TfrmVoucherLocacaoVeiculos
  Left = 192
  Top = 103
  Width = 560
  Height = 409
  Caption = 'Voucher/Loca'#231#227'o de Ve'#237'culos'
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
    Top = 363
    Width = 552
    Height = 19
    Panels = <>
    SimplePanel = False
  end
  object Panel1: TPanel
    Left = 0
    Top = 0
    Width = 552
    Height = 363
    Align = alClient
    BevelInner = bvLowered
    TabOrder = 1
    object Label1: TLabel
      Left = 84
      Top = 32
      Width = 12
      Height = 13
      Caption = 'N'#186
    end
    object Label2: TLabel
      Left = 20
      Top = 63
      Width = 76
      Height = 13
      Caption = 'Nome Locadora'
    end
    object Label3: TLabel
      Left = 50
      Top = 93
      Width = 46
      Height = 13
      Caption = 'Endere'#231'o'
    end
    object Label4: TLabel
      Left = 64
      Top = 124
      Width = 32
      Height = 13
      Caption = 'Cliente'
    end
    object Label8: TLabel
      Left = 361
      Top = 124
      Width = 20
      Height = 13
      Caption = 'CPF'
    end
    object Label9: TLabel
      Left = 421
      Top = 32
      Width = 39
      Height = 13
      Caption = 'Emiss'#227'o'
    end
    object Label10: TLabel
      Left = 383
      Top = 307
      Width = 74
      Height = 13
      Caption = 'N'#186' Confirma'#231#227'o'
    end
    object Label5: TLabel
      Left = 211
      Top = 307
      Width = 54
      Height = 13
      Caption = 'Valor (US$)'
    end
    object Label6: TLabel
      Left = 60
      Top = 307
      Width = 36
      Height = 13
      Caption = 'N'#186' Dias'
    end
    object Edit1: TEdit
      Left = 105
      Top = 28
      Width = 65
      Height = 21
      TabOrder = 0
    end
    object Edit2: TEdit
      Left = 105
      Top = 59
      Width = 249
      Height = 21
      TabOrder = 1
    end
    object Edit3: TEdit
      Left = 105
      Top = 89
      Width = 249
      Height = 21
      TabOrder = 2
    end
    object ComboBox1: TComboBox
      Left = 105
      Top = 120
      Width = 249
      Height = 21
      ItemHeight = 13
      TabOrder = 3
    end
    object Edit5: TEdit
      Left = 393
      Top = 120
      Width = 141
      Height = 21
      TabOrder = 4
    end
    object MaskEdit3: TMaskEdit
      Left = 469
      Top = 28
      Width = 65
      Height = 21
      EditMask = '!99/99/0000;1;_'
      MaxLength = 10
      TabOrder = 5
      Text = '  /  /    '
    end
    object DBGrid1: TDBGrid
      Left = 16
      Top = 160
      Width = 518
      Height = 129
      TabOrder = 6
      TitleFont.Charset = DEFAULT_CHARSET
      TitleFont.Color = clWindowText
      TitleFont.Height = -11
      TitleFont.Name = 'MS Sans Serif'
      TitleFont.Style = []
      Columns = <
        item
          Expanded = False
          Title.Caption = 'Chegada'
          Width = 53
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'Data'
          Width = 52
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'Hora'
          Width = 36
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'Cidade'
          Width = 72
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'Devolu'#231#227'o'
          Width = 58
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'Data'
          Width = 53
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'Hora'
          Width = 35
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'Cidade'
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'Tipo Ve'#237'culo'
          Width = 69
          Visible = True
        end>
    end
    object DBNavigator1: TDBNavigator
      Left = 2
      Top = 336
      Width = 548
      Height = 25
      Align = alBottom
      Flat = True
      TabOrder = 7
    end
    object Edit6: TEdit
      Left = 469
      Top = 303
      Width = 65
      Height = 21
      TabOrder = 8
    end
    object Edit4: TEdit
      Left = 274
      Top = 303
      Width = 79
      Height = 21
      TabOrder = 9
    end
    object Edit7: TEdit
      Left = 105
      Top = 303
      Width = 65
      Height = 21
      TabOrder = 10
    end
  end
end
