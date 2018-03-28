object Form3: TForm3
  Left = 295
  Top = 255
  BorderStyle = bsDialog
  Caption = 'Informa'#231#245'es de Jogo'
  ClientHeight = 147
  ClientWidth = 439
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'MS Sans Serif'
  Font.Style = []
  OldCreateOrder = False
  PixelsPerInch = 96
  TextHeight = 13
  object Memo1: TMemo
    Left = 0
    Top = 0
    Width = 437
    Height = 145
    Lines.Strings = (
      'Escolha seu personagem, distribua pontos como preferir.'
      'Pontos:'
      
        'For'#231'a: Dados de ataque caso em sua vez caia em um quadro j'#225' ocup' +
        'ado'
      
        'Destrteza: Dados de defesa caso algu'#233'm caia em um quadrado ocupa' +
        'do por voc'#234
      
        'Movimento: B'#244'nus de movimento. Ap'#243's andar, voc'#234' escolhe a dire'#231#227 +
        'o que quer andar'
      
        'a mais, ent'#227'o anda o equivalente a seu total de pontos. O uso de' +
        'sta habilidade '#233' opcional.'
      'Jogo:'
      
        'Cada cor no tabuleiro representa algo, batalha, item, passagem s' +
        'ecreta, etc.....'
      
        'O objetivo do jogo '#233' roubar ao menos um ovo de drag'#227'o e retornar' +
        ' para o in'#237'cio sem que '
      'algu'#233'm o ven'#231'a em batalha.')
    ReadOnly = True
    TabOrder = 0
  end
end
