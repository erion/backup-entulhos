unit UPedidoSeguro;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, Grids, DBGrids, StdCtrls, Mask, ExtCtrls, ComCtrls, DBCtrls;

type
  TfrmPedidoSeguro = class(TForm)
    StatusBar1: TStatusBar;
    Panel1: TPanel;
    Label1: TLabel;
    Label2: TLabel;
    Label3: TLabel;
    Label4: TLabel;
    Label5: TLabel;
    Label6: TLabel;
    Edit1: TEdit;
    MaskEdit1: TMaskEdit;
    Edit2: TEdit;
    Edit3: TEdit;
    ComboBox1: TComboBox;
    Edit4: TEdit;
    GroupBox1: TGroupBox;
    DBGrid1: TDBGrid;
    DBNavigator1: TDBNavigator;
    Edit5: TEdit;
    Label7: TLabel;
    Label8: TLabel;
  private
    { Private declarations }
  public
    { Public declarations }
  end;

var
  frmPedidoSeguro: TfrmPedidoSeguro;

implementation

{$R *.dfm}

end.
