unit Ujo_balak2;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, ExtCtrls, StdCtrls;

type
  TForm2 = class(TForm)
    Image1: TImage;
    Timer1: TTimer;
    Label1: TLabel;
    Timer2: TTimer;
    Image3: TImage;
    Image2: TImage;
    Image4: TImage;
    Timer3: TTimer;
    Timer4: TTimer;
    Image5: TImage;
    Image6: TImage;
    Image7: TImage;
    Image8: TImage;
    Timer5: TTimer;
    Image9: TImage;
    Timer6: TTimer;
    Timer7: TTimer;
    RadioButton1: TRadioButton;
    RadioButton2: TRadioButton;
    RadioButton3: TRadioButton;
    RadioButton4: TRadioButton;
    RadioButton5: TRadioButton;
    Timer8: TTimer;
    procedure Timer1Timer(Sender: TObject);
    procedure FormClose(Sender: TObject; var Action: TCloseAction);
    procedure Timer2Timer(Sender: TObject);
    procedure Timer3Timer(Sender: TObject);
    procedure Timer4Timer(Sender: TObject);
    procedure Timer5Timer(Sender: TObject);
    procedure Timer6Timer(Sender: TObject);
    procedure Timer7Timer(Sender: TObject);
    procedure Timer8Timer(Sender: TObject);
    procedure FormShow(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

const
  oponente = 5; //MAXIMO DE OPONENTES

var
  Form2: TForm2;
  vidaini:array[1..oponente] of integer; //VIDA DOS OPONENTES
  vida:integer;  //VIDA DO JOGADOR (MAXIMO 5)

implementation

uses Ujog_balak;

{$R *.dfm}

{************************************************************
****************MINHAS FUNÇÕES E PROCEDIMENTOS***************
*************************************************************}

//TESTE DE COLUSIAO DE DUAS IMAGENS
function colisao(var a,b:TImage):boolean;
begin
if b.Visible = true then
begin
  if  a.Top >= b.Top then
    begin
      if a.top <= b.Top + 40 then
        begin
          if a.left >= b.Left then
            begin
             if  a.Left <= b.Left + 40 then
               begin
                 colisao := true;
               end;
            end;
        end;
    end
  else
    begin
      colisao := false;
    end;
end;
end;

//MOVIMENTO DE INIMIGOS
function movimento(var a:integer):integer;
var
b:integer;
begin
b:=0;
  if a >= 570 then//NÃO SUMIR A DIREITA
    begin
      a:= a - 30;
      movimento:= a;
    end
  else
    begin
      if a <= 30 then//NÃO SUMIR A ESQUERDA
        begin
          a:= a + 30;
          movimento:= a;
        end
      else
        begin
            b:= random(4);
            case b of
            0:begin
              a:= a - 30;
              movimento:= a;
              end;
            1:begin
              a:= a + 30;
              movimento:= a;
              end;
            2:begin
              a:= a - 30;
              movimento := a;
              end;
            3:begin
              a:= a + 50;
              movimento := a;
              end;
            4:begin
              a:= a - 50;
              movimento := a;
              end;
            end;
        end;
    end;
end;

//TESTE DE VITORIA
procedure vitoria();
begin
  if  (vidaini[1]
  and  vidaini[2]
  and  vidaini[3]) >= 2 then // INIMIGOS TEM 2 PONTOS DE VIDA
    begin
      showmessage('Você venceu!!!');
      form1.close;
    end;
end;

//TESTE DE DERROTA
procedure derrota();
begin
  if vida = 5 then// VOCÊ TEM 5 PONTOS DE VIDA
    begin
      showmessage('Você perdeu!!!!');
      form1.close;
    end;
end;

{************************************************************
****************FIM DAS FUNÇÕES E PROCEDIMENTOS**************
*************************************************************}

procedure TForm2.Timer1Timer(Sender: TObject);
begin
image1.Top:= image1.Top - 5;
if image1.top = (-1000) then
  begin
    image1.Top := 0;
  end;
end;

procedure TForm2.FormClose(Sender: TObject; var Action: TCloseAction);
begin
form1.close;
end;

procedure TForm2.Timer2Timer(Sender: TObject);
var
posavi: array[1..5] of integer;
begin
//MOVIMENTOS DOS INIMIGOS
posavi[1] := image2.Left;
image2.Left:= movimento(posavi[1]);
posavi[2] := image3.Left;
image3.Left:= movimento(posavi[2]);
posavi[3] := image4.Left;
image4.Left:= movimento(posavi[3]);
end;

procedure TForm2.Timer3Timer(Sender: TObject);
begin
// POSICIONA OS MISSEIS INIMIGOS
{posiciona missel}
if image2.Visible = true then
begin
  image5.visible:= true;
  image5.left:= image2.Left;
  image5.top:= image2.top;
  timer4.Enabled:=true;
end;
{fim}
{posiciona missel}
if image3.Visible = true then
begin
  image6.visible:= true;
  image6.left:= image3.Left;
  image6.top:= image3.top;
  timer4.Enabled:=true;
end;
{fim}
{posiciona missel}
if image4.Visible = true then
begin
  image7.visible:= true;
  image7.left:= image4.Left;
  image7.top:= image4.top;
  timer4.Enabled:=true;
end;
{fim}
end;

procedure TForm2.Timer4Timer(Sender: TObject);
begin
//TIRO DOS INIMIGOS
image5.top:= image5.top - 30;
image6.top:= image6.top - 30;
image7.top:= image7.top - 30;
if colisao(image5,image8) = true then
  begin
    image5.visible:= false;
    vida := vida + 1;
    derrota;
  end;
if colisao(image6,image8) = true then
  begin
    image6.visible:= false;
    vida := vida + 1;
    derrota;
  end;
if colisao(image7,image8) = true then
  begin
    image7.visible:= false;
    vida := vida + 1;
    derrota;
  end;
case vida of
  1:radiobutton5.Visible:= false;
  2:radiobutton4.Visible:= false;
  3:radiobutton3.Visible:= false;
  4:radiobutton2.Visible:= false;
  5:radiobutton1.Visible:= false;
end;
end;

procedure TForm2.Timer5Timer(Sender: TObject);
var
posicao:integer;
begin
//MOVIMENTO DO JOGADOR
posicao := image8.Left;
if posicao < 580 then
  begin
    if GetKeyState(VK_RIGHT) < 0 then
      begin
        image8.Left:= image8.Left + 10;
      end;
  end;
if  posicao > 15 then
  begin
    if GetKeyState(VK_LEFT) < 0 then
      begin
        image8.Left:= image8.Left - 10;
      end;
  end;
end;

procedure TForm2.Timer6Timer(Sender: TObject);
begin
//TIRO DO JOGADOR
image9.Top := image9.Top + 30;
if colisao(image9,image2) = true then
  begin
    image9.visible := false;
    vidaini[1]:= vidaini[1] + 1;
    timer7.Enabled:=true;
    vitoria;
  end;
if colisao(image9,image3) = true then
  begin
    image9.visible := false;
    vidaini[2]:= vidaini[2] + 1;
    timer7.Enabled:=true;
    vitoria;
  end;
if colisao(image9,image4) = true then
  begin
    image9.visible := false;
    vidaini[3]:= vidaini[3] + 1;
    timer7.Enabled:=true;
    vitoria;
  end;
end;

procedure TForm2.Timer7Timer(Sender: TObject);
begin
//VALIDA VIDA DOS OPONENTES PARA ELES SUMIREM
if vidaini[1] >= 2 then
  begin
    image2.visible := false;
    vitoria;
  end;
if vidaini[2] >= 2 then
  begin
    image3.visible := false;
    vitoria;
  end;
if vidaini[3] >= 2 then
  begin
    image4.visible := false;
    vitoria;
  end;
timer7.Enabled:=false;
end;

procedure TForm2.Timer8Timer(Sender: TObject);
begin
{posiciona missel do jogador}
if GetKeyState(VK_SPACE) < 0 then
  begin
    image9.visible:= true;
    image9.left:= image8.Left;
    image9.top:= image8.top;
    timer6.Enabled:=true;
  end;
{fim}
end;

procedure TForm2.FormShow(Sender: TObject);
begin
image1.Picture.LoadFromFile('cenario2.bmp');
end;

end.
