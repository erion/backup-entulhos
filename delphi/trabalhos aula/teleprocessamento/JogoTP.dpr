program JogoTP;

uses
  Forms,
  UJogo in 'UJogo.pas' {fmJogoTP};

{$R *.res}

begin
  Application.Initialize;
  Application.CreateForm(TfmJogoTP, fmJogoTP);
  Application.Run;
end.
