unit Unit4;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs,urpg, ExtCtrls,qt, StdCtrls, Menus;

type
  TForm4 = class(TForm)
    Image1: TImage;
    Image2: TImage;
    Image3: TImage;
    Image4: TImage;
    Button1: TButton;
    Image5: TImage;
    Image6: TImage;
    Label1: TLabel;
    Label2: TLabel;
    Image7: TImage;
    Timer1: TTimer;
    Image8: TImage;
    Timer2: TTimer;
    procedure Image1MouseMove(Sender: TObject; Shift: TShiftState; X,
      Y: Integer);
    procedure Image3MouseMove(Sender: TObject; Shift: TShiftState; X,
      Y: Integer);
    procedure Image4MouseMove(Sender: TObject; Shift: TShiftState; X,
      Y: Integer);
    procedure FormShow(Sender: TObject);
    procedure Button1Click(Sender: TObject);
    procedure Image7MouseMove(Sender: TObject; Shift: TShiftState; X,
      Y: Integer);
    procedure Timer1Timer(Sender: TObject);
    procedure inventario1Click(Sender: TObject);
    procedure Button2Click(Sender: TObject);
    procedure Image2Click(Sender: TObject);
    procedure Image1Click(Sender: TObject);
    procedure Timer2Timer(Sender: TObject);
    procedure Image8MouseMove(Sender: TObject; Shift: TShiftState; X,
      Y: Integer);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  Form4: TForm4;

implementation

uses Urpg2, Uitem, Unit6;

{$R *.dfm}

procedure TForm4.Image1MouseMove(Sender: TObject; Shift: TShiftState; X,
  Y: Integer);
begin
if y < 535 then
        image2.Top:= y
else
        image2.Top:= 535;
if x < 790 then
        image2.Left:= x
else
        image2.Left:=790;
end;

procedure TForm4.Image3MouseMove(Sender: TObject; Shift: TShiftState; X,
  Y: Integer);
begin
  showmessage('Fantasma atacou...');
  inimigo:=1;
  form2.showmodal;
  form2.Timer4.Enabled:=true;
end;

procedure TForm4.Image4MouseMove(Sender: TObject; Shift: TShiftState; X,
  Y: Integer);
begin
  showmessage('Uma caverna cheia de ursos!!!');
  inimigo:=2;
  form2.Showmodal;
  form2.Timer4.Enabled:=true;
end;

procedure TForm4.FormShow(Sender: TObject);
begin
  case form1.RadioGroup1.ItemIndex of
  0:begin
          image2.Picture.LoadFromFile('tamanho_boneco.bmp');
    end;
  1:begin
          image2.Picture.LoadFromFile('ladrao.bmp');
    end;
  2:begin
          image2.Picture.LoadFromFile('ranger.bmp');
    end;
  3:begin
          image2.Picture.LoadFromFile('barbaro.bmp');
    end;
  end;
end;

procedure TForm4.Button1Click(Sender: TObject);
begin
  form1.Close;
end;

procedure TForm4.Image7MouseMove(Sender: TObject; Shift: TShiftState; X,
  Y: Integer);
begin
  showmessage('Olá, sempre vendo itens para malucos aventureiros como você...Quer comprar algo?');
  form5.showmodal;
end;

procedure TForm4.Timer1Timer(Sender: TObject);
begin
  label2.Caption:=inttostr(po);
end;

procedure TForm4.inventario1Click(Sender: TObject);
begin
  form6.showmodal;
end;

procedure TForm4.Button2Click(Sender: TObject);
begin
  form6.ShowModal;
end;

procedure TForm4.Image2Click(Sender: TObject);
begin
  form6.ShowModal;
end;

procedure TForm4.Image1Click(Sender: TObject);
begin
  form6.ShowModal;
end;

procedure TForm4.Timer2Timer(Sender: TObject);
begin
  image8.Visible:=true;
end;

procedure TForm4.Image8MouseMove(Sender: TObject; Shift: TShiftState; X,
  Y: Integer);
begin
  showmessage('A árvore é um ente! E ela acordou furiosa!!!!');
  inimigo:=4;
  form2.showmodal;
  form2.Timer4.Enabled:=true;
end;

end.
