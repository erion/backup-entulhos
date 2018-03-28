unit uxadrez;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, ExtCtrls, StdCtrls;

type
  TForm1 = class(TForm)
    Label1: TLabel;
    Label2: TLabel;
    Edit1: TEdit;
    Edit2: TEdit;
    Image1: TImage;
    Image2: TImage;
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
    Timer1: TTimer;
    Label3: TLabel;
    Label4: TLabel;
    Label5: TLabel;
    procedure FormCreate(Sender: TObject);
    procedure Image17Click(Sender: TObject);
    procedure Image10Click(Sender: TObject);
    procedure Image11Click(Sender: TObject);
    procedure Image12Click(Sender: TObject);
    procedure Image13Click(Sender: TObject);
    procedure Image14Click(Sender: TObject);
    procedure Image15Click(Sender: TObject);
    procedure Image16Click(Sender: TObject);
    procedure Image9Click(Sender: TObject);
    procedure Image2Click(Sender: TObject);
    procedure Image3Click(Sender: TObject);
    procedure Image4Click(Sender: TObject);
    procedure Image5Click(Sender: TObject);
    procedure Image6Click(Sender: TObject);
    procedure Image7Click(Sender: TObject);
    procedure Image8Click(Sender: TObject);
    procedure Image18Click(Sender: TObject);
    procedure Image20Click(Sender: TObject);
    procedure Image19Click(Sender: TObject);
    procedure Image22Click(Sender: TObject);
    procedure Image21Click(Sender: TObject);
    procedure Image23Click(Sender: TObject);
    procedure Image24Click(Sender: TObject);
    procedure Image25Click(Sender: TObject);
    procedure Image26Click(Sender: TObject);
    procedure Image27Click(Sender: TObject);
    procedure Image28Click(Sender: TObject);
    procedure Image29Click(Sender: TObject);
    procedure Image30Click(Sender: TObject);
    procedure Image31Click(Sender: TObject);
    procedure Image32Click(Sender: TObject);
    procedure Image33Click(Sender: TObject);
    procedure Timer1Timer(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  Form1: TForm1;
  vez: boolean; //true branco, false preto
  {armazena espaço em branco ou preenchido do tabuleiro
  0- vazio
  1- peça preta
  2- peça branca}
  tabuleiro: array[1..8,1..8] of integer;
  type jogo = record
         posicao: array[1..2] of integer;
         imagem: TImage;
       end;
  type peca = record
         pecap: array[1..16] of jogo;
         pecab: array[1..16] of jogo;
       end;

{************************************************************
pecap:
1- torre
2- cavalo
3- bispo
4- rainha
5- rei
6- bispo
7- cavalo
8- torre
9 a 16 - peão

pecab:
1- torre
2- cavalo
3- bispo
4- rainha
5- rei
6- bispo
7- cavalo
8- torre
9 a 16 - peão
*************************************************************}


{************************************************************
                        DICIONÁRIO DE IMAGENS:

1- Tabuleiro

Peças Pretas:
2- Torre
3- Cavalo
4- Bispo
5- Rei
6- Rainha
7- Bispo
8- Cavalo
9- Torre
10 a 17- Peão

Peças Brancas:
18- Torre
19- Cavalo
20- Bispo
21- Rainha
22- Rei
23- Bispo
24- Cavalo
25- Torre
26 a 33- Peão

************************************************************}

implementation

uses Uxadrez_movimento;

{$R *.dfm}

{************************************************************
*************** Minhas procedures e functions ***************
************************************************************}

//
function testa_vez(a:integer):boolean;
var
cont:integer;
begin
cont:=0;
  case a of
  0:begin
      if vez = true then
        begin
          showmessage('Movimento pertence as peças brancas!');
          testa_vez:= true;
          cont:= +1;
        end;
    end;
  1:begin
      if vez = false then
        begin
          showmessage('Movimento pertence as peças pretas!');
          testa_vez:= true;
          cont:= +1;
        end;
    end;
  end;
if cont = 0 then
  begin
    testa_vez:= false;
    if vez = true then
      vez:= false
    else
      vez:= true;
  end;
end;
//todos os radiogroup do form2 desmarcam
procedure zera_radiogroup();
begin
form2.RadioGroup1.ItemIndex:= -1;
form2.RadioGroup2.ItemIndex:= -1;
form2.RadioGroup3.ItemIndex:= -1;
form2.RadioGroup4.ItemIndex:= -1;
end;

//controla tabuleiro, vazio ou ocupado por peca preta/branca
{procedure controle(pecas:integer);
var
x,y:integer;
p: peca;
begin
if form2.RadioGroup2.ItemIndex <> -1 then
  begin
    x:= form2.RadioGroup2.ItemIndex;
  end
else
  begin
    x:=
  end;
if form2.RadioGroup1.ItemIndex <> -1 then
  begin
    y:= form2.RadioGroup1.ItemIndex;
  end;
end;}

//posiciona peças para início de jogo
procedure posiciona(a:timage; x,y:integer);
var
i,j:integer;
begin
a.Top:=48;
a.Left:=39;
for i:=1 to x - 1 do
  begin
    a.Left := a.Left + 58;
  end;
for j := 1 to y - 1 do
  begin
    a.Top:= a.Top + 56;
  end;
end;

//restrições de movimento do peão
procedure peao(a:timage);
begin
  if  form2.RadioGroup1.ItemIndex = 0 then
    begin
      case form2.RadioGroup4.ItemIndex of
        0: a.Top:= a.Top - 55;
        1: a.Top:= a.Top + 55;
      end;
    end;
end;

//restrições de movimento da torre
procedure torre(a:timage);
var
b,i:integer;
begin
  if form2.RadioGroup1.ItemIndex = -1 then
    begin
      b:= form2.RadioGroup2.ItemIndex + 1;
      if form2.RadioGroup3.ItemIndex = 0 then
        begin
          for i := 1 to b do
            begin
              a.left:= a.left - 60;
            end;
        end;
      if form2.RadioGroup3.ItemIndex = 1 then
        for i := 1 to b do
          begin
            a.left:= a.left + 60;
          end;
    end;
  if form2.RadioGroup2.ItemIndex = -1 then
    begin
      b:= form2.RadioGroup1.ItemIndex + 1;
      if form2.RadioGroup4.ItemIndex = 0 then
        begin
          for i := 1 to b do
            begin
              a.top:=a.top - 55;
            end;
        end;
      if form2.RadioGroup4.ItemIndex = 1 then
        begin
          for i := 1 to b do
            begin
              a.top:=a.top + 55;
            end;
        end;
    end;
  if  form2.RadioGroup2.ItemIndex
  and form2.RadioGroup4.ItemIndex = -1 then
    begin
      showmessage('Escolha uma direção para movimento');
    end;
end;

//restrições de movimento do cavalo
procedure cavalo(a:timage);
var
i:integer;
begin
  if form2.RadioGroup1.ItemIndex = 1 then
    begin
      if form2.RadioGroup2.ItemIndex = 0 then
        begin
          for i:=1 to form2.RadioGroup1.ItemIndex + 1 do
            begin
              case form2.RadioGroup4.ItemIndex of
              0:begin
                  a.Top:= a.Top - 55;
                end;
              1:begin
                  a.Top:= a.Top + 55;
                end;
              end;
            end;
          case form2.RadioGroup3.ItemIndex of
          0:begin
              a.Left:= a.Left - 60;
            end;
          1:begin
              a.Left:= a.Left + 60;
            end;
          end;
        end;
    end;
  if form2.RadioGroup1.ItemIndex = 0 then
    begin
      if form2.RadioGroup2.ItemIndex = 1 then
        begin
          for i:=1 to form2.RadioGroup2.ItemIndex + 1 do
            begin
              case form2.RadioGroup3.ItemIndex of
              0:begin
                a.left:= a.left - 60;
                end;
              1:begin
                a.left:= a.left + 60;
                end;
              end;
            end;
          case form2.RadioGroup4.ItemIndex of
          0:begin
              a.top:= a.top - 55;
            end;
          1:begin
              a.top:= a.top + 55;
            end;
          end;
        end;
    end;
end;

//restrições de movimento do bispo
procedure bispo(a:timage);
var
b,i:integer;
begin
if form2.RadioGroup1.ItemIndex = form2.RadioGroup2.ItemIndex then
  begin
    case form2.RadioGroup4.ItemIndex of
    0:begin
        b:= form2.RadioGroup1.ItemIndex + 1;
        for i:=1 to b do
          begin
            a.Top:= a.Top - 55;
          end;
      end;
    1:begin
        b:= form2.RadioGroup1.ItemIndex + 1;
        for i:=1 to b do
          begin
            a.Top:= a.Top + 55;
          end;
      end;
    end;
    case form2.RadioGroup3.ItemIndex of
    0:begin
        b:= form2.RadioGroup2.ItemIndex + 1;
        for i:=1 to b do
          begin
            a.left:= a.left - 60;
          end;
      end;
    1:begin
        b:= form2.RadioGroup2.ItemIndex + 1;
        for i:=1 to b do
          begin
            a.left:= a.left + 60;
          end;
      end;
    end;
  end
  else
    begin
      showmessage('Movimento inválido!');
    end;
end;

//restrições de movimento do rei
procedure rei(a:timage);
begin
  if  form2.RadioGroup1.ItemIndex
  and form2.RadioGroup2.ItemIndex <> 0 then
    begin
      showmessage('Jogada invalida');
    end
  else
    begin
      case form2.RadioGroup4.ItemIndex of
      0:begin
          a.top := a.top - 55;
        end;
      1:begin
          a.Top := a.Top + 55;
        end;
      end;
      case form2.RadioGroup3.ItemIndex of
      0:begin
          a.left := a.left - 60;
        end;
      1:begin
          a.left := a.left + 60;
        end;
      end;
    end;
end;

//restrições de movimento do rainha
procedure rainha(a:timage);
var
b,i:integer;
begin
if form2.RadioGroup1.ItemIndex = form2.RadioGroup2.ItemIndex then
  begin
    case form2.RadioGroup4.ItemIndex of
    0:begin
        b:= form2.RadioGroup1.ItemIndex + 1;
        for i:=1 to b do
          begin
            a.Top:= a.Top - 55;
          end;
      end;
    1:begin
        b:= form2.RadioGroup1.ItemIndex + 1;
        for i:=1 to b do
          begin
            a.Top:= a.Top + 55;
          end;
      end;
    end;
    case form2.RadioGroup3.ItemIndex of
    0:begin
        b:= form2.RadioGroup2.ItemIndex + 1;
        for i:=1 to b do
          begin
            a.left:= a.left - 60;
          end;
      end;
    1:begin
        b:= form2.RadioGroup2.ItemIndex + 1;
        for i:=1 to b do
          begin
            a.left:= a.left + 60;
          end;
      end;
    end;
  end
  else
    begin
      if form2.RadioGroup1.ItemIndex = -1 then
        begin
          b:= form2.RadioGroup2.ItemIndex + 1;
          if form2.RadioGroup3.ItemIndex = 0 then
            begin
              for i := 1 to b do
                begin
                  a.left:= a.left - 60;
                end;
            end;
          if form2.RadioGroup3.ItemIndex = 1 then
            for i := 1 to b do
              begin
                a.left:= a.left + 60;
              end;
        end;
      if form2.RadioGroup2.ItemIndex = -1 then
        begin
          b:= form2.RadioGroup1.ItemIndex + 1;
          if form2.RadioGroup4.ItemIndex = 0 then
            begin
              for i := 1 to b do
                begin
                  a.top:=a.top - 55;
                end;
            end;
          if form2.RadioGroup4.ItemIndex = 1 then
            begin
              for i := 1 to b do
                begin
                  a.top:=a.top + 55;
                end;
            end;
        end;
    end;
end;

{************************************************************
*************** Fim das procedures e functions **************
************************************************************}

procedure TForm1.FormCreate(Sender: TObject);
var
p: peca;
begin
vez:= true;    //brancas começam
// tabuleiro
image1.Picture.LoadFromFile('tabuleiro.bmp');
{***********************  peças pretas  **********************}
posiciona(image2,1,1);
image2.Picture.LoadFromFile('torre_preto.bmp');
tabuleiro[1,1]:=1;
p.pecap[1].posicao[1]:=1;
p.pecap[1].posicao[2]:=1;
p.pecap[1].imagem:=image2;
//
posiciona(image3,2,1);
image3.Picture.LoadFromFile('cavalo_preto.bmp');
tabuleiro[2,1]:=1;
p.pecap[2].posicao[1]:=2;
p.pecap[2].posicao[2]:=1;
p.pecap[2].imagem:=image3;
//
posiciona(image4,3,1);
image4.Picture.LoadFromFile('bispo_preto.bmp');
tabuleiro[3,1]:=1;
p.pecap[3].posicao[1]:=3;
p.pecap[3].posicao[2]:=1;
p.pecap[3].imagem:=image4;
//
posiciona(image5,4,1);
image5.Picture.LoadFromFile('rei_preto.bmp');
tabuleiro[4,1]:=1;
p.pecap[5].posicao[1]:=4;
p.pecap[5].posicao[2]:=1;
p.pecap[5].imagem:=image5;
//
posiciona(image6,5,1);
image6.Picture.LoadFromFile('rainha_preto.bmp');
tabuleiro[5,1]:=1;
p.pecap[4].posicao[1]:=5;
p.pecap[4].posicao[2]:=1;
p.pecap[4].imagem:=image6;
//
posiciona(image7,6,1);
image7.Picture.LoadFromFile('bispo_preto.bmp');
tabuleiro[6,1]:=1;
p.pecap[6].posicao[1]:=6;
p.pecap[6].posicao[2]:=1;
p.pecap[6].imagem:=image7;
//
posiciona(image8,7,1);
image8.Picture.LoadFromFile('cavalo_preto.bmp');
tabuleiro[7,1]:=1;
p.pecap[7].posicao[1]:=7;
p.pecap[7].posicao[2]:=1;
p.pecap[7].imagem:=image8;
//
posiciona(image9,8,1);
image9.Picture.LoadFromFile('torre_preto.bmp');
tabuleiro[8,1]:=1;
p.pecap[8].posicao[1]:=8;
p.pecap[8].posicao[2]:=1;
p.pecap[8].imagem:=image9;
//
posiciona(image10,1,2);
image10.Picture.LoadFromFile('peao_preto.bmp');
tabuleiro[1,2]:=1;
p.pecap[9].posicao[1]:=1;
p.pecap[9].posicao[2]:=2;
p.pecap[9].imagem:=image10;
//
posiciona(image11,2,2);
image11.Picture.LoadFromFile('peao_preto.bmp');
tabuleiro[2,2]:=1;
p.pecap[10].posicao[1]:=2;
p.pecap[10].posicao[2]:=2;
p.pecap[10].imagem:=image11;
//
posiciona(image12,3,2);
image12.Picture.LoadFromFile('peao_preto.bmp');
tabuleiro[3,2]:=1;
p.pecap[11].posicao[1]:=3;
p.pecap[11].posicao[2]:=2;
p.pecap[11].imagem:=image12;
//
posiciona(image13,4,2);
image13.Picture.LoadFromFile('peao_preto.bmp');
tabuleiro[4,2]:=1;
p.pecap[12].posicao[1]:=4;
p.pecap[12].posicao[2]:=2;
p.pecap[12].imagem:=image13;
//
posiciona(image14,5,2);
image14.Picture.LoadFromFile('peao_preto.bmp');
tabuleiro[5,2]:=1;
p.pecap[13].posicao[1]:=5;
p.pecap[13].posicao[2]:=2;
p.pecap[13].imagem:=image14;
//
posiciona(image15,6,2);
image15.Picture.LoadFromFile('peao_preto.bmp');
tabuleiro[6,2]:=1;
p.pecap[14].posicao[1]:=6;
p.pecap[14].posicao[2]:=2;
p.pecap[14].imagem:=image15;
//
posiciona(image16,7,2);
image16.Picture.LoadFromFile('peao_preto.bmp');
tabuleiro[7,2]:=1;
p.pecap[15].posicao[1]:=7;
p.pecap[15].posicao[2]:=2;
p.pecap[15].imagem:=image16;
//
posiciona(image17,8,2);
image17.Picture.LoadFromFile('peao_preto.bmp');
tabuleiro[8,2]:=1;
p.pecap[16].posicao[1]:=8;
p.pecap[16].posicao[2]:=2;
p.pecap[16].imagem:=image17;
//
{**********************  peças brancas  *********************}
posiciona(image18,1,8);
image18.Picture.LoadFromFile('torre_branco.bmp');
tabuleiro[1,8]:=2;
p.pecab[1].posicao[1]:= 1;
p.pecab[1].posicao[2]:= 8;
p.pecab[1].imagem:= image18;
//
posiciona(image19,2,8);
image19.Picture.LoadFromFile('cavalo_branco.bmp');
tabuleiro[2,8]:=2;
p.pecab[2].posicao[1]:= 2;
p.pecab[2].posicao[2]:= 8;
p.pecab[2].imagem:= image19;
//
posiciona(image20,3,8);
image20.Picture.LoadFromFile('bispo_branco.bmp');
tabuleiro[3,8]:=2;
p.pecab[3].posicao[1]:= 3;
p.pecab[3].posicao[2]:= 8;
p.pecab[3].imagem:= image20;
//
posiciona(image21,4,8);
image21.Picture.LoadFromFile('rainha_branco.bmp');
tabuleiro[4,8]:=2;
p.pecab[4].posicao[1]:= 4;
p.pecab[4].posicao[2]:= 8;
p.pecab[4].imagem:= image21;
//
posiciona(image22,5,8);
image22.Picture.LoadFromFile('rei_branco.bmp');
tabuleiro[5,8]:=2;
p.pecab[5].posicao[1]:= 5;
p.pecab[5].posicao[2]:= 8;
p.pecab[5].imagem:= image22;
//
posiciona(image23,6,8);
image23.Picture.LoadFromFile('bispo_branco.bmp');
tabuleiro[6,8]:=2;
p.pecab[6].posicao[1]:= 6;
p.pecab[6].posicao[2]:= 8;
p.pecab[6].imagem:= image23;
//
posiciona(image24,7,8);
image24.Picture.LoadFromFile('cavalo_branco.bmp');
tabuleiro[7,8]:=2;
p.pecab[7].posicao[1]:= 7;
p.pecab[7].posicao[2]:= 8;
p.pecab[7].imagem:= image24;
//
posiciona(image25,8,8);
image25.Picture.LoadFromFile('torre_branco.bmp');
tabuleiro[8,8]:=2;
p.pecab[8].posicao[1]:= 8;
p.pecab[8].posicao[2]:= 8;
p.pecab[8].imagem:= image25;
//
posiciona(image26,1,7);
image26.Picture.LoadFromFile('peao_branco.bmp');
tabuleiro[1,7]:=2;
p.pecab[9].posicao[1]:= 1;
p.pecab[9].posicao[2]:= 7;
p.pecab[9].imagem:= image26;
//
posiciona(image27,2,7);
image27.Picture.LoadFromFile('peao_branco.bmp');
tabuleiro[2,7]:=2;
p.pecab[10].posicao[1]:= 2;
p.pecab[10].posicao[2]:= 7;
p.pecab[10].imagem:= image27;
//
posiciona(image28,3,7);
image28.Picture.LoadFromFile('peao_branco.bmp');
tabuleiro[3,7]:=2;
p.pecab[11].posicao[1]:= 3;
p.pecab[11].posicao[2]:= 7;
p.pecab[11].imagem:= image28;
//
posiciona(image29,4,7);
image29.Picture.LoadFromFile('peao_branco.bmp');
tabuleiro[4,7]:=2;
p.pecab[12].posicao[1]:= 4;
p.pecab[12].posicao[2]:= 7;
p.pecab[12].imagem:= image29;
//
posiciona(image30,5,7);
image30.Picture.LoadFromFile('peao_branco.bmp');
tabuleiro[5,7]:=2;
p.pecab[13].posicao[1]:= 5;
p.pecab[13].posicao[2]:= 7;
p.pecab[13].imagem:= image30;
//
posiciona(image31,6,7);
image31.Picture.LoadFromFile('peao_branco.bmp');
tabuleiro[6,7]:=2;
p.pecab[14].posicao[1]:= 6;
p.pecab[14].posicao[2]:= 7;
p.pecab[14].imagem:= image31;
//
posiciona(image32,7,7);
image32.Picture.LoadFromFile('peao_branco.bmp');
tabuleiro[7,7]:=2;
p.pecab[15].posicao[1]:= 7;
p.pecab[15].posicao[2]:= 7;
p.pecab[15].imagem:= image32;
//
posiciona(image33,8,7);
image33.Picture.LoadFromFile('peao_branco.bmp');
tabuleiro[8,7]:=2;
p.pecab[16].posicao[1]:= 8;
p.pecab[16].posicao[2]:= 7;
p.pecab[16].imagem:= image33;
//
end;

procedure TForm1.Image17Click(Sender: TObject);
begin
if testa_vez(0) = false then
  begin
    zera_radiogroup;
    form2.showmodal;
    peao(image17);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;    
end;

procedure TForm1.Image10Click(Sender: TObject);
begin
if testa_vez(0) = false then
  begin
    zera_radiogroup;
    form2.showmodal;
    peao(image10);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;    
end;

procedure TForm1.Image11Click(Sender: TObject);
begin
if testa_vez(0) = false then
  begin
    zera_radiogroup;
    form2.showmodal;
    peao(image11);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;    
end;

procedure TForm1.Image12Click(Sender: TObject);
begin
if testa_vez(0) = false then
  begin
    zera_radiogroup;
    form2.showmodal;
    peao(image12);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;    
end;

procedure TForm1.Image13Click(Sender: TObject);
begin
if testa_vez(0) = false then
  begin
    zera_radiogroup;
    form2.showmodal;
    peao(image13);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;    
end;

procedure TForm1.Image14Click(Sender: TObject);
begin
if testa_vez(0) = false then
  begin
    zera_radiogroup;
    form2.showmodal;
    peao(image14);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;
end;

procedure TForm1.Image15Click(Sender: TObject);
begin
if testa_vez(0) = false then
  begin
    zera_radiogroup;
    form2.showmodal;
    peao(image15);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;    
end;

procedure TForm1.Image16Click(Sender: TObject);
begin
if testa_vez(0) = false then
  begin
    zera_radiogroup;
    form2.showmodal;
    peao(image16);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;    
end;

procedure TForm1.Image9Click(Sender: TObject);
begin
if testa_vez(0) = false then
  begin
    zera_radiogroup;
    form2.ShowModal;
    torre(image9);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;    
end;

procedure TForm1.Image2Click(Sender: TObject);
begin
if testa_vez(0) = false then
  begin
    zera_radiogroup;
    form2.ShowModal;
    torre(image2);
    vez:= true;
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;
end;

procedure TForm1.Image3Click(Sender: TObject);
begin
if testa_vez(0) = false then
  begin
    zera_radiogroup;
    form2.ShowModal;
    cavalo(image3);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;    
end;

procedure TForm1.Image4Click(Sender: TObject);
begin
if testa_vez(0) = false then
  begin
    zera_radiogroup;
    form2.ShowModal;
    bispo(image4);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;
end;

procedure TForm1.Image5Click(Sender: TObject);
begin
if testa_vez(0) = false then
  begin
    zera_radiogroup;
    form2.ShowModal;
    rei(image5);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;    
end;

procedure TForm1.Image6Click(Sender: TObject);
begin
if testa_vez(0) = false then
  begin
    zera_radiogroup;
    form2.ShowModal;
    rainha(image6);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;     
end;

procedure TForm1.Image7Click(Sender: TObject);
begin
if testa_vez(0) = false then
  begin
    zera_radiogroup;
    form2.ShowModal;
    bispo(image7);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;    
end;

procedure TForm1.Image8Click(Sender: TObject);
begin
if testa_vez(0) = false then
  begin
    zera_radiogroup;
    form2.ShowModal;
    cavalo(image8);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;    
end;

procedure TForm1.Image18Click(Sender: TObject);
begin
if testa_vez(1) = false then
  begin
    zera_radiogroup;
    form2.showmodal;
    torre(image18);
    vez:= false;
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;
end;

procedure TForm1.Image20Click(Sender: TObject);
begin
if testa_vez(1) = false then
  begin
    zera_radiogroup;
    form2.ShowModal;
    bispo(image20);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;    
end;

procedure TForm1.Image19Click(Sender: TObject);
begin
if testa_vez(1) = false then
  begin
    zera_radiogroup;
    form2.ShowModal;
    cavalo(image19);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;    
end;

procedure TForm1.Image22Click(Sender: TObject);
begin
if testa_vez(1) = false then
  begin
    zera_radiogroup;
    form2.ShowModal;
    rei(image22);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;
end;

procedure TForm1.Image21Click(Sender: TObject);
begin
if testa_vez(1) = false then
  begin
    zera_radiogroup;
    form2.ShowModal;
    rainha(image21);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;    
end;

procedure TForm1.Image23Click(Sender: TObject);
begin
if testa_vez(1) = false then
  begin
    zera_radiogroup;
    form2.ShowModal;
    bispo(image23);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;
end;

procedure TForm1.Image24Click(Sender: TObject);
begin
if testa_vez(1) = false then
  begin
    zera_radiogroup;
    form2.ShowModal;
    cavalo(image24);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;    
end;

procedure TForm1.Image25Click(Sender: TObject);
begin
if testa_vez(1) = false then
  begin
    zera_radiogroup;
    form2.showmodal;
    torre(image25);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;    
end;

procedure TForm1.Image26Click(Sender: TObject);
begin
if testa_vez(1) = false then
  begin
    zera_radiogroup;
    form2.showmodal;
    peao(image26);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;    
end;

procedure TForm1.Image27Click(Sender: TObject);
begin
if testa_vez(1) = false then
  begin
    zera_radiogroup;
    form2.showmodal;
    peao(image27);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;    
end;

procedure TForm1.Image28Click(Sender: TObject);
begin
if testa_vez(1) = false then
  begin
    zera_radiogroup;
    form2.showmodal;
    peao(image28);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;    
end;

procedure TForm1.Image29Click(Sender: TObject);
begin
if testa_vez(1) = false then
  begin
    zera_radiogroup;
    form2.showmodal;
    peao(image29);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;    
end;

procedure TForm1.Image30Click(Sender: TObject);
begin
if testa_vez(1) = false then
  begin
    zera_radiogroup;
    form2.showmodal;
    peao(image30);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;    
end;

procedure TForm1.Image31Click(Sender: TObject);
begin
if testa_vez(1) = false then
  begin
    zera_radiogroup;
    form2.showmodal;
    peao(image31);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;    
end;

procedure TForm1.Image32Click(Sender: TObject);
begin
if testa_vez(1) = false then
  begin
    zera_radiogroup;
    form2.showmodal;
    peao(image32);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;     
end;

procedure TForm1.Image33Click(Sender: TObject);
begin
if testa_vez(1) = false then
  begin
    zera_radiogroup;
    form2.showmodal;
    peao(image33);
    label3.caption := inttostr(5);
    label5.caption := inttostr(00);
  end;    
end;

procedure TForm1.Timer1Timer(Sender: TObject);
begin
if strtoint(Label5.Caption) = 0 then
  begin
    label5.caption:= inttostr(60);
    label3.Caption:= inttostr(strtoint(label3.Caption) - 1);
  end;
label5.caption:= inttostr(strtoint(label5.Caption) - 1);
if strtoint(label3.caption) = 0 then
  begin
    showmessage('Tempo esgotado, você perdeu!');
  end;
end;

end.
