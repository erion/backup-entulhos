object frmRoomList: TfrmRoomList
  Left = 192
  Top = 103
  Width = 538
  Height = 438
  Caption = 'Cadastro Room - List'
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
    Top = 392
    Width = 530
    Height = 19
    Panels = <>
    SimplePanel = False
  end
  object Panel1: TPanel
    Left = 0
    Top = 0
    Width = 530
    Height = 392
    Align = alClient
    BevelInner = bvLowered
    TabOrder = 1
    object Label1: TLabel
      Left = 15
      Top = 28
      Width = 69
      Height = 13
      Caption = 'C'#243'd. Excurs'#227'o'
    end
    object Label2: TLabel
      Left = 418
      Top = 27
      Width = 23
      Height = 13
      Caption = 'Data'
    end
    object Label3: TLabel
      Left = 51
      Top = 57
      Width = 33
      Height = 13
      Caption = 'Cidade'
    end
    object Label4: TLabel
      Left = 160
      Top = 28
      Width = 75
      Height = 13
      Caption = 'Nome Excurs'#227'o'
    end
    object Label5: TLabel
      Left = 40
      Top = 86
      Width = 48
      Height = 13
      Caption = 'N'#186' '#212'nibus'
    end
    object Label6: TLabel
      Left = 320
      Top = 56
      Width = 41
      Height = 13
      Caption = 'Empresa'
    end
    object Label7: TLabel
      Left = 227
      Top = 86
      Width = 25
      Height = 13
      Caption = 'Hotel'
    end
    object Bevel1: TBevel
      Left = 25
      Top = 272
      Width = 491
      Height = 78
    end
    object Label8: TLabel
      Left = 25
      Top = 256
      Width = 46
      Height = 13
      Caption = 'Resumo'
      Font.Charset = DEFAULT_CHARSET
      Font.Color = clWindowText
      Font.Height = -11
      Font.Name = 'MS Sans Serif'
      Font.Style = [fsBold]
      ParentFont = False
    end
    object Label9: TLabel
      Left = 36
      Top = 292
      Width = 75
      Height = 13
      Caption = 'QTD Quartos'
      Font.Charset = DEFAULT_CHARSET
      Font.Color = clWindowText
      Font.Height = -11
      Font.Name = 'MS Sans Serif'
      Font.Style = [fsBold]
      ParentFont = False
    end
    object Label10: TLabel
      Left = 85
      Top = 316
      Width = 26
      Height = 13
      Caption = 'Tipo'
      Font.Charset = DEFAULT_CHARSET
      Font.Color = clWindowText
      Font.Height = -11
      Font.Name = 'MS Sans Serif'
      Font.Style = [fsBold]
      ParentFont = False
    end
    object Edit1: TEdit
      Left = 96
      Top = 24
      Width = 51
      Height = 21
      TabOrder = 0
    end
    object Edit2: TEdit
      Left = 242
      Top = 24
      Width = 168
      Height = 21
      TabOrder = 1
    end
    object MaskEdit1: TMaskEdit
      Left = 449
      Top = 24
      Width = 68
      Height = 21
      EditMask = '!99/99/0000;1;_'
      MaxLength = 10
      TabOrder = 2
      Text = '  /  /    '
    end
    object Edit3: TEdit
      Left = 96
      Top = 53
      Width = 217
      Height = 21
      TabOrder = 3
    end
    object Edit4: TEdit
      Left = 367
      Top = 53
      Width = 150
      Height = 21
      TabOrder = 4
    end
    object Edit5: TEdit
      Left = 96
      Top = 82
      Width = 121
      Height = 21
      TabOrder = 5
    end
    object ComboBox1: TComboBox
      Left = 260
      Top = 82
      Width = 257
      Height = 21
      ItemHeight = 13
      TabOrder = 6
    end
    object DBGrid1: TDBGrid
      Left = 24
      Top = 121
      Width = 493
      Height = 121
      TabOrder = 7
      TitleFont.Charset = DEFAULT_CHARSET
      TitleFont.Color = clWindowText
      TitleFont.Height = -11
      TitleFont.Name = 'MS Sans Serif'
      TitleFont.Style = []
      Columns = <
        item
          Expanded = False
          Title.Caption = 'N'#186' Quarto'
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'Tipo Quarto'
          Width = 116
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'Passageiro(s)'
          Width = 294
          Visible = True
        end>
    end
    object DBNavigator1: TDBNavigator
      Left = 2
      Top = 365
      Width = 526
      Height = 25
      Align = alBottom
      Flat = True
      TabOrder = 8
    end
    object Edit6: TEdit
      Left = 120
      Top = 288
      Width = 81
      Height = 21
      TabOrder = 9
    end
    object Edit7: TEdit
      Left = 120
      Top = 312
      Width = 81
      Height = 21
      TabOrder = 10
    end
  end
  object Edit8: TEdit
    Left = 205
    Top = 312
    Width = 81
    Height = 21
    TabOrder = 2
  end
  object Edit9: TEdit
    Left = 205
    Top = 288
    Width = 81
    Height = 21
    TabOrder = 3
  end
  object Edit10: TEdit
    Left = 290
    Top = 312
    Width = 81
    Height = 21
    TabOrder = 4
  end
  object Edit11: TEdit
    Left = 290
    Top = 288
    Width = 81
    Height = 21
    TabOrder = 5
  end
  object Edit12: TEdit
    Left = 375
    Top = 312
    Width = 81
    Height = 21
    TabOrder = 6
  end
  object Edit13: TEdit
    Left = 375
    Top = 288
    Width = 81
    Height = 21
    TabOrder = 7
  end
end
