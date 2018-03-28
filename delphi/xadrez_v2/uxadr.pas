unit uxadr;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, ExtCtrls, StdCtrls;

type
  TForm1 = class(TForm)
    Image1: TImage;
    Image2: TImage;
    Timer1: TTimer;
    Image3: TImage;
    Image4: TImage;
    Image5: TImage;
    Image6: TImage;
    Image7: TImage;
    Image8: TImage;
    Image9: TImage;
    Image10: TImage;
    Image11: TImage;
    Image12: TImage;
    Image13: TImage;
    Image14: TImage;
    Image15: TImage;
    Image16: TImage;
    Image17: TImage;
    Image18: TImage;
    Image19: TImage;
    Image20: TImage;
    Image21: TImage;
    Image22: TImage;
    Image23: TImage;
    Image24: TImage;
    Image25: TImage;
    Image26: TImage;
    Image27: TImage;
    Image28: TImage;
    Image29: TImage;
    Image30: TImage;
    Image31: TImage;
    Image32: TImage;
    Image33: TImage;
    Image34: TImage;
    Image35: TImage;
    Image36: TImage;
    Image37: TImage;
    Image38: TImage;
    Image39: TImage;
    Image40: TImage;
    Image41: TImage;
    Image42: TImage;
    Image43: TImage;
    Image44: TImage;
    Image45: TImage;
    Image46: TImage;
    Image47: TImage;
    Image48: TImage;
    Image49: TImage;
    Image50: TImage;
    Image51: TImage;
    Image52: TImage;
    Image53: TImage;
    Image54: TImage;
    Image55: TImage;
    Image56: TImage;
    Image57: TImage;
    Image58: TImage;
    Image59: TImage;
    Image60: TImage;
    Image61: TImage;
    Image62: TImage;
    Image63: TImage;
    Image64: TImage;
    Label1: TLabel;
    Label2: TLabel;
    Edit1: TEdit;
    Edit2: TEdit;
    torreBranca: TImage;
    cavaloBranco: TImage;
    BispoBranco: TImage;
    rainhaBranca: TImage;
    reiBranco: TImage;
    bispoBranco2: TImage;
    cavaloBranco2: TImage;
    torreBranca2: TImage;
    peaoBranco1: TImage;
    peaoBranco2: TImage;
    peaoBranco3: TImage;
    peaoBranco4: TImage;
    peaoBranco5: TImage;
    peaoBranco6: TImage;
    peaoBranco7: TImage;
    peaoBranco8: TImage;
    torrePreta: TImage;
    cavaloPreto: TImage;
    bispoPreto: TImage;
    reiPreto: TImage;
    rainhaPreta: TImage;
    bispoPreto2: TImage;
    cavaloPreto2: TImage;
    torrePreta2: TImage;
    peaoPreto1: TImage;
    peaoPreto2: TImage;
    peaoPreto3: TImage;
    peaoPreto4: TImage;
    peaoPreto5: TImage;
    peaoPreto6: TImage;
    peaoPreto7: TImage;
    peaoPreto8: TImage;
    Image97: TImage;
    Image98: TImage;
    Image99: TImage;
    Image100: TImage;
    Image101: TImage;
    Image102: TImage;
    Image103: TImage;
    Image104: TImage;
    Image105: TImage;
    Image106: TImage;
    Image107: TImage;
    Image108: TImage;
    Image109: TImage;
    Image110: TImage;
    Image111: TImage;
    procedure FormCreate(Sender: TObject);
  private
    { Private declarations }
    procedure posiciona_tabuleiro(a:timage;cor,posi,posi2:integer);
    procedure tabuleiroVirtual(a:timage;cor,pec,x,y:integer);
    procedure posiciona_peca(a:timage;cor,pec,posi,posi2:integer);
    procedure corTabuleiroMov(a:TImage);
    procedure peao(a,b:timage;x,y:integer);
  public
    { Public declarations }
  end;

var
  Form1: TForm1;
  vez:boolean; //true->branca, false->preta
  movimento:boolean; //true->movimenta,false->nada

  type jogo = record
         posicao: array[1..8,1..8] of integer;
         imagem: TImage;
       end;
  type peca = record
         pecap: array[1..16] of jogo;
         pecab: array[1..16] of jogo;
       end;

implementation

