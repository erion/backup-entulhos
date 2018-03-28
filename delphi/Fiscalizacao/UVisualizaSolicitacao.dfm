object frmVisualizaSolicitacao: TfrmVisualizaSolicitacao
  Left = 299
  Top = 231
  Width = 474
  Height = 281
  Caption = 'SICOF - Visualiza'#231#227'o de Solicita'#231#227'o'
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'MS Sans Serif'
  Font.Style = []
  OldCreateOrder = False
  Position = poDesktopCenter
  OnClose = FormClose
  OnCreate = FormCreate
  PixelsPerInch = 96
  TextHeight = 13
  object Panel1: TPanel
    Left = 0
    Top = 0
    Width = 466
    Height = 235
    Align = alClient
    BevelInner = bvLowered
    TabOrder = 0
    object Label1: TLabel
      Left = 13
      Top = 48
      Width = 64
      Height = 13
      Caption = 'Id Solicita'#231#227'o'
    end
    object Label2: TLabel
      Left = 21
      Top = 74
      Width = 56
      Height = 13
      Caption = 'Requerente'
    end
    object Label3: TLabel
      Left = 46
      Top = 208
      Width = 96
      Height = 13
      Caption = 'Usu'#225'rio Cadastrante'
    end
    object Label4: TLabel
      Left = 44
      Top = 100
      Width = 33
      Height = 13
      Caption = 'Origem'
    end
    object Label5: TLabel
      Left = 195
      Top = 128
      Width = 21
      Height = 13
      Caption = 'Tipo'
    end
    object Label6: TLabel
      Left = 17
      Top = 128
      Width = 60
      Height = 13
      Caption = 'N'#186' Protocolo'
    end
    object Label7: TLabel
      Left = 346
      Top = 128
      Width = 23
      Height = 13
      Caption = 'Data'
    end
    object Label8: TLabel
      Left = 345
      Top = 48
      Width = 23
      Height = 13
      Caption = 'Data'
    end
    object Label9: TLabel
      Left = 39
      Top = 22
      Width = 38
      Height = 13
      Caption = 'Assunto'
    end
    object Label10: TLabel
      Left = 19
      Top = 168
      Width = 58
      Height = 13
      Caption = 'Observa'#231#227'o'
    end
    object idSolicitacao: TwwDBEdit
      Left = 86
      Top = 44
      Width = 67
      Height = 21
      Color = clAqua
      DataField = 'idsolicitacao'
      DataSource = dmFiscalizacao.dsVisualizaSolicitacao
      ReadOnly = True
      TabOrder = 0
      UnboundDataType = wwDefault
      WantReturns = False
      WordWrap = False
    end
    object dataSolicitacao: TwwDBEdit
      Left = 374
      Top = 44
      Width = 73
      Height = 21
      Hint = 'Data da Solicita'#231#227'o'
      Color = clAqua
      DataField = 'datahorasolicitacao'
      DataSource = dmFiscalizacao.dsVisualizaSolicitacao
      ReadOnly = True
      TabOrder = 1
      UnboundDataType = wwDefault
      WantReturns = False
      WordWrap = False
    end
    object tipoRequerente: TwwDBEdit
      Left = 86
      Top = 70
      Width = 153
      Height = 21
      Color = clAqua
      DataField = 'tiporequerente'
      DataSource = dmFiscalizacao.dsVisualizaSolicitacao
      ReadOnly = True
      TabOrder = 2
      UnboundDataType = wwDefault
      WantReturns = False
      WordWrap = False
    end
    object nomeRequerente: TwwDBEdit
      Left = 242
      Top = 70
      Width = 205
      Height = 21
      Color = clAqua
      DataField = 'requerente'
      DataSource = dmFiscalizacao.dsVisualizaSolicitacao
      ReadOnly = True
      TabOrder = 3
      UnboundDataType = wwDefault
      WantReturns = False
      WordWrap = False
    end
    object assunto: TwwDBEdit
      Left = 86
      Top = 18
      Width = 361
      Height = 21
      Color = clAqua
      DataField = 'assunto'
      DataSource = dmFiscalizacao.dsVisualizaSolicitacao
      ReadOnly = True
      TabOrder = 4
      UnboundDataType = wwDefault
      WantReturns = False
      WordWrap = False
    end
    object origem: TwwDBEdit
      Left = 86
      Top = 96
      Width = 129
      Height = 21
      Color = clAqua
      DataField = 'origem'
      DataSource = dmFiscalizacao.dsVisualizaSolicitacao
      ReadOnly = True
      TabOrder = 5
      UnboundDataType = wwDefault
      WantReturns = False
      WordWrap = False
    end
    object usuario: TwwDBEdit
      Left = 148
      Top = 204
      Width = 201
      Height = 21
      Color = clAqua
      DataField = 'nome'
      DataSource = dmFiscalizacao.dsVisualizaSolicitacao
      ReadOnly = True
      TabOrder = 6
      UnboundDataType = wwDefault
      WantReturns = False
      WordWrap = False
    end
    object nmrProtocolo: TwwDBEdit
      Left = 86
      Top = 124
      Width = 103
      Height = 21
      Color = clAqua
      DataField = 'numprotocolo'
      DataSource = dmFiscalizacao.dsVisualizaSolicitacao
      ReadOnly = True
      TabOrder = 7
      UnboundDataType = wwDefault
      WantReturns = False
      WordWrap = False
    end
    object tipoProtocolo: TwwDBEdit
      Left = 221
      Top = 124
      Width = 121
      Height = 21
      Color = clAqua
      DataField = 'tipoprotocolo'
      DataSource = dmFiscalizacao.dsVisualizaSolicitacao
      ReadOnly = True
      TabOrder = 8
      UnboundDataType = wwDefault
      WantReturns = False
      WordWrap = False
    end
    object dataProtocolo: TwwDBEdit
      Left = 373
      Top = 124
      Width = 74
      Height = 21
      Hint = 'Data do Protocolo'
      Color = clAqua
      DataField = 'dataprotocolo'
      DataSource = dmFiscalizacao.dsVisualizaSolicitacao
      ReadOnly = True
      TabOrder = 9
      UnboundDataType = wwDefault
      WantReturns = False
      WordWrap = False
    end
    object observacao: TwwDBRichEdit
      Left = 86
      Top = 152
      Width = 362
      Height = 44
      AutoURLDetect = False
      Color = clAqua
      DataField = 'observacao'
      DataSource = dmFiscalizacao.dsVisualizaSolicitacao
      PrintJobName = 'Delphi 6'
      TabOrder = 10
      EditorCaption = 'Edit Rich Text'
      EditorPosition.Left = 0
      EditorPosition.Top = 0
      EditorPosition.Width = 0
      EditorPosition.Height = 0
      MeasurementUnits = muInches
      PrintMargins.Top = 1
      PrintMargins.Bottom = 1
      PrintMargins.Left = 1
      PrintMargins.Right = 1
      RichEditVersion = 2
      Data = {
        730000007B5C727466315C616E73695C616E7369637067313235325C64656666
        305C6465666C616E67313034367B5C666F6E7474626C7B5C66305C666E696C20
        4D532053616E732053657269663B7D7D0D0A5C766965776B696E64345C756331
        5C706172645C66305C667331365C7061720D0A7D0D0A00}
    end
  end
  object StatusBar1: TStatusBar
    Left = 0
    Top = 235
    Width = 466
    Height = 19
    Panels = <>
    SimplePanel = False
  end
end
