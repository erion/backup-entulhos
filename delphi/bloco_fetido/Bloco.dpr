program Bloco;

uses
  Forms,
  ubloco in 'ubloco.pas' {Form1},
  Ufonte in 'Ufonte.pas' {Form2};

{$R *.res}

begin
  Application.Initialize;
  Application.CreateForm(TForm1, Form1);
  Application.CreateForm(TForm2, Form2);
  Application.Run;
end.