{***********************************************************
                     DICIONÁRIO DE IMAGENS

1 à 64-> tabuleiro

65 à 80-> peça preta:
65-> torre
66-> cavalo
67-> bispo
68-> rainha
69-> rei
70-> bispo
71-> cavalo
72-> torre
73 à 80 -> peão

80 à 96-> peça branca:
81-> torre
82-> cavalo
83-> bispo
84-> rainha
85-> rei
86-> bispo
87-> cavalo
88-> torre
89 à 96 -> peão

97 à 111-> jogada; onde a peça pode andar
***********************************************************}

{************************************************************
*************** Minhas procedures e functions ***************
************************************************************}

procedure TForm1.posiciona_tabuleiro(a:timage;cor,posi,posi2:integer);
{a = imagem que tem tabuleiro
 cor: 0= branco 1=preto
 posi: posicao do tabuleiro}
var
i,j:integer;
begin
  a.Top :=90;
  a.left:=64;
case cor of
0:begin
    a.Picture.LoadFromFile('tabuleiro_branco.bmp');
  end;
1:begin
    a.Picture.LoadFromFile('tabuleiro_preto.bmp');
  end;
end;
for i:= 1 to posi do
  begin
    a.Left:=a.left + 56;
  end;
for j:= 1 to posi2 do
  begin
    a.top:=a.top + 54
  end;
end;

procedure TForm1.tabuleiroVirtual(a:timage;cor,pec,x,y:integer);
//atualiza tabuleiro virtual
var
p:peca;
j:jogo;
begin
case cor of
0:begin //branca
    p.pecab[pec].posicao[x,y]:= pec;
    p.pecab[pec].imagem := a;
    showmessage(IntToStr(p.pecab[pec].posicao[x,y]) + ' ' + IntToStr(x) + ' ' + IntToStr(y) + ' ' + a.Name);
  end;
1:begin //preta
    p.pecap[pec].posicao[x,y]:= pec;
    p.pecap[pec].imagem := a;
    showmessage(IntToStr(p.pecab[pec].posicao[x,y]) + ' ' + IntToStr(x) + ' ' + IntToStr(y) + ' ' + a.Name);
  end;
end;
end;

procedure TForm1.posiciona_peca(a:timage;cor,pec,posi,posi2:integer);
{a = imagem que tem tabuleiro
 cor: 0= branco 1=preto
 peca: 0:peao, 1:torre, 2:cavalo, 3:bispo, 4:rainha, 5:rei
 posi: posicao do tabuleiro}
var
i,j:integer;
begin
  a.Top :=35;
  a.left:=30;
case cor of
0:begin
    case pec of
    0:begin
        a.Picture.LoadFromFile('peao_branco.bmp');
      end;
    1:begin
        a.Picture.LoadFromFile('torre_branco.bmp');
      end;
    2:begin
        a.Picture.LoadFromFile('cavalo_branco.bmp');
      end;
    3:begin
        a.Picture.LoadFromFile('bispo_branco.bmp');
      end;
    4:begin
        a.Picture.LoadFromFile('rainha_branco.bmp');
      end;
    5:begin
        a.Picture.LoadFromFile('rei_branco.bmp');
      end;
    end;
  end;
1:begin
    case pec of
    0:begin
        a.Picture.LoadFromFile('peao_preto.bmp');
      end;
    1:begin
        a.Picture.LoadFromFile('torre_preto.bmp');
      end;
    2:begin
        a.Picture.LoadFromFile('cavalo_preto.bmp');
      end;
    3:begin
        a.Picture.LoadFromFile('bispo_preto.bmp');
      end;
    4:begin
        a.Picture.LoadFromFile('rainha_preto.bmp');
      end;
    5:begin
        a.Picture.LoadFromFile('rei_preto.bmp');
      end;
    end;
  end;
end;
for i:= 0 to posi do
  begin
    a.Left:=a.left + 56;
  end;
for j:= 0 to posi2 do
  begin
    a.top:=a.top + 54;
  end;
//tabuleiroVirtual(a,cor,pec,posi,posi2);
end;

procedure TForm1.corTabuleiroMov(a:TImage);
//altera imagem onde a peça pode se movimentar
begin
  a.Picture.LoadFromFile('movimento.bmp');
  a.Visible := false;
end;

procedure TForm1.peao(a,b:timage;x,y:integer);
//restringe movimento do peao
begin
  y:=y+1;
  posiciona_tabuleiro(b,0,x,y);
end;

