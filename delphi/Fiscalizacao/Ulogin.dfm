object frmLogin: TfrmLogin
  Left = 381
  Top = 297
  BorderStyle = bsNone
  Caption = 'Login'
  ClientHeight = 116
  ClientWidth = 230
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'MS Sans Serif'
  Font.Style = []
  OldCreateOrder = False
  Position = poDesktopCenter
  PixelsPerInch = 96
  TextHeight = 13
  object Label1: TLabel
    Left = 26
    Top = 32
    Width = 29
    Height = 13
    Caption = 'Login:'
  end
  object Label2: TLabel
    Left = 21
    Top = 75
    Width = 34
    Height = 13
    Caption = 'Senha:'
  end
  object edtUser: TEdit
    Left = 64
    Top = 29
    Width = 121
    Height = 21
    TabOrder = 0
  end
  object edtSenha: TMaskEdit
    Left = 64
    Top = 68
    Width = 121
    Height = 21
    PasswordChar = '*'
    TabOrder = 1
    OnKeyPress = edtSenhaKeyPress
  end
end
