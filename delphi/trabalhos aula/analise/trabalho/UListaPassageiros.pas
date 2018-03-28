unit UListaPassageiros;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, StdCtrls, Mask, Grids, DBGrids, ExtCtrls, ComCtrls, DBCtrls;

type
  TfrmListaPassageiros = class(TForm)
    StatusBar1: TStatusBar;
    Panel1: TPanel;
    Label1: TLabel;
    Edit1: TEdit;
    Label2: TLabel;
    Edit2: TEdit;
    Label3: TLabel;
    Label4: TLabel;
    Label5: TLabel;
    Edit5: TEdit;
    DBGrid1: TDBGrid;
    MaskEdit1: TMaskEdit;
    ComboBox1: TComboBox;
    DBNavigator1: TDBNavigator;
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  frmListaPassageiros: TfrmListaPassageiros;

implementation

{$R *.dfm}

end.
