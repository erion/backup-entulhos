unit Unit2;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, StdCtrls;

type
  TForm2 = class(TForm)
    Label1: TLabel;
    Button1: TButton;
    Button2: TButton;
    procedure Button1Click(Sender: TObject);
    procedure Button2Click(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  Form2: TForm2;

implementation

uses ubola;

{$R *.dfm}

procedure TForm2.Button1Click(Sender: TObject);
begin
form1.edit1.text:='';
form1.edit2.text:='';
form1.label4.Visible:=false;
form1.Image1.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image2.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image3.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image4.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image5.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image6.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image7.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image8.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image9.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image10.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image11.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image12.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image13.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image14.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image15.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image16.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image17.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image18.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image19.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image20.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image21.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image22.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image23.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image24.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image25.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image26.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image27.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image28.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image29.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image30.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image31.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image32.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image33.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image34.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image35.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image36.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image37.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image38.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image39.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image40.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image41.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image42.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image43.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image44.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image45.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image46.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image47.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image48.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image49.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image50.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image51.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image52.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image53.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image54.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image55.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image56.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image57.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image58.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image59.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image60.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image61.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image62.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image63.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image64.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image65.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image66.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image67.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image68.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image69.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image70.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image71.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image72.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image73.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image74.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image75.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image76.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image77.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image78.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image79.Picture.LoadFromFile('tabuleiro.bmp');
form1.Image80.Picture.LoadFromFile('tabuleiro.bmp');
form2.Close;
end;

procedure TForm2.Button2Click(Sender: TObject);
begin
form1.Close;
end;

end.
