program Agentes;

uses
  Forms,
  UAgentes in 'UAgentes.pas' {frmAgentes},
  UClasses in 'UClasses.pas';

{$R *.res}

begin
  Application.Initialize;
  Application.CreateForm(TfrmAgentes, frmAgentes);
  Application.Run;
end.
