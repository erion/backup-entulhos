unit ubola;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, ExtCtrls, StdCtrls;

type
  TForm1 = class(TForm)
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
    Image65: TImage;
    Image66: TImage;
    Image67: TImage;
    Image68: TImage;
    Image69: TImage;
    Image70: TImage;
    Image71: TImage;
    Image72: TImage;
    Image73: TImage;
    Image74: TImage;
    Image75: TImage;
    Image76: TImage;
    Image77: TImage;
    Image78: TImage;
    Image79: TImage;
    Image80: TImage;
    Label1: TLabel;
    Label2: TLabel;
    Edit1: TEdit;
    Edit2: TEdit;
    Label3: TLabel;
    Timer1: TTimer;
    Label4: TLabel;
    Timer2: TTimer;
    procedure Image80Click(Sender: TObject);
    procedure Image79Click(Sender: TObject);
    procedure Image78Click(Sender: TObject);
    procedure Image77Click(Sender: TObject);
    procedure Image76Click(Sender: TObject);
    procedure Image75Click(Sender: TObject);
    procedure Image74Click(Sender: TObject);
    procedure Image73Click(Sender: TObject);
    procedure Image72Click(Sender: TObject);
    procedure Image71Click(Sender: TObject);
    procedure Image70Click(Sender: TObject);
    procedure Image69Click(Sender: TObject);
    procedure Image68Click(Sender: TObject);
    procedure Image67Click(Sender: TObject);
    procedure Image66Click(Sender: TObject);
    procedure Image65Click(Sender: TObject);
    procedure Image64Click(Sender: TObject);
    procedure Image63Click(Sender: TObject);
    procedure Image62Click(Sender: TObject);
    procedure Image61Click(Sender: TObject);
    procedure Image60Click(Sender: TObject);
    procedure Image59Click(Sender: TObject);
    procedure Image58Click(Sender: TObject);
    procedure Image57Click(Sender: TObject);
    procedure Image56Click(Sender: TObject);
    procedure Image55Click(Sender: TObject);
    procedure Image54Click(Sender: TObject);
    procedure Image53Click(Sender: TObject);
    procedure Image52Click(Sender: TObject);
    procedure Image51Click(Sender: TObject);
    procedure Image50Click(Sender: TObject);
    procedure Image49Click(Sender: TObject);
    procedure Image48Click(Sender: TObject);
    procedure Image47Click(Sender: TObject);
    procedure Image46Click(Sender: TObject);
    procedure Image45Click(Sender: TObject);
    procedure Image44Click(Sender: TObject);
    procedure Image43Click(Sender: TObject);
    procedure Image42Click(Sender: TObject);
    procedure Image41Click(Sender: TObject);
    procedure Image40Click(Sender: TObject);
    procedure Image39Click(Sender: TObject);
    procedure Image38Click(Sender: TObject);
    procedure Image37Click(Sender: TObject);
    procedure Image36Click(Sender: TObject);
    procedure Image35Click(Sender: TObject);
    procedure Image34Click(Sender: TObject);
    procedure Image33Click(Sender: TObject);
    procedure Image32Click(Sender: TObject);
    procedure Image31Click(Sender: TObject);
    procedure Image21Click(Sender: TObject);
    procedure Image22Click(Sender: TObject);
    procedure Image30Click(Sender: TObject);
    procedure Image29Click(Sender: TObject);
    procedure Image28Click(Sender: TObject);
    procedure Image27Click(Sender: TObject);
    procedure Image26Click(Sender: TObject);
    procedure Image25Click(Sender: TObject);
    procedure Image24Click(Sender: TObject);
    procedure Image23Click(Sender: TObject);
    procedure Image20Click(Sender: TObject);
    procedure Image19Click(Sender: TObject);
    procedure Image18Click(Sender: TObject);
    procedure Image17Click(Sender: TObject);
    procedure Image16Click(Sender: TObject);
    procedure Image15Click(Sender: TObject);
    procedure Image14Click(Sender: TObject);
    procedure Image13Click(Sender: TObject);
    procedure Image12Click(Sender: TObject);
    procedure Image11Click(Sender: TObject);
    procedure Image10Click(Sender: TObject);
    procedure Image9Click(Sender: TObject);
    procedure Image8Click(Sender: TObject);
    procedure Image7Click(Sender: TObject);
    procedure Image6Click(Sender: TObject);
    procedure Image5Click(Sender: TObject);
    procedure Image4Click(Sender: TObject);
    procedure Image3Click(Sender: TObject);
    procedure Image2Click(Sender: TObject);
    procedure Image1Click(Sender: TObject);
    procedure Timer1Timer(Sender: TObject);
    procedure Timer2Timer(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  Form1: TForm1;
  vez:boolean;
  tab:array[1..8,1..10]of integer;


implementation

uses Unit2;

{$R *.dfm}

procedure TForm1.Image80Click(Sender: TObject);
begin
if tab[8,10] = 0 then
begin
  if vez = true then
    begin
      image80.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[8,10]:=2;
    end
  else
    begin
      image80.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[8,10]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image79Click(Sender: TObject);
begin
if tab[8,9] = 0 then
begin
  if vez = true then
    begin
      image79.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[8,9]:=2;
    end
  else
    begin
      image79.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[8,9]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image78Click(Sender: TObject);
begin
if tab[8,8] = 0 then
begin
  if vez = true then
    begin
      image78.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[8,8]:=2;
    end
  else
    begin
      image78.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[8,8]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image77Click(Sender: TObject);
begin
if tab[8,7] = 0 then
begin
  if vez = true then
    begin
      image77.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[8,7]:=2;
    end
  else
    begin
      image77.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[8,7]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image76Click(Sender: TObject);
begin
if tab[8,6] = 0 then
begin
  if vez = true then
    begin
      image76.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[8,6]:=2;
    end
  else
    begin
      image76.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[8,6]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image75Click(Sender: TObject);
begin
if tab[8,5] = 0 then
begin
  if vez = true then
    begin
      image75.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[8,5]:=2;
    end
  else
    begin
      image75.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[8,5]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image74Click(Sender: TObject);
begin
if tab[8,4] = 0 then
begin
  if vez = true then
    begin
      image74.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[8,4]:=2;
    end
  else
    begin
      image74.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[8,4]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image73Click(Sender: TObject);
begin
if tab[8,3] = 0 then
begin
  if vez = true then
    begin
      image73.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[8,3]:=2;
    end
  else
    begin
      image73.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[8,3]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image72Click(Sender: TObject);
begin
if tab[8,2] = 0 then
begin
  if vez = true then
    begin
      image72.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[8,2]:=2;
    end
  else
    begin
      image72.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[8,2]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image71Click(Sender: TObject);
begin
if tab[8,1] = 0 then
begin
  if vez = true then
    begin
      image71.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[8,1]:=2;
    end
  else
    begin
      image71.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[8,1]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image70Click(Sender: TObject);
begin
if tab[7,10] = 0 then
begin
  if vez = true then
    begin
      image70.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[7,10]:=2;
    end
  else
    begin
      image70.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[7,10]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image69Click(Sender: TObject);
begin
if tab[7,9] = 0 then
begin
  if vez = true then
    begin
      image69.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[7,9]:=2;
    end
  else
    begin
      image69.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[7,9]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image68Click(Sender: TObject);
begin
if tab[7,8] = 0 then
begin
  if vez = true then
    begin
      image68.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[7,8]:=2;
    end
  else
    begin
      image68.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[7,8]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image67Click(Sender: TObject);
begin
if tab[7,7] = 0 then
begin
  if vez = true then
    begin
      image67.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[7,7]:=2;
    end
  else
    begin
      image67.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[7,7]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image66Click(Sender: TObject);
begin
if tab[7,6] = 0 then
begin
  if vez = true then
    begin
      image66.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[7,6]:=2;
    end
  else
    begin
      image66.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[7,6]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image65Click(Sender: TObject);
begin
if tab[7,5] = 0 then
begin
  if vez = true then
    begin
      image65.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[7,5]:=2;
    end
  else
    begin
      image65.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[7,5]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image64Click(Sender: TObject);
begin
if tab[7,4] = 0 then
begin
  if vez = true then
    begin
      image64.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[7,4]:=2;
    end
  else
    begin
      image64.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[7,4]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image63Click(Sender: TObject);
begin
if tab[7,3] = 0 then
begin
  if vez = true then
    begin
      image63.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[7,3]:=2;
    end
  else
    begin
      image63.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[7,3]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image62Click(Sender: TObject);
begin
if tab[7,2] = 0 then
begin
  if vez = true then
    begin
      image62.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[7,2]:=2;
    end
  else
    begin
      image62.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[7,2]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image61Click(Sender: TObject);
begin
if tab[7,1] = 0 then
begin
  if vez = true then
    begin
      image61.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[7,1]:=2;
    end
  else
    begin
      image61.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[7,1]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image60Click(Sender: TObject);
begin
if tab[6,10] = 0 then
begin
  if vez = true then
    begin
      image60.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[6,10]:=2;
    end
  else
    begin
      image60.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[6,10]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image59Click(Sender: TObject);
begin
if tab[6,9] = 0 then
begin
  if vez = true then
    begin
      image59.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[6,9]:=2;
    end
  else
    begin
      image59.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[6,9]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image58Click(Sender: TObject);
begin
if tab[6,8] = 0 then
begin
  if vez = true then
    begin
      image58.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[6,8]:=2;
    end
  else
    begin
      image58.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[6,8]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image57Click(Sender: TObject);
begin
if tab[6,7] = 0 then
begin
  if vez = true then
    begin
      image57.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[6,7]:=2;
    end
  else
    begin
      image57.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[6,7]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image56Click(Sender: TObject);
begin
if tab[6,6] = 0 then
begin
  if vez = true then
    begin
      image56.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[6,6]:=2;
    end
  else
    begin
      image56.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[6,6]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image55Click(Sender: TObject);
begin
if tab[6,5] = 0 then
begin
  if vez = true then
    begin
      image55.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[6,5]:=2;
    end
  else
    begin
      image55.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[6,5]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image54Click(Sender: TObject);
begin
if tab[6,4] = 0 then
begin
  if vez = true then
    begin
      image54.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[6,4]:=2;
    end
  else
    begin
      image54.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[6,4]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image53Click(Sender: TObject);
begin
if tab[6,3] = 0 then
begin
  if vez = true then
    begin
      image53.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[6,3]:=2;
    end
  else
    begin
      image53.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[6,3]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image52Click(Sender: TObject);
begin
if tab[6,2] = 0 then
begin
  if vez = true then
    begin
      image52.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[6,2]:=2;
    end
  else
    begin
      image52.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[6,2]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image51Click(Sender: TObject);
begin
if tab[6,1] = 0 then
begin
  if vez = true then
    begin
      image51.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[6,1]:=2;
    end
  else
    begin
      image51.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[6,1]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image50Click(Sender: TObject);
begin
if tab[5,10] = 0 then
begin
  if vez = true then
    begin
      image50.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[5,10]:=2;
    end
  else
    begin
      image50.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[5,10]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image49Click(Sender: TObject);
begin
if tab[5,9] = 0 then
begin
  if vez = true then
    begin
      image49.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[5,9]:=2;
    end
  else
    begin
      image49.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[5,9]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image48Click(Sender: TObject);
begin
if tab[5,8] = 0 then
begin
  if vez = true then
    begin
      image48.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[5,8]:=2;
    end
  else
    begin
      image48.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[5,8]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image47Click(Sender: TObject);
begin
if tab[5,7] = 0 then
begin
  if vez = true then
    begin
      image47.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[5,7]:=2;
    end
  else
    begin
      image47.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[5,7]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image46Click(Sender: TObject);
begin
if tab[5,6] = 0 then
begin
  if vez = true then
    begin
      image46.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[5,6]:=2;
    end
  else
    begin
      image46.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[5,6]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image45Click(Sender: TObject);
begin
if tab[5,5] = 0 then
begin
  if vez = true then
    begin
      image45.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[5,5]:=2;
    end
  else
    begin
      image45.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[5,5]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image44Click(Sender: TObject);
begin
if tab[5,4] = 0 then
begin
  if vez = true then
    begin
      image44.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[5,4]:=2;
    end
  else
    begin
      image44.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[5,4]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image43Click(Sender: TObject);
begin
if tab[5,3] = 0 then
begin
  if vez = true then
    begin
      image43.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[5,7]:=2;
    end
  else
    begin
      image43.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[5,3]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image42Click(Sender: TObject);
begin
if tab[5,2] = 0 then
begin
  if vez = true then
    begin
      image42.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[5,2]:=2;
    end
  else
    begin
      image42.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[5,2]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image41Click(Sender: TObject);
begin
if tab[5,1] = 0 then
begin
  if vez = true then
    begin
      image41.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[5,1]:=2;
    end
  else
    begin
      image41.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[5,1]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image40Click(Sender: TObject);
begin
if tab[4,10] = 0 then
begin
  if vez = true then
    begin
      image40.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[4,10]:=2;
    end
  else
    begin
      image40.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[4,10]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image39Click(Sender: TObject);
begin
if tab[4,9] = 0 then
begin
  if vez = true then
    begin
      image39.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[4,9]:=2;
    end
  else
    begin
      image39.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[4,9]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image38Click(Sender: TObject);
begin
if tab[4,8] = 0 then
begin
  if vez = true then
    begin
      image38.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[4,8]:=2;
    end
  else
    begin
      image38.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[4,8]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image37Click(Sender: TObject);
begin
if tab[4,7] = 0 then
begin
  if vez = true then
    begin
      image37.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[4,7]:=2;
    end
  else
    begin
      image37.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[4,7]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image36Click(Sender: TObject);
begin
if tab[4,6] = 0 then
begin
  if vez = true then
    begin
      image36.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[4,6]:=2;
    end
  else
    begin
      image36.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[4,6]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image35Click(Sender: TObject);
begin
if tab[4,5] = 0 then
begin
  if vez = true then
    begin
      image35.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[4,5]:=2;
    end
  else
    begin
      image35.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[4,5]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image34Click(Sender: TObject);
begin
if tab[4,4] = 0 then
begin
  if vez = true then
    begin
      image34.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[4,4]:=2;
    end
  else
    begin
      image34.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[4,4]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image33Click(Sender: TObject);
begin
if tab[4,3] = 0 then
begin
  if vez = true then
    begin
      image33.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[4,3]:=2;
    end
  else
    begin
      image33.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[4,3]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image32Click(Sender: TObject);
begin
if tab[4,2] = 0 then
begin
  if vez = true then
    begin
      image32.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[4,2]:=2;
    end
  else
    begin
      image32.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[4,2]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image31Click(Sender: TObject);
begin
if tab[4,1] = 0 then
begin
  if vez = true then
    begin
      image31.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[4,1]:=2;
    end
  else
    begin
      image31.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[4,1]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image21Click(Sender: TObject);
begin
if tab[3,1] = 0 then
begin
  if vez = true then
    begin
      image21.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[3,1]:=2;
    end
  else
    begin
      image21.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[3,1]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image22Click(Sender: TObject);
begin
if tab[3,2] = 0 then
begin
  if vez = true then
    begin
      image22.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[3,2]:=2;
    end
  else
    begin
      image22.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[3,2]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image30Click(Sender: TObject);
begin
if tab[3,10] = 0 then
begin
  if vez = true then
    begin
      image30.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[3,10]:=2;
    end
  else
    begin
      image30.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[3,10]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image29Click(Sender: TObject);
begin
if tab[3,9] = 0 then
begin
  if vez = true then
    begin
      image29.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[3,9]:=2;
    end
  else
    begin
      image29.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[3,9]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image28Click(Sender: TObject);
begin
if tab[3,8] = 0 then
begin
  if vez = true then
    begin
      image28.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[3,8]:=2;
    end
  else
    begin
      image28.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[3,8]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image27Click(Sender: TObject);
begin
if tab[3,7] = 0 then
begin
  if vez = true then
    begin
      image27.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[3,7]:=2;
    end
  else
    begin
      image27.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[3,7]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image26Click(Sender: TObject);
begin
if tab[3,6] = 0 then
begin
  if vez = true then
    begin
      image26.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[3,6]:=2;
    end
  else
    begin
      image26.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[3,6]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image25Click(Sender: TObject);
begin
if tab[3,5] = 0 then
begin
  if vez = true then
    begin
      image25.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[3,5]:=2;
    end
  else
    begin
      image25.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[3,5]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image24Click(Sender: TObject);
begin
if tab[3,4] = 0 then
begin
  if vez = true then
    begin
      image24.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[3,4]:=2;
    end
  else
    begin
      image24.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[3,4]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image23Click(Sender: TObject);
begin
if tab[3,3] = 0 then
begin
  if vez = true then
    begin
      image23.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[3,3]:=2;
    end
  else
    begin
      image23.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[3,3]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image20Click(Sender: TObject);
begin
if tab[2,10] = 0 then
begin
  if vez = true then
    begin
      image20.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[2,10]:=2;
    end
  else
    begin
      image20.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[2,10]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image19Click(Sender: TObject);
begin
if tab[2,9] = 0 then
begin
  if vez = true then
    begin
      image19.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[2,9]:=2;
    end
  else
    begin
      image19.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[2,9]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image18Click(Sender: TObject);
begin
if tab[2,8] = 0 then
begin
  if vez = true then
    begin
      image18.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[2,8]:=2;
    end
  else
    begin
      image18.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[2,8]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image17Click(Sender: TObject);
begin
if tab[2,7] = 0 then
begin
  if vez = true then
    begin
      image17.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[2,7]:=2;
    end
  else
    begin
      image17.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[2,7]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image16Click(Sender: TObject);
begin
if tab[2,6] = 0 then
begin
  if vez = true then
    begin
      image16.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[2,6]:=2;
    end
  else
    begin
      image16.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[2,6]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image15Click(Sender: TObject);
begin
if tab[2,5] = 0 then
begin
  if vez = true then
    begin
      image15.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[2,5]:=2;
    end
  else
    begin
      image15.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[2,5]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image14Click(Sender: TObject);
begin
if tab[2,4] = 0 then
begin
  if vez = true then
    begin
      image14.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[2,4]:=2;
    end
  else
    begin
      image14.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[2,4]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image13Click(Sender: TObject);
begin
if tab[2,3] = 0 then
begin
  if vez = true then
    begin
      image13.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[2,3]:=2;
    end
  else
    begin
      image13.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[2,3]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image12Click(Sender: TObject);
begin
if tab[2,2] = 0 then
begin
  if vez = true then
    begin
      image12.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[2,2]:=2;
    end
  else
    begin
      image12.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[2,2]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image11Click(Sender: TObject);
begin
if tab[2,1] = 0 then
begin
  if vez = true then
    begin
      image11.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[2,1]:=2;
    end
  else
    begin
      image11.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[2,1]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image10Click(Sender: TObject);
begin
if tab[1,10] = 0 then
begin
  if vez = true then
    begin
      image10.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[1,10]:=2;
    end
  else
    begin
      image10.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[1,10]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image9Click(Sender: TObject);
begin
if tab[1,9] = 0 then
begin
  if vez = true then
    begin
      image9.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[1,9]:=2;
    end
  else
    begin
      image9.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[1,9]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image8Click(Sender: TObject);
begin
if tab[1,8] = 0 then
begin
  if vez = true then
    begin
      image8.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[1,8]:=2;
    end
  else
    begin
      image8.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[1,8]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image7Click(Sender: TObject);
begin
if tab[1,7] = 0 then
begin
  if vez = true then
    begin
      image7.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[1,7]:=2;
    end
  else
    begin
      image7.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[1,7]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image6Click(Sender: TObject);
begin
if tab[1,6] = 0 then
begin
  if vez = true then
    begin
      image6.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[1,6]:=2;
    end
  else
    begin
      image6.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[1,6]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image5Click(Sender: TObject);
begin
if tab[1,5] = 0 then
begin
  if vez = true then
    begin
      image5.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[1,5]:=2;
    end
  else
    begin
      image5.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[1,5]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image4Click(Sender: TObject);
begin
if tab[1,4] = 0 then
begin
  if vez = true then
    begin
      image4.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[1,4]:=2;
    end
  else
    begin
      image4.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[1,4]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image3Click(Sender: TObject);
begin
if tab[1,3] = 0 then
begin
  if vez = true then
    begin
      image3.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[1,3]:=2;
    end
  else
    begin
      image3.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[1,3]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image2Click(Sender: TObject);
begin
if tab[1,2] = 0 then
begin
  if vez = true then
    begin
      image2.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[1,2]:=2;
    end
  else
    begin
      image2.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[1,2]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Image1Click(Sender: TObject);
begin
if tab[1,1] = 0 then
begin
  if vez = true then
    begin
      image1.Picture.LoadFromFile('bola_azul.bmp');
      vez:=false;
      tab[1,1]:=2;
    end
  else
    begin
      image1.Picture.LoadFromFile('bola_vermelha.bmp');
      vez:=true;
      tab[1,1]:=1;
    end;
end;
timer1.Enabled:=true;
end;

procedure TForm1.Timer1Timer(Sender: TObject);
var
i,j:integer;
begin
for i:= 1 to 8 do
  begin
    for j:= 1 to 10 do
      begin
        if  ((tab[i,j]
        and tab[i,j+1]
        and tab[i,j+2]
        and tab[i,j+3]= 1)
        or (tab[i,j]
        and tab[i+1,j]
        and tab[i+2,j]
        and tab[i+3,j]= 1)
        or (tab[i,j]
        and tab[i+1,j+1]
        and tab[i+2,j+2]
        and tab[i+3,j+3]= 1)
        or (tab[i,j]
        and tab[i-1,j+1]
        and tab[i-2,j+2]
        and tab[i-3,j+3]= 1))then
          begin
            label4.Visible:=true;
            label4.caption:='Você venceu ' + edit1.Text +'!';
            timer2.Enabled:=true;
            form2.Show;
          end
        else
          begin
            if  ((tab[i,j]
            and tab[i,j+1]
            and tab[i,j+2]
            and tab[i,j+3]= 2)
            or (tab[i,j]
            and tab[i+1,j]
            and tab[i+2,j]
            and tab[i+3,j]= 2)
            or (tab[i,j]
            and tab[i+1,j+1]
            and tab[i+2,j+2]
            and tab[i+3,j+3]= 2)
            or (tab[i,j]
            and tab[i-1,j+1]
            and tab[i-2,j+2]
            and tab[i-3,j+3]= 2))then
              begin
                label4.Visible:=true;
                label4.caption:='Você venceu ' + edit2.Text +'!';
                timer2.Enabled:=true;
                form2.Show;
              end;
          end;
      end;
  end;
timer1.Enabled:=false;
end;

procedure TForm1.Timer2Timer(Sender: TObject);
var
i,j:integer;
begin
for i:=1 to 8 do
  begin
    for j:=1 to 10 do
      begin
        tab[i,j]:=0;
      end;
  end;
timer2.Enabled:=false;
end;

end.


