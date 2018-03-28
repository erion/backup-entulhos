unit UGansosWin;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, jpeg, ExtCtrls, StdCtrls;

type
  TfrmGansoWin = class(TForm)
    Panel1: TPanel;
    Image1: TImage;
    Label1: TLabel;
    procedure FormClose(Sender: TObject; var Action: TCloseAction);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  frmGansoWin: TfrmGansoWin;

implementation

{$R *.dfm}

procedure TfrmGansoWin.FormClose(Sender: TObject;
  var Action: TCloseAction);
begin
  Application.Terminate;
end;

end.
