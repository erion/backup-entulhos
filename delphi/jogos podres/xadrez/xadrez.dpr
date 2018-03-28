program xadrez;

uses
  Forms,
  uxadrez in 'uxadrez.pas' {Form1},
  Uxadrez_movimento in 'Uxadrez_movimento.pas' {Form2};

{$R *.res}

begin
  Application.Initialize;
  Application.CreateForm(TForm1, Form1);
  Application.CreateForm(TForm2, Form2);
  Application.Run;
end.
