unit uxadr;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, ExtCtrls, StdCtrls;

{
        ARRUMAR O DESTROY DE TMovimento
}

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
    procedure peaoBranco8Click(Sender: TObject);
  private
    { Private declarations }
    procedure PosicionaTabuleiro(a:timage;cor,posi,posi2:integer);   //Posiciona o tabuleiro
    procedure TabuleiroVirtual(pec,cor,oldX,oldY,newX,newY:integer); //Atualiza o tabsvitual
    procedure PosicionaPeca(a:timage;cor,pec,posi,posi2:integer);    //Posiciona peca para inicio do jogo
    procedure PeaoClick(peca:TImage;cor:integer);                    //Identifica o peao
    procedure TorreClick(peca:TImage);
    procedure CavaloClick(peca:TImage);
    procedure BispoClick(peca:TImage);
    procedure ReiClick(peca:TImage);
    procedure RainhaClick(peca:TImage);
    procedure MovimentoPeao(Inicial:Boolean; XAtual,YAtual:integer;ger:TImage);//Trata movimentos do peao
    procedure MovimentoTorre;
    procedure MovimentoCavalo;
    procedure MovimentoBispo;
    procedure MovimentoRei;
    procedure MovimentoRainha;
    procedure CriaMovimento(x,y:integer;ger:TImage);                 //Altera cor de onde pode se movimentar
    function GetPeca(tabx,taby:integer):integer;                     //Retorna codigo da peca na posicao x y
    function GetCor(tabx,taby:integer):integer;                      //Retorna cor da peca na posicao x y
    function GetPosXPeca(peca:TImage):integer;                       //Retorna coordenadas x da posicao em tabs da imagem
    function GetPosYPeca(peca:TImage):integer;                       //Retorna coordenadas y da posicao em tabs da imagem
  public
    procedure DestroyMovimento;
    { Public declarations }
  end;

  TMovimento = class
    private
      mImagem:TImage; //imagem de local dosponivel para movimento
      mX, mY:integer; //posicao no tabuleiro
      mCodigo:integer;//identificador
    public
      procedure MovimentaPeca(Sender:TObject);                         //Movimenta a peca
      procedure SetImagem(caminho:string);
      procedure SetPosicao(x,y:integer);
      procedure SetCodigo(codigo:integer);
      function GetCodigo():integer;
      function GetPosX(Sender:TObject):integer;
      function GetPosY(Sender:TObject):integer;
      constructor Create;
      destructor Destroy;
  end;

var
  Form1: TForm1;
  vez:boolean; //true->branca, false->preta
  movimento:boolean; //true->movimenta,false->nada
  tabMovimento: array [1..20] of TMovimento;
  tabVirtualPeca: array [1..8,1..8] of integer; //armazena o nmr da peca na posicao x,y; 9 = vazio
  tabVirtualCor: array [1..8,1..8] of integer;  //armazena o nmr da cor na posicao x,y; 9 = vazio
  pecaMovimento:TImage;

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

{
 cor: 0= branco 1=preto
 peca: 0:peao, 1:torre, 2:cavalo, 3:bispo, 4:rainha, 5:rei
 }

{************************************************************
*************** Minhas procedures e functions ***************
************************************************************}

{ TMovimento }

constructor TMovimento.Create;
begin
  mImagem := TImage.Create(nil);
  mImagem.OnClick := MovimentaPeca;
end;

destructor TMovimento.Destroy;
begin
//  FreeAndNil(mImagem);
  mImagem.Visible := false;
end;

function TMovimento.GetCodigo: integer;
begin
  result := mCodigo;
end;

procedure TMovimento.SetCodigo(codigo: integer);
begin
  mCodigo := codigo;
end;

procedure TMovimento.SetImagem(caminho: string);
begin
  mImagem.Picture.LoadFromFile(caminho);
  mImagem.Parent := Application.MainForm;
  mImagem.Visible := True;
  mImagem.Width := 64;
  mImagem.Height := 60;
  mImagem.BringToFront;
  mImagem.AutoSize := True;
end;

procedure TMovimento.SetPosicao(x, y: integer);
var
  i: integer;
