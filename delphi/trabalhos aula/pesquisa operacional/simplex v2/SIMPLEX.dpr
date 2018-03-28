program SIMPLEX;

uses
  Forms,
  USimplex in 'USimplex.pas' {frmSimplex};

{$R *.res}

begin
  Application.Initialize;
  Application.CreateForm(TfrmSimplex, frmSimplex);
  Application.Run;
end.
