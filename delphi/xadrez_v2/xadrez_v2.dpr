program xadrez_v2;

uses
  Forms,
  uxadr in 'uxadr.pas' {Form1};

{$R *.res}

begin
  Application.Initialize;
  Application.CreateForm(TForm1, Form1);
  Application.Run;
end.
