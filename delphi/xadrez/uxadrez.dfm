object Form1: TForm1
  Left = 315
  Top = 146
  BorderStyle = bsDialog
  Caption = 'Jogo de Xadrez'
  ClientHeight = 530
  ClientWidth = 521
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'MS Sans Serif'
  Font.Style = []
  OldCreateOrder = False
  Position = poMainFormCenter
  OnCreate = FormCreate
  PixelsPerInch = 96
  TextHeight = 13
  object Label1: TLabel
    Left = 20
    Top = 8
    Width = 50
    Height = 13
    Caption = 'Jogador 1:'
  end
  object Label2: TLabel
    Left = 451
    Top = 8
    Width = 50
    Height = 13
    Caption = 'Jogador 2:'
  end
  object Image1: TImage
    Left = 20
    Top = 64
    Width = 478
    Height = 446
  end
  object Image2: TImage
    Left = 175
    Top = 8
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image2Click
  end
  object Image3: TImage
    Left = 183
    Top = 16
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image3Click
  end
  object Image4: TImage
    Left = 191
    Top = 24
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image4Click
  end
  object Image5: TImage
    Left = 199
    Top = 32
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image5Click
  end
  object Image6: TImage
    Left = 207
    Top = 40
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image6Click
  end
  object Image7: TImage
    Left = 215
    Top = 48
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image7Click
  end
  object Image8: TImage
    Left = 223
    Top = 56
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image8Click
  end
  object Image9: TImage
    Left = 231
    Top = 64
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image9Click
  end
  object Image10: TImage
    Left = 239
    Top = 72
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image10Click
  end
  object Image11: TImage
    Left = 247
    Top = 80
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image11Click
  end
  object Image12: TImage
    Left = 255
    Top = 88
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image12Click
  end
  object Image13: TImage
    Left = 263
    Top = 96
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image13Click
  end
  object Image14: TImage
    Left = 271
    Top = 104
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image14Click
  end
  object Image15: TImage
    Left = 279
    Top = 112
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image15Click
  end
  object Image16: TImage
    Left = 287
    Top = 120
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image16Click
  end
  object Image17: TImage
    Left = 295
    Top = 128
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image17Click
  end
  object Image18: TImage
    Left = 319
    Top = 8
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image18Click
  end
  object Image19: TImage
    Left = 327
    Top = 16
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image19Click
  end
  object Image20: TImage
    Left = 335
    Top = 24
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image20Click
  end
  object Image21: TImage
    Left = 343
    Top = 32
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image21Click
  end
  object Image22: TImage
    Left = 351
    Top = 40
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image22Click
  end
  object Image23: TImage
    Left = 359
    Top = 48
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image23Click
  end
  object Image24: TImage
    Left = 367
    Top = 56
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image24Click
  end
  object Image25: TImage
    Left = 375
    Top = 64
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image25Click
  end
  object Image26: TImage
    Left = 383
    Top = 72
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image26Click
  end
  object Image27: TImage
    Left = 391
    Top = 80
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image27Click
  end
  object Image28: TImage
    Left = 399
    Top = 88
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image28Click
  end
  object Image29: TImage
    Left = 407
    Top = 96
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image29Click
  end
  object Image30: TImage
    Left = 415
    Top = 104
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image30Click
  end
  object Image31: TImage
    Left = 423
    Top = 112
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image31Click
  end
  object Image32: TImage
    Left = 431
    Top = 120
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image32Click
  end
  object Image33: TImage
    Left = 439
    Top = 128
    Width = 22
    Height = 47
    Transparent = True
    OnClick = Image33Click
  end
  object Label3: TLabel
    Left = 232
    Top = 18
    Width = 15
    Height = 29
    Caption = '5'
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWindowText
    Font.Height = -24
    Font.Name = 'MS Sans Serif'
    Font.Style = [fsBold]
    ParentFont = False
  end
  object Label4: TLabel
    Left = 256
    Top = 16
    Width = 8
    Height = 29
    Caption = ':'
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWindowText
    Font.Height = -24
    Font.Name = 'MS Sans Serif'
    Font.Style = [fsBold]
    ParentFont = False
  end
  object Label5: TLabel
    Left = 272
    Top = 18
    Width = 29
    Height = 29
    Caption = '00'
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWindowText
    Font.Height = -24
    Font.Name = 'MS Sans Serif'
    Font.Style = [fsBold]
    ParentFont = False
  end
  object Edit1: TEdit
    Left = 20
    Top = 26
    Width = 121
    Height = 21
    TabOrder = 0
    Text = 'Jogador1'
  end
  object Edit2: TEdit
    Left = 380
    Top = 26
    Width = 121
    Height = 21
    TabOrder = 1
    Text = 'Jogador2'
  end
  object Timer1: TTimer
    OnTimer = Timer1Timer
    Left = 8
    Top = 264
  end
end
