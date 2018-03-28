unit Ujog_balak;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, StdCtrls, ExtCtrls;

type
  TForm1 = class(TForm)
    Label1: TLabel;
    Label2: TLabel;
    Label3: TLabel;
    Label4: TLabel;
    Label5: TLabel;
    Label6: TLabel;
    Label7: TLabel;
    Label8: TLabel;
    Label9: TLabel;
    Label10: TLabel;
    Label11: TLabel;
    Label12: TLabel;
    Timer1: TTimer;
    Image1: TImage;
    Image2: TImage;
    Timer2: TTimer;
    Image3: TImage;
    procedure Timer1Timer(Sender: TObject);
    procedure Timer2Timer(Sender: TObject);
    procedure Image3MouseMove(Sender: TObject; Shift: TShiftState; X,
      Y: Integer);
    procedure FormMouseMove(Sender: TObject; Shift: TShiftState; X,
      Y: Integer);
    procedure Image3Click(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  Form1: TForm1;

implementation

uses Ujo_balak2;

{$R *.dfm}

function cor():integer;
var
a:integer;
begin
a:= random(13+1);
case a of
0:begin
  cor := clblack;
  end;
1:begin
  cor := clmaroon;
  end;
2:begin
  cor := clgreen;
  end;
3:begin
  cor := clolive;
  end;
4:begin
  cor := clnavy;
  end;
5:begin
  cor := clpurple;
  end;
6:begin
  cor := clteal;
  end;
7:begin
  cor := clgray;
  end;
8:begin
  cor := clsilver;
  end;
9:begin
  cor := clred;
  end;
10:begin
   cor := cllime;
   end;
11:begin
   cor := clyellow;
   end;
12:begin
   cor := clblue;
   end;
13:begin
   cor := clFuchsia;
   end;
14:begin
   cor := claqua;
   end;
end;
end;

function centraliza():integer;
var
a:integer;
begin
a:=round((508)/2);
centraliza := a;
end;

procedure TForm1.Timer1Timer(Sender: TObject);
begin
{labels}
  label1.Font.Color:= cor();
  label1.Font.Size:= random(20+20);
  label1.Top:= centraliza;
{}
  label2.Font.Color:= cor();
  label2.Font.Size:= random(20+20);
  label2.Top:= centraliza;
{}
  label3.Font.Color:= cor();
  label3.Font.Size:= random(20+20);
  label3.Top:= centraliza;
{}
  label4.Font.Color:= cor();
  label4.Font.Size:= random(20+20);
  label4.Top:= centraliza;
{}
  label5.Font.Color:= cor();
  label5.Font.Size:= random(20+20);
  label5.Top:= centraliza;
{}
  label6.Font.Color:= cor();
  label6.Font.Size:= random(20+20);
  label6.Top:= centraliza;
{}
  label7.Font.Color:= cor();
  label7.Font.Size:= random(20+20);
  label7.Top:= centraliza;
{}
  label8.Font.Color:= cor();
  label8.Font.Size:= random(20+20);
  label8.Top:= centraliza;
{}
  label9.Font.Color:= cor();
  label9.Font.Size:= random(20+20);
  label9.Top:= centraliza;
{}
  label10.Font.Color:= cor();
  label10.Font.Size:= random(20+20);
  label10.Top:= centraliza;
{}
  label11.Font.Color:= cor();
  label11.Font.Size:= random(20+20);
  label11.Top:= centraliza;
{}
  label12.Font.Color:= cor();
  label12.Font.Size:= random(20+20);
  label12.Top:= centraliza;
end;

procedure TForm1.Timer2Timer(Sender: TObject);
begin
image1.left := image1.left + 10;
image2.left := image2.left - 10;
if image1.Left > 690 then
  begin
    image1.Left:= -180;
    image2.left:=  630;
  end;
end;

procedure TForm1.Image3MouseMove(Sender: TObject; Shift: TShiftState; X,
  Y: Integer);
begin
image3.Picture.LoadFromFile('inicia2.bmp');
end;

procedure TForm1.FormMouseMove(Sender: TObject; Shift: TShiftState; X,
  Y: Integer);
begin
image3.Picture.LoadFromFile('inicia1.bmp');
end;

procedure TForm1.Image3Click(Sender: TObject);
begin
form2.showmodal;
end;

end.
