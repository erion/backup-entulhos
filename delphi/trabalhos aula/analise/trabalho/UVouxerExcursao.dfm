object frmVoucherExcursao: TfrmVoucherExcursao
  Left = 195
  Top = 122
  Width = 558
  Height = 445
  Caption = 'Voucher/Excurs'#227'o'
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
    Top = 399
    Width = 550
    Height = 19
    Panels = <>
    SimplePanel = False
  end
  object Panel1: TPanel
    Left = 0
    Top = 0
    Width = 550
    Height = 399
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
      Left = 52
      Top = 63
      Width = 41
      Height = 13
      Caption = 'Empresa'
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
    object Label5: TLabel
      Left = 49
      Top = 156
      Width = 44
      Height = 13
      Caption = 'Excurs'#227'o'
    end
    object Label6: TLabel
      Left = 361
      Top = 156
      Width = 23
      Height = 13
      Caption = 'Data'
    end
    object Label7: TLabel
      Left = 465
      Top = 156
      Width = 23
      Height = 13
      Caption = 'Hora'
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
      Left = 19
      Top = 339
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
    object Edit4: TEdit
      Left = 105
      Top = 152
      Width = 249
      Height = 21
      TabOrder = 4
    end
    object MaskEdit1: TMaskEdit
      Left = 393
      Top = 152
      Width = 65
      Height = 21
      EditMask = '!99/99/0000;1;_'
      MaxLength = 10
      TabOrder = 5
      Text = '  /  /    '
    end
    object MaskEdit2: TMaskEdit
      Left = 497
      Top = 152
      Width = 37
      Height = 21
      EditMask = '!90:00;1;_'
      MaxLength = 5
      TabOrder = 6
      Text = '  :  '
    end
    object Edit5: TEdit
      Left = 393
      Top = 120
      Width = 141
      Height = 21
      TabOrder = 7
    end
    object MaskEdit3: TMaskEdit
      Left = 469
      Top = 28
      Width = 65
      Height = 21
      EditMask = '!99/99/0000;1;_'
      MaxLength = 10
      TabOrder = 8
      Text = '  /  /    '
    end
    object DBGrid1: TDBGrid
      Left = 24
      Top = 192
      Width = 510
      Height = 129
      TabOrder = 9
      TitleFont.Charset = DEFAULT_CHARSET
      TitleFont.Color = clWindowText
      TitleFont.Height = -11
      TitleFont.Name = 'MS Sans Serif'
      TitleFont.Style = []
      Columns = <
        item
          Expanded = False
          Title.Caption = 'Local'
          Width = 116
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'Passageiro'
          Width = 123
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'RG'
          Width = 86
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'Nacionalidade'
          Width = 79
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'Passaporte'
          Width = 86
          Visible = True
        end>
    end
    object DBNavigator1: TDBNavigator
      Left = 2
      Top = 372
      Width = 546
      Height = 25
      Align = alBottom
      Flat = True
      TabOrder = 10
    end
    object Edit6: TEdit
      Left = 105
      Top = 335
      Width = 65
      Height = 21
      TabOrder = 11
    end
  end
end