begin
  mX := x;
  mY := y;

  mImagem.Top :=90;
  mImagem.left:=64;

  for i := 1 to y-1 do
    mImagem.Left:= mImagem.left + 56;
  for i := 1 to x-1 do
    mImagem.top:= mImagem.top + 54
end;

procedure TMovimento.MovimentaPeca(Sender:TObject);
begin
  pecaMovimento.Top := (Sender as TImage).Top;
  pecaMovimento.Left := (Sender as TImage).Left +20;
  showmessage('posx: '+ IntToStr(GetPosX(Sender))+' posy? '+IntToStr(GetPosY(Sender)));
  Form1.DestroyMovimento;
end;

function TMovimento.GetPosX(Sender:TObject): integer;
var
  a :integer;
begin
  a := (Sender as TImage).Top - 35;
  result := Round(a/54);
end;

function TMovimento.GetPosY(Sender:TObject): integer;
var
  a :integer;
begin
  a := (Sender as TImage).Left - 30;
  result := Round(a/56);
end;

{fim TMovimento}

procedure TForm1.posicionaTabuleiro(a:timage;cor,posi,posi2:integer);
{a = imagem que tem tabuleiro
 cor: 0= branco 1=preto
 posi: posicao do tabuleiro posi = Y posi2 = X}
var
  i:integer;
begin
  a.Top :=90;
  a.left:=64;
  case cor of
    0: a.Picture.LoadFromFile('tabuleiro_branco.bmp');
    1: a.Picture.LoadFromFile('tabuleiro_preto.bmp');
  end;

  for i := 1 to posi do
    a.Left:=a.left + 56;
  for i := 1 to posi2 do
    a.top:=a.top + 54

end;

procedure TForm1.TabuleiroVirtual(pec,cor,oldX,oldY,newX,newY:integer);
begin
  if ((oldX <> 0) and (oldY <> 0) and (pec <> 1) and (cor <> 0)) then // p/n buga pela torre b q tem 0,0 de coordenada inicial
  begin
    tabVirtualPeca[oldX+1,oldY+1] := 9;
    tabVirtualCor[oldX+1,oldY+1] := 9;
  end;
  tabVirtualPeca[newX+1,newY+1] := pec;
  tabVirtualCor[newX+1,newY+1] := cor;
end;

procedure TForm1.PosicionaPeca(a:timage;cor,pec,posi,posi2:integer);
{a = imagem que tem tabuleiro
 cor: 0= branco 1=preto
 peca: 0:peao, 1:torre, 2:cavalo, 3:bispo, 4:rainha, 5:rei
 posi: posicao do tabuleiro posi = Y posi2 = X}
var
  i:integer;
begin
  a.Top :=35;
  a.left:=30;
  case cor of
  0:begin
      case pec of
        0: a.Picture.LoadFromFile('peao_branco.bmp');
        1: a.Picture.LoadFromFile('torre_branco.bmp');
        2: a.Picture.LoadFromFile('cavalo_branco.bmp');
        3: a.Picture.LoadFromFile('bispo_branco.bmp');
        4: a.Picture.LoadFromFile('rainha_branco.bmp');
        5: a.Picture.LoadFromFile('rei_branco.bmp');
      end;
    end;
  1:begin
      case pec of
        0: a.Picture.LoadFromFile('peao_preto.bmp');
        1: a.Picture.LoadFromFile('torre_preto.bmp');
        2: a.Picture.LoadFromFile('cavalo_preto.bmp');
        3: a.Picture.LoadFromFile('bispo_preto.bmp');
        4: a.Picture.LoadFromFile('rainha_preto.bmp');
        5: a.Picture.LoadFromFile('rei_preto.bmp');
      end;
    end;
  end;

  for i := 0 to posi do
    a.Left := a.left + 56;
  for i := 0 to posi2 do
    a.top := a.top + 54;

  tabuleiroVirtual(pec,cor,0,0,posi2,posi);
end;

function TForm1.GetPeca(tabx, taby: integer): integer;
//retorna o nmr do código da peca na pocicao xy do tabuleiro
begin
  result := tabVirtualPeca[tabx,taby];
