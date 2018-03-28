unit Unit3;

interface

uses Classes;

type
  TContador = class(TThread)
  protected
    procedure Execute; override;
end;

implementation

uses Unit2;

procedure TContador.Execute;
var i:Integer;
begin
  Priority := tpLower;
  Form2.ProgressBar1.Max := 1000000;
  for i := 1 to Form2.ProgressBar1.Max do
    Form2.ProgressBar1.Position := i;
end;

end.
 