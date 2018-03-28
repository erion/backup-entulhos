program Xadrez_v4;

uses
  Forms,
  uxdrz in 'uxdrz.pas' {fmXadrez},
  UXdrzClasses in 'UXdrzClasses.pas';

{$R *.res}

begin
  Application.Initialize;
  Application.CreateForm(TfmXadrez, fmXadrez);
  Application.Run;
end.