end;

function TForm1.GetCor(tabx, taby: integer): integer;
begin
  result := tabVirtualCor[tabx,taby];
end;

procedure TForm1.BispoClick(peca: TImage);
begin
//
end;

procedure TForm1.CavaloClick(peca: TImage);
begin
//
end;

procedure TForm1.PeaoClick(peca: TImage; cor:integer);
var
  x,y:integer;
begin
  if cor = 0 then
  begin
    if peca.Name = 'peaoBranco1' then
    begin
      pecaMovimento := peaoBranco1;
      if tabVirtualPeca[2,1] = 0 then
      begin
        MovimentoPeao(True,2,1,peca);
      end else
        MovimentoPeao(False,GetPosXPeca(peca),GetPosYPeca(peca),peca);
    end else
    if peca.Name = 'peaoBranco2' then
    begin
      pecaMovimento := peaoBranco2;
      if tabVirtualPeca[2,2] = 0 then
      begin
        MovimentoPeao(True,2,2,peca);
      end else
        MovimentoPeao(False,GetPosXPeca(peca),GetPosYPeca(peca),peca);
    end else
    if peca.Name = 'peaoBranco3' then
    begin
      pecaMovimento := peaoBranco3;
      if tabVirtualPeca[2,3] = 0 then
      begin
        MovimentoPeao(True,2,3,peca);
      end else
        MovimentoPeao(False,GetPosXPeca(peca),GetPosYPeca(peca),peca);
    end else
    if peca.Name = 'peaoBranco4' then
    begin
      pecaMovimento := peaoBranco4;
      if tabVirtualPeca[2,4] = 0 then
      begin
        MovimentoPeao(True,2,4,peca);
      end else
        MovimentoPeao(False,GetPosXPeca(peca),GetPosYPeca(peca),peca);
    end else
    if peca.Name = 'peaoBranco5' then
    begin
      pecaMovimento := peaoBranco5;
      if tabVirtualPeca[2,5] = 0 then
      begin
        MovimentoPeao(True,2,5,peca);
      end else
        MovimentoPeao(False,GetPosXPeca(peca),GetPosYPeca(peca),peca);
    end else
    if peca.Name = 'peaoBranco6' then
    begin
      pecaMovimento := peaoBranco6;
      if tabVirtualPeca[2,6] = 0 then
      begin
        MovimentoPeao(True,2,6,peca);
      end else
        MovimentoPeao(False,GetPosXPeca(peca),GetPosYPeca(peca),peca);
    end else
    if peca.Name = 'peaoBranco7' then
    begin
      pecaMovimento := peaoBranco7;
      if tabVirtualPeca[2,7] = 0 then
      begin
        MovimentoPeao(True,2,7,peca);
      end else
        MovimentoPeao(False,GetPosXPeca(peca),GetPosYPeca(peca),peca);
    end else
    if peca.Name = 'peaoBranco8' then
    begin
      pecaMovimento := peaoBranco8;
      if tabVirtualPeca[2,8] = 0 then
      begin
        MovimentoPeao(True,2,8,peca);
      end else
        MovimentoPeao(False,GetPosXPeca(peca),GetPosYPeca(peca),peca);
    end;
  end else
  begin
  //pecas pretas
  end;
end;

procedure TForm1.RainhaClick(peca: TImage);
begin
//
end;

procedure TForm1.ReiClick(peca: TImage);
begin
//
end;

procedure TForm1.TorreClick(peca: TImage);
begin
//
end;

procedure TForm1.MovimentoBispo;
begin
//
end;

procedure TForm1.MovimentoCavalo;
begin
//
end;

procedure TForm1.MovimentoPeao(Inicial:Boolean; XAtual,YAtual:integer;ger:TImage);
var
  i:integer;
begin
  if not movimento then
  begin
    movimento := true;
    if Inicial then
    begin
      CriaMovimento(XAtual+1,YAtual,ger);
      CriaMovimento(XAtual+2,YAtual,ger);
    end else
      CriaMovimento(XAtual+1,YAtual,ger)
  end;
end;

procedure TForm1.MovimentoRainha;
begin
//
end;