{************************************************************
*************** Fim das procedures e functions ***************
************************************************************}

{$R *.dfm}

procedure TForm1.FormCreate(Sender: TObject);
begin
//tabuleiro
//coluna1
posiciona_tabuleiro(image1,1,0,0);
posiciona_tabuleiro(image2,0,1,0);
posiciona_tabuleiro(image3,1,2,0);
posiciona_tabuleiro(image4,0,3,0);
posiciona_tabuleiro(image5,1,4,0);
posiciona_tabuleiro(image6,0,5,0);
posiciona_tabuleiro(image7,1,6,0);
posiciona_tabuleiro(image8,0,7,0);
//coluna2
posiciona_tabuleiro(image9,0,0,1);
posiciona_tabuleiro(image10,1,1,1);
posiciona_tabuleiro(image11,0,2,1);
posiciona_tabuleiro(image12,1,3,1);
posiciona_tabuleiro(image13,0,4,1);
posiciona_tabuleiro(image14,1,5,1);
posiciona_tabuleiro(image15,0,6,1);
posiciona_tabuleiro(image16,1,7,1);
//coluna3
posiciona_tabuleiro(image17,1,0,2);
posiciona_tabuleiro(image18,0,1,2);
posiciona_tabuleiro(image19,1,2,2);
posiciona_tabuleiro(image20,0,3,2);
posiciona_tabuleiro(image21,1,4,2);
posiciona_tabuleiro(image22,0,5,2);
posiciona_tabuleiro(image23,1,6,2);
posiciona_tabuleiro(image24,0,7,2);
//coluna4
posiciona_tabuleiro(image25,0,0,3);
posiciona_tabuleiro(image26,1,1,3);
posiciona_tabuleiro(image27,0,2,3);
posiciona_tabuleiro(image28,1,3,3);
posiciona_tabuleiro(image29,0,4,3);
posiciona_tabuleiro(image30,1,5,3);
posiciona_tabuleiro(image31,0,6,3);
posiciona_tabuleiro(image32,1,7,3);
//coluna5
posiciona_tabuleiro(image33,1,0,4);
posiciona_tabuleiro(image34,0,1,4);
posiciona_tabuleiro(image35,1,2,4);
posiciona_tabuleiro(image36,0,3,4);
posiciona_tabuleiro(image37,1,4,4);
posiciona_tabuleiro(image38,0,5,4);
posiciona_tabuleiro(image39,1,6,4);
posiciona_tabuleiro(image40,0,7,4);
//coluna6
posiciona_tabuleiro(image41,0,0,5);
posiciona_tabuleiro(image42,1,1,5);
posiciona_tabuleiro(image43,0,2,5);
posiciona_tabuleiro(image44,1,3,5);
posiciona_tabuleiro(image45,0,4,5);
posiciona_tabuleiro(image46,1,5,5);
posiciona_tabuleiro(image47,0,6,5);
posiciona_tabuleiro(image48,1,7,5);
//coluna7
posiciona_tabuleiro(image49,1,0,6);
posiciona_tabuleiro(image50,0,1,6);
posiciona_tabuleiro(image51,1,2,6);
posiciona_tabuleiro(image52,0,3,6);
posiciona_tabuleiro(image53,1,4,6);
posiciona_tabuleiro(image54,0,5,6);
posiciona_tabuleiro(image55,1,6,6);
posiciona_tabuleiro(image56,0,7,6);
//coluna8
posiciona_tabuleiro(image57,0,0,7);
posiciona_tabuleiro(image58,1,1,7);
posiciona_tabuleiro(image59,0,2,7);
posiciona_tabuleiro(image60,1,3,7);
posiciona_tabuleiro(image61,0,4,7);
posiciona_tabuleiro(image62,1,5,7);
posiciona_tabuleiro(image63,0,6,7);
posiciona_tabuleiro(image64,1,7,7);
//pecas
//brancas
posiciona_peca(torreBranca,0,1,0,0);
posiciona_peca(cavaloBranco,0,2,1,0);
posiciona_peca(bispoBranco,0,3,2,0);
posiciona_peca(rainhaBranca,0,5,3,0);
posiciona_peca(reiBranco,0,4,4,0);
posiciona_peca(bispoBranco2,0,3,5,0);
posiciona_peca(cavaloBranco2,0,2,6,0);
posiciona_peca(torreBranca2,0,1,7,0);

