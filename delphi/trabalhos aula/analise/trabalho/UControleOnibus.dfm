object frmControleOnibus: TfrmControleOnibus
  Left = 192
  Top = 103
  Width = 739
  Height = 432
  Caption = 'Controle de '#212'nibus'
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
    Top = 386
    Width = 731
    Height = 19
    Panels = <>
    SimplePanel = False
  end
  object Panel1: TPanel
    Left = 0
    Top = 0
    Width = 731
    Height = 386
    Align = alClient
    BevelInner = bvLowered
    TabOrder = 1
    object Label1: TLabel
      Left = 39
      Top = 28
      Width = 48
      Height = 13
      Caption = 'N'#186' '#212'nibus'
    end
    object Label2: TLabel
      Left = 181
      Top = 28
      Width = 27
      Height = 13
      Caption = 'Placa'
    end
    object Label3: TLabel
      Left = 309
      Top = 28
      Width = 30
      Height = 13
      Caption = 'Marca'
    end
    object Label4: TLabel
      Left = 457
      Top = 28
      Width = 75
      Height = 13
      Caption = 'Ano Fabrica'#231#227'o'
    end
    object Label5: TLabel
      Left = 605
      Top = 28
      Width = 53
      Height = 13
      Caption = 'N'#186' Lugares'
    end
    object Edit1: TEdit
      Left = 95
      Top = 24
      Width = 75
      Height = 21
      TabOrder = 0
    end
    object Edit2: TEdit
      Left = 221
      Top = 24
      Width = 81
      Height = 21
      TabOrder = 1
    end
    object Edit3: TEdit
      Left = 349
      Top = 24
      Width = 98
      Height = 21
      TabOrder = 2
    end
    object Edit4: TEdit
      Left = 540
      Top = 24
      Width = 58
      Height = 21
      TabOrder = 3
    end
    object Edit5: TEdit
      Left = 664
      Top = 24
      Width = 49
      Height = 21
      TabOrder = 4
    end
    object DBGrid1: TDBGrid
      Left = 16
      Top = 110
      Width = 697
      Height = 201
      TabOrder = 5
      TitleFont.Charset = DEFAULT_CHARSET
      TitleFont.Color = clWindowText
      TitleFont.Height = -11
      TitleFont.Name = 'MS Sans Serif'
      TitleFont.Style = []
      Columns = <
        item
          Expanded = False
          Title.Caption = 'Data'
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'Hora'
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'Data'
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'Hora'
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'Finalidade'
          Width = 193
          Visible = True
        end
        item
          Expanded = False
          Title.Caption = 'Motorista'
          Width = 224
          Visible = True
        end>
    end
    object RadioGroup1: TRadioGroup
      Left = 95
      Top = 57
      Width = 238
      Height = 36
      Caption = '  Tipo  '
      Columns = 2
      Items.Strings = (
        'Comum'
        'Leito')
      TabOrder = 6
    end
  end
end
