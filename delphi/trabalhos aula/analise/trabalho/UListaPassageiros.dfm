object frmListaPassageiros: TfrmListaPassageiros
  Left = 192
  Top = 103
  Width = 646
  Height = 375
  Caption = 'Lista de Passageiros'
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
    Top = 329
    Width = 638
    Height = 19
    Panels = <>
    SimplePanel = False
  end
  object Panel1: TPanel
    Left = 0
    Top = 0
    Width = 638
    Height = 329
    Align = alClient
    BevelInner = bvLowered
    TabOrder = 1
    object Label1: TLabel
      Left = 21
      Top = 28
      Width = 69
      Height = 13
      Caption = 'C'#243'd. Excurs'#227'o'
    end
    object Label2: TLabel
      Left = 173
      Top = 28
      Width = 75
      Height = 13
      Caption = 'Nome Excurs'#227'o'
    end
    object Label3: TLabel
      Left = 525
      Top = 28
      Width = 23
      Height = 13
      Caption = 'Data'
    end
    object Label4: TLabel
      Left = 42
      Top = 55
      Width = 48
      Height = 13
      Caption = 'N'#186' '#212'nibus'
    end
    object Label5: TLabel
      Left = 231
      Top = 55
      Width = 41
      Height = 13
      Caption = 'Empresa'
    end
    object Edit1: TEdit
      Left = 99
      Top = 24
      Width = 70
      Height = 21
      TabOrder = 0
    end
    object Edit2: TEdit
      Left = 254
      Top = 24
      Width = 264
      Height = 21
      TabOrder = 1
    end
    object Edit5: TEdit
      Left = 278
      Top = 51
      Width = 345
      Height = 21
      TabOrder = 2
    end
    object DBGrid1: TDBGrid
      Left = 20
      Top = 86
      Width = 603
      Height = 201
      TabOrder = 3
      TitleFont.Charset = DEFAULT_CHARSET
      TitleFont.Color = clWindowText
      TitleFont.Height = -11
      TitleFont.Name = 'MS Sans Serif'
      TitleFont.Style = []
      Columns = <
        item
          Expanded = False
          Title.Caption = 'Apelido'
          Width = 139
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'Nome'
          Width = 150
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
          Title.Caption = 'Data Nascimento'
          Width = 87
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'Nacionalidade'
          Width = 121
          Visible = True
        end>
    end
    object MaskEdit1: TMaskEdit
      Left = 556
      Top = 24
      Width = 67
      Height = 21
      EditMask = '!99/99/0000;1;_'
      MaxLength = 10
      TabOrder = 4
      Text = '  /  /    '
    end
    object ComboBox1: TComboBox
      Left = 98
      Top = 51
      Width = 127
      Height = 21
      ItemHeight = 13
      TabOrder = 5
    end
    object DBNavigator1: TDBNavigator
      Left = 2
      Top = 302
      Width = 634
      Height = 25
      Align = alBottom
      Flat = True
      TabOrder = 6
    end
  end
end
