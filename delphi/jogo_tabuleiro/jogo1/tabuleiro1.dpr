program tabuleiro1;

uses
  Forms,
  utabu1 in 'utabu1.pas' {Form1},
  utabu2 in 'utabu2.pas' {Form2},
  uinfo in 'uinfo.pas' {Form3},
  utabu3 in 'utabu3.pas' {Form4};

{$R *.res}

begin
  Application.Initialize;
  Application.CreateForm(TForm1, Form1);
  Application.CreateForm(TForm2, Form2);
  Application.CreateForm(TForm3, Form3);
  Application.CreateForm(TForm4, Form4);
  Application.Run;
end.