posiciona_peca(peaoBranco1,0,0,0,1);
posiciona_peca(peaoBranco2,0,0,1,1);
posiciona_peca(peaoBranco3,0,0,2,1);
posiciona_peca(peaoBranco4,0,0,3,1);
posiciona_peca(peaoBranco5,0,0,4,1);
posiciona_peca(peaoBranco6,0,0,5,1);
posiciona_peca(peaoBranco7,0,0,6,1);
posiciona_peca(peaoBranco8,0,0,7,1);
//pretas
posiciona_peca(torrePreta,1,1,0,7);
posiciona_peca(cavaloPreto,1,2,1,7);
posiciona_peca(bispoPreto,1,3,2,7);
posiciona_peca(reiPreto,1,4,3,7);
posiciona_peca(rainhaPreta,1,5,4,7);
posiciona_peca(bispoPreto2,1,3,5,7);
posiciona_peca(cavaloPreto2,1,2,6,7);
posiciona_peca(torrePreta2,1,1,7,7);

posiciona_peca(peaoPreto1,1,0,0,6);
posiciona_peca(peaoPreto2,1,0,1,6);
posiciona_peca(peaoPreto3,1,0,2,6);
posiciona_peca(peaoPreto4,1,0,3,6);
posiciona_peca(peaoPreto5,1,0,4,6);
posiciona_peca(peaoPreto6,1,0,5,6);
posiciona_peca(peaoPreto7,1,0,6,6);
posiciona_peca(peaoPreto8,1,0,7,6);
{
//armazena no tabuleiro virtual
//brancas
tabuleiroVirtual(torreBranca,0,1,0,0);
tabuleiroVirtual(cavaloBranco,0,2,1,0);
tabuleiroVirtual(bispoBranco,0,3,2,0);
tabuleiroVirtual(rainhaBranca,0,5,3,0);
tabuleiroVirtual(reiBranco,0,4,4,0);
tabuleiroVirtual(bispoBranco2,0,3,5,0);
tabuleiroVirtual(cavaloBranco2,0,2,6,0);
tabuleiroVirtual(torreBranca2,0,1,7,0);

tabuleiroVirtual(peaoBranco1,0,0,0,1);
tabuleiroVirtual(peaoBranco2,0,0,1,1);
tabuleiroVirtual(peaoBranco3,0,0,2,1);
tabuleiroVirtual(peaoBranco4,0,0,3,1);
tabuleiroVirtual(peaoBranco5,0,0,4,1);
tabuleiroVirtual(peaoBranco6,0,0,5,1);
tabuleiroVirtual(peaoBranco7,0,0,6,1);
tabuleiroVirtual(peaoBranco8,0,0,7,1);
//pretas
tabuleiroVirtual(torrePreta,1,1,0,7);
tabuleiroVirtual(cavaloPreto,1,2,1,7);
tabuleiroVirtual(bispoPreto,1,3,2,7);
tabuleiroVirtual(reiPreto,1,4,3,7);
tabuleiroVirtual(rainhaPreta,1,5,4,7);
tabuleiroVirtual(bispoPreto2,1,3,5,7);
tabuleiroVirtual(cavaloPreto2,1,2,6,7);
tabuleiroVirtual(torrePreta2,1,1,7,7);

tabuleiroVirtual(peaoPreto1,1,0,0,6);
tabuleiroVirtual(peaoPreto2,1,0,1,6);
tabuleiroVirtual(peaoPreto3,1,0,2,6);
tabuleiroVirtual(peaoPreto4,1,0,3,6);
tabuleiroVirtual(peaoPreto5,1,0,4,6);
tabuleiroVirtual(peaoPreto6,1,0,5,6);
tabuleiroVirtual(peaoPreto7,1,0,6,6);
tabuleiroVirtual(peaoPreto8,1,0,7,6);
}

// carrega imagens para movimentação de peças

corTabuleiroMov(Image97);
corTabuleiroMov(Image98);
corTabuleiroMov(Image99);
corTabuleiroMov(Image100);
corTabuleiroMov(Image101);
corTabuleiroMov(Image102);
corTabuleiroMov(Image103);
corTabuleiroMov(Image104);
corTabuleiroMov(Image105);
corTabuleiroMov(Image106);
corTabuleiroMov(Image107);
corTabuleiroMov(Image108);
corTabuleiroMov(Image109);
corTabuleiroMov(Image110);
corTabuleiroMov(Image111);
end;
end.
