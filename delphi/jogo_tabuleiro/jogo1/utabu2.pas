unit utabu2;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, ExtCtrls, StdCtrls;

type
  TForm2 = class(TForm)
    Image1: TImage;
    Timer1: TTimer;
    Image2: TImage;
    Button1: TButton;
    Timer2: TTimer;
    Label1: TLabel;
    Label2: TLabel;
    Label3: TLabel;
    Label4: TLabel;
    Image3: TImage;
    Image4: TImage;
    Image5: TImage;
    Image6: TImage; //player 1
    Image7: TImage; //player 2
    Image8: TImage; //player 3
    Image9: TImage; //player 4
    procedure Timer1Timer(Sender: TObject);
    procedure FormClose(Sender: TObject; var Action: TCloseAction);
    procedure Button1Click(Sender: TObject);
    procedure Timer2Timer(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

const
  tam_qua = 55;   //tamanho de cada quadrado

var
  Form2: TForm2;
  anda:integer;    //numero que tirou no dado
  direcao:integer; //direção de movimento

implementation

uses utabu1, uinfo, utabu3;

{$R *.dfm}

{************************************************************
*************** Minhas procedures e functions ***************
************************************************************}

//rola dado
function dado():string;
var
a:integer;
begin
a:= random(5);
case a of
0:begin
  dado:='dado_um.bmp';
  anda:=1;
  end;
1:begin
  dado:='dado_dois.bmp';
  anda:=2;
  end;
2:begin
  dado:='dado_tres.bmp';
  anda:=3;
  end;
3:begin
  dado:='dado_quatro.bmp';
  anda:=4;
  end;
4:begin
  dado:='dado_cinco.bmp';
  anda:=5;
  end;
5:begin
  dado:='dado_seis.bmp';
  anda:=6;
  end;
end;
end;

//movimenta personagem
procedure movimento(image:timage;a:integer);
begin
case a of
1:begin
    image.Left:= image.Left + tam_qua;
  end;
2:begin
    image.Left:= image.Left - tam_qua;
  end;
3:begin
    image.top:= image.top + tam_qua;
  end;
4:begin
    image.top:= image.top - tam_qua;
  end;
end;
end;

{indica as opções de direções possíveis de movimento
1:cima
2:baixo
3:direita
4:esquerda}
procedure chama_direcao(pos1,pos2,pos3,pos4:boolean);
begin
if pos1 = true then
  begin
    form4.image1.visible:= true;
  end;
if pos2 = true then
  begin
    form4.image2.visible:= true;
  end;
if pos3 = true then
  begin
    form4.image3.visible:= true;
  end;
if pos4 = true then
  begin
    form4.image4.visible:= true;
  end;
form3.showmodal;
end;

{************************************************************
*************** Fim das procedures e functions ***************
************************************************************}

procedure TForm2.Timer1Timer(Sender: TObject);
begin
image1.Picture.LoadFromFile(dado);
end;

procedure TForm2.FormClose(Sender: TObject; var Action: TCloseAction);
begin
form1.close;
end;

procedure TForm2.Button1Click(Sender: TObject);
begin
timer1.Enabled:=true;
timer2.Enabled:=true;
end;

procedure TForm2.Timer2Timer(Sender: TObject);
begin
timer1.Enabled:=false;
timer2.Enabled:=false;
end;

end.
