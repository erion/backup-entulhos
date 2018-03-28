program JogoRaposa;

uses
  Forms,
  UJogoRaposa in 'UJogoRaposa.pas' {frmJogo},
  UClasses in 'UClasses.pas',
  URaposaWin in 'URaposaWin.pas' {frmRaposaWin},
  UGansosWin in 'UGansosWin.pas' {frmGansoWin};

{$R *.res}

begin
  Application.Initialize;
  Application.CreateForm(TfrmJogo, frmJogo);
  Application.CreateForm(TfrmRaposaWin, frmRaposaWin);
  Application.CreateForm(TfrmGansoWin, frmGansoWin);
  Application.Run;
end.
