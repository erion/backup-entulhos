object frmNotaFiscal: TfrmNotaFiscal
  Left = 192
  Top = 103
  Width = 490
  Height = 519
  Caption = 'Notas Fiscais'
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
    Top = 473
    Width = 482
    Height = 19
    Panels = <>
    SimplePanel = False
  end
  object Panel1: TPanel
    Left = 0
    Top = 0
    Width = 482
    Height = 473
    Align = alClient
    BevelInner = bvLowered
    TabOrder = 1
    object Label1: TLabel
      Left = 23
      Top = 28
      Width = 53
      Height = 13
      Caption = 'Nota Fiscal'
    end
    object Label2: TLabel
      Left = 348
      Top = 28
      Width = 39
      Height = 13
      Caption = 'Emiss'#227'o'
    end
    object Label3: TLabel
      Left = 44
      Top = 57
      Width = 32
      Height = 13
      Caption = 'Cliente'
    end
    object Label4: TLabel
      Left = 321
      Top = 57
      Width = 20
      Height = 13
      Caption = 'CPF'
    end
    object Label5: TLabel
      Left = 30
      Top = 86
      Width = 46
      Height = 13
      Caption = 'Endere'#231'o'
    end
    object Label6: TLabel
      Left = 43
      Top = 115
      Width = 33
      Height = 13
      Caption = 'Cidade'
    end
    object Label7: TLabel
      Left = 289
      Top = 115
      Width = 14
      Height = 13
      Caption = 'UF'
    end
    object Label15: TLabel
      Left = 245
      Top = 276
      Width = 88
      Height = 13
      Caption = 'Total dos Servi'#231'os'
    end
    object Edit1: TEdit
      Left = 88
      Top = 24
      Width = 121
      Height = 21
      TabOrder = 0
    end
    object ComboBox1: TComboBox
      Left = 88
      Top = 53
      Width = 225
      Height = 21
      ItemHeight = 13
      TabOrder = 1
    end
    object Edit2: TEdit
      Left = 348
      Top = 53
      Width = 121
      Height = 21
      Color = clInfoBk
      TabOrder = 2
    end
    object Edit3: TEdit
      Left = 88
      Top = 82
      Width = 381
      Height = 21
      Color = clInfoBk
      TabOrder = 3
    end
    object Edit4: TEdit
      Left = 88
      Top = 111
      Width = 193
      Height = 21
      Color = clInfoBk
      TabOrder = 4
    end
    object Edit5: TEdit
      Left = 313
      Top = 111
      Width = 49
      Height = 21
      Color = clInfoBk
      TabOrder = 5
    end
    object MaskEdit1: TMaskEdit
      Left = 396
      Top = 24
      Width = 73
      Height = 21
      EditMask = '!99/99/0000;1;_'
      MaxLength = 10
      TabOrder = 6
      Text = '  /  /    '
    end
    object DBGrid1: TDBGrid
      Left = 19
      Top = 146
      Width = 445
      Height = 120
      TabOrder = 7
      TitleFont.Charset = DEFAULT_CHARSET
      TitleFont.Color = clWindowText
      TitleFont.Height = -11
      TitleFont.Name = 'MS Sans Serif'
      TitleFont.Style = []
      Columns = <
        item
          Expanded = False
          Title.Caption = 'Descri'#231#227'o do Servi'#231'o'
          Width = 302
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'Valor do Servi'#231'o'
          Width = 123
          Visible = True
        end>
    end
    object DBNavigator1: TDBNavigator
      Left = 2
      Top = 446
      Width = 478
      Height = 25
      Align = alBottom
      Flat = True
      TabOrder = 8
    end
    object GroupBox1: TGroupBox
      Left = 19
      Top = 295
      Width = 446
      Height = 137
      Caption = '  Pagamento  '
      TabOrder = 9
      object Label8: TLabel
        Left = 52
        Top = 28
        Width = 21
        Height = 13
        Caption = 'Tipo'
      end
      object Label9: TLabel
        Left = 38
        Top = 56
        Width = 37
        Height = 13
        Caption = 'Entrada'
      end
      object Label10: TLabel
        Left = 26
        Top = 84
        Width = 49
        Height = 13
        Caption = '1'#170' Parcela'
      end
      object Label11: TLabel
        Left = 26
        Top = 112
        Width = 49
        Height = 13
        Caption = '2'#170' Parcela'
      end
      object Label12: TLabel
        Left = 306
        Top = 55
        Width = 39
        Height = 13
        Caption = 'Emiss'#227'o'
      end
      object Label13: TLabel
        Left = 306
        Top = 83
        Width = 39
        Height = 13
        Caption = 'Emiss'#227'o'
      end
      object Label14: TLabel
        Left = 306
        Top = 111
        Width = 39
        Height = 13
        Caption = 'Emiss'#227'o'
      end
      object ComboBox2: TComboBox
        Left = 85
        Top = 24
        Width = 150
        Height = 21
        ItemHeight = 13
        TabOrder = 0
      end
      object MaskEdit2: TMaskEdit
        Left = 357
        Top = 52
        Width = 73
        Height = 21
        EditMask = '!99/99/0000;1;_'
        MaxLength = 10
        TabOrder = 1
        Text = '  /  /    '
      end
      object MaskEdit3: TMaskEdit
        Left = 357
        Top = 80
        Width = 73
        Height = 21
        EditMask = '!99/99/0000;1;_'
        MaxLength = 10
        TabOrder = 2
        Text = '  /  /    '
      end
      object MaskEdit4: TMaskEdit
        Left = 357
        Top = 108
        Width = 73
        Height = 21
        EditMask = '!99/99/0000;1;_'
        MaxLength = 10
        TabOrder = 3
        Text = '  /  /    '
      end
      object Edit7: TEdit
        Left = 85
        Top = 52
        Width = 97
        Height = 21
        TabOrder = 4
      end
      object Edit8: TEdit
        Left = 85
        Top = 80
        Width = 97
        Height = 21
        TabOrder = 5
      end
      object Edit9: TEdit
        Left = 85
        Top = 108
        Width = 97
        Height = 21
        TabOrder = 6
      end
    end
    object Edit6: TEdit
      Left = 343
      Top = 272
      Width = 121
      Height = 21
      TabOrder = 10
    end
  end
end
