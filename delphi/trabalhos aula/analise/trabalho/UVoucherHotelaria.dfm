object frmVoucherHotelaria: TfrmVoucherHotelaria
  Left = 192
  Top = 103
  Width = 565
  Height = 400
  Caption = 'Voucher/Hotelaria'
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
    Top = 354
    Width = 557
    Height = 19
    Panels = <>
    SimplePanel = False
  end
  object Panel1: TPanel
    Left = 0
    Top = 0
    Width = 557
    Height = 354
    Align = alClient
    BevelInner = bvLowered
    TabOrder = 1
    object Label1: TLabel
      Left = 34
      Top = 32
      Width = 59
      Height = 13
      Caption = 'N'#186' Excurs'#227'o'
    end
    object Label2: TLabel
      Left = 36
      Top = 63
      Width = 56
      Height = 13
      Caption = 'P/ Empresa'
    end
    object Label3: TLabel
      Left = 20
      Top = 93
      Width = 73
      Height = 13
      Caption = 'End. Embarque'
    end
    object Label4: TLabel
      Left = 61
      Top = 124
      Width = 32
      Height = 13
      Caption = 'Cliente'
    end
    object Label9: TLabel
      Left = 421
      Top = 32
      Width = 39
      Height = 13
      Caption = 'Emiss'#227'o'
    end
    object Label10: TLabel
      Left = 19
      Top = 299
      Width = 74
      Height = 13
      Caption = 'N'#186' Confirma'#231#227'o'
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
      Width = 348
      Height = 21
      TabOrder = 1
    end
    object Edit3: TEdit
      Left = 105
      Top = 89
      Width = 348
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
    object MaskEdit3: TMaskEdit
      Left = 469
      Top = 28
      Width = 65
      Height = 21
      EditMask = '!99/99/0000;1;_'
      MaxLength = 10
      TabOrder = 4
      Text = '  /  /    '
    end
    object DBGrid1: TDBGrid
      Left = 24
      Top = 152
      Width = 510
      Height = 129
      TabOrder = 5
      TitleFont.Charset = DEFAULT_CHARSET
      TitleFont.Color = clWindowText
      TitleFont.Height = -11
      TitleFont.Name = 'MS Sans Serif'
      TitleFont.Style = []
      Columns = <
        item
          Expanded = False
          Title.Caption = 'N'#186' Pessoas'
          Width = 116
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'Dt Chegada'
          Width = 123
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'Dt Sa'#237'da'
          Width = 86
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'Tipo Quartos'
          Width = 79
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'N'#186' Quartos'
          Width = 86
          Visible = True
        end>
    end
    object DBNavigator1: TDBNavigator
      Left = 2
      Top = 327
      Width = 553
      Height = 25
      Align = alBottom
      Flat = True
      TabOrder = 6
    end
    object Edit6: TEdit
      Left = 105
      Top = 295
      Width = 65
      Height = 21
      TabOrder = 7
    end
  end
end
