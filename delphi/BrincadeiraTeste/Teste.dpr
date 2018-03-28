program Teste;

uses
  Forms,
  UTeste in 'UTeste.pas' {frmTeste};

{$R *.res}

begin
  Application.Initialize;
  Application.CreateForm(TfrmTeste, frmTeste);
  Application.Run;
end.
