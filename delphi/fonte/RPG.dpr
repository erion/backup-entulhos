program RPG;

uses
  Forms,
  Urpg in 'Urpg.pas' {Form1},
  Urpg2 in 'Urpg2.pas' {Form2},
  Urpg3ajuda in 'Urpg3ajuda.pas' {Form3},
  Unit4 in 'Unit4.pas' {Form4},
  uitem in 'uitem.pas' {Form5},
  Unit6 in 'Unit6.pas' {Form6},
  Urpg7mapa in 'Urpg7mapa.pas' {Form7};

{$R *.res}

begin
  Application.Initialize;
  Application.CreateForm(TForm1, Form1);
  Application.CreateForm(TForm2, Form2);
  Application.CreateForm(TForm3, Form3);
  Application.CreateForm(TForm4, Form4);
  Application.CreateForm(TForm5, Form5);
  Application.CreateForm(TForm6, Form6);
  Application.CreateForm(TForm7, Form7);
  Application.Run;
end.
