object frmCadastroHotel: TfrmCadastroHotel
  Left = 192
  Top = 103
  Width = 636
  Height = 502
  Caption = 'Cadastro de Hotel'
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
    Top = 456
    Width = 628
    Height = 19
    Panels = <>
    SimplePanel = False
  end
  object Panel1: TPanel
    Left = 0
    Top = 0
    Width = 628
    Height = 456
    Align = alClient
    BevelInner = bvLowered
    TabOrder = 1
    object Label1: TLabel
      Left = 37
      Top = 26
      Width = 28
      Height = 13
      Caption = 'Nome'
    end
    object Label2: TLabel
      Left = 19
      Top = 53
      Width = 46
      Height = 13
      Caption = 'Endere'#231'o'
    end
    object Label3: TLabel
      Left = 32
      Top = 81
      Width = 33
      Height = 13
      BiDiMode = bdLeftToRight
      Caption = 'Cidade'
      ParentBiDiMode = False
    end
    object Label4: TLabel
      Left = 264
      Top = 81
      Width = 14
      Height = 13
      Caption = 'UF'
    end
    object Label5: TLabel
      Left = 8
      Top = 108
      Width = 57
      Height = 13
      Caption = 'Fone(s)/Fax'
    end
    object Label6: TLabel
      Left = 360
      Top = 81
      Width = 38
      Height = 13
      Caption = 'Gerente'
    end
    object RadioGroup1: TRadioGroup
      Left = 344
      Top = 17
      Width = 270
      Height = 54
      Caption = '  Classifica'#231#227'o Estrelas  '
      Columns = 5
      Items.Strings = (
        '1'
        '2'
        '3'
        '4'
        '5')
      TabOrder = 0
    end
    object Edit1: TEdit
      Left = 74
      Top = 22
      Width = 198
      Height = 21
      TabOrder = 1
    end
    object Edit2: TEdit
      Left = 74
      Top = 49
      Width = 246
      Height = 21
      TabOrder = 2
    end
    object Edit3: TEdit
      Left = 74
      Top = 77
      Width = 182
      Height = 21
      TabOrder = 3
    end
    object ComboBox1: TComboBox
      Left = 286
      Top = 77
      Width = 65
      Height = 21
      ItemHeight = 13
      TabOrder = 4
    end
    object Edit4: TEdit
      Left = 405
      Top = 77
      Width = 209
      Height = 21
      TabOrder = 5
    end
    object Edit5: TEdit
      Left = 74
      Top = 104
      Width = 121
      Height = 21
      TabOrder = 6
    end
    object Edit6: TEdit
      Left = 203
      Top = 104
      Width = 121
      Height = 21
      TabOrder = 7
    end
    object GroupBox1: TGroupBox
      Left = 24
      Top = 136
      Width = 589
      Height = 281
      Caption = '  Excurs'#245'es  '
      TabOrder = 8
      object DBGrid1: TDBGrid
        Left = 13
        Top = 24
        Width = 561
        Height = 243
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
            Width = 69
            Visible = True
          end
          item
            Expanded = False
            Title.Caption = 'Data'
            Width = 76
            Visible = True
          end
          item
            Expanded = False
            Title.Caption = 'Avalia'#231#227'o'
            Width = 191
            Visible = True
          end
          item
            Expanded = False
            Title.Caption = 'Observa'#231#227'o'
            Width = 205
            Visible = True
          end>
      end
    end
    object DBNavigator1: TDBNavigator
      Left = 2
      Top = 429
      Width = 624
      Height = 25
      Align = alBottom
      Flat = True
      TabOrder = 9
    end
  end
end
