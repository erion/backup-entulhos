program Pokemon;

uses
  Forms,
  UBatalha in 'UBatalha.pas' {frmBatalha};

{$R *.res}

begin
  Application.Initialize;
  Application.CreateForm(TfrmBatalha, frmBatalha);
  Application.Run;
end.
