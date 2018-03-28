program velha;

uses
  Forms,
  jogodavelha in 'jogodavelha.pas' {Form1},
  ujv_2 in 'ujv_2.pas' {Form2};

{$R *.res}

begin
  Application.Initialize;
  Application.CreateForm(TForm1, Form1);
  Application.CreateForm(TForm2, Form2);
  Application.Run;
end.
