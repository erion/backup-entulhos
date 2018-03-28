unit USenha;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, ExtCtrls, Qtypes, StdCtrls;

type
  TForm1 = class(TForm)
    Timer1: TTimer;
    Edit1: TEdit;
    procedure Timer1Timer(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  Form1: TForm1;
  WndHint: THintWindow = nil;

implementation

{$R *.dfm}

procedure TForm1.Timer1Timer(Sender: TObject);
var
Pos: TPoint;
HWin: THandle;
Paswd: Array [0..63] of Char;
R: TRect;
begin
  GetCursorPos (Pos);
  HWin := WindowFromPoint (Pos);
    if SendMessage (HWin, EM_GETPASSWORDCHAR, 0, 0) <> 0 then
      begin
        if WndHint = nil then
          begin
            WndHint := THintWindow.Create (Self);
            WndHint.Color := clInfoBk;
            SendMessage (HWin, WM_GETTEXT, 64, Longint (@Paswd));
            R := Rect (Pos.X, Pos.Y + 18, Pos.X +
            WndHint.Canvas.TextWidth (Paswd) + 8,
            Pos.Y + 18 + WndHint.Canvas.TextHeight (Paswd));
            WndHint.ActivateHint (R, Paswd);
          end;
      end
      else
        begin
          WndHint.ReleaseHandle;
          WndHint := nil;
        end;
end;

end.