procedure TForm1.MovimentoRei;
begin
//
end;

procedure TForm1.MovimentoTorre;
begin
//
end;

function TForm1.GetPosXPeca(peca: TImage): integer;
//nmrs de acordo com a function posicionaPeca
var
  a :integer;
begin
  a := peca.Top - 35;
  result := Round(a/54);
end;

function TForm1.GetPosYPeca(peca: TImage): integer;
//nmrs de acordo com a function posicionaPeca
var
  a :integer;
begin
  a := peca.Left - 30;
  result := Round(a/56);
end;

procedure TForm1.CriaMovimento(x, y: integer;ger:TImage);
var
  i:integer;
begin
  i := 1;
  while tabMovimento[i] <> nil do
    Inc(i);

  tabMovimento[i] := TMovimento.Create;
  tabMovimento[i].SetImagem('movimento.bmp');
  tabMovimento[i].SetCodigo(i);
  tabMovimento[i].SetPosicao(x,y);
end;

procedure TForm1.DestroyMovimento;
var
  i:integer;
begin
  i := 1;
  while tabMovimento[i] <> nil do
  begin
    tabMovimento[i].Destroy;
    tabMovimento[i] := nil;
    Inc(i);
  end;
  movimento := False;
  pecaMovimento := nil;
end;

{************************************************************
*************** Fim das procedures e functions ***************
************************************************************}

{$R *.dfm}

procedure TForm1.FormCreate(Sender: TObject);
var
  i,j:integer;
begin
for i := 1 to 8 do
  for j := 1 to 8 do
  begin
    tabVirtualPeca[i,j] := 9;
    tabVirtualCor[i,j] := 9;
  end;
//tabuleiro
//coluna1
PosicionaTabuleiro(image1,1,0,0);
PosicionaTabuleiro(image2,0,1,0);
PosicionaTabuleiro(image3,1,2,0);
PosicionaTabuleiro(image4,0,3,0);
PosicionaTabuleiro(image5,1,4,0);
PosicionaTabuleiro(image6,0,5,0);
PosicionaTabuleiro(image7,1,6,0);
PosicionaTabuleiro(image8,0,7,0);
//coluna2
PosicionaTabuleiro(image9,0,0,1);
PosicionaTabuleiro(image10,1,1,1);
PosicionaTabuleiro(image11,0,2,1);
PosicionaTabuleiro(image12,1,3,1);
PosicionaTabuleiro(image13,0,4,1);
PosicionaTabuleiro(image14,1,5,1);
PosicionaTabuleiro(image15,0,6,1);
PosicionaTabuleiro(image16,1,7,1);
//coluna3
PosicionaTabuleiro(image17,1,0,2);
PosicionaTabuleiro(image18,0,1,2);
PosicionaTabuleiro(image19,1,2,2);
PosicionaTabuleiro(image20,0,3,2);
PosicionaTabuleiro(image21,1,4,2);
PosicionaTabuleiro(image22,0,5,2);
PosicionaTabuleiro(image23,1,6,2);
PosicionaTabuleiro(image24,0,7,2);
//coluna4
PosicionaTabuleiro(image25,0,0,3);
PosicionaTabuleiro(image26,1,1,3);
PosicionaTabuleiro(image27,0,2,3);
PosicionaTabuleiro(image28,1,3,3);
PosicionaTabuleiro(image29,0,4,3);
PosicionaTabuleiro(image30,1,5,3);
PosicionaTabuleiro(image31,0,6,3);
PosicionaTabuleiro(image32,1,7,3);
//coluna5
PosicionaTabuleiro(image33,1,0,4);
PosicionaTabuleiro(image34,0,1,4);
PosicionaTabuleiro(image35,1,2,4);
PosicionaTabuleiro(image36,0,3,4);
PosicionaTabuleiro(image37,1,4,4);
PosicionaTabuleiro(image38,0,5,4);
PosicionaTabuleiro(image39,1,6,4);
PosicionaTabuleiro(image40,0,7,4);
//coluna6
PosicionaTabuleiro(image41,0,0,5);
PosicionaTabuleiro(image42,1,1,5);
PosicionaTabuleiro(image43,0,2,5);
PosicionaTabuleiro(image44,1,3,5);
PosicionaTabuleiro(image45,0,4,5);
PosicionaTabuleiro(image46,1,5,5);
PosicionaTabuleiro(image47,0,6,5);
PosicionaTabuleiro(image48,1,7,5);
//coluna7
PosicionaTabuleiro(image49,1,0,6);
PosicionaTabuleiro(image50,0,1,6);
PosicionaTabuleiro(image51,1,2,6);
PosicionaTabuleiro(image52,0,3,6);
PosicionaTabuleiro(image53,1,4,6);
PosicionaTabuleiro(image54,0,5,6);
PosicionaTabuleiro(image55,1,6,6);
PosicionaTabuleiro(image56,0,7,6);
//coluna8
PosicionaTabuleiro(image57,0,0,7);
PosicionaTabuleiro(image58,1,1,7);
PosicionaTabuleiro(image59,0,2,7);
PosicionaTabuleiro(image60,1,3,7);
PosicionaTabuleiro(image61,0,4,7);
PosicionaTabuleiro(image62,1,5,7);
PosicionaTabuleiro(image63,0,6,7);
PosicionaTabuleiro(image64,1,7,7);
//pecas
//brancas
PosicionaPeca(torreBranca,0,1,0,0);
PosicionaPeca(cavaloBranco,0,2,1,0);
PosicionaPeca(bispoBranco,0,3,2,0);
PosicionaPeca(rainhaBranca,0,5,3,0);
PosicionaPeca(reiBranco,0,4,4,0);
PosicionaPeca(bispoBranco2,0,3,5,0);
PosicionaPeca(cavaloBranco2,0,2,6,0);
PosicionaPeca(torreBranca2,0,1,7,0);

