program Balak;

uses
  Forms,
  Ujog_balak in 'Ujog_balak.pas' {Form1},
  Ujo_balak2 in 'Ujo_balak2.pas' {Form2};

{$R *.res}

begin
  Application.Initialize;
  Application.CreateForm(TForm1, Form1);
  Application.CreateForm(TForm2, Form2);
  Application.Run;
end.
