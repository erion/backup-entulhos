object Form1: TForm1
  Left = 210
  Top = 128
  Width = 677
  Height = 477
  Caption = 'Bloco F'#233'tido'
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'MS Sans Serif'
  Font.Style = []
  Icon.Data = {
    000001000200101010000000000028010000260000002020100000000000E802
    00004E0100002800000010000000200000000100040000000000C00000000000
    0000000000000000000000000000000000000000800000800000008080008000
    00008000800080800000C0C0C000808080000000FF0000FF000000FFFF00FF00
    0000FF00FF00FFFF0000FFFFFF00000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
    FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
    FFFFFFFFFFFFFFFFFFFFFFFFFFFF280000002000000040000000010004000000
    0000800200000000000000000000000000000000000000000000000080000080
    00000080800080000000800080008080000080808000C0C0C0000000FF0000FF
    000000FFFF00FF000000FF00FF00FFFF0000FFFFFF0000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    0000000000000000000000000000000000000000000000000000000000000000
    00000000000000000000000000000000000000000000FFFFFFFFFFFFFFFFFFFF
    FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
    FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
    FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
    FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF}
  Menu = MainMenu1
  OldCreateOrder = False
  WindowState = wsMaximized
  PixelsPerInch = 96
  TextHeight = 13
  object Memo1: TMemo
    Left = 0
    Top = 0
    Width = 1026
    Height = 722
    Lines.Strings = (
      '')
    TabOrder = 0
  end
  object MainMenu1: TMainMenu
    Left = 296
    Top = 104
    object Arquivo1: TMenuItem
      Caption = 'Arquivo'
      object Novo1: TMenuItem
        Caption = 'Novo'
        ShortCut = 16462
      end
      object Abrir1: TMenuItem
        Caption = 'Abrir...'
        ShortCut = 16463
      end
      object Salvar1: TMenuItem
        Caption = 'Salvar'
        ShortCut = 16467
      end
      object Salvarcomo1: TMenuItem
        Caption = 'Salvar como...'
      end
      object N1: TMenuItem
        Caption = '-'
      end
      object Configurarpgina1: TMenuItem
        Caption = 'Configurar p'#225'gina...'
      end
      object Imprimir1: TMenuItem
        Caption = 'Imprimir...'
        ShortCut = 16464
      end
      object N2: TMenuItem
        Caption = '-'
      end
      object extBridge1: TMenuItem
        Caption = 'TextBridge...'
      end
      object Sair1: TMenuItem
        Caption = 'Sair'
      end
    end
    object Editar1: TMenuItem
      Caption = 'Editar'
      object Desfazer1: TMenuItem
        Caption = 'Desfazer'
        ShortCut = 16474
      end
      object N3: TMenuItem
        Caption = '-'
      end
      object Recortar1: TMenuItem
        Caption = 'Recortar'
        ShortCut = 16472
      end
      object Copiar1: TMenuItem
        Caption = 'Copiar'
        ShortCut = 16451
      end
      object Colar1: TMenuItem
        Caption = 'Colar'
        ShortCut = 16470
      end
      object Excluir1: TMenuItem
        Caption = 'Excluir'
        ShortCut = 46
      end
      object N4: TMenuItem
        Caption = '-'
      end
      object Localizar1: TMenuItem
        Caption = 'Localizar...'
        ShortCut = 16454
      end
      object Localizarprxima1: TMenuItem
        Caption = 'Localizar pr'#243'xima'
        ShortCut = 114
      end
      object Substituir1: TMenuItem
        Caption = 'Substituir...'
        ShortCut = 16456
      end
      object Irpara1: TMenuItem
        Caption = 'Ir para...'
        ShortCut = 16455
      end
      object N5: TMenuItem
        Caption = '-'
      end
      object Selecionartudo1: TMenuItem
        Caption = 'Selecionar tudo'
        ShortCut = 16449
      end
      object HoraData1: TMenuItem
        Caption = 'Hora/Data'
        ShortCut = 116
      end
    end
    object Formatar1: TMenuItem
      Caption = 'Formatar'
      object Quebraautomticadelinhas1: TMenuItem
        Caption = 'Quebra autom'#225'tica de linhas'
        OnClick = Quebraautomticadelinhas1Click
      end
      object Fonte1: TMenuItem
        Caption = 'Fonte...'
        OnClick = Fonte1Click
      end
    end
    object Exibir1: TMenuItem
      Caption = 'Exibir'
      object BarradeStatus1: TMenuItem
        Caption = 'Barra de status'
      end
    end
    object Ajuda1: TMenuItem
      Caption = 'Ajuda'
      object SobreBlocoFtido1: TMenuItem
        Caption = 'Sobre Bloco F'#233'tido'
      end
    end
  end
end