PosicionaPeca(peaoBranco1,0,0,0,1);
PosicionaPeca(peaoBranco2,0,0,1,1);
PosicionaPeca(peaoBranco3,0,0,2,1);
PosicionaPeca(peaoBranco4,0,0,3,1);
PosicionaPeca(peaoBranco5,0,0,4,1);
PosicionaPeca(peaoBranco6,0,0,5,1);
PosicionaPeca(peaoBranco7,0,0,6,1);
PosicionaPeca(peaoBranco8,0,0,7,1);
//pretas
PosicionaPeca(torrePreta,1,1,0,7);
PosicionaPeca(cavaloPreto,1,2,1,7);
PosicionaPeca(bispoPreto,1,3,2,7);
PosicionaPeca(reiPreto,1,4,3,7);
PosicionaPeca(rainhaPreta,1,5,4,7);
PosicionaPeca(bispoPreto2,1,3,5,7);
PosicionaPeca(cavaloPreto2,1,2,6,7);
PosicionaPeca(torrePreta2,1,1,7,7);

PosicionaPeca(peaoPreto1,1,0,0,6);
PosicionaPeca(peaoPreto2,1,0,1,6);
PosicionaPeca(peaoPreto3,1,0,2,6);
PosicionaPeca(peaoPreto4,1,0,3,6);
PosicionaPeca(peaoPreto5,1,0,4,6);
PosicionaPeca(peaoPreto6,1,0,5,6);
PosicionaPeca(peaoPreto7,1,0,6,6);
PosicionaPeca(peaoPreto8,1,0,7,6);


{
// carrega imagens para movimentação de peças

TabuleiroMov(Image97);
TabuleiroMov(Image98);
TabuleiroMov(Image99);
TabuleiroMov(Image100);
TabuleiroMov(Image101);
TabuleiroMov(Image102);
TabuleiroMov(Image103);
TabuleiroMov(Image104);
TabuleiroMov(Image105);
TabuleiroMov(Image106);
TabuleiroMov(Image107);
TabuleiroMov(Image108);
TabuleiroMov(Image109);
TabuleiroMov(Image110);
TabuleiroMov(Image111);
}
end;

procedure TForm1.peaoBranco8Click(Sender: TObject);
begin
  PeaoClick((Sender as TImage),0);
end;

end.
